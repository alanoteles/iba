<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\ProjectType;
use Iba\Models\ProjectTypeTranslation;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioModalidadeDeProjetoController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = ProjectType::join('project_type_translations', 'project_type_translations.project_type_id', '=', 'project_types.id')
            ->where('project_type_translations.locale', app()->getLocale())
            ->orderBy('project_type_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.modalidade-de-projeto.index';

        return view($view, [
            'resultados' => $resultados,
            'action' => \Request::path() . '/pesquisa',
            'model' => 'ProjectType',
            'table' => 'project_types',
            'table_translation' => 'project_type_translations',
            'fk' => 'project_type_id',
            'exibir' => 'S',
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
        return view('admin.tabelas-de-apoio.modalidade-de-projeto.edit');

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
        $project_type_id = ProjectType::create($request->all())->id;
        $request->request->add(['project_type_id' => $project_type_id]);

        //Criando pt_br
        ProjectTypeTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
            ProjectTypeTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/modalidade-de-projeto')->with('success','Dados salvos com sucesso !');

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
        $resultado = ProjectType::find($id);

        $view = 'admin.tabelas-de-apoio.modalidade-de-projeto.edit';

        return view($view, [
            'resultado' => $resultado,
            'model' => 'ProjectType',
            'table' => 'project_types',
            'table_translation' => 'project_type_translations',
            'fk' => 'project_type_id',
            'idiomas'           => Language::get(),
            'view' => $view
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
            $request->request->add(['project_type_id' => $id]); //add na request o campo

            //$project_type = ProjectTypeTranslation::where('project_type_id', $id)->where('locale', app()->getLocale());

            //$project_type->update(['name' => $request->name]);

            $project_type = ProjectType::find($id);
            $project_type->name      = $request->name;
            $project_type->locale   = 'pt_br';

            $project_type->save();


            //Caso exista outro idioma preenchido
//            if (!empty($request->name_translation) && !empty($request->locale_translation)) {
//                //Substituindo campos name e locale com os valores de tradução
//                $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
//
//                $translation = ProjectTypeTranslation::where('project_type_id', $id)
//                    ->where('locale', $request->locale_translation);
//                if ($translation->count() != 0) {
//                    $translation->update(['name' => $request->name, 'locale' => $request->locale, 'project_type_id' => $request->project_type_id]);
//                } else {
//                    ProjectTypeTranslation::create($request->all());
//                }
//            }

            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'          => $request->name_trad,
                    'locale'        => $request->language
                ];


                if ($project_type->translation->contains('locale', $request->language)) {

                    $translation = ProjectTypeTranslation::where('project_type_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $project_type->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/modalidade-de-projeto')->with('success','Dados salvos com sucesso !');
        }

    }

}
