<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Attachment;
use Iba\Models\AttachmentTranslation;
use Iba\Models\Author;
use Iba\Models\Filetype;
use Iba\Models\Language;
use Iba\Models\License;
use Iba\Models\Level;
use Iba\Models\Object;
use Iba\Models\ObjectAuthor;
use Iba\Models\ObjectTag;
use Iba\Models\ObjectImage;
use Iba\Models\ObjectTranslation;
use Iba\Models\TagTranslation;
use Iba\Models\Thread;
use Iba\Models\Topic;
use Iba\Models\Type;
use Iba\Models\Tag;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Iba\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass;
use Validator;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;

class ObjetosController extends Controller
{

    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = Object::join('object_translations', 'object_translations.object_id', '=', 'objects.id')
            ->where('object_translations.locale', app()->getLocale())
            ->orderBy('date', 'desc')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.objetos.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Object',
            'table'             => 'objects',
            'table_translation' => 'object_translations',
            'fk'                => 'object_id',
            'exibir'            => 'S',
            'idiomas'           => Language::get(),
            'tipos_de_midia'    => Filetype::get(),
            'linhas'            => Thread::get(),
            'temas'             => Topic::get(),
            'view'              => $view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.objetos.edit', [
            'model'             => 'Object',
            'linhas'            => ControllerFront::linhas(),
            'temas'             => ControllerFront::temas(),
            'subtemas'          => ControllerFront::subtemas(),
            'autores'           => Author::get(),
            'created_by'        => User::get(),
            'licencas'          => License::get(),
            'nivel_escolar'     => Level::get(),
            'idiomas'           => Language::get(),
            'tipos_de_midia'    => Filetype::get(),
            'tipos_de_material' => Type::get(),
            'tags'              => Tag::get(),
            'imagem'            => '',
            'array_tags'        => (''),
            'array_autores'     => ('')
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Tabela pai
        $object_id = Object::create($request->all())->id;
        $object    = Object::find($object_id);
        $request->request->add(['object_id' => $object_id]);
        $request->date = date("Y-m-d", strtotime(str_replace('/', '-', $request->date)));

        //Imagem de capa se existir
        if ($request->base64_image != null) {
            //Removendo os dados da string base64 referente ao tipo de dado
            //data:image/jpeg;base64,...
            list($type, $data) = explode(';', $request->base64_image);
            list(, $data) = explode(',', $data);

            //Decodificando para binário
            $image = base64_decode($data);
            $fp    = fopen('uploads/biblioteca/capas/' . $object_id . '_m.jpg', 'wb+');
            fwrite($fp, $image);
            fclose($fp);

            $object->images()->delete();
            ObjectImage::create(['image'     => $object_id . '_m.jpg',
                                 'object_id' => $object_id]);

        }
        //Translation
        ObjectTranslation::create($request->all());


        //Novas tags
        if (!empty($request->novas_tags)) {
            $novas_tags = explode(',', $request->novas_tags);
            foreach ($novas_tags as $key => $value) {
                if (!empty($value)) {
                    $tag_id = Tag::create([])->id;

                    TagTranslation::create([
                        'name'       => $value,
                        'tag_id'     => $tag_id,
                        'created_by' => $request->created_by,
                        'locale'     => app()->getLocale()
                    ]);

                    $object->object_tags()->attach($tag_id);

                }
            }
        }
        //Tags
        if (!empty($request->array_tags))
            $object->object_tags()->attach(explode(',', $request->array_tags));
        //Object Levels (Escolaridade)
        if (!empty($request->object_levels))
            $object->object_levels()->attach($request->object_levels);
        //Object Author (Autores)
        if (!empty($request->array_autores))
            $object->object_author()->attach(
                explode(',', $request->array_autores), ['created_by' => $request->created_by]
            );


        //Novos Autores
        if (!empty($request->novos_autores)) {

            $novos_autores = explode(',', $request->novos_autores);

            foreach ($novos_autores as $key => $value) {
                if (!empty($value)) {

                    $author_id = Author::create([
                        'name'       => $value,
                        'created_by' => $request->created_by
                    ])->id;

                    $object->object_author()->attach($author_id);
                }
            }
        }

        //Gravando dados do arquivo (anexo) já enviado via ajax
        if (!empty($request->file_info_uploaded)) {

            $file = json_decode($request->file_info_uploaded);

            //Salvando em banco os dados do anexo
            $attachment_id = Attachment::create([
                'name'       => $request->title,
                'filename'   => $file->filename,
                'path'       => $file->path,
                'size'       => $file->size,
                'hash'       => $file->hash,
                'origin'     => $file->origin,
                'created_by' => $request->created_by
            ])->id;

            $object->attachment_object()->attach(['attachment_id' => $attachment_id], ['created_by' => $request->created_by]);

            //Renomeando arquivo para attachment_id.extensão
            rename("{$file->path}{$file->hash}", "{$file->path}{$attachment_id}.{$file->extension}");

        }

        //Salvando todos os dados associados ao objeto
        $object->save();

        return redirect(app()->getLocale() . '/admin/objetos')->with('success', 'Dados salvos com sucesso !');;

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $object = Object::find($id);

//        foreach($news->news_attachment as $a){
//            $array_anexos[] = $a->object_id;
//        }
        $id_tags    = ObjectTag::where('object_id', $id)->lists('tag_id')->toArray();
        $id_authors = ObjectAuthor::where('object_id', $id)->lists('author_id')->toArray();


        return view('admin.objetos.edit', [
            'objetos'           => $object,
            'model'             => 'Object',
            'linhas'            => ControllerFront::linhas(),
            'temas'             => ControllerFront::temas(),
            'subtemas'          => ControllerFront::subtemas(),
            'created_by'        => User::get(),
            'autores'           => Author::get(),
            'licencas'          => License::get(),
            'nivel_escolar'     => Level::get(),
            'idiomas'           => Language::get(),
            'tipos_de_midia'    => Filetype::get(),
            'tipos_de_material' => Type::get(),
            'tags'              => Tag::get(),
            'imagem'            => (isset($object->images->image) ? $object->images->image : ''),
            'array_tags'        => (!empty($id_tags) ? implode(',', $id_tags) : ''),
            'array_autores'     => (!empty($id_authors) ? implode(',', $id_authors) : ''),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo 'dddd';die;
        //-- Se na tela de listagem o usuário clicou para mudar o status do registro, o update é chamado via AJAX.
        //-- Caso contrário, o form está sendo atualizado pelo botão SALVAR
        if ($request->ajax()) {
            parent::update($request, $id);
        } else {
            $params         = $request->all();
            $params['date'] = date("Y-m-d", strtotime(str_replace('/', '-', $params['date'])));

            $objeto = Object::find($id);

            //Salvando imagem 'cropada'
            if ($params['base64_image'] != null) {

                //Removendo os dados da string base64 referente ao tipo de dado
                //data:image/jpeg;base64,...
                list($type, $data) = explode(';', $params['base64_image']);
                list(, $data) = explode(',', $data);

                //Decodificando para binário
                $image = base64_decode($data);
                $fp    = fopen('uploads/biblioteca/capas/' . $id . '_m.jpg', 'wb+');
                fwrite($fp, $image);
                fclose($fp);

                $objeto->images()->delete();
                ObjectImage::create(['image'     => $id . '_m.jpg',
                                     'object_id' => $id]);

            }


            $objeto->allow_seals  = $params['allow_seals'];
            $objeto->allow_collab = $params['allow_collab'];
            $objeto->public       = $params['public'];
            $objeto->license_id   = $params['license_id'];
            $objeto->type_id      = $params['type_id'];
            $objeto->filetype_id  = $params['filetype_id'];
            $objeto->thread_id    = $params['thread_id'];
            $objeto->topic_id     = $params['topic_id'];
            $objeto->subtopic_id  = $params['subtopic_id'];
            //$objeto->banner_id      = $params['banner_id'];
            $objeto->issn = $params['issn'];

            $objeto->title    = $params['title'];
            $objeto->preamble = $params['preamble'];
            $objeto->source   = $params['source'];
            $objeto->locale   = $params['locale'];
            $objeto->date     = $params['date'];

            if (isset($params['object_levels'])) {
                $objeto->object_levels()->detach();
                $objeto->object_levels()->attach($params['object_levels']);
            }


            //-- Associa tags já existentes ao objeto
            $objeto->object_tags()->detach();
            if (!empty($params['array_tags'])) {

                $array_tags = explode(',', $params['array_tags']);
                $objeto->object_tags()->attach($array_tags);
            }

            //-- Cria novas tags e faz a associação ao objeto
            if (!empty($params['novas_tags'])) {

                $novas_tags = explode(',', $params['novas_tags']);

                foreach ($novas_tags as $key => $value) {
                    if (!empty($value)) {

                        $tag_id = Tag::create([])->id;

                        TagTranslation::create([
                            'name'       => $value,
                            'tag_id'     => $tag_id,
                            'created_by' => $this->created_by,
                            'locale'     => app()->getLocale()
                        ]);

                        $objeto->object_tags()->attach($tag_id);
                    }
                }
            }


            //-- Associa autores já existentes ao objeto
            $objeto->object_author()->detach();
            if (!empty($params['array_autores'])) {

                $array_autores = explode(',', $params['array_autores']);
                $objeto->object_author()->attach($array_autores, ['created_by' => $this->created_by]);
            }

            //-- Cria novos autores e faz a associação ao objeto
            if (!empty($params['novos_autores'])) {

                $novos_autores = explode(',', $params['novos_autores']);

                foreach ($novos_autores as $key => $value) {
                    if (!empty($value)) {


                        $author_id = Author::create([
                            'name'       => $value,
                            'created_by' => $this->created_by
                        ])->id;

                        $objeto->object_author()->attach($author_id, ['created_by' => $this->created_by]);
                    }
                }
            }

            //Gravando dados do arquivo (anexo) já enviado via ajax (pt_br)
            if (!empty($request->file_info_uploaded)) {

                $file = json_decode($request->file_info_uploaded);

                //Localizando anexo anterior
                $attachment_id = $objeto->attachment_object[0]->id;
                $attachment    = Attachment::find($attachment_id);


                //Salvando em banco os dados do anexo
                $attachment->update([
                    'name'       => $request->title,
                    'filename'   => $file->filename,
                    'path'       => $file->path,
                    'size'       => $file->size,
                    'locale'     => 'pt_br',
                    'hash'       => $file->hash,
                    'origin'     => $file->origin,
                    'created_by' => $request->created_by
                ]);
                //Nome do arquivo attachment_id + locale
                $file_name_in_directory = "{$file->path}{$attachment_id}_pt_br.{$file->extension}";
                //Apaga arquivo anterior
                if (file_exists($file_name_in_directory))
                    unlink($file_name_in_directory);
                //Renomeando arquivo para attachment_id.extensão
                rename("{$file->path}{$file->hash}", "{$file_name_in_directory}");

            }



            if (!empty($request->title_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'title'     => $request->title_trad,
                    'locale'    => $request->language,
                    'preamble'  => $request->preamble_trad,
                    'source'    => $params['source'],
                    'created_by' => $this->created_by
                ];


                if ($objeto->translation->contains('locale', $request->language)) {

                    $translation = ObjectTranslation::where('object_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $objeto->translation()->create($params_trad);
                }

            }


            //Dados do anexo de tradução
            if (!empty($request->file_info_uploaded_translation)) {

                $file = json_decode($request->file_info_uploaded_translation);

                //Localizando anexo anterior
                $attachment_id = $objeto->attachment_object[0]->id;
                $attachment = Attachment::find($attachment_id);

                $attachment = $attachment->translation->where('locale',$request->language);



                $attachment_data = [
                    'name'       => $request->title_trad,
                    'filename'   => $file->filename,
                    'path'       => $file->path,
                    'size'       => $file->size,
                    'locale'     => $request->language,
                    'hash'       => $file->hash,
                    'origin'     => $file->origin,
                    'attachment_id' => $attachment_id,
                    'created_by' => $request->created_by
                ];


                //Salvando em banco os dados do anexo
                if($attachment->count() > 0){
                    //print_r($attachment[1]);die;
                    $attachment_translation = AttachmentTranslation::find($attachment[1]->id);


                    $attachment_translation->update($attachment_data);
                }
                else{
                    AttachmentTranslation::create($attachment_data);
                }
                //Nome do arquivo attachment_id + locale
                $file_name_in_directory = "{$file->path}{$attachment_id}_{$request->language}.{$file->extension}";
                //Apaga arquivo anterior
                if (file_exists($file_name_in_directory))
                    unlink($file_name_in_directory);
                //Renomeando arquivo para attachment_id.extensão
                rename("{$file->path}{$file->hash}", "{$file_name_in_directory}");

            }


            $objeto->save();

            // redirect
            //Session::flash('message', 'Successfully updated nerd!');
            return \Redirect::to(app()->getLocale() . '/admin/objetos')->with('success', 'Dados salvos com sucesso !');;

        }
    }

    /**
     * Upload do anexo via ajax, salvando com nome hash
     * Após o post normal renomeia o hash para o id do attachment
     * @param Request $request
     * @return mixed
     */
    public function uploadAnexo(Request $request)
    {
        //Verificando upload pt_br
        if ($request->hasFile('files'))
            $files = $request->file('files');
        //Upload de translation
        if ($request->hasFile('file_translation'))
            $files = $request->file('file_translation');

        if (!empty($files)) {

            $file            = new \stdClass();
            $file->path      = 'uploads/biblioteca/';
            $file->filename  = $files->getClientOriginalName();
            $file->extension = $files->getClientOriginalExtension();
            $file->size      = $files->getSize();
            $file->mime      = $files->getClientMimeType();
            $file->origin    = 'telescope';
            $file->hash      = md5($file->filename . $file->size);

            try {
                //Gravando arquivo com hash temporário no diretório
                $files->move($file->path, "{$file->hash}");
            } catch (Exception $exception) {
                return response()->json($exception, 400);
            }

            return response()->json(array('file_info_uploaded' => $file), 200);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }
}
