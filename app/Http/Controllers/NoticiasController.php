<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Illuminate\Http\Request;
use Iba\Models\News;
use Iba\Models\Partner;
use Iba\Models\NewsTranslation;
use Iba\Models\CmsObjectAttachment;
use DB;
use PDO;
use Iba\Models\Object;
use Iba\Http\Requests;

class NoticiasController extends Controller
{
    protected $itens_por_pagina = 5;

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $resultados = News::where('status', 1)
                ->join('news_translations', 'news_translations.news_id', '=', 'news.id')
                ->where('news_translations.locale', app()->getLocale())
                ->whereNotIn('news.id', function ($q) {
                    $q->select('record_id')->from('cms_highlights')
                        ->where('module', 'noticias')
                        ->where('page', 'interna');
                })->lists('news.id')->toArray();

            $resultados = News::whereIn('id', $resultados)
                ->paginate($this->itens_por_pagina);

            return [
                'resultados'     => view('includes.ajax_noticias')->with(compact('resultados'))->render(),
                'proxima_pagina' => $resultados->nextPageUrl()
            ];

        } else { //-- Senão, foi no carregamento normal da página.

            //Notícias em destaque
            $noticias = News::where('status', 1)
                ->join('cms_highlights', 'cms_highlights.record_id', '=', 'news.id')
                ->join('news_translations', 'news_translations.news_id', '=', 'news.id')
                ->where('cms_highlights.module', 'noticias')
                ->where('cms_highlights.page', 'interna')
                ->where('news_translations.locale', app()->getLocale())
                ->orderBy('position', 'asc')->lists('news.id')->toArray();

            //Somente assim funciona o translatable/Dimsav
            $noticias = News::find($noticias);

            $noticias[0]->position = 'p1'; //Posição 1
            $noticias[1]->position = 'p2'; //Posição 2


//dd($destaques_biblioteca);
            //Notícias mais recentes (exceto destaque)
            $ultimas_noticias = News::where('status', 1)
                ->join('news_translations', 'news_translations.news_id', '=', 'news.id')
                ->where('news_translations.locale', app()->getLocale())
                ->whereNotIn('news.id', function ($q) {
                    $q->select('record_id')->from('cms_highlights')
                        ->where('module', 'noticias')
                        ->where('page', 'interna');
                })->lists('news.id')->toArray();

            $ultimas_noticias = News::whereIn('id', $ultimas_noticias)
                ->paginate($this->itens_por_pagina);


            return view('noticias', [
                'pagina'               => 'interna page-noticias',
                'noticias'             => $noticias,
                'editorias'            => $this->editorias(),
                'associadas'           => $this->associadas(),
                'destaques_biblioteca' => $this->destaques_biblioteca(2),
                'banners'              => BannerPosition::get(),
                'ultimas_noticias'     => $ultimas_noticias,
                'itens_por_pagina'     => $this->itens_por_pagina
            ]);
        }
    }


    public function detalhe(Request $request, $id)
    {

        $dados_noticia = News::find($id);

        //-- Box de Arquivos anexados à Notícia
        $id_objetos = CmsObjectAttachment::where('module', 'noticias')->where('fk_id', $id)->lists('object_id')->toArray();
        $objetos    = Object::find($id_objetos);


        //-- Box de Notícias relacionados -- Relaciona, de forma randômica, os noticias que tenham a mesma Editoria
        $noticias_relacionadas = News::where('news_editorial_id', $dados_noticia->news_editorial_id)
            ->join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->where('news.id', '!=', $dados_noticia->id)
            ->where('status', '1')
            ->where('news_translations.locale', app()->getLocale())
            ->orderBy('date', 'DESC')
            ->take(4)->lists('news.id')->toArray();

        $noticias_relacionadas = News::find($noticias_relacionadas);


        return view('noticias_detalhe', ['pagina'                => 'noticias',
                                         'noticia'               => $dados_noticia,
                                         'objetos'               => $objetos,
                                         'atividades'            => $this->atividades(),
                                         'associadas'            => $this->associadas(),
                                         'banners'               => BannerPosition::get(),
                                         'top_activities'        => $this->top_activity_projects(),
                                         'noticias_relacionadas' => $noticias_relacionadas

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
                            from news A,
                                news_translations B,
                                news_editorials C,
                                news_editorial_translations D
                            where A.id = B.news_id
                            and   C.id = A.news_editorial_id
                            and   B.locale = \'' . app()->getLocale() . '\'
                            and A.status = \'1\'
                            and C.status = \'1\'
                      ';

        if (!empty($params['termo'])) {

            $query .= ' and (   B.title             LIKE \'%' . $params['termo'] . '%\'
                             or	B.featured_title    LIKE \'%' . $params['termo'] . '%\'
                             or	B.source            LIKE \'%' . $params['termo'] . '%\'
                             or	B.content_data      LIKE \'%' . $params['termo'] . '%\'
                             or	D.name              LIKE \'%' . $params['termo'] . '%\'
                            )';
        }


        if (!empty($params['mes_inicio'])) {
            $query .= ' and MONTH(A.date) =\'' . $params['mes_inicio'] . '\'';

        }
        if (!empty($params['mes_final'])) {
            $query .= ' and MONTH(A.date) =\'' . $params['mes_final'] . '\'';
        }

        if (!empty($params['ano_inicio'])) {
            $query .= ' and YEAR(A.date) =\'' . $params['ano_inicio'] . '\'';

        } elseif (!empty($params['ano_final'])) {
            $query .= ' and YEAR(A.date) =\'' . $params['ano_final'] . '\'';
        }


        if (!empty($params['editoria'])) {

            $query .= ' and A.news_editorial_id = ' . $params['editoria'];

        }


        DB::connection()->enableQueryLog();
        DB::setFetchMode(PDO::FETCH_ASSOC);

        $resultado = DB::select($query); //->paginate(5);


        $id_noticias = array();
        foreach ($resultado as $r) {
            $id_noticias[] = $r['id'];
        }


        $noticias = News::whereIn('id', $id_noticias)->paginate($this->itens_por_pagina)->appends([
            'termo'      => (!empty($params['termo'])) ? $params['termo'] : '',
            'mes_inicio' => (!empty($params['mes_inicio'])) ? $params['mes_inicio'] : '',
            'mes_final'  => (!empty($params['mes_final'])) ? $params['mes_final'] : '',
            'ano_inicio' => (!empty($params['ano_inicio'])) ? $params['ano_inicio'] : '',
            'ano_final'  => (!empty($params['ano_final'])) ? $params['ano_final'] : '',
            'editoria'   => (!empty($params['editoria'])) ? $params['editoria'] : ''
        ]);


        DB::setFetchMode(PDO::FETCH_CLASS);

        if ($request->ajax()) {

            $resultados = $noticias;

            return [
                'resultados'     => view('includes.ajax_noticias')->with(compact('resultados'))->render(),
                'proxima_pagina' => $noticias->nextPageUrl()
            ];
        } else {
            return view('noticias', ['pagina'               => 'noticias',
                                     'editorias'            => $this->editorias(),
                                     'associadas'           => $this->associadas(),
                                     'destaques_biblioteca' => $this->destaques_biblioteca(2),
                                     'tipo'                 => 'busca',
                                     'noticias'             => $noticias,
                                     'banners'              => BannerPosition::get(),
                                     'itens_por_pagina'     => $this->itens_por_pagina
            ]);
        }

    }
}
