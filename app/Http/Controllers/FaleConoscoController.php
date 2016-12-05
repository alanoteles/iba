<?php

namespace Iba\Http\Controllers;

use Iba\Models\Banner;
use Iba\Models\BannerPosition;
use Mail;
use Illuminate\Http\Request;
use Iba\Models\Partner;
use Iba\Http\Requests;

class FaleConoscoController extends Controller
{
    public function index(Request $request){



       return view('faleconosco',[
            'pagina'                => 'faleconosco',
            'associadas'            => $this->associadas(),
            'banners'               => BannerPosition::get()
            ]);
    }



    public function envia(Request $request){

        $params = $request->all();

        if($params['assunto'] == 'duvida'){
            $params['assunto'] = 'Dúvida';

        }elseif($params['assunto'] == 'reclamacao'){
            $params['assunto'] = 'Reclamação';

        }elseif($params['assunto'] == 'elogio'){
            $params['assunto'] = 'Elogio';
        }


        Mail::send('faleconosco_mensagem',  ['params' => $params], function ($m) use ($params) {
            $m->from('locness.dev@gmail.com', 'Portal IBA');

            $m->to('locness.dev@gmail.com', 'Locness Desenv')->subject('Fale conosco IBA - ' . $params['assunto']);
        });

        if (Mail::failures()) {
            return view('faleconosco',[
                'pagina'                => 'faleconosco',
                'associadas'            => $this->associadas(),
                'enviado'               => '<p>Ocorreu um problema no envio de sua mensagem</p><p>Por favor, tente novamente mais tarde. Obrigado !</p>'
            ]);
        }else{
            return view('faleconosco',[
                'pagina'                => 'faleconosco',
                'associadas'            => $this->associadas(),
                'enviado'               => '<p>Sua mensagem foi enviada com sucesso.</p><p>Agradecemos pelo contato  !</p>'
            ]);
        }
    }

}
