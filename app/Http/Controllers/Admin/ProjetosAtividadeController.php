<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\ProjectActivity;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Iba\Http\Requests\Admin\ProjetosAtividadeRequest;

class ProjetosAtividadeController extends Controller
{
    public $palavra_chave = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Listagem inicial de atividades de projetos
        //Usar nome da variável padrão $results devido ao admin/includes/paginacao.blade.php
        $results = ProjectActivity::translation(Config::get('constants.PAGINATE'));


        return view('admin.projetos_atividade',[
            'results'=>$results,
            'palavra_chave'=>$this->palavra_chave
        ]);
    }

    /**
     * Realiza uma busca na listagem das atividades de projeto
     *
     * @param Request $request
     */
    public function search(Request $request){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projetos_atividade_cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjetosAtividadeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetosAtividadeRequest $request)
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
        $atividade = ProjectActivity::findOrFail($id);

        return view('admin.projetos_atividade_cadastro',[
            'atividade'=>$atividade
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjetosAtividadeRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetosAtividadeRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
