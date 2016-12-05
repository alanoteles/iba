<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Iba\Models\Attachment;
use Iba\Models\CmsObjectAttachment;
use Iba\Models\News;
use Iba\Models\NewsTranslation;
use Iba\Models\Object;
use Iba\Models\Partner;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use PDO;
use Illuminate\Http\Request;
use Iba\Models\ProjectTranslation;
use Iba\Models\Project;
use Iba\Http\Requests;
use Iba\MyClasses\Tools;

class ProjetosController extends Controller
{

    protected $itens_por_pagina = 5;

    public function index(Request $request, $secao = '')
    {
//        echo '<pre>';
//        echo $request->path();die;


        if ($secao == '') {

            //-- Se entrou via botão "Exibir mais resultados" veio por AJAX
            if ($request->ajax()) {

                $resultados = Project::where('project_situation_id', $request->situation_id)
                    ->where('status', 1)
                    ->orderBy('meeting_date', 'desc')
                    ->paginate($this->itens_por_pagina);

                return [
                    'resultados'     => view('includes.ajax_projetos')->with(compact('resultados'))->render(),
                    'proxima_pagina' => $resultados->nextPageUrl()
                ];

            } else { //-- Senão, foi no carregamento normal da página.

                $pagina = 'projetos';

                $projetos = Project::where('status', 1)
                    ->join('cms_highlights', 'cms_highlights.record_id', '=', 'projects.id')
                    ->join('project_translations', 'project_translations.project_id', '=', 'projects.id')
                    ->where('cms_highlights.module', 'projetos')
                    ->where('cms_highlights.page', 'home')
                    ->orderBy('meeting_date', 'desc')->lists('projects.id')->toArray();

                $projetos = Project::find($projetos);


                $em_andamento = Project::where('project_situation_id', \Config::get('constants.EM_ANDAMENTO'))
                    ->where('status', 1)
                    ->orderBy('meeting_date', 'desc')
                    ->paginate($this->itens_por_pagina);

                $em_analise = Project::where('project_situation_id', \Config::get('constants.EM_ANALISE'))
                    ->where('status', 1)
                    ->orderBy('meeting_date', 'desc')
                    ->paginate($this->itens_por_pagina);

                $encerrados = Project::where('project_situation_id', \Config::get('constants.ENCERRADO'))
                    ->where('status', 1)
                    ->orderBy('meeting_date', 'desc')
                    ->paginate($this->itens_por_pagina);

                $cancelados = Project::where('project_situation_id', \Config::get('constants.CANCELADO'))
                    ->where('status', 1)
                    ->orderBy('meeting_date', 'desc')
                    ->paginate($this->itens_por_pagina);


                return view('projetos', [
                    'projetos'              => $projetos,
                    'pagina'                => 'projetos',
                    'em_andamento'          => $em_andamento,
                    'em_analise'            => $em_analise,
                    'encerrados'            => $encerrados,
                    'cancelados'            => $cancelados,
                    'associadas'            => $this->associadas(),
                    'associadas_executoras' => $this->associadas_executoras(),
                    'situacoes'             => $this->situacoes(),
                    'atividades'            => $this->atividades(),
                    'top_activities'        => $this->top_activity_projects(),
                    'destaques_biblioteca'  => $this->destaques_biblioteca(2),
                    'banners'               => BannerPosition::get(),
                    'itens_por_pagina'      => $this->itens_por_pagina]);
            }

        }//elseif($secao == 'cria')

    }


    public function detalhe(Request $request, $id)
    {

        $dados_projeto = Project::find($id);

        //-- Box de Arquivos anexados ao Projeto
        $id_objetos = CmsObjectAttachment::where('module', 'projetos')->where('fk_id', $id)->lists('object_id')->toArray();
        $objetos    = Object::find($id_objetos);
//echo 'www<pre>';
//print_r($objetos);die;

        //-- Box de Projetos relacionados -- Relaciona, de forma randômica, os projetos que tenham a mesma Atividade
        $projetos_relacionados = Project::where('project_activity_id', $dados_projeto->project_activity_id)
            ->where('id', '!=', $dados_projeto->id)
            ->where('status', '1')
            ->orderByRaw("RAND()")
            ->take(3)
            ->get();

        //-- Box de Arquivos/Objetos Relacionados -- Relaciona objetos que tenham a mesma Linha, Tema e Subtema --//
        $array_arquivos_relacionados = array();
        foreach ($objetos as $objeto) {

            $array_arquivos_relacionados[] = Object::where('thread_id', $objeto->thread_id)
                ->where('topic_id', $objeto->topic_id)
                ->where('subtopic_id', $objeto->subtopic_id)
                ->lists('id')
                ->toArray();
        }

        //-- Converte o array multidimensional em unidimensional, remove IDs duplicados e reorganiza o array
        $id_arquivos_relacionados = array_values(array_unique(array_reduce($array_arquivos_relacionados, 'array_merge', array())));

        $arquivos_relacionados = Object::whereIn('id', $id_arquivos_relacionados)->orderBy('created_at', 'desc')->take(3)->get();


        //-- Box de Notícias Relacionadas -- Relaciona notícias que contenham o mesmo acrônimo dos parceiros do projeto. ( CONFIRMAR ISSO )
        $array_noticias_relacionadas = array();
        foreach ($dados_projeto->project_partner as $pp) {

            $array_noticias_relacionadas[] = NewsTranslation::where('title', 'like', '%' . $pp->acronym . '%')
                ->orWhere('featured_title', 'like', '%' . $pp->acronym . '%')
                ->orWhere('source', 'like', '%' . $pp->acronym . '%')
                ->orWhere('content_data', 'like', '%' . $pp->acronym . '%')
                ->lists('news_id')
                ->toArray();;
        }

        //-- Converte o array multidimensional em unidimensional, remove IDs duplicados e reorganiza o array
        $id_noticias_relacionadas = array_values(array_unique(array_reduce($array_noticias_relacionadas, 'array_merge', array())));

        $noticias_relacionadas = News::whereIn('id', $id_noticias_relacionadas)->orderBy('created_at', 'desc')->take(3)->get();


        return view('projetos_detalhe', ['pagina'                => 'projetos',
                                         'dados'                 => $dados_projeto,
                                         'objetos'               => $objetos,
                                         'associadas'            => $this->associadas(),
                                         'associadas_executoras' => $this->associadas_executoras(),
                                         'projetos_relacionados' => $projetos_relacionados,
                                         'arquivos_relacionados' => $arquivos_relacionados,
                                         'noticias_relacionadas' => $noticias_relacionadas,
                                         'banners'               => BannerPosition::get()
        ]);
    }


    public function busca(Request $request)
    {

//echo $request->input('termo');die;
        $this->itens_por_pagina = 5;

        $params = $request->all();

//        echo '<pre>';
//        print_r($params);//die;

        $query = 'select DISTINCT(A.id)
                        from projects A,
                            project_translations B,
                            partners C,
                            partner_project D,
                            partner_translations E
                        where A.id = B.project_id
                        and   A.id = D.project_id
                        and   B.locale = \'' . app()->getLocale() . '\'
                        and   C.id = D.partner_id
                        and   C.id = E.partner_id
                        and A.status = \'1\'
                        and C.status = \'1\'
                  ';

        if (!empty($params['termo'])) {

            $query .= ' and (   B.title         LIKE \'%' . $params['termo'] . '%\'
                            or	B.summary       LIKE \'%' . $params['termo'] . '%\'
                            or	A.number        LIKE \'%' . $params['termo'] . '%\'
                            or	B.comment       LIKE \'%' . $params['termo'] . '%\'
                            or	B.results       LIKE \'%' . $params['termo'] . '%\'
                            )';
        }

        //Selecionou uma associada/executora
        if (!empty($params['associada_executora'])) {
            $query .= ' and (	D.partner_id = ' . $params['associada_executora'] . ' AND type="proponente")';
        }


        if (!empty($params['tipo_data'])) {
            if ($params['tipo_data'] == 'R') {
                if (!empty($params['mes_inicio'])) {
                    $query .= ' and (MONTH(A.meeting_date) >=\'' . $params['mes_inicio'] . '\')';

                }

                if (!empty($params['mes_final'])) {
                    $query .= ' and  (MONTH(A.meeting_date) <=\'' . $params['mes_final'] . '\')';
                }

                //Ano início e ano fim selecionados
                if (!empty($params['ano_inicio']) && !empty($params['ano_fim'])) {
                    $query .= ' and ((YEAR(A.meeting_date) >=\'' . $params['ano_inicio'] . '\')';
                    $query .= ' and (YEAR(A.meeting_date) <=\'' . $params['ano_fim'] . '\'))';

                }//Somente um ou outro ano selecionado
                elseif(!empty($params['ano_inicio']) || !empty($params['ano_fim'])){

                    if (!empty($params['ano_inicio'])) {
                        $query .= ' and (YEAR(A.meeting_date) =\'' . $params['ano_inicio'] . '\')';

                    }

                    if (!empty($params['ano_fim'])) {
                        $query .= ' and (YEAR(A.meeting_date) =\'' . $params['ano_fim'] . '\')';
                    }

                }
            }


            if ($params['tipo_data'] == 'E') {

                //$query .= ' and (';
                if (!empty($params['mes_inicio'])) {
                    $query .= ' and (MONTH(A.implementation_period_start) >=\'' . $params['mes_inicio'] . '\')';

                }

                if (!empty($params['mes_final'])) {
                    $query .= ' and  (MONTH(A.implementation_period_end) <=\'' . $params['mes_final'] . '\')';
                }

                //Ano início e ano fim selecionados
                if (!empty($params['ano_inicio']) && !empty($params['ano_fim'])) {
                    $query .= ' and ((YEAR(A.implementation_period_start) >=\'' . $params['ano_inicio'] . '\')';
                    $query .= ' and (YEAR(A.implementation_period_end) <=\'' . $params['ano_fim'] . '\'))';

                }//Somente um ou outro ano selecionado
                elseif(!empty($params['ano_inicio']) || !empty($params['ano_fim'])){

                    if (!empty($params['ano_inicio'])) {
                        $query .= ' and (YEAR(A.implementation_period_start) =\'' . $params['ano_inicio'] . '\')';

                    }

                    if (!empty($params['ano_fim'])) {
                        $query .= ' and (YEAR(A.implementation_period_end) =\'' . $params['ano_fim'] . '\')';
                    }

                }


                //$query .= ')';
            }
        }


        if (!empty($params['atividade'])) {

            $query .= " and (A.project_activity_id = {$params['atividade']})";

        }

        if (!empty($params['situacao'])) {

            $query .= " and (A.project_situation_id = {$params['situacao']})";

        }


        //echo $query;die;
        //if
        DB::connection()->enableQueryLog();
        DB::setFetchMode(PDO::FETCH_ASSOC);

        $resultado = DB::select($query); //->paginate(5);

//        echo '<pre>' ;//. array_unique($resultado);die;
//        print_r($resultado);die;

        //$id_projetos = array_values(array_unique(array_reduce($resultado, 'array_merge', array())));

        $id_projetos = array();
        foreach ($resultado as $r) {
            $id_projetos[] = $r['id'];
        }


        $projetos = Project::whereIn('id', $id_projetos)->paginate($this->itens_por_pagina)->appends([
            'termo'               => (!empty($params['termo'])) ? $params['termo'] : '',
            'associada_executora' => (!empty($params['associada_executora'])) ? $params['associada_executora'] : '',
            'tipo_data'           => (!empty($params['tipo_data'])) ? $params['tipo_data'] : '',
            'atividade'           => (!empty($params['atividade'])) ? $params['atividade'] : '',
            'situacao'            => (!empty($params['situacao'])) ? $params['situacao'] : '',
            'mes_inicio'          => (!empty($params['mes_inicio'])) ? $params['mes_inicio'] : '',
            'mes_final'           => (!empty($params['mes_final'])) ? $params['mes_final'] : '',
            'ano_inicio'          => (!empty($params['ano_inicio'])) ? $params['ano_inicio'] : '',
            'ano_fim'           => (!empty($params['ano_fim'])) ? $params['ano_fim'] : '',
        ]);


//            ->where('partner_translations.locale', app()->getLocale())
//            ->join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
//            ->orderByRaw("RAND()")
//            ->get();

        DB::setFetchMode(PDO::FETCH_CLASS);

        if ($request->ajax()) {

            $resultados = $projetos;

            return [
                'resultados'     => view('includes.ajax_projetos')->with(compact('resultados'))->render(),
                'proxima_pagina' => $projetos->nextPageUrl()
            ];
        } else {
            return view('projetos', [
                'pagina'                => 'projetos',
                'associadas'            => $this->associadas(),
                'situacoes'             => $this->situacoes(),
                'atividades'            => $this->atividades(),
                'associadas_executoras' => $this->associadas_executoras(),
                'destaques_biblioteca'  => $this->destaques_biblioteca(2),
                'top_activities'        => $this->top_activity_projects(),
                'tipo'                  => 'busca',
                'projetos'              => $projetos,
                'banners'               => BannerPosition::get(),
                'itens_por_pagina'      => $this->itens_por_pagina
            ]);
        }

    }


    public function numeros()
    {


        $query_lista = "select sum(A.project_value) as total_projetos, C.name
                        from projects A,
                            project_activities B,
                            project_activity_translations C
                        where A.status = '1'
                        and   B.id = C.project_activity_id
                        and   A.project_activity_id = B.id
                        group by A.project_activity_id";

        $resultado_lista = DB::select($query_lista);

        $vlr_total_projetos = 0;

        foreach ($resultado_lista as $num => $values) {
            $vlr_total_projetos += $values->total_projetos;
        }
        foreach ($resultado_lista as $num => $values) {
            $values->porcentagem = round(($values->total_projetos * 100) / $vlr_total_projetos, 2);
        }

        //Listagem do total todos os projetos por associada
        $valor_contratado = Project::buscaProjetosAssociadas(0, true);

        //print_r($valor_contratado);die;

        return view('projetos_em_numeros', [
            'pagina'             => 'projetos',
            'associadas'         => $this->associadas(),
            'situacoes'          => $this->situacoes(),
            'atividades'         => $this->atividades(),
            'valor_contratado'   => $valor_contratado,
            'lista'              => $resultado_lista,
            'vlr_total_projetos' => $vlr_total_projetos,
            'banners'            => BannerPosition::get()
        ]);
    }

    /**
     * Requisição para retornar os dados dos projetos
     * por situacao,associada, ou atividade. Usada para gráfico de linha
     * @param Request $request
     * @return mixed
     */
    public function projetosSituacaoAtividade(Request $request)
    {

        //Recebendo dados das associadas, situação,atividade
        $params    = $request->all();
        $resultado = Project::buscaProjetosSituacaoAtividade($params['associada'], $params['situacao'], $params['atividade']);

        //Caso seja requisição Ajax
        if ($request->ajax()) {
            //Verificando se foi encontrado registros
            if (count($resultado) == 0)
                $resultado = 0;

            return Response::json($resultado); //Retornando resultado em JSON
        }
    }

    /**
     * Retornar todos os projetos x associada
     * Usado para gráfico full
     * @param Request $request
     * @return mixed
     */
    public function projetosAssociadaSituacao(Request $request)
    {

        $resultado = Project::buscaProjetosAssociadas();

        return Response::json($resultado);

    }


}
