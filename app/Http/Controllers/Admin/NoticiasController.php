<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Filetype;
use Iba\Models\Language;
use Iba\Models\News;
use Iba\Models\NewsEditorial;
use Iba\Models\CmsHighlight;
use Iba\Models\CmsObjectAttachment;
use Iba\Models\NewsImage;
use Iba\Models\NewsTag;
use Iba\Models\NewsTranslation;
use Iba\Models\Object;
use Iba\Models\Tag;
use Iba\Models\TagTranslation;
use Iba\Models\ProjectActivity;
use Iba\Models\ProjectSituation;
use Iba\Models\ProjectType;
use Iba\Models\Thread;
use Iba\Models\Topic;
use Iba\Models\UserGroup;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Iba\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;

class NoticiasController extends Controller
{

    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->where('news_translations.locale', app()->getLocale())
            ->paginate($this->itens_por_pagina);

        $view = 'admin.noticias.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'News',
            'table'             => 'news',
            'table_translation' => 'news_translations',
            'fk'                => 'news_id',
            'exibir'            => 'S',
            'editorias'         => NewsEditorial::get(),
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
        //return view('admin.noticias.edit',[ 'editorias'         => NewsEditorial::get()]);

        return view('admin.noticias.edit', [
            'editorias' => NewsEditorial::get(),
            'idiomas'   => Language::get(),
            'tags'      => Tag::get(),
            'array_tags'=> (''),
            'linhas'    => ControllerFront::linhas(),
            'temas'     => ControllerFront::temas(),
            'subtemas'  => ControllerFront::subtemas()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destaques()
    {
        $resultados = News::join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->where('news_translations.locale', app()->getLocale())->get();

        foreach ($resultados as $p) {
            if (count($p->cms_highlights) > 0) {
                foreach ($p->cms_highlights as $key => $r) {
                    //print_r($r->position . ' - ' . $r->record_id);
                    if ($r->position == 'h1') {
                        $h1 = $r;
                    } elseif ($r->position == 'h2') {
                        $h2 = $r;
                    } elseif ($r->position == 'h3') {
                        $h3 = $r;
                    } elseif ($r->position == 'h4') {
                        $h4 = $r;
                    } elseif ($r->position == 'p1') {
                        $p1 = $r;
                    } elseif ($r->position == 'p2') {
                        $p2 = $r;
                    } elseif ($r->position == 'p3') {
                        $p3 = $r;
                    } elseif ($r->position == 'p4') {
                        $p4 = $r;
                    } elseif ($r->position == 'p5') {
                        $p5 = $r;
                    } elseif ($r->position == 'p6') {
                        $p6 = $r;
                    }
                }
            }
        }


        return view('admin.noticias.destaques', [
            'noticias' => $resultados,
            'h1'       => (!empty($h1) ? $h1 : ''),
            'h2'       => (!empty($h2) ? $h2 : ''),
            'h3'       => (!empty($h3) ? $h3 : ''),
            'h4'       => (!empty($h4) ? $h4 : ''),
            'p1'       => (!empty($p1) ? $p1 : ''),
            'p2'       => (!empty($p2) ? $p2 : ''),
            'p3'       => (!empty($p3) ? $p3 : ''),
            'p4'       => (!empty($p4) ? $p4 : ''),
            'p5'       => (!empty($p5) ? $p5 : ''),
            'p6'       => (!empty($p6) ? $p6 : '')

        ]);
    }


    /**
     * Salva os destaques das notícias.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function salva_destaques(Request $request)
    {
        $params = $request->all();

//echo '<pre>';
//print_r($params);die;

        CmsHighlight::where('module', 'noticias')->delete();


        if (!empty($params['h1'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'h1',
                      'page'      => 'home',
                      'record_id' => $params['h1']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['h2'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'h2',
                      'page'      => 'home',
                      'record_id' => $params['h2']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['h3'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'h3',
                      'page'      => 'home',
                      'record_id' => $params['h3']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['h4'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'h4',
                      'page'      => 'home',
                      'record_id' => $params['h4']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['p1'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p1',
                      'page'      => 'interna',
                      'record_id' => $params['p1']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p2'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p2',
                      'page'      => 'interna',
                      'record_id' => $params['p2']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p3'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p3',
                      'page'      => 'interna',
                      'record_id' => $params['p3']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p4'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p4',
                      'page'      => 'interna',
                      'record_id' => $params['p4']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p5'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p5',
                      'page'      => 'interna',
                      'record_id' => $params['p5']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p6'])) {
            $dados = ['module'    => 'noticias',
                      'position'  => 'p6',
                      'page'      => 'interna',
                      'record_id' => $params['p6']];

            CmsHighlight::create($dados);
        }


        return \Redirect::to(app()->getLocale() . '/admin/noticias')->with('success','Dados salvos com sucesso !');;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params         = $request->all();
        $params['date'] = date("Y-m-d", strtotime(str_replace('/', '-', $params['date'])));

        $news_id = News::create($params)->id;
        $noticia = News::find($news_id);

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

                    $noticia->news_tags()->attach($tag_id);

                }
            }
        }
        //Tags
        if (!empty($request->array_tags))
            $noticia->news_tags()->attach(explode(',', $request->array_tags));

        NewsTranslation::create([
            'title'          => $request->title,
            'featured_title' => $request->featured_title,
            'source'         => $request->source,
            'content_data'   => $request->content_data,
            'status'         => $request->status,
            'news_id'        => $news_id,
            'locale'         => app()->getLocale()
        ]);

        return redirect(app()->getLocale() . '/admin/noticias')->with('success','Dados salvos com sucesso !');;

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
        $news = News::find($id);

        $id_tags    = NewsTag::where('news_id', $id)->lists('tag_id')->toArray();

        foreach ($news->news_attachment as $a) {
            $array_anexos[] = $a->object_id;
        }
        $id_objetos = CmsObjectAttachment::where('module', 'noticias')->where('fk_id', $id)->lists('object_id')->toArray();
        $objetos    = Object::find($id_objetos);

//        $image = $news->images->image;
//        echo '<pre>';
//        print_r($image);die;

        return view('admin.noticias.edit', [
            'editorias'    => NewsEditorial::get(),
            'noticias'     => $news,
            'imagem'       => (isset($news->images->image) ? $news->images->image : ''),
            'objetos'      => (isset($objetos) ? $objetos : ''),
            'model'        => 'News',
            'idiomas'      => Language::get(),
            'tags'         => Tag::get(),
            'array_tags'   => (!empty($id_tags) ? implode(',', $id_tags) : ''),
            'array_anexos' => (isset($array_anexos) ? implode(',', $array_anexos) : ''),
            'linhas'       => ControllerFront::linhas(),
            'temas'        => ControllerFront::temas(),
            'subtemas'     => ControllerFront::subtemas()
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

            $params = $request->all();


            $noticias = News::find($id);

            //Salvando imagem 'cropada'
            if ($params['base64_image'] != null) {

                //Removendo os dados da string base64 referente ao tipo de dado
                //data:image/jpeg;base64,...
                list($type, $data) = explode(';', $params['base64_image']);
                list(, $data) = explode(',', $data);
                //Decodificando para binário
                $image = base64_decode($data);
                $fp    = fopen('uploads/noticias/' . $id . '_m.jpg', 'wb+');
                fwrite($fp, $image);
                fclose($fp);

                $noticias->images()->delete();
                NewsImage::create(['image'   => $id . '_m.jpg',
                                   'news_id' => $id]);

            }


            $noticias = News::find($id);

            $noticias->title             = $params['title'];
            $noticias->news_editorial_id = $params['news_editorial_id'];
            $noticias->featured_title    = $params['featured_title'];
            $noticias->source            = $params['source'];
            $noticias->date              = date("Y-m-d", strtotime(str_replace('/', '-', $params['date'])));
            $noticias->content_data      = $params['content_data'];
            $noticias->status            = $params['status'];

            if (!empty($params['array_anexos'])) {
                $anexos = explode(',', $params['array_anexos']);
                $anexos = array_values(array_filter($anexos)); //-- Remove elementos vazios e reorganiza o array.

                $noticias->cms_object_attachments()->detach();
                $noticias->cms_object_attachments()->attach($anexos, ['module' => 'noticias']);
            }



            //-- Associa tags já existentes ao objeto
            $noticias->news_tags()->detach();
            if (!empty($params['array_tags'])) {

                $array_tags = explode(',', $params['array_tags']);
                $noticias->news_tags()->attach($array_tags);
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

                        $noticias->news_tags()->attach($tag_id);
                    }
                }
            }



            //Caso exista outro idioma preenchido
            if (!empty($request->title_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'title'             => $request->title_trad,
                    'featured_title'    => $request->featured_title_trad,
                    'source'            => $request->source_trad,
                    'content_data'      => $request->content_data_trad,
                    'locale'            => $request->language
                ];


                if ($noticias->translation->contains('locale', $request->language)) {

                    $translation = NewsTranslation::where('news_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $noticias->translation()->create($params_trad);
                }

            }
            $noticias->save();

            // redirect
            //Session::flash('message', 'Successfully updated nerd!');
            return \Redirect::to(app()->getLocale() . '/admin/noticias')->with('success','Dados salvos com sucesso !');;
            //}
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
