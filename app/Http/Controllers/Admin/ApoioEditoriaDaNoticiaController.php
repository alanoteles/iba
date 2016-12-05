<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\NewsEditorial;
use Iba\Models\NewsEditorialTranslation;
use Iba\Models\ProjectType;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioEditoriaDaNoticiaController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = NewsEditorial::join('news_editorial_translations', 'news_editorial_translations.news_editorial_id', '=', 'news_editorials.id')
            ->where('news_editorial_translations.locale', app()->getLocale())
            ->orderBy('news_editorial_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.editoria-da-noticia.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'NewsEditorial',
            'table'             => 'news_editorials',
            'table_translation' => 'news_editorial_translations',
            'fk'                => 'news_editorial_id',
            'idiomas'           => Language::get(),
            'exibir'            => 'S',
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
        return view('admin.tabelas-de-apoio.editoria-da-noticia.edit',['idiomas' => Language::get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Tabela mãe
        $request->request->add(['created_by' => $this->created_by]); //add na request o campo
        $news_editorial_id = NewsEditorial::create($request->all())->id;
        $request->request->add(['news_editorial_id' => $news_editorial_id]);

        //Criando pt_br
        NewsEditorialTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['name' => $request->name_trad, 'locale' => $request->locale_translation]);
            NewsEditorialTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/editoria-da-noticia')->with('success','Dados salvos com sucesso !');

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
        $resultado = NewsEditorial::find($id);

        $view = 'admin.tabelas-de-apoio.editoria-da-noticia.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'NewsEditorial',
            'table'             => 'news_editorials',
            'table_translation' => 'news_editorial_translations',
            'fk'                => 'news_editorial_id',
            'idiomas'           => Language::get(),
            'view'              => $view
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
        if($request->ajax()){
            parent::update($request, $id);
        }else {
            $request->request->add(['created_by' => $this->created_by]); //add na request o campo
            $request->request->add(['news_editorial_id' => $id]); //add na request o campo


            $editoria = NewsEditorial::find($id);

            $editoria->name  = $request->name;

            $editoria->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'          => $request->name_trad,
                    'created_by'    => $this->created_by,
                    'locale'        => $request->language
                ];


                if ($editoria->translation->contains('locale', $request->language)) {

                    $translation = NewsEditorialTranslation::where('news_editorial_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $editoria->translation()->create($params_trad);
                }

            }


            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/editoria-da-noticia')->with('success','Dados salvos com sucesso !');
        }

    }

}
