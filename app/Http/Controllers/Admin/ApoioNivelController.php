<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Object;
use Iba\Models\Thread;
use Iba\Models\Topic;
use Iba\Models\ThreadTranslation;
use Iba\Models\TopicTranslation;
use Iba\Models\Language;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;


class ApoioNivelController extends Controller
{
    protected $itens_por_pagina = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $total_linhas   = count(Thread::get());
        $total_temas    = count(TopicTranslation::where('topic_id', '!=', 0)
                                    ->where('subtopic_id', '==', 0)
                                    ->where('locale', app()->getLocale())
                                    ->distinct('topic_id')
                                    ->get());

//    echo '<pre>';
//    print_r($total_temas);die;
        $total_subtemas = count(ControllerFront::subtemas());

        $view = 'admin.tabelas-de-apoio.nivel.index';

        return view($view, [
            'total_linhas'   => $total_linhas,
            'total_temas'    => $total_temas,
            'total_subtemas' => $total_subtemas,
            'view'           => $view
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tabelas-de-apoio.nivel.edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        echo 'llll';die;
//        //Tabela mãe, Schooling
//        //$request->request->add(['created_by' => $this->created_by]); //add na request o campo
////        $project_type_id = ProjectType::create($request->all())->id;
////        $request->request->add(['project_type_id' => $project_type_id]);
//
//        //$params = $request->all();
//        echo 'qqq<pre>';die;
//        print_r($params);die;
//
//        //Criando pt_br
//        ProjectTypeTranslation::create($request->all());
//
//        //Outros idiomas en, es, etc
//        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
//            //Substituindo campos name e locale com os valores de tradução
//            $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
//            ProjectTypeTranslation::create($request->all());//Salvando dado
//        }
//        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/nivel')->with('success','Dados salvos com sucesso !');

    }


    public function adiciona_niveis(Request $request)
    {

        $params = $request->all();
        $valores = explode('#', $params['novos_niveis']);


        if($params['id'] == 'L'){

            //$linha = ['thread_id' => $valores[0], 'topic_id' => 0];

            $linha_id = Thread::create([])->id;

            ThreadTranslation::create([
                'title' => $valores[1],
                'locale' => 'pt_br',
                'created_by' => $this->created_by,
                'thread_id' => $linha_id
            ]);
        }



        if($params['id'] == 'T'){

            $tema = ['thread_id' => $valores[0], 'topic_id' => 0];

            $topic_id = Topic::create($tema)->id;

            TopicTranslation::create([
                                        'title' => $valores[1],
                                        'locale' => 'pt_br',
                                        'created_by' => $this->created_by,
                                        'topic_id' => $topic_id,
                                        'subtopic_id' => 0
                                        ]);
        }


        if($params['id'] == 'S'){

            $subtema = ['thread_id' => 0, 'topic_id' => $valores[0]];

            $subtopic_id = Topic::create($subtema)->id;

            $topic_subtopic_id = TopicTranslation::create([
                'title' => $valores[1],
                'locale' => 'pt_br',
                'created_by' => $this->created_by,
                'topic_id' => 0,
                'subtopic_id' => $subtopic_id
            ])->id;

            $sub = TopicTranslation::find($topic_subtopic_id);
            $sub->topic_id = $topic_subtopic_id;
            $sub->save();
        }



        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/nivel/' . $params['id'] . '/edit');

        echo 'qqq<pre>';
        print_r($params);die;
//
//        //Criando pt_br
//        ProjectTypeTranslation::create($request->all());
//
//        //Outros idiomas en, es, etc
//        if (!empty($request->name_translation) && !empty($request->locale_translation)) {
//            //Substituindo campos name e locale com os valores de tradução
//            $request->merge(['name' => $request->name_translation, 'locale' => $request->locale_translation]);
//            ProjectTypeTranslation::create($request->all());//Salvando dado
//        }
//        return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/nivel')->with('success','Dados salvos com sucesso !');

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
        if($id == 'L'){
            $tipo               = 'Linha';
            $model              = 'Thread';
            $table              = 'threads';
            $table_translation  = 'thread_translations';
            $fk                 = 'thread_id';
        }

        if($id == 'T'){
            $tipo               = 'Tema';
            $model              = 'Topic';
            $table              = 'topics';
            $table_translation  = 'topic_translations';
            $fk                 = 'topic_id';
        }

        if($id == 'S'){
            $tipo               = 'Subtema';
            $model              = 'Topic';
            $table              = 'topics';
            $table_translation  = 'topic_translations';
            $fk                 = 'topic_id';
        }
//        echo $id;die;
//        $resultado = ProjectType::find($id);

        $temas = TopicTranslation::where('topic_id', '!=', 0)
            ->where('subtopic_id', '==', 0)
            ->where('locale', app()->getLocale())
            ->distinct('topic_id')
            ->get();

        //$id_temas    = Topic::where('object_id', $id)->lists('tag_id')->toArray();

        $subtemas = TopicTranslation::where('topic_id', '!=', 0)
            ->where('subtopic_id', '!=', 0)
            ->where('locale', app()->getLocale())
            ->distinct('subtopic_id')
            ->get();


        $view = 'admin.tabelas-de-apoio.nivel.edit';

        return view($view, [
            'tipo'              => $tipo,
            'id'                => $id,
            'model'             => $model,
            'table'             => $table,
            'table_translation' => $table_translation,
            'fk'                => $fk,
            'linhas'            => ControllerFront::linhas(),
            'temas'             => $temas,
            'subtemas'          => $subtemas,
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
            //$request->request->add(['project_type_id' => $id]); //add na request o campo

            $params = $request->all();

            if(!empty($params['niveis_apagados']) || !empty($params['novos_niveis'])){


            }
            //-- Remove níveis
            if (!empty($params['niveis_apagados'])) {

                $niveis_apagados = explode(',', $params['niveis_apagados']);
//echo '<pre>';
//print_r($niveis_apagados);die;
                foreach ($niveis_apagados as $key => $value) {
                    //echo $params['id'] . ' - ' . $value;die;
                    if (!empty($value)) {

                        if($params['id'] == 'T' || $params['id'] == 'S'){

                            Topic::destroy($value);
                            TopicTranslation::where('topic_id',$value)->delete();

                        }

                        if($params['id'] == 'L'){

                            Thread::destroy($value);
                            ThreadTranslation::where('thread_id',$value)->delete();

                        }


                    }
                }
            }


//echo '<pre>';
//print_r($params);die;
//            $project_type = ProjectTypeTranslation::where('project_type_id', $id)->where('locale', app()->getLocale());
//
//            $project_type->update(['name' => $request->name]);
//
//            //Caso exista outro idioma preenchido
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

            return \Redirect::to(app()->getLocale() . '/admin/tabelas-de-apoio/nivel')->with('success','Dados salvos com sucesso !');
        }

    }




    public function apaga_niveis(Request $request)
    {
        $params = $request->all();

        $total = 0;

        if($params['tipo'] == 'L'){

            $total = count(Object::where('thread_id', $params['id'])->get());

            if($total == 0){
                //Thread::destroy($params['id']);
                return 1;
            }
        }

        if($params['tipo'] == 'T'){

            $total = count(Object::where('topic_id', $params['id'])->get());

            if($total == 0){
                //Topic::destroy($params['id']);
                return 1;
            }
        }

        if($params['tipo'] == 'S'){

            $total = count(Object::where('subtopic_id', $params['id'])->get());

            if($total == 0){

//                Topic::destroy($params['id']);
//                TopicTranslation::where('topic_id',$params['id'])->delete();
                return 1;
            }
        }

        return 0;
    }



    public function retorna_traducao_nivel(Request $request)
    {
        $params = $request->all();
        $model = 'Iba\Models\\' . $params['model'];

        $resultado = $model::find($params['id']);

echo '<pre>';
print_r($params);
print_r($resultado->translation);die;
        //echo count(array_values($resultado->translation->where('locale', $params['locale'])->toArray()));
        if(count(array_values($resultado->translation->where('locale', $params['locale'])->toArray())) > 0){
            return json_encode(array_values($resultado->translation->where('locale', $params['locale'])->toArray()));
        }else{
            return '' ;
        }

    }


}
