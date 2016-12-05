<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Partner;
use Iba\Models\PartnerImage;
use Iba\Models\PartnerGroup;
use Iba\Models\PartnerTranslation;
use Iba\Models\Language;
use Iba\Models\UserGroup;
use Illuminate\Http\Request;
use Iba\Http\Requests;
use Validator;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;

class ParceirosController extends Controller
{

    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = Partner::join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
                            ->where('partner_translations.locale', app()->getLocale())
                            ->paginate($this->itens_por_pagina);

        $view = 'admin.parceiros.index';

        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Partner',
            'table'             => 'partners',
            'table_translation' => 'partner_translations',
            'fk'                => 'partner_id',
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
        //return view('admin.noticias.edit',[ 'editorias'         => NewsEditorial::get()]);

        return view('admin.parceiros.edit',[
            'partner_groups'    => PartnerGroup::get(),
            'idiomas'           => Language::get(),
            'model'             => 'Partner'
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
        //$params['date']                 = date("Y-m-d",strtotime(str_replace('/', '-',$params['date'])));

        $partner_id = Partner::create($params)->id;

        PartnerTranslation::create([
            'name'          => $request->name,
            'acronym'       => $request->acronym,
            'summary'       => $request->summary,
            'content_data'  => $request->content_data,
            'url'           => $request->url,
            'partner_id'    => $partner_id,
            'locale'        => app()->getLocale()
        ]);

        return redirect( app()->getLocale() . '/admin/parceiros')->with('success','Dados salvos com sucesso !');;

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
        $partner = Partner::find($id);

        return view('admin.parceiros.edit',[
            'parceiros'         => $partner,
            'imagem'            => (isset($partner->images->image) ? $partner->images->image : ''),
            'partner_groups'    => PartnerGroup::get(),
            'idiomas'           => Language::get(),
            'model'             => 'Partner'

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

            $parceiros = Partner::find($id);

            //Salvando imagem 'cropada'
            if ($params['base64_image']!=null){

                //Removendo os dados da string base64 referente ao tipo de dado
                //data:image/jpeg;base64,...
                list($type,$data) = explode(';',$params['base64_image']);
                list(,$data) = explode(',', $data);
                //Decodificando para binário
                $image = base64_decode($data);
                $fp = fopen('uploads/associadas/'.$id.'_m.jpg','wb+');
                fwrite($fp,$image);
                fclose($fp);

                $parceiros->images()->delete();
                PartnerImage::create([ 'image'     => $id.'_m.jpg',
                                    'partner_id'        => $id]);

            }

            $parceiros->name                = $params['name'];
            $parceiros->acronym             = $params['acronym'];
            $parceiros->summary             = $params['summary'];
            $parceiros->url                 = $params['url'];
            $parceiros->content_data        = $params['content_data'];
            $parceiros->status              = $params['status'];
            $parceiros->partner_group_id    = $params['partner_group_id'];

            //Caso exista outro idioma preenchido
            if (!empty($request->name_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'name'           => $request->name_trad,
                    'acronym'        => $request->acronym_trad,
                    'summary'        => $request->summary_trad,
                    'url'            => $request->url_trad,
                    'content_data'   => $request->content_data_trad,
                    'locale'         => $request->language
                ];


                if ($parceiros->translation->contains('locale', $request->language)) {

                    $translation = PartnerTranslation::where('partner_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $parceiros->translation()->create($params_trad);
                }

            }

            $parceiros->save();

            return \Redirect::to(app()->getLocale() . '/admin/parceiros')->with('success','Dados salvos com sucesso !');;

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
}
