<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Tag;
use Iba\Models\TagTranslation;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioTagController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados =  Tag::join('tag_translations', 'tag_translations.tag_id', '=', 'tags.id')
            ->where('tag_translations.locale', app()->getLocale())
            ->orderBy('tag_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.tag.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Tag',
            'table'             => 'tags',
            'table_translation' => 'tag_translations',
            'fk'                => 'tag_id',
            'idiomas'           => Language::get(),
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
        return view('admin.tabelas-de-apoio.tag.edit', ['idiomas' => Language::get()]);

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
        $params = $request->all();

        $tag_id = Tag::create($params)->id;
        $request->request->add(['tag_id'        => $tag_id]);
        $request->request->add(['created_by'    => $this->created_by]);

        //Criando pt_br
        TagTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->tag_trad) && !empty($request->locale_trad)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['tag' => $request->tag_trad, 'locale' => $request->locale_trad]);
            TagTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tag')->with('success','Dados salvos com sucesso !');

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
        $resultado = Tag::find($id);

        $view = 'admin.tabelas-de-apoio.tag.edit';

//        $resultado->object();die;
//        echo '<pre>';
//        print_r(count($resultado->news));die;
        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Tag',
            'table'             => 'tags',
            'table_translation' => 'tag_translations',
            'fk'                => 'tag_id',
            'total_news_tags'   => count($resultado->news),
            'total_object_tags' => count($resultado->object),
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
            //$request->request->add(['created_by' => $this->created_by]); //add na request o campo
            $request->request->add(['tag_id' => $id]); //add na request o campo
            $request->request->add(['name' => $request->name]);


            $tag = Tag::find($id);

            $tag->name  = $request->name;

            $tag->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'          => $request->name_trad,
                    'created_by'    => $this->created_by,
                    'locale'        => $request->language
                ];


                if ($tag->translation->contains('locale', $request->language)) {

                    $translation = TagTranslation::where('tag_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $tag->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tag')->with('success','Dados salvos com sucesso !');
        }

    }

}
