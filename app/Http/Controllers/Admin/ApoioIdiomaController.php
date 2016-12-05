<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Language;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioIdiomaController extends Controller
{
    protected $itens_por_pagina = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $view = 'admin.tabelas-de-apoio.idioma.index';
        return view($view,[
            'resultados'        => Language::paginate($this->itens_por_pagina),
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Language',
            'table'             => 'languages',
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
        return view('admin.tabelas-de-apoio.idioma.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['created_by' => $this->created_by]);
        Language::create($request->all());
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/idioma')->with('success','Dados salvos com sucesso !');

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

        $view = 'admin.tabelas-de-apoio.idioma.edit';
        return view($view,[
            'idiomas'   => Language::find($id),
            'model'     => 'Language',
            'view'      => $view
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


        if($request->ajax()){
            parent::update($request, $id);
        }
            $idioma = Language::find($id);
            $idioma->update($request->all());
            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/idioma')->with('success','Dados salvos com sucesso !');


    }

}
