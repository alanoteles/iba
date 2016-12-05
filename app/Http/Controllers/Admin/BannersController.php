<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Banner;
use Iba\Models\BannerTranslation;
use Iba\Models\BannerPosition;
use Iba\Models\UserGroup;
use Illuminate\Http\Request;
use Iba\Http\Requests;
use Iba\Models\Language;
use Validator;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;

class BannersController extends Controller
{

    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = Banner::join('banner_translations', 'banner_translations.banner_id', '=', 'banners.id')
                            ->where('banner_translations.locale', app()->getLocale())
                            ->paginate($this->itens_por_pagina);

        $view = 'admin.banners.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Banner',
            'table'             => 'banners',
            'table_translation' => 'banner_translations',
            'fk'                => 'banner_id',
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

        return view('admin.banners.edit',[
            'model'             => 'Banner',
            'idiomas'           => Language::get()
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->all();

        $banner_id = Banner::create($params)->id;

        if (\Request::hasFile('arquivo')){

            $uploadedFile   = $request->file('arquivo') ;
            $tamanhoKb      = round($request->file('arquivo')->getClientSize()/1000,2);
            $tamanhoMb      = round($tamanhoKb/1000,2);

            $uploadedFile->move('uploads/banners/', $uploadedFile->getClientOriginalName());
            $image = $uploadedFile->getClientOriginalName();

        }

        BannerTranslation::create([
            'title'         => $request->title,
            'image_alt'     => $request->image_alt,
            'url'           => $request->url,
            'banner_id'     => $banner_id,
            'image'         => $image,
            'locale'        => app()->getLocale()
        ]);


        return redirect( app()->getLocale() . '/admin/banners')->with('success','Dados salvos com sucesso !');;

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
        $banner = Banner::find($id);

        return view('admin.banners.edit',[
            'banners'           => $banner,
            'idiomas'           => Language::get(),
            'model'             => 'Banner'

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
        //-- Se na tela de listagem o usuário clicou para mudar o status do registro, o update é chamado via AJAX.
        //-- Caso contrário, o form está sendo atualizado pelo botão SALVAR
        if($request->ajax()){
            parent::update($request, $id);
        }else{

            $params = $request->all();

            $banners = Banner::find($id);


            if (\Request::hasFile('arquivo')){
                //echo 'tem';

                $uploadedFile   = $request->file('arquivo') ;
                $extensao       = $request->file('arquivo')->getClientOriginalExtension();
                $tamanhoKb      = round($request->file('arquivo')->getClientSize()/1000,2);
                $tamanhoMb      = round($tamanhoKb/1000,2);

                //if ($uploadedFile->isValid()) {
                $uploadedFile->move('uploads/banners/', $uploadedFile->getClientOriginalName());
                //}
                $banners->image = $uploadedFile->getClientOriginalName();

            }


            $banners->title                = $params['title'];
            $banners->comment             = $params['comment'];
            $banners->image_alt           = $params['image_alt'];
            $banners->url                 = $params['url'];
            $banners->status              = $params['status'];

            $banners->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->title_trad) && !empty($request->language)) {

                if (\Request::hasFile('image')){
                    //echo 'tem';

                    $uploadedFile   = $request->file('image') ;
                    $extensao       = $request->file('image')->getClientOriginalExtension();
                    $tamanhoKb      = round($request->file('image')->getClientSize()/1000,2);
                    $tamanhoMb      = round($tamanhoKb/1000,2);

                    //if ($uploadedFile->isValid()) {
                    $uploadedFile->move('uploads/banners/', $request->language . '_' . $uploadedFile->getClientOriginalName());
                    //}
                    //$banners->image = $uploadedFile->getClientOriginalName();

                    $image_trad = $request->language . '_' . $uploadedFile->getClientOriginalName()  ;

                }

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'title'     => $request->title_trad,
                    'image'     => (isset($image_trad) ? $image_trad : ''),
                    'image_alt' => $request->image_alt_trad,
                    'url'       => $request->url_trad,
                    'locale'    => $request->language
                ];


                if ($banners->translation->contains('locale', $request->language)) {

                    $translation = BannerTranslation::where('banner_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $banners->translation()->create($params_trad);
                }

            }
            return \Redirect::to(app()->getLocale() . '/admin/banners')->with('success','Dados salvos com sucesso !');;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destaques()
    {

        $resultados = Banner::join('banner_translations', 'banner_translations.banner_id', '=', 'banners.id')
                        ->where('banner_translations.locale', app()->getLocale())->get();
        
        $h1 = '';
        $p1 = '';

        foreach($resultados as $p){

            if(count($p->positions) > 0 ){

                if($p->positions->position == 'h1'){
                    $h1 = $p;

                }elseif($p->positions->position == 'p1'){
                    $p1 = $p;
                }
            }
        }

        return view('admin.banners.destaques',[
            'banners'  => $resultados,
            'h1'        => $h1,
            'p1'        => $p1

        ]);
    }




    /**
     * Salva os destaques das notícias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function salva_destaques(Request $request)
    {
        $params = $request->all();

        BannerPosition::truncate();

        if(!empty($params['h1'])){
            $dados = [  'position'    => 'h1',
                        'banner_id'   => $params['h1']];

            BannerPosition::create($dados);

        }

        if(!empty($params['p1'])){
            $dados = [  'position'    => 'p1',
                        'banner_id'   => $params['p1']];

            BannerPosition::create($dados);
        }

        return \Redirect::to(app()->getLocale() . '/admin/banners')->with('success','Dados salvos com sucesso !');;

    }

}
