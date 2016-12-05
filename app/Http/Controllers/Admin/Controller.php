<?php
/**
 * Created by PhpStorm.
 * User: fabricioromao
 * Date: 08/06/16
 * Time: 18:05
 */

namespace Iba\Http\Controllers\Admin;

use Iba\Models\Filetype;
use Iba\Models\Language;
use Iba\Models\ProjectActivity;
use Iba\Models\ProjectSituation;
use Iba\Models\ProjectType;
use Iba\Models\Thread;
use Iba\Models\Topic;
use Iba\Models\UserGroup;
use Iba\Models\NewsEditorial;
use Iba\Models\Page;
use Illuminate\Http\Request;
use DB;

class Controller extends \Illuminate\Routing\Controller
{

    protected $itens_por_pagina = 10;
    protected $created_by =  0;



    public function __construct(){
        $this->created_by = (\Session::has('usuario') ? \Session::get('usuario.id') : '0');

        //Se não estiver logado, redirecionar
        if(empty($this->created_by)){
            return \Redirect::to(app()->getLocale() . '/admin/');
        }
    }



    public function pesquisa(Request $request)
    {
        $params     = $request->all();
        $filtros    = '';
   // echo '<pre>';print_r($params);die;

        $table              = $params['table'];
        $table_translation  = isset($params['table_translation']) ? $params['table_translation'] : '';
        $fk                 = isset($params['fk']) ? $params['fk'] : '';

        //-- Monta a pesquisa que busca pela palavra-chave em todos os campos das tabelas
        $query = "select DISTINCT(A.id)
                            from  {$table} A";

        if($fk!='' && $table_translation!=''){
            $query.= ",{$table_translation} B
                            where A.id = B.{$fk}
                            and   B.locale = '". app()->getLocale() . "'";
        }else{
            $query.= " WHERE 1=1";
        }

        $columns                = \Schema::getColumnListing($table);

        $condicoes = '';
        foreach($columns as $key => $column){
            $condicoes .= " LOWER(A.{$column}) LIKE '" . strtolower("%{$params['palavra_chave']}%") . "'";

            if($key < count($columns)){
                $condicoes .= " or ";
            }
        }
        //Exceção para tabelas que possuem sua associativa translation
        if($table_translation!=''){
            $columns_translation    = \Schema::getColumnListing($table_translation);
            foreach($columns_translation as $key => $column_translation){
                $condicoes .= " LOWER(B.{$column_translation}) LIKE '" . strtolower("%{$params['palavra_chave']}%") . "'";

                if($key < (count($columns_translation)-1)){
                    $condicoes .= " or ";
                }
            }
        }else{
            $condicoes = substr($condicoes,0,-3);
        }



        $query .= ' and (' . $condicoes . ')';


        $exibir = '';
        if(isset($params['exibir'])){
            if(!empty($params['exibir'])) {
                if ($table == 'Objects') {
                    $query .= ' and A.active = \'1\'';
                } else {
                    $query .= ' and A.status = \'1\'';
                }
            }

            $exibir = $params['exibir'];
        }

        $idiomas = '';
        if(isset($params['idioma'])){
            if(!empty($params['idioma'])) {
                $query .= " and LOWER(B.locale) = '" . strtolower($params['idioma']) . "'";

                $filtros .= "'idiomas'           => Language::get(),";
            }

            $idiomas = Language::get();
        }

        $atividades = '';
        if(isset($params['atividade'])){
            if(!empty($params['atividade'])) {
                $query .= " and A.project_activity_id = " . $params['atividade'];

                $filtros .= "'atividades'        => ProjectActivity::get(),";
            }

            $atividades = ProjectActivity::get();
        }

        $editorias = '';
        if(isset($params['editoria'])){
            if(!empty($params['editoria'])) {
                $query .= " and A.news_editorial_id = " . $params['editoria'];

                $filtros .= "'editoria'        => NewsEditorial::get(),";
            }
            $editorias = NewsEditorial::get();
        }

        $modalidades = '';
        if(isset($params['modalidade'])){
            if(!empty($params['modalidade'])) {
                $query .= " and A.project_type_id = " . $params['modalidade'];

                $filtros .= "'modalidades'       => ProjectType::get(),";
            }
            $modalidades = ProjectType::get();
        }

        $tipos_de_midia = '';
        if(isset($params['tipo_de_midia'])){
            if(!empty($params['tipo_de_midia'])) {
                $query .= " and A.id = " . $params['tipo_de_midia'];

                $filtros .= "'tipos_de_midia'    => Filetype::get(),";
            }

            $tipos_de_midia = Filetype::get();
        }

        $situacoes = '';
        if(isset($params['situacao'])){
            if(!empty($params['situacao'])) {
                $query .= " and A.project_situation_id = " . $params['situacao'];

                $filtros .= "'situacoes'         => ProjectSituation::get(),";
            }
            $situacoes = ProjectSituation::get();
        }

        $linha = '';
        if(isset($params['linha'])){
            if(!empty($params['linha'])) {
                $query .= " and A.thread_id = " . $params['linha'];

                $filtros .= "'linhas'            => Thread::get(),";
            }
            $linha = Thread::get();
        }

        $temas = '';
        if(isset($params['tema'])){
            if(!empty($params['tema'])) {
                $query .= " and A.topic_id = " . $params['tema'];

                $filtros .= "'temas'             => Topic::get(),";
            }
            $temas = Topic::get();
        }

        $grupos = '';
        if(isset($params['grupo'])){

            $grupos = UserGroup::get();
        }

//echo $query;die;
        $resultado_filtros = DB::select($query);
        $ids_filtrados = array();
        foreach($resultado_filtros as $r){
            $ids_filtrados[] = $r->id;
        }



        $model = 'Iba\Models\\' . $params['model'];
        $resultado_final = $model::whereIn('id', $ids_filtrados)
                                ->paginate($this->itens_por_pagina)
                                ->appends(['palavra_chave' => $params['palavra_chave'],
                                    'table'             => $params['table'],
                                    'table_translation' => $params['table_translation'],
                                    'fk'                => $params['fk'],
                                    'model'             => $params['model'],
                                    'exibir'            => (isset($params['exibir']) ? $params['exibir'] : ''),
                                    'grupo'             => (isset($params['grupo']) ? $params['grupo'] : ''),
                                    'situacao'          => (isset($params['situacao']) ? $params['situacao'] : ''),
                                    'idioma'            => (isset($params['idioma']) ? $params['idioma'] : ''),
                                    'atividade'         => (isset($params['atividade']) ? $params['atividade'] : ''),
                                    'editoria'          => (isset($params['editoria']) ? $params['editoria'] : ''),
                                    'modalidade'        => (isset($params['modalidade']) ? $params['modalidade'] : ''),
                                    'tipo_de_midia'     => (isset($params['tipo_de_midia']) ? $params['tipo_de_midia'] : ''),
                                    'linha'             => (isset($params['linha']) ? $params['linha'] : ''),
                                    'tema'              => (isset($params['tema']) ? $params['tema'] : ''),
                                    'view'              => $params['view']]);

//echo '<pre>';//die;
//print_r($resultado_final);die;

        return view($params['view'], [
            'action'            => \Request::path(),
            'table'             => $params['table'],
            'table_translation' => $params['table_translation'],
            'fk'                => $params['fk'],
            'model'             => $params['model'],
            'palavra_chave'     => $params['palavra_chave'],
            'exibir'            => $exibir,
            'grupos'            => $grupos,
            'situacoes'         => $situacoes,
            'idiomas'           => $idiomas,
            'atividades'        => $atividades,
            'editorias'         => $editorias,
            'modalidades'       => $modalidades,
            'tipos_de_midia'    => $tipos_de_midia,
            'linhas'            => $linha,
            'temas'             => $temas,
            'resultados'        => $resultado_final,
            'params'            => $params,
            'view'              => $params['view']
        ]);

    }



    public function update(Request $request, $id)
    {
        $params = $request->all();
        $model = 'Iba\Models\\' . $params['model'];

        $resultado = $model::find($id);

        if($params['model'] == 'Object'){
            $resultado->active = ($resultado->active == 1) ? '0' : '1';
        }else{
            $resultado->status = ($resultado->status == 1) ? '0' : '1';
        }

        $resultado->save();

    }



    public function destroy(Request $request, $id)
    {
        $params = $request->all();
        $model = 'Iba\Models\\' . $params['model'];

        $resultado = $model::destroy($id);

        $resultado = 1;

        return $resultado ;

    }



    public function retorna_traducao(Request $request)
    {
        $params = $request->all();
        $model = 'Iba\Models\\' . $params['model'];

        $resultado = $model::find($params['id']);

        //echo count(array_values($resultado->translation->where('locale', $params['locale'])->toArray()));
        if(count(array_values($resultado->translation->where('locale', $params['locale'])->toArray())) > 0){
            return json_encode(array_values($resultado->translation->where('locale', $params['locale'])->toArray()));
        }else{
            return '' ;
        }

    }



    public function busca_cep(Request $request)
    {

        $busca_cep = json_decode(@file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($request->cep).'&formato=json'));

        if($busca_cep->resultado != 0){

            return json_encode($busca_cep);
        }else{
            return '0' ;
        }


    }

}