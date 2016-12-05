<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Illuminate\Http\Request;
use Iba\Models\Partner;
use Iba\Models\Project;
use Iba\Models\NewsTranslation;
use Iba\Models\News;
use Iba\Models\Object;
use Iba\Models\CmsObjectAttachment;
use DB;

use Iba\Http\Requests;

class AssociadasController extends Controller
{
    protected $itens_por_pagina = 5;

    public function index(){

        //echo app()->getLocale();die;
        $associadas =  Partner::where('status', '1')
                    ->where('partner_translations.locale', app()->getLocale())
                    ->where('partner_group_id', '2')
                    ->join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
                    ->lists('partners.id')->toArray();

        $associadas = Partner::whereIn('id',$associadas)->orderBy('order')->get();



        return view('associadas', [
            'pagina'             => 'associadas',
            'banners'            => BannerPosition::get(),
            'associadas'         => $associadas
        ]);

    }



    public function detalhe(Request $request, $id){

        $associada  = Partner::find($id);

        //-- Retorna o conteúdo das abas relativo aos projetos daquela associada.
        $ids_andamento  = Partner::retorna_projetos($id, 1);
        $em_andamento   = Project::whereIn('id', $ids_andamento)->paginate($this->itens_por_pagina);

        $ids_analise    = Partner::retorna_projetos($id, 2);
        $em_analise     = Project::whereIn('id', $ids_analise)->paginate($this->itens_por_pagina);

        $ids_encerrados = Partner::retorna_projetos($id, 3);
        $encerrados     = Project::whereIn('id', $ids_encerrados)->paginate($this->itens_por_pagina);

        $ids_cancelados = Partner::retorna_projetos($id, 4);
        $cancelados     = Project::whereIn('id', $ids_cancelados)->paginate($this->itens_por_pagina);





        //-- Monta array com todos os projetos da Associada, para retornar os arquivos relacionados.
        $ids_projetos = array_merge($ids_andamento, $ids_analise, $ids_encerrados, $ids_cancelados);

        //-- Box de Arquivos anexados ao Projeto
        $id_objetos = CmsObjectAttachment::where('module', 'projetos')->whereIn('fk_id', $ids_projetos)->lists('object_id')->toArray();
        $objetos = Object::find($id_objetos);

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

//echo '<pre>';
//print_r($arquivos_relacionados);die;

        $query_lista = "select sum(A.project_value) as total_projetos, C.name
                        from projects A,
                            project_activities B,
                            project_activity_translations C,
                            partners D,
                            partner_project E
                        where A.status = '1'
                        and   B.id = C.project_activity_id
                        and   A.project_activity_id = B.id
                        and   A.id = E.project_id
                        and   D.id = E.partner_id
                        and   D.id = " . $id . "
                        group by A.project_activity_id";

        $resultado_lista = DB::select($query_lista);

        $vlr_total_projetos = 0;

        foreach ($resultado_lista as $num => $values) {
            $vlr_total_projetos += $values->total_projetos;
        }
        foreach ($resultado_lista as $num => $values) {
            $values->porcentagem = round(($values->total_projetos * 100) / $vlr_total_projetos, 2);
        }




        //-- Box de Notícias Relacionadas -- Relaciona notícias que contenham o mesmo acrônimo dos parceiros do projeto. ( CONFIRMAR ISSO )
        $array_noticias_relacionadas = array();
        //foreach($dados_projeto->project_partner as $pp){

        $array_noticias_relacionadas[] = NewsTranslation::where('title',            'like', '%'.  $associada->acronym .'%')
            ->orWhere('featured_title', 'like', '%' . $associada->acronym .'%')
            ->orWhere('source',         'like', '%' . $associada->acronym .'%')
            ->orWhere('content_data',        'like', '%' . $associada->acronym .'%')
            ->lists('news_id')
            ->toArray();;
        //}

        //-- Converte o array multidimensional em unidimensional, remove IDs duplicados e reorganiza o array
        $id_noticias_relacionadas = array_values(array_unique(array_reduce($array_noticias_relacionadas, 'array_merge', array())));

        $noticias_relacionadas = News::whereIn('id', $id_noticias_relacionadas)->orderBy('created_at', 'desc')->take(3)->get();

        return view('associadas_detalhe',[
            'associada'             => $associada,
            'pagina'                => 'associadas',
            'em_andamento'          => $em_andamento,
            'em_analise'            => $em_analise,
            'encerrados'            => $encerrados,
            'cancelados'            => $cancelados,
            'associadas'            => $this->associadas(),
            'situacoes'             => $this->situacoes(),
            'atividades'            => $this->atividades(),
            'destaques_biblioteca'  => $this->destaques_biblioteca(2),
            'itens_por_pagina'      => $this->itens_por_pagina,
            'noticias_relacionadas' => $noticias_relacionadas,
            'top_activities'        => $this->top_activity_projects(),
            'lista'                 => $resultado_lista,
            'vlr_total_projetos'    => $vlr_total_projetos,
            'banners'               => BannerPosition::get(),
            'arquivos_relacionados' => $arquivos_relacionados]) ;
    }
}
