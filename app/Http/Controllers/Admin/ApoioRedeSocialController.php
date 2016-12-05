<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Social;
use Iba\Models\SocialTranslation;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioRedeSocialController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados =  Social::join('social_translations', 'social_translations.social_id', '=', 'socials.id')
            ->where('social_translations.locale', app()->getLocale())
            ->orderBy('socials.url', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.rede-social.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Social',
            'table'             => 'socials',
            'table_translation' => 'social_translations',
            'fk'                => 'social_id',
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
        return view('admin.tabelas-de-apoio.rede-social.edit', ['idiomas' => Language::get()]);

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

        if (\Request::hasFile('imagem-icon')){

            $uploadedFile = $request->file('imagem-icon') ;
            $tamanhoKb  = round($request->file('imagem-icon')->getClientSize()/1000,2);
            $tamanhoMb  = round($tamanhoKb/1000,2);

            $uploadedFile->move('imagens/', 'icon_' . $uploadedFile->getClientOriginalName());
            $icon_image = 'icone_' . $uploadedFile->getClientOriginalName();

            $params['image'] = $icon_image;

        }

        $social_id = Social::create($params)->id;

        $social = Social::find($social_id);
        $social->name = $params['name'];
        $social->save();

        $request->request->add(['social_id' => $social_id]);

        //Criando pt_br
        SocialTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->image_alt_trad) && !empty($request->locale_trad)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['image_alt_trad' => $request->image_alt_trad, 'locale' => $request->locale_trad]);
            SocialTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/rede-social')->with('success','Dados salvos com sucesso !');

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
        $resultado = Social::find($id);

        $view = 'admin.tabelas-de-apoio.rede-social.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Social',
            'table'             => 'socials',
            'table_translation' => 'social_translations',
            'fk'                => 'social_id',
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
            $request->request->add(['social_id' => $id]); //add na request o campo

            $social = Social::find($id);

            $social->name       = $request->name;
            $social->url        = $request->url;
            $social->image_alt  = $request->image_alt;

            if (\Request::hasFile('imagem-icon')){

                $uploadedFile = $request->file('imagem-icon') ;
                $tamanhoKb  = round($request->file('imagem-icon')->getClientSize()/1000,2);
                $tamanhoMb  = round($tamanhoKb/1000,2);

                $uploadedFile->move('images/', 'icone_' . $uploadedFile->getClientOriginalName());
                $icon_image = 'icone_' . $uploadedFile->getClientOriginalName();

                $params['icon_image'] = $icon_image;

                $social->image = $icon_image;

            }


            $social->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->image_alt_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'image_alt'     => $request->image_alt_trad,
                    'locale'        => $request->language
                ];


                if ($social->translation->contains('locale', $request->language)) {

                    $translation = SocialTranslation::where('social_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $social->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/rede-social')->with('success','Dados salvos com sucesso !');
        }

    }

}
