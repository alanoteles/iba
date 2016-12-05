<?php

namespace Iba\Http\Controllers;

use Iba\Models\NewsEditorial;
use Iba\Models\Project;
use Iba\Models\Social;
use Iba\Models\TopicTranslation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Iba\Models\ProjectSituation;
use Iba\Models\ProjectActivity;
use Iba\Models\Object;
use Iba\Models\Partner;
use Iba\Models\Thread;
use Iba\Models\Tag;
use Iba\Models\Topic;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct(){

        $redes_sociais = Social::where('status', '1')
                            ->where('social_translations.locale', app()->getLocale())
                            ->join('social_translations', 'social_translations.social_id', '=', 'socials.id')
                            ->orderBy('image_alt')
                            ->get();

        \Session::put('social', $redes_sociais);

    }


    public function situacoes()
    {

        return ProjectSituation::where('status', '1')->get();

    }


    public function atividades()
    {

        return ProjectActivity::where('status', '1')
            ->where('project_activity_translations.locale', app()->getLocale())
            ->join('project_activity_translations', 'project_activity_translations.project_activity_id', '=', 'project_activities.id')
            ->orderBy('name')
            ->get();

    }


    public function editorias()
    {

        return NewsEditorial::where('status', '1')->get();

    }


    public static function linhas($id = null)
    {

        if($id){
            $linhas = Thread::find($id);
        }else{
            $linhas = Thread::translated(App::getLocale())->get();
        }

        return $linhas;

    }


    public static function temas($id = null)
    {

//        return TopicTranslation::where('topic_id', '!=', 0)
//            ->where('subtopic_id', '==', 0)
//            ->where('locale', app()->getLocale())
//            ->distinct('topic_id')
//            ->get();

        if($id){
            $temas = Topic::find($id);
        }else{
            $temas = Topic::translated(App::getLocale())->get();
        }
        return $temas;
    }


    public static function subtemas()
    {

        return TopicTranslation::where('topic_id', '!=', 0)
            ->where('subtopic_id', '!=', 0)
            ->where('locale', app()->getLocale())
            ->distinct('topic_id')
            ->get();

    }


    public function destaques_biblioteca($quant = 2)
    {

        return Object::where('active', '1')
            ->whereIn('id',[62,63,64,67])
            ->orderBy('created_at', 'DESC')
            ->take($quant)
            ->get();
    }


    /**
     * Retorna 3 associadas de forma aleatória
     * @return mixed
     */
    public function associadas()
    {

        $associadas =  Partner::where('status', '1')
            ->where('partner_translations.locale', app()->getLocale())
            ->where('partner_group_id', '2')
            ->join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
            ->orderByRaw("RAND()")
            ->take(3)->lists('partners.id')->toArray();

        return Partner::find($associadas);
    }

    /**
     * Retorna todas as associadas - Grupo Associadas
     * @return mixed
     */
    public function associadas_executoras(){
        //Para select de associadas (proponentes/executoras)
        $associadas_executoras =  Partner::where('status', '1')
            ->where('partner_translations.locale', app()->getLocale())
            ->whereIn('partner_group_id', ['2','3'])
            ->join('partner_translations', 'partner_translations.partner_id', '=', 'partners.id')
            ->pluck('partners.id')->toArray();

        return Partner::whereIn('id',$associadas_executoras)->orderBy('order','DESC')->get();
    }

    /**
     * Retorna os dados dos círculos - gráfico- com as maiores
     * atividades financiadas - top3
     */
    public function top_activity_projects()
    {

        $final = null;

        //Somatório de todos os projetos
        $valor_total_projetos = Project::sum('project_value');

        //As 3 maiores atividade agrupadas e seus valores
        $sql = "select sum(A.project_value) as project_value, C.name
                        from projects A,
                            project_activities B,
                            project_activity_translations C
                        where A.status = '1'
                        and   B.id = C.project_activity_id
                        and   A.project_activity_id = B.id
                        group by A.project_activity_id ORDER BY project_value DESC LIMIT 0,3";

        $resultados = DB::select($sql);

        //Cálculo da porcentagem de cada atividade
        $i = 0;
        foreach ($resultados as $resultado) {
            $perc = ($resultado->project_value * 100) / $valor_total_projetos;
            $final[$i]['perc'] = round($perc, 1);
            $final[$i]['activity'] = $resultado->name;
            $i++;
        }

        return $final;
    }

}
