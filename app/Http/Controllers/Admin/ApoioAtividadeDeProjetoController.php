<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\ProjectActivity;
use Iba\Models\ProjectActivityTranslation;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioAtividadeDeProjetoController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = ProjectActivity::join('project_activity_translations', 'project_activity_translations.project_activity_id', '=', 'project_activities.id')
            ->where('project_activity_translations.locale', app()->getLocale())
            ->orderBy('project_activity_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.atividade-de-projeto.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'ProjectActivity',
            'table'             => 'project_activities',
            'table_translation' => 'project_activity_translations',
            'fk'                => 'project_activity_id',
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
        return view('admin.tabelas-de-apoio.atividade-de-projeto.edit');

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
        $project_activity_id = ProjectActivity::create($request->all())->id;
        $request->request->add(['project_activity_id' => $project_activity_id]);

        //Criando pt_br
        ProjectActivityTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['name' => $request->name_trad, 'locale' => $request->locale_translation]);
            ProjectActivityTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/atividade-de-projeto')->with('success','Dados salvos com sucesso !');

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
        $resultado = ProjectActivity::find($id);

        $view = 'admin.tabelas-de-apoio.atividade-de-projeto.edit';

        return view($view, [
        'resultado'             => $resultado,
            'model'             => 'ProjectActivity',
            'table'             => 'project_activities',
            'table_translation' => 'project_activity_translations',
            'fk'                => 'project_activity_id',
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
            $request->request->add(['project_activity_id' => $id]); //add na request o campo

//
            $atividade = ProjectActivity::find($id);

            $atividade->name  = $request->name;

            $atividade->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'          => $request->name_trad,
                    'locale'        => $request->language
                ];


                if ($atividade->translation->contains('locale', $request->language)) {

                    $translation = ProjectActivityTranslation::where('project_activity_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $atividade->translation()->create($params_trad);
                }

            }



            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/atividade-de-projeto')->with('success','Dados salvos com sucesso !');
        }

    }

}
