<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\License;
use Iba\Models\LicenseTranslation;
use Iba\Models\ProjectType;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioLicencaController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = License::join('license_translations', 'license_translations.license_id', '=', 'licenses.id')
            ->where('license_translations.locale', app()->getLocale())
            ->orderBy('license_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.licenca.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'License',
            'table'             => 'licenses',
            'table_translation' => 'license_translations',
            'fk'                => 'license_id',
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
        return view('admin.tabelas-de-apoio.licenca.edit', ['idiomas' => Language::get()]);

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
        $license_id = License::create()->id;
        $request->request->add(['license_id' => $license_id]);
        //$request->request->add(['summary' => '']); //TODO não tem no front, fazer formulário de sumário

        //Criando pt_br
        LicenseTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['name' => $request->name_trad, 'locale' => $request->locale_translation]);
            LicenseTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/licenca')->with('success','Dados salvos com sucesso !');

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
        $resultado = License::find($id);

        $view = 'admin.tabelas-de-apoio.licenca.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'License',
            'table'             => 'licenses',
            'table_translation' => 'license_translations',
            'fk'                => 'license_id',
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
            $request->request->add(['license_id' => $id]); //add na request o campo
            //$request->request->add(['summary' => '']); //TODO não tem no front, fazer formulário de sumário

//            //Status
//            $project_type = License::find($id);
//            $project_type->update();
//
//            //Translation
//            $translation = LicenseTranslation::where('license_id', $id)->where('locale', app()->getLocale());
//            $translation->update(['name' => $request->name, 'summary'=>$request->summary]);
//
//            //Caso exista outro idioma preenchido
//            if (!empty($request->name_translation) && !empty($request->locale_translation)) {
//                //Substituindo campos name e locale com os valores de tradução
//                $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
//
//                $translation = LicenseTranslation::where('license_id', $id)->where('locale', $request->locale_translation);
//                if ($translation->count() != 0) {
//                    $translation->update(['name' => $request->name, 'locale' => $request->locale, 'license_id' => $request->license_id]);
//                } else {
//                    LicenseTranslation::create($request->all());
//                }
//            }


            $licenca            = License::find($id);
            $licenca->name      = $request->name;
            $licenca->summary   = $request->summary;

            $licenca->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'          => $request->name_trad,
                    'summary'       => $request->summary_trad,
                    'created_by'    => $this->created_by,
                    'locale'        => $request->language
                ];


                if ($licenca->translation->contains('locale', $request->language)) {

                    $translation = LicenseTranslation::where('license_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $licenca->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/licenca')->with('success','Dados salvos com sucesso !');
        }

    }

}
