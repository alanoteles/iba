<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Iba\Models\City;
use Iba\Models\Page;
use Iba\Models\Partner;
use Iba\Models\Project;
use Iba\Models\Object;
use Iba\Models\News;
use DB;
use PDO;
use Iba\Models\ProjectTranslation;
use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index(Request $request)
    {


        $projetos = Project::where('status', 1)
            ->join('cms_highlights', 'cms_highlights.record_id', '=', 'projects.id')
            ->join('project_translations', 'project_translations.project_id', '=', 'projects.id')
            ->where('cms_highlights.module', 'projetos')
            ->where('cms_highlights.page', 'home')
            ->orderBy('position', 'asc')->lists('projects.id')->toArray();

        $projetos = Project::find($projetos);

//        echo '<pre>';print_r($projetos);

        //Notícias em destaque
        $noticias = News::where('status', 1)
            ->join('cms_highlights', 'cms_highlights.record_id', '=', 'news.id')
            ->join('news_translations', 'news_translations.news_id', '=', 'news.id')
            ->where('cms_highlights.module', 'noticias')
            ->where('cms_highlights.page', 'home')
            ->where('news_translations.locale', app()->getLocale())
            ->orderBy('position', 'asc')->lists('news.id')->toArray();

        //Somente assim funciona o translatable/Dimsav
        $noticias = News::find($noticias);

        //A primeira é destaque
        $noticias[0]->position = 'h1'; //Posição 1


        return view('index',
            ['pagina'                => 'index',
             'projetos'              => $projetos,
             'associadas'            => $this->associadas()->take(3),
             'associadas_executoras' => $this->associadas_executoras(),
             'atividades'            => $this->atividades(),
             'situacoes'             => $this->situacoes(),
             'banners'               => BannerPosition::get(),
             'noticias'              => $noticias,
             'destaques_biblioteca'  => $this->destaques_biblioteca(2),
             'top_activities'        => $this->top_activity_projects()
            ]);
    }


    public function busca(Request $request, $termo)
    {
//

        if (empty($termo)) {
            return redirect('/');
        }
        $this->itens_por_pagina = 3;

        $params = $request->all();

        if ($request->ajax()) {

            if ($params['situation_id'] == '1') {
                $resultados = Project::busca($request, $termo, $this->itens_por_pagina);
                $view_ajax  = 'includes.ajax_projetos';

            } elseif ($params['situation_id'] == 'ultimas') {
                $resultados = News::busca($request, $termo, $this->itens_por_pagina);
                $view_ajax  = 'includes.ajax_noticias';

            } elseif ($params['situation_id'] == 'recentes') {
                $resultados = Object::busca($request, $termo, $this->itens_por_pagina);
                $view_ajax  = 'includes.ajax_biblioteca';

            } elseif ($params['situation_id'] == 'institucional') {
                $resultados = Page::busca($request, $termo, $this->itens_por_pagina);
                $view_ajax  = 'includes.ajax_institucional';
            }

//            echo $resultados->nextPageUrl();die;
            return [
                'resultados'     => view($view_ajax)->with(compact('resultados'))->render(),
                'proxima_pagina' => $resultados->nextPageUrl()
            ];

        } else {
            $projetos = Project::busca($request, $termo, $this->itens_por_pagina);

            $noticias = News::busca($request, $termo, $this->itens_por_pagina);

            $biblioteca = Object::busca($request, $termo, $this->itens_por_pagina);

            $institucional = Page::busca($request, $termo, $this->itens_por_pagina);

            return view('busca', [
                'pagina'        => 'busca',
                'projetos'      => $projetos,
                'noticias'      => $noticias,
                'biblioteca'    => $biblioteca,
                'institucional' => $institucional,

                'associadas'       => $this->associadas(),
                'itens_por_pagina' => $this->itens_por_pagina
            ]);
        }


    }


}
