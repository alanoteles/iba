<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\PartnerGroup;
use Iba\Models\PartnerGroupTranslation;
use Iba\Models\ProjectType;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioGrupoDeParceirosController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados = PartnerGroup::join('partner_group_translations', 'partner_group_translations.partner_group_id', '=', 'partner_groups.id')
            ->where('partner_group_translations.locale', app()->getLocale())
            ->orderBy('partner_group_translations.name', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.grupo-de-parceiros.index';

        return view($view, [
            'resultados' => $resultados,
            'action' => \Request::path() . '/pesquisa',
            'model' => 'PartnerGroup',
            'table' => 'partner_groups',
            'table_translation' => 'partner_group_translations',
            'fk' => 'partner_group_id',
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
        return view('admin.tabelas-de-apoio.grupo-de-parceiros.edit');

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
        $partner_group_id = PartnerGroup::create($request->all())->id;
        $request->request->add(['partner_group_id' => $partner_group_id]);

        //Criando pt_br
        PartnerGroupTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
            PartnerGroupTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/grupo-de-parceiros')->with('success','Dados salvos com sucesso !');

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
        $resultado = PartnerGroup::find($id);

        $view = 'admin.tabelas-de-apoio.grupo-de-parceiros.edit';

        return view($view, [
            'resultado' => $resultado,
            'model' => 'PartnerGroup',
            'table' => 'partner_groups',
            'table_translation' => 'partner_group_translations',
            'fk' => 'partner_group_id',
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
            $request->request->add(['partner_group_id' => $id]); //add na request o campo

            //Status
            $parent = PartnerGroup::find($id);
            $parent->update(['status'=>$request->status]);

            //Translation
            $translation = PartnerGroupTranslation::where('partner_group_id', $id)->where('locale', app()->getLocale());
            $translation->update(['name' => $request->name]);

            //Caso exista outro idioma preenchido
            if (!empty($request->name_translation) && !empty($request->locale_translation)) {
                //Substituindo campos name e locale com os valores de tradução
                $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);

                $translation = PartnerGroupTranslation::where('partner_group_id', $id)->where('locale', $request->locale_translation);
                if ($translation->count() != 0) {
                    $translation->update(['name' => $request->name, 'locale' => $request->locale, 'partner_group_id' => $request->partner_group_id]);
                } else {
                    PartnerGroupTranslation::create($request->all());
                }
            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/grupo-de-parceiros')->with('success','Dados salvos com sucesso !');
        }

    }

}
