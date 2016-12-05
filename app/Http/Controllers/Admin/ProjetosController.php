<?php

namespace Iba\Http\Controllers\Admin;

use Iba\Models\CmsHighlight;
use Iba\Models\Language;
use Iba\Models\ProjectYear;
use Illuminate\Http\Request;
use Iba\Models\CmsObjectAttachment;
use Iba\Models\ProjectTranslation;
use Iba\Models\Project;
use Iba\Models\ProjectActivity;
use Iba\Models\ProjectSituation;
use Iba\Models\ProjectType;
use Iba\Models\Object;
use Iba\Models\Partner;
use Iba\Models\Thread;
use Iba\Models\Topic;
use Iba\Http\Requests;
use Iba\Http\Controllers\Admin\Controller;
use Iba\Http\Controllers\Controller as ControllerFront;

class ProjetosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultados = Project::join('project_translations', 'project_translations.project_id', '=', 'projects.id')
            ->where('project_translations.locale', app()->getLocale())
            ->paginate($this->itens_por_pagina);


        $view = 'admin.projetos.index';


        return view($view, [
            'resultados'        => $resultados,
            'action'            => \Request::path() . '/pesquisa',
            'model'             => 'Project',
            'table'             => 'projects',
            'table_translation' => 'project_translations',
            'fk'                => 'project_id',
            'exibir'            => 'S',
            'situacoes'         => ProjectSituation::get(),
            'atividades'        => ProjectActivity::get(),
            'modalidades'       => ProjectType::get(),
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
        return view('admin.projetos.edit', [
            'situacoes'     => ProjectSituation::get(),
            'atividades'    => ProjectActivity::get(),
            'modalidades'   => ProjectType::get(),
            'parceiros'     => Partner::get(),
            'idiomas'       => Language::get(),
            'linhas'        => ControllerFront::linhas(),
            'temas'         => ControllerFront::temas(),
            'subtemas'      => ControllerFront::subtemas()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $params = $request->all();

        $array_periodo_execucao                = explode(' - ', $params['periodo_execucao']);
        $params['implementation_period_start'] = date("Y-m-d", strtotime(str_replace('/', '-', $array_periodo_execucao['0'])));
        $params['implementation_period_end']   = date("Y-m-d", strtotime(str_replace('/', '-', $array_periodo_execucao['1'])));
        $params['meeting_date']                = date("Y-m-d", strtotime(str_replace('/', '-', $params['meeting_date'])));

        $params['project_value'] = str_replace('.', '', $params['valor_total']);
        $params['project_value'] = str_replace(',', '.', $params['project_value']);


        $project_id = Project::create($params)->id;


        ProjectTranslation::create([
            'title'      => $params['title'],
            'summary'    => $params['summary'],
            'comment'    => $params['comment'],
            'results'    => $params['results'],
            'status'     => $params['status'],
            'project_id' => $project_id,
            'locale'     => app()->getLocale()
        ]);


        $projetos = Project::find($project_id);


        if (!empty($params['array_anexos'])) {
            $anexos = explode(',', $params['array_anexos']);
            $anexos = array_values(array_filter($anexos)); //-- Remove elementos vazios e reorganiza o array.

            $projetos->cms_object_attachments()->detach();
            $projetos->cms_object_attachments()->attach($anexos, ['module' => 'projetos']);
        }


        if (!empty($params['array_proponentes'])) {
            $array_proponentes = explode(',', $params['array_proponentes']);
            $projetos->partners()->attach($array_proponentes, ['type' => 'proponente']);
        }


        if (!empty($params['array_executores'])) {
            $array_executores = explode(',', $params['array_executores']);
            $projetos->partners()->attach($array_executores, ['type' => 'executor']);
        }


        //-- Grava a informação de Project Years. Primeiro apaga todos os registros com aquele ID de Projeto e depois insere novamente.
        foreach ($params['ano'] as $key => $value) {
            if (!empty($value)) {

                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);

                ProjectYear::create(['year'       => $key,
                                     'value'      => $value,
                                     'project_id' => $project_id]);
            }
        }


        return redirect(app()->getLocale() . '/admin/projetos')->with('success','Dados salvos com sucesso !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destaques()
    {
        $resultados = Project::join('project_translations', 'project_translations.project_id', '=', 'projects.id')
            ->where('project_translations.locale', app()->getLocale())->get();

        foreach ($resultados as $p) {
            if (count($p->cms_highlights) > 0) {
                foreach ($p->cms_highlights as $key => $r) {
                    //print_r($r->position . ' - ' . $r->record_id);
                    if ($r->position == 'h1') {
                        $h1 = $r;
                    } elseif ($r->position == 'h2') {
                        $h2 = $r;
                    } elseif ($r->position == 'p1') {
                        $p1 = $r;
                    } elseif ($r->position == 'p2') {
                        $p2 = $r;
                    }
                }
            }
        }


        return view('admin.projetos.destaques', [
            'projetos' => $resultados,
            'h1'       => (!empty($h1) ? $h1 : ''),
            'h2'       => (!empty($h2) ? $h2 : ''),
            'p1'       => (!empty($p1) ? $p1 : ''),
            'p2'       => (!empty($p2) ? $p2 : '')
        ]);
    }


    /**
     * Salva os destaques dos projetos.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function salva_destaques(Request $request)
    {
        $params = $request->all();

        CmsHighlight::where('module', 'projetos')->delete();


        if (!empty($params['h1'])) {
            $dados = ['module'    => 'projetos',
                      'position'  => 'h1',
                      'page'      => 'home',
                      'record_id' => $params['h1']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['h2'])) {
            $dados = ['module'    => 'projetos',
                      'position'  => 'h2',
                      'page'      => 'home',
                      'record_id' => $params['h2']];

            CmsHighlight::create($dados);

        }
        if (!empty($params['p1'])) {
            $dados = ['module'    => 'projetos',
                      'position'  => 'p1',
                      'page'      => 'interna',
                      'record_id' => $params['p1']];

            CmsHighlight::create($dados);
        }
        if (!empty($params['p2'])) {
            $dados = ['module'    => 'projetos',
                      'position'  => 'p2',
                      'page'      => 'interna',
                      'record_id' => $params['p2']];

            CmsHighlight::create($dados);
        }


        return redirect(app()->getLocale() . '/admin/projetos')->with('success','Dados salvos com sucesso !');;


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $project = Project::find($id);
//echo '<pre>';
//print_r($project->project_translation);die;

        foreach ($project->project_partner as $p) {
            if ($p->pivot->type == \Config::get('constants.PARTNERS_TYPE_EXECUTOR')) {
                $array_executores[] = $p->id;
            } else {
                $array_proponentes[] = $p->id;
            }
        }


        foreach ($project->project_attachment as $a) {
            $array_anexos[] = $a->object_id;
        }
        $id_objetos = CmsObjectAttachment::where('module', 'projetos')->where('fk_id', $id)->lists('object_id')->toArray();
        $objetos    = Object::find($id_objetos);


        return view('admin.projetos.edit', [
            'situacoes'         => ProjectSituation::get(),
            'atividades'        => ProjectActivity::get(),
            'modalidades'       => ProjectType::get(),
            'parceiros'         => Partner::get(),
            'model'             => 'Project',
            'projeto'           => $project,
            'objetos'           => $objetos,
            'idiomas'           => Language::get(),
            'array_anexos'      => (isset($array_anexos) ? implode(',', $array_anexos) : ''),
            'array_executores'  => (isset($array_executores) ? implode(',', $array_executores) : ''),
            'array_proponentes' => (isset($array_proponentes) ? implode(',', $array_proponentes) : ''),
            'linhas'            => ControllerFront::linhas(),
            'temas'             => ControllerFront::temas(),
            'subtemas'          => ControllerFront::subtemas()
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
        if ($request->ajax()) {
            parent::update($request, $id);
        } else {

            $params = $request->all();

            $array_periodo_execucao = explode(' - ', $params['periodo_execucao']);


            $params['valor_total'] = str_replace('.', '', $params['valor_total']);
            $params['valor_total'] = str_replace(',', '.', $params['valor_total']);


            $projetos = Project::find($id);


            $projetos->title                       = $params['title'];
            $projetos->number                      = $params['number'];
            $projetos->summary                     = $params['summary'];
            $projetos->comment                     = $params['comment'];
            $projetos->locale                      = $params['locale'];
            $projetos->project_type_id             = $params['project_type_id'];
            $projetos->project_situation_id        = $params['project_situation_id'];
            $projetos->project_activity_id         = $params['project_activity_id'];
            $projetos->results                     = $params['results'];
            $projetos->meeting_date                = date("Y-m-d", strtotime(str_replace('/', '-', $params['meeting_date'])));
            $projetos->implementation_period_start = date("Y-m-d", strtotime(str_replace('/', '-', $array_periodo_execucao['0'])));
            $projetos->implementation_period_end   = date("Y-m-d", strtotime(str_replace('/', '-', $array_periodo_execucao['1'])));
            $projetos->project_value               = $params['valor_total'];
            $projetos->status                      = $params['status'];


            $array_proponentes = explode(',', $params['array_proponentes']);
            $array_executores  = explode(',', $params['array_executores']);

            $projetos->partners()->detach();
            $projetos->partners()->attach($array_proponentes, ['type' => 'proponente']);
            $projetos->partners()->attach($array_executores, ['type' => 'executor']);


            //-- Grava a informação de Project Years. Primeiro apaga todos os registros com aquele ID de Projeto e depois insere novamente.
            $projetos->project_year()->delete();
            foreach ($params['ano'] as $key => $value) {
                if (!empty($value)) {

                    $value = str_replace('.', '', $value);
                    $value = str_replace(',', '.', $value);

                    ProjectYear::create(['year'       => $key,
                                         'value'      => $value,
                                         'project_id' => $id]);
                }
            }


            if (!empty($params['array_anexos'])) {
                $anexos = explode(',', $params['array_anexos']);
                $anexos = array_values(array_filter($anexos)); //-- Remove elementos vazios e reorganiza o array.

                $projetos->cms_object_attachments()->detach();
                $projetos->cms_object_attachments()->attach($anexos, ['module' => 'projetos']);
            }


            //Caso exista outro idioma preenchido
            if (!empty($request->title_trad) && !empty($request->language)) {

                //Substituindo campos com os valores de tradução
                $params_trad = [
                    'title'   => $request->title_trad,
                    'locale'  => $request->language,
                    'summary' => $request->summary_trad,
                    'comment' => $request->comment_trad,
                    'results' => $request->results_trad,
                    'locale'  => $request->language
                ];


                if ($projetos->translation->contains('locale', $request->language)) {

                    $translation = ProjectTranslation::where('project_id', $id)->where('locale', $request->language);

                    $translation->update($params_trad);

                } else {
                    $projetos->translation()->create($params_trad);
                }

            }
            $projetos->save();

            //return \Redirect::to(app()->getLocale() . '/admin/projetos/' . $id . '/edit');
            return \Redirect::to(app()->getLocale() . '/admin/projetos')->with('success','Dados salvos com sucesso !');
            //}
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//    }


    public function projetosEmNumeros(Request $request)
    {

        return view('admin.projetos_em_numeros');

    }

    public function projetosDestaques(Request $request)
    {

        return view('admin.projetos_destaques');

    }
}
