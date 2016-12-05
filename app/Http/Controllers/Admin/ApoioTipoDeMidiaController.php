<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Filetype;
use Iba\Models\FiletypeTranslation;
use Illuminate\Http\Request;
use Iba\Models\Language;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;


class ApoioTipoDeMidiaController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultados =  Filetype::join('filetype_translations', 'filetype_translations.filetype_id', '=', 'filetypes.id')
            ->where('filetype_translations.locale', app()->getLocale())
            ->orderBy('filetype_translations.type', 'ASC')
            ->paginate($this->itens_por_pagina);

        $view = 'admin.tabelas-de-apoio.tipo-de-midia.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Filetype',
            'table'             => 'filetypes',
            'table_translation' => 'filetype_translations',
            'fk'                => 'filetype_id',
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
        return view('admin.tabelas-de-apoio.tipo-de-midia.edit', ['idiomas' => Language::get()]);

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

            $uploadedFile->move('uploads/tipo-de-midia/', 'icone_' . $uploadedFile->getClientOriginalName());
            $icon_image = 'icone_' . $uploadedFile->getClientOriginalName();

            $params['icon_image'] = $icon_image;

        }

        if (\Request::hasFile('imagem-capa')){

            $uploadedFile = $request->file('imagem-capa') ;
            $tamanhoKb  = round($request->file('imagem-capa')->getClientSize()/1000,2);
            $tamanhoMb  = round($tamanhoKb/1000,2);

            $uploadedFile->move('uploads/tipo-de-midia/', 'capa_' . $uploadedFile->getClientOriginalName());
            $cover_image = 'capa_' . $uploadedFile->getClientOriginalName();

            $params['cover_image'] = $cover_image;

        }

        $filetype_id = Filetype::create($params)->id;
        $request->request->add(['filetype_id' => $filetype_id]);

        //Criando pt_br
        FiletypeTranslation::create($request->all());

        //Outros idiomas en, es, etc
        if (!empty($request->filetype_trad) && !empty($request->locale_trad)) {
            //Substituindo campos name e locale com os valores de tradução
            $request->merge(['filetype' => $request->filetype_trad, 'locale' => $request->locale_trad]);
            TypeTranslation::create($request->all());//Salvando dado
        }
        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tipo-de-midia')->with('success','Dados salvos com sucesso !');

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
        $resultado = Filetype::find($id);

        $view = 'admin.tabelas-de-apoio.tipo-de-midia.edit';

        return view($view, [
            'resultado'         => $resultado,
            'model'             => 'Filetype',
            'table'             => 'filetypes',
            'table_translation' => 'filetype_translations',
            'fk'                => 'filetype_id',
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

            $tipomidia = Filetype::find($id);

            $tipomidia->type = $request->type;

            if (\Request::hasFile('imagem-capa')){

                $uploadedFile = $request->file('imagem-capa') ;
                $tamanhoKb  = round($request->file('imagem-capa')->getClientSize()/1000,2);
                $tamanhoMb  = round($tamanhoKb/1000,2);

                $uploadedFile->move('uploads/tipo-de-midia/', 'capa_' . $uploadedFile->getClientOriginalName());
                $cover_image = 'capa_' . $uploadedFile->getClientOriginalName();

                $params['cover_image'] = $cover_image;

                $tipomidia->icon_image = $cover_image;

            }

            if (\Request::hasFile('imagem-icon')){

                $uploadedFile = $request->file('imagem-icon') ;
                $tamanhoKb  = round($request->file('imagem-icon')->getClientSize()/1000,2);
                $tamanhoMb  = round($tamanhoKb/1000,2);

                $uploadedFile->move('uploads/tipo-de-midia/', 'icone_' . $uploadedFile->getClientOriginalName());
                $icon_image = 'icone_' . $uploadedFile->getClientOriginalName();

                $params['icon_image'] = $icon_image;

                $tipomidia->icon_image = $icon_image;

            }


            $tipomidia->save();


            //Caso exista outro idioma preenchido
            if (!empty($request->type_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'type'          => $request->type_trad,
                    'alt_image'     => $request->alt_image_trad,
                    'alt_cover'     => $request->alt_cover_trad,
                    'locale'        => $request->language
                ];


                if ($tipomidia->translation->contains('locale', $request->language)) {

                    $translation = FiletypeTranslation::where('filetype_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $tipomidia->translation()->create($params_trad);
                }

            }

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/tipo-de-midia')->with('success','Dados salvos com sucesso !');
        }

    }

}
