<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Iba\Models\News;
use Iba\Models\Object;
use Iba\Models\Partner;
use Iba\Models\Project;
use Iba\Models\CmsObjectAttachment;
use Iba\Models\TopicTranslation;
use DB;
use Illuminate\Support\Facades\App;
use PDO;
use Illuminate\Http\Request;

use Iba\Http\Requests;

class BibliotecaController extends Controller
{
    protected $itens_por_pagina = 10;

    public function index(Request $request)
    {
        $resultados = Object::where('active', 1)
                        ->orderBy('date', 'desc')
                        ->paginate($this->itens_por_pagina);


        if ($request->ajax()) {
            return [
                'resultados'     => view('includes.ajax_biblioteca')->with(compact('resultados'))->render(),
                'proxima_pagina' => $resultados->nextPageUrl()
            ];

        } else { //-- Senão, foi no carregamento normal da página.

            return view('biblioteca', [
                'pagina'               => 'interna page-biblioteca',
                'destaques_biblioteca' => $this->destaques_biblioteca(4),
                'mais_recentes'        => $resultados,
                'associadas'           => $this->associadas(),
                'banners'              => BannerPosition::get(),
                'linhas'               => $this->linhas(),
                'temas'                => $this->temas(),
                'subtemas'             => $this->subtemas(),
                'itens_por_pagina'     => $this->itens_por_pagina
            ]);
        }
    }


    public function detalhe(Request $request, $id)
    {

        $dados_objeto = Object::find($id);

        //-- Box de Projetos que estão relacionados ao objeto
        $id_projetos = CmsObjectAttachment::where('module', 'projetos')->where('object_id', $id)->lists('fk_id')->toArray();
        $projetos    = Project::find($id_projetos);

        $id_noticias = CmsObjectAttachment::where('module', 'noticias')->where('object_id', $id)->lists('fk_id')->toArray();
        $noticias    = News::find($id_noticias);


        //-- Box de Projetos relacionados -- Relaciona, de forma randômica, os projetos que tenham o arquivo escolhido como anexo.
        $projetos_relacionados = Project::whereIn('id', $id_projetos)
            ->where('status', '1')
            ->orderByRaw("RAND()")
            ->take(3)
            ->get();

        //-- Box de Notícias relacionadas -- Relaciona, de forma randômica, as noticias que tenham o arquivo escolhido como anexo.
        $noticias_relacionadas = News::whereIn('id', $id_noticias)
            ->where('status', '1')
            ->orderByRaw("RAND()")
            ->take(3)
            ->get();

        //-- Box de Arquivos/Objetos Relacionados -- Relaciona objetos que tenham a mesma Linha, Tema e Subtema --//
        $array_arquivos_relacionados = array();
        //foreach($dados_objeto as $objeto){

        $array_arquivos_relacionados[] = Object::where('thread_id', $dados_objeto->thread_id)
            ->where('topic_id', $dados_objeto->topic_id)
            ->where('subtopic_id', $dados_objeto->subtopic_id)
            ->lists('id')
            ->toArray();
        //}

        //-- Converte o array multidimensional em unidimensional, remove IDs duplicados e reorganiza o array
        $id_arquivos_relacionados = array_values(array_unique(array_reduce($array_arquivos_relacionados, 'array_merge', array())));

        $arquivos_relacionados = Object::whereIn('id', $id_arquivos_relacionados)->orderBy('date', 'desc')->take(3)->get();

        //Adicionado para pegar os dados da tabela de tradução
        switch(app()->getLocale()){
            case 'pt_br': $indice =0;break;
            case 'en': $indice =1;break;
            case 'es': $indice =2;break;
        }
        $dados_objeto->attachment[0] = $dados_objeto->attachment[0]->translation[$indice];

        //Definindo a extensão
        $extension                              = explode('.', $dados_objeto->attachment[0]->filename);
        $extension                              = $extension[count($extension) - 1];
        $dados_objeto->attachment[0]->extension = $extension;
        //Nome original
        $dados_objeto->attachment[0]->originalName = $dados_objeto->attachment[0]->filename;
        //Pegando o id da translation de attachment
        $attachment_id = $dados_objeto->attachment[0]->attachment_id;


        //Verificando se o arquivo existe com o nome original (devido a importação, após usamos o id)
        if (!file_exists('uploads/biblioteca/' . $dados_objeto->attachment[0]->filename)) {
            $filename                              = $attachment_id. '_'.app()->getLocale().'.' . $dados_objeto->attachment[0]->extension;
            $dados_objeto->attachment[0]->filename = $filename;
        }


        return view('biblioteca_detalhe', [
            'pagina'                => 'biblioteca',
            'objeto'                => $dados_objeto,
            'associadas'            => $this->associadas(),
            'banners'               => BannerPosition::get(),
            'projetos_relacionados' => $projetos_relacionados,
            'arquivos_relacionados' => $arquivos_relacionados,
            'noticias_relacionadas' => $noticias_relacionadas
        ]);
    }


    public function busca(Request $request, $itens_por_pagina = 5)
    {

//echo $request->input('termo');die;
        //$this->itens_por_pagina = 5;

        $params = $request->all();

//        echo '<pre>';
//        print_r($params);//die;

        $query = "SELECT DISTINCT(A.id)
                        from objects A,
                            object_translations B,
                            threads C,
                            thread_translations D,
                            topics E,
                            topic_translations F,
                            types G,
                            type_translations H
                        where A.id = B.object_id
                        and   B.locale = '".app()->getLocale()."'
                        and   C.id = A.thread_id
                        and   C.id = D.thread_id
                        and   E.id = A.topic_id
                        and   F.locale = '".app()->getLocale()."'
                        and   E.id = F.topic_id

                        and A.active = '1'
                  ";
//and   F.subtopic_id = A.subtopic_id

        if (!empty($params['termo'])) {

            $query .= " and (   B.title     LIKE '%{$params['termo']}%'
                            or	B.preamble  LIKE '%{$params['termo']}%'
                            or	B.source    LIKE '%{$params['termo']}%'
                            )";
        }


        if (!empty($params['mes_inicio'])) {
            $query .= " and (MONTH(A.created_at) ='{$params['mes_inicio']}')";

        }
        if (!empty($params['mes_final'])) {
            $query .= " and (MONTH(A.created_at) ='{$params['mes_final']}')";
        }

        if (!empty($params['ano_inicio'])) {
            $query .= " and (YEAR(A.created_at) ='{$params['ano_inicio']}')";

        } elseif (!empty($params['ano_final'])) {
            $query .= " and (YEAR(A.created_at) ='{$params['ano_final']}')";
        }


        if (!empty($params['linha'])) {

            $query .= " and (A.thread_id = '{$params['linha']}')";

        }

        if (!empty($params['tema'])) {

            $query .= " and (A.topic_id = {$params['tema']})";

        }

        if (!empty($params['subtema'])) {

            $query .= " and (A.subtopic_id = {$params['subtema']})";

        }



        //echo $query;die;
        //if
        DB::connection()->enableQueryLog();
        DB::setFetchMode(PDO::FETCH_ASSOC);

        $resultado = DB::select($query); //->paginate(5);


        //$id_projetos = array_values(array_unique(array_reduce($resultado, 'array_merge', array())));

        $id_biblioteca = array();
        foreach ($resultado as $r) {
            $id_biblioteca[] = $r['id'];
        }

//        echo '<pre>' ;//. array_unique($resultado);die;
//        print_r(array_unique($id_projetos));die;

        $biblioteca = Object::whereIn('id', $id_biblioteca)->orderBy('date', 'desc')->paginate($this->itens_por_pagina)->appends([
            'termo'      => (!empty($params['termo'])) ? $params['termo'] : '',
            'linha'      => (!empty($params['linha'])) ? $params['linha'] : '',
            'tema'       => (!empty($params['tema'])) ? $params['tema'] : '',
            'subtema'    => (!empty($params['subtema'])) ? $params['subtema'] : '',
            'mes_inicio' => (!empty($params['mes_inicio'])) ? $params['mes_inicio'] : '',
            'mes_final'  => (!empty($params['mes_final'])) ? $params['mes_final'] : '',
            'ano_inicio' => (!empty($params['ano_inicio'])) ? $params['ano_inicio'] : '',
            'ano_final'  => (!empty($params['ano_final'])) ? $params['ano_final'] : ''
            ]);


//        echo '<pre>';//die;
//        print_r($biblioteca);die;
//            ->where('partner_translations.locale', app()->getLocale())
//            ->join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
//            ->orderByRaw("RAND()")
//            ->get();

        DB::setFetchMode(PDO::FETCH_CLASS);

        if ($request->ajax()) {

            $resultados = $biblioteca;

            if (isset($params['admin'])) { //-- A busca está sendo feita pela aba ANEXOS do Admin
                $view = 'admin.includes.ajax_anexos';
            } else {                       //-- A busca está sendo feita pelo botão "Exibir mais resultados" da Biblioteca
                $view = 'includes.ajax_biblioteca';
            }

            return [
                'resultados'     => view($view)->with(compact('resultados'))->render(),
                'proxima_pagina' => $resultados->nextPageUrl()
            ];

        } else { //-- Carrega a página da Biblioteca do front.
            return view('biblioteca', ['pagina'               => 'biblioteca',
                                       'associadas'           => $this->associadas(),
                                       'linhas'               => $this->linhas(),
                                       'temas'                => $this->temas(),
                                       'subtemas'             => $this->subtemas(),
                                       'destaques_biblioteca' => $this->destaques_biblioteca(2),
                                       'tipo'                 => 'busca',
                                       'biblioteca'           => $biblioteca,
                                       'banners'              => BannerPosition::get(),
                                       'itens_por_pagina'     => $this->itens_por_pagina
            ]);
        }
    }


    public function linhas_busca(Request $request)
    {
//echo $request->id;die;
        if(!empty($request->id) && $request->id != 'NaN') {
            $linha = $this->linhas($request->id);

            return $linha->topic->toArray();
        }else{
            $temas = TopicTranslation::where('topic_id', '!=', 0)
                ->where('subtopic_id', '==', 0)
                ->where('locale', app()->getLocale())
                ->distinct('topic_id')
                ->get()->toArray();

            return $temas;

        }

    }


    public function temas_busca(Request $request)
    {

        if(!empty($request->id && $request->id != 'NaN')){
            $tema = $this->temas($request->id);

            return $tema->subtopic->toArray();
        }else{
            $temas = TopicTranslation::where('topic_id', '!=', 0)
                ->where('subtopic_id', '!=', 0)
                ->where('locale', app()->getLocale())
                ->distinct('subtopic_id')
                ->get()->toArray();

            return $temas;
        }




    }

    public function download(Request $request){

        $filename = $request->filename;
        $originalName = $request->originalName;
        //Verificando se o arquivo existe com o nome original (devido a importação, após usamos o id)
        if (!file_exists('uploads/biblioteca/' . $filename))  $filename = $originalName;

        return response()->download('uploads/biblioteca/' . $filename, $originalName);

    }

}
