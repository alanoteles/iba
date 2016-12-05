<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Page;
use Iba\Models\PageTranslation;
use Iba\Models\Language;
use Iba\Models\PageImage;
use Iba\Models\CmsObjectAttachment;
use Iba\Models\Object;
use Iba\Http\Controllers\Controller as ControllerFront;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;

class SecoesController extends Controller
{

    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = Page::paginate($this->itens_por_pagina);
        $view = 'admin.secoes.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Page',
            'table'             => 'pages',
            'table_translation' => 'page_translations',
            'fk'                => 'page_id',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resultado = Page::find($id);

        foreach ($resultado->attachment as $a) {
            $array_anexos[] = $a->object_id;
        }
        $id_objetos = CmsObjectAttachment::where('module', 'secoes')->where('fk_id', $id)->lists('object_id')->toArray();
        $objetos    = Object::find($id_objetos);

        $view = 'admin.secoes.edit';

        return view($view, [
            'resultado' => $resultado,
            'model' => 'Page',
            'table' => 'Pages',
            'table_translation' => 'page_translations',
            'fk' => 'page_id',
            'imagem'       => (isset($resultado->images->image) ? $resultado->images->image : ''),
            'idiomas'           => Language::get(),
            'objetos'           => $objetos,
            'array_anexos'      => (isset($array_anexos) ? implode(',', $array_anexos) : ''),
            'linhas'            => ControllerFront::linhas(),
            'temas'             => ControllerFront::temas(),
            'subtemas'          => ControllerFront::subtemas(),
            'view' => $view
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //echo 'dddd';die;
        if($request->ajax()){
            parent::update($request, $id);
        }else{
            $request->request->add(['created_by' => $this->created_by]); //add na request o campo
            $request->request->add(['page_id' => $id]); //add na request o campo

            $params = $request->all();

            //Status
            $secoes = Page::find($id);


            //Salvando imagem 'cropada'
            if ($params['base64_image'] != null) {

                //Removendo os dados da string base64 referente ao tipo de dado
                //data:image/jpeg;base64,...
                list($type, $data) = explode(';', $params['base64_image']);
                list(, $data) = explode(',', $data);
                //Decodificando para binário
                $image = base64_decode($data);
                $fp    = fopen('uploads/secoes/' . $id . '_m.jpg', 'wb+');
                fwrite($fp, $image);
                fclose($fp);

                $secoes->images()->delete();
                PageImage::create(['image'   => $id . '_m.jpg',
                    'page_id' => $id]);

            }


            $secoes->title        = $params['title'];
            $secoes->content_data = $params['content_data'];
            $secoes->locale       = $params['locale'];
            //$secoes->page_id      = $params['page_id'];


            if (!empty($params['array_anexos'])) {
                $anexos = explode(',', $params['array_anexos']);
                $anexos = array_values(array_filter($anexos)); //-- Remove elementos vazios e reorganiza o array.

                $secoes->cms_object_attachments()->detach();
                $secoes->cms_object_attachments()->attach($anexos, ['module' => 'secoes']);
            }


            //Caso exista outro idioma preenchido
            if (!empty($request->title_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'title'   => $request->title_trad,
                    'locale'  => $request->language,
                    'content_data' => $request->content_data_trad
                ];


                if ($secoes->translation->contains('locale', $request->language)) {

                    $translation = PageTranslation::where('page_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $secoes->translation()->create($params_trad);
                }

            }
            $secoes->save();


            return \Redirect::to(app()->getLocale() . '/admin/secoes')->with('success','Dados salvos com sucesso !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }
}
