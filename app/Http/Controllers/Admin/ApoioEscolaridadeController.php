<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Schooling;
use Iba\Models\SchoolingTranslation;
use Iba\Models\Language;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioEscolaridadeController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = Schooling::join('schooling_translations', 'schooling_translations.schooling_id', '=', 'schoolings.id')
            ->where('schooling_translations.locale', app()->getLocale())
            ->orderBy('order', 'ASC')
            ->paginate($this->itens_por_pagina);
//echo '<pre>';
//print_r($resultados);die;
        $view = 'admin.tabelas-de-apoio.escolaridade.index';

        return view($view, [
            'resultados' => $resultados,
            'action' => \Request::path() . '/pesquisa',
            'model' => 'Schooling',
            'table' => 'schoolings',
            'table_translation' => 'schooling_translations',
            'fk' => 'schooling_id',
            'view' => $view
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tabelas-de-apoio.escolaridade.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Tabela mãe, Schooling
        $request->request->add(['created_by' => $this->created_by]); //add na request o campo
        $schooling_id = Schooling::create($request->all())->id;
        $request->request->add(['schooling_id' => $schooling_id]);

        //Criando pt_br
        SchoolingTranslation::create($request->all());

//        //Outros idiomas en, es, etc
//        if (!empty($request->name_trad) && !empty($request->locale_translation)) {
//            //Substituindo campos name e locale com os valores de tradução
//            $request->merge(['name' => $request->name_trad, 'locale' => $request->locale_translation]);
//            SchoolingTranslation::create($request->all());//Salvando dado
//        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/escolaridade')->with('success','Dados salvos com sucesso !');

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
        $resultado = Schooling::find($id);

        $view = 'admin.tabelas-de-apoio.escolaridade.edit';

        return view($view, [
            'escolaridade'      => $resultado,
            'model'             => 'Schooling',
            'table'             => 'schoolings',
            'table_translation' => 'schooling_translations',
            'fk'                => 'schooling_id',
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
            $request->request->add(['schooling_id' => $id]); //add na request o campo

            $escolaridade = Schooling::find($id);

            $escolaridade->name  = $request->name;
            $escolaridade->order = $request->order;

            $escolaridade->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                                'name'          => $request->name_trad,
                                'created_by'    => $this->created_by,
                                'locale'        => $request->language
                                ];


                if ($escolaridade->translation->contains('locale', $request->language)) {

                    $translation = SchoolingTranslation::where('schooling_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $escolaridade->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/escolaridade')->with('success','Dados salvos com sucesso !');
        }

    }

    /**
     * Função para reordenar posição dos registros de escolaridade
     * @param Request $request
     * @return mixed
     */
    public function ordenacao(Request $request)
    {

        $registro = Schooling::find($request->id);
        $registro_order = $registro->order;

        //Pressionou seta para baixo
        if ($request->posicao == 'down') {
            $registro_troca = Schooling::where('order', '=', ($registro_order + 1));
            $registro_troca->update(['order' => ($registro_order)]);

            $registro->update(['order' => ($registro_order + 1)]);

        } else {
            $registro_troca = Schooling::where('order', '=', ($registro_order - 1));
            $registro_troca->update(['order' => ($registro_order)]);

            $registro->update(['order' => ($registro_order - 1)]);
        }


        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/escolaridade')->with('success','Dados salvos com sucesso !');
    }

}
