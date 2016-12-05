<?php

namespace Iba\Http\Controllers;

use Iba\Models\Partner;
use Iba\Models\ProjectTranslation;
use Illuminate\Http\Request;
use Iba\Models\Project;
use Iba\Http\Requests;

class ProjectController extends Controller
{
    public function index(){

        //$projetos = Project::translatedIn('en')->get();
        $projetos = Project::orderByRaw("RAND()")->get();
        $projetos = Project::get();

        $partners = Partner::get();

        $projetos_trans = ProjectTranslation::all();
        //dd($projetos);
        echo '<pre>';
        print_r($projetos);die;
        return view('projetos')->with(compact('projetos', 'projetos_trans', 'partners'));
    }
}
