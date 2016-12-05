<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Iba\Models\Page;
use Iba\Models\Object;
use Iba\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Iba\Http\Requests;

class SecaoController extends Controller
{
    public function index($secao){

        $pagina = 'interna';

        if($secao == 4 || $secao == 5){
            $pagina = 'projetos';

        }

        $dados = Page::find($secao);
        return view('secao', [
                    'pagina'                => $pagina,
                    'dados'                 => $dados,
                    'associadas'            => $this->associadas(),
                    'atividades'            => $this->atividades(),
                    'top_activities'        => $this->top_activity_projects(),
                    'destaques_biblioteca'  => $this->destaques_biblioteca(2),
                    'banners'               => BannerPosition::get()
                    ]);


    }


}
