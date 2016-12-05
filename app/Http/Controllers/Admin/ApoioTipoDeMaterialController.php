<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Type;
use Iba\Models\TypeTranslation;
use Iba\Models\ProjectType;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioTipoDeMaterialController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Type::join('type_translations', 'type_translations.type_id', '=', 'types.id')
            ->where('type_translations.locale', app()->getLocale())
            ->orderBy('type_translations.type', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.tipo-de-material.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Type',
            'table'             => 'types',
            'table_translation' => 'type_translations',
            'fk'                => 'type_id',
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
        return view('admin.tabelas-de-apoio.tipo-de-material.edit', ['idiomas' => Language::get()]);

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
        //$request->request->add(['created_by' => $this->created_by]); //add na request o campo
        $type_id = Type::create()->id;
        $request->request->add(['type_id' => $type_id]);
        $request->request->add(['type' => $request->type]);

        //Criando pt_br
        TypeTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['type' => $request->type_trad, 'locale' => $request->locale_translation]);
            TypeTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tipo-de-material')->with('success','Dados salvos com sucesso !');

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
        $resultado = Type::find($id);

        $view = 'admin.tabelas-de-apoio.tipo-de-material.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Type',
            'table'             => 'types',
            'table_translation' => 'type_translations',
            'fk'                => 'type_id',
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
            $request->request->add(['type_id' => $id]); //add na request o campo
            $request->request->add(['type' => $request->type]);

//            //Status
//            $project_type = Type::find($id);
//            $project_type->update();
//
//            //Translation
//            $translation = TypeTranslation::where('type_id', $id)->where('locale', app()->getLocale());
//            $translation->update(['type' => $request->type]);
//
//            //Caso exista outro idioma preenchido
//            if (!empty($request->name_translation) && !empty($request->locale_translation)) {
//                //Substituindo campos name e locale com os valores de tradução
//                $request->merge(['type' => $request->name_translation, 'locale' => $request->locale_translation]);
//
//                $translation = TypeTranslation::where('type_id', $id)->where('locale', $request->locale_translation);
//                if ($translation->count() != 0) {
//                    $translation->update(['type' => $request->type, 'locale' => $request->locale, 'type_id' => $request->type_id]);
//                } else {
//                    TypeTranslation::create($request->all());
//                }
//            }


            $tipomaterial = Type::find($id);

            $tipomaterial->type  = $request->type;

            $tipomaterial->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->type_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'type'          => $request->type_trad,
                    'locale'        => $request->language
                ];


                if ($tipomaterial->translation->contains('locale', $request->language)) {

                    $translation = TypeTranslation::where('type_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $tipomaterial->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tipo-de-material')->with('success','Dados salvos com sucesso !');
        }

    }

}
