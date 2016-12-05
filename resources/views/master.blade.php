<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Tags -->
        <title></title>

        <!-- CSS files -->
        <link rel="stylesheet" href="{{ asset('css/master.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        {{--<link href='https://fonts.googleapis.com/css?family=OpenSans:300,400,700' rel='stylesheet' type='text/css'>--}}
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.5.9/slick-theme.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- JS files -->
        <script src="https://d3js.org/d3.v3.min.js" type="text/javascript"></script>
        <script src="{{ asset('js/bower.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('js/application.js') }}" type="text/javascript" charset="utf-8"></script>
        <script src="{{ asset('js/bootbox.min.js') }}" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-531272b70f3c9478"></script>
        <script src="{{ asset('js/components/jquery.number.min.js') }}" type="text/javascript" charset="utf-8"></script>
    </head>

    <body class="page-{{ $pagina or '-'}}">
        <input type="hidden" id="app_locale" value="{{ App::getLocale() }}">
    <header>
        <div id="brand" class="container">
            <a href="/{{ App::getLocale() }}"><img src="{{ asset('images/img-logo-iba.png') }}" alt="Instituto Brasileiro do Algodão"></a>
        </div>
        <?php //echo $_SERVER[HTTP_HOST] ?>
        <nav class="container hidden-xs hidden-sm">
            <ul class="pull-right uppercase">
                <li><a href="" data-route="/secao/1">{{trans('interface.o_que_fazemos')}}</a></li>
                <li><a href="" data-route="/secao/2">{{trans('interface.nossa_historia')}}</a></li>
                <li><a href="" data-route="/secao/3">{{trans('interface.quem_e_quem')}}</a></li>
                <li><a href="" data-route="/associadas">{{trans('interface.associadas')}}</a></li>
                <li><a href="" data-route="/faleconosco">{{trans('interface.fale_conosco')}}</a></li>
                <li class="sip"><a href="" data-route="/secao/6">{{trans('interface.sip')}}</a></li>
                <li class="busca">
                    <div class="form-wrap">
                        <input type="text" name="form-busca" id="form-busca" placeholder="{{trans('interface.busca')}}">
                        <span class="icone-busca"><img src="{{ asset('images/icon-busca.png') }}" alt="Ícone Busca"></span>
                    </div>
                </li>
                <li @if(App::getLocale()=="en") style="background: white"; @endif><a href="/en"> {{trans('interface.en')}} </a><li>
                <li @if(App::getLocale()=="pt_br") style="background: white"; @endif><a href="/pt_br"> {{trans('interface.pt')}} </a><li>
            </ul>
        </nav>

        <div class="menu-mobile col-md-8 hidden-lg hidden-md">
            <div class="container">
                <i class="material-icons open-menu">menu</i>
            </div>

            <nav class="nav-mobile uppercase">
                <ul>
                    <li><a href="" data-route="/secao/1">{{trans('interface.o_que_fazemos')}}</a></li>
                    <li><a href="" data-route="/secao/2">{{trans('interface.nossa_historia')}}</a></li>
                    <li><a href="" data-route="/secao/3">{{trans('interface.quem_e_quem')}}</a></li>
                    <li><a href="" data-route="/associadas">{{trans('interface.associadas')}}</a></li>
                    <li><a href="" data-route="/faleconosco">{{trans('interface.fale_conosco')}}</a></li>
                    <li class="sip"><a href="" data-route="/secao/6">{{trans('interface.sip')}}</a></li>
                    <li class="busca">
                        <div class="form-wrap">
                            <input type="text" name="termo" id="form-busca" placeholder="{{trans('interface.busca')}}">
                            <a href="" data-route="/busca"><span class="icone-busca"><img src="{{ asset('images/icon-busca-branco.png') }}" alt="Ícone Busca"></span></a>
                        </div>
                    </li>
                    <li @if(App::getLocale()=="en") style="background: white"; @endif><a href="/en"> {{trans('interface.en')}} </a><li>
                    <li @if(App::getLocale()=="pt_br") style="background: white"; @endif><a href="/pt_br"> {{trans('interface.pt')}} </a><li>
                </ul>
            </nav>

            <div class="container">
                <i class="material-icons close-menu col-md-8">close</i>
            </div>
        </div>
    </header>

    <section class="beh-painel">
        <div class="image parallax-window" data-parallax="scroll" data-speed="0.5" data-position="0 0" data-image-src="{{ asset('images/bkg-painel-md.jpg') }}"></div>
    </section>

    <div class="content">
        <section class="beh-navbar">
            <nav >
                <ul class="container uppercase">
                    <li class="item-navbar item-projetos col-md-4 ">
                        <a href="" data-route="/projetos"><span class="area">{{trans('interface.projetos')}}</span></a>
                    </li>

                    <div class="sub-navbar hidden-md hidden-lg">
                        <ul class="container">
                            <li class="col-md-3"><a href="" data-route="/projetos" class="active">{{trans('interface.todos_os_projetos')}}</a></li>
                            {{--<li class="col-md-3"><a href="" data-route="/projetos-numeros">{{trans('interface.projetos_em_numeros')}}</a></li>--}}
                            <li class="col-md-3"><a href="" data-route="/secao/4">{{trans('interface.como_criar_um_projeto')}}</a></li>
                            <li class="col-md-3"><a href="" data-route="/secao/5">{{trans('interface.como_gerenciar_um_projeto')}}</a></li>
                        </ul>
                    </div>

                    <li class="item-navbar item-noticias col-md-4 ">
                        <a href="" data-route="/noticias"><span class="area">{{trans('interface.noticias')}}</span></a>
                    </li>
                    <li class="item-navbar item-biblioteca col-md-4 ">
                        <a href="" data-route="/biblioteca"><span class="area">{{trans('interface.biblioteca')}}</span></a>
                    </li>
                </ul>
                <div class="sub-navbar hidden-xs hidden-sm">
                    <ul class="container">
                        <li class="col-md-3"><a href="" data-route="/projetos" class="active">{{trans('interface.todos_os_projetos')}}</a></li>
                        {{--<li class="col-md-3"><a href="" data-route="/projetos-numeros">{{trans('interface.projetos_em_numeros')}}</a></li>--}}
                        <li class="col-md-3"><a href="" data-route="/secao/4">{{trans('interface.como_criar_um_projeto')}}</a></li>
                        <li class="col-md-3"><a href="" data-route="/secao/5">{{trans('interface.como_gerenciar_um_projeto')}}</a></li>
                    </ul>
                </div>
            </nav>
        </section>

    </div>

    @if($pagina != 'index')
        <div class="content">
            <div class="container">
                <section class="beh-breadcrumb col-md-12 uppercase">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </section>
            </div>
        </div>
    @endif


    @yield('content')

    @yield('content-color')

    @yield('destaques_institucionais_biblioteca')

    @yield('banner')

    @yield('associadas')



    <footer class="footer">
        <section class="footer-img"></section>
        <div class="container">
            <div class="footer-links">
                <nav class="footer-nav uppercase">
                    <div class="coluna-links col-md-3 col-sm-6 col-xs-6">
                        <h3>Institucional</h3>
                        <ul class="lista-links">
                            <li><a href="" data-route="/secao/1">{{trans('interface.o_que_fazemos')}}</a></li>
                            <li><a href="" data-route="/secao/2">{{trans('interface.nossa_historia')}}</a></li>
                            <li><a href="" data-route="/secao/3">{{trans('interface.quem_e_quem')}}</a></li>
                            <li><a href="" data-route="/associadas">{{trans('interface.associadas')}}</a></li>
                            <li><a href="" data-route="/faleconosco">{{trans('interface.fale_conosco')}}</a></li>
                        </ul>
                    </div>

                    <div class="coluna-links col-md-3 col-sm-6 col-xs-6">
                        <a href="" data-route="/projetos"><h3>Projetos</h3></a>
                        <ul class="lista-links">
                            <li><a href="" data-route="/projetos" class="active">{{trans('interface.todos_os_projetos')}}</a></li>
                            <!--<li><a href="" data-route="/projetos-numeros">{{trans('interface.projetos_em_números')}}</a></li>-->
                            <li><a href="" data-route="/secao/4">{{trans('interface.como_criar_um_projeto')}}</a></li>
                            <li><a href="" data-route="/secao/5">{{trans('interface.como_gerenciar_um_projeto')}}</a></li>
                            <li class="sip"><a href="" data-route="/secao/6">SIP</a></li>
                        </ul>
                    </div>

                    <div class="coluna-links col-md-3">
                        <a href="" data-route="/noticias"><h3>{{trans('interface.noticias')}}</h3></a>

                        <a  href="" data-route="/biblioteca"><h3>{{trans('interface.biblioteca')}}</h3></a>
                        <ul class="lista-links">
                            <li><a href="" data-route="/secao/7">{{trans('interface.politica_de_dados')}}</a></li>
                            <li><a href="" data-route="/secao/8">{{trans('interface.licenca_de_uso_e_direito_autoral')}}</a></li>
                        </ul>

                        @if(Request::session()->has('social'))
                            <div class="icons-sociais">
                                @foreach(Request::session()->get('social') as $social)
                                    <a href="//{{ $social->url }}" target="_blank"><img src="{{ asset('images/' . $social->image) }}" alt="{{ $social->image_alt }}" ></a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </nav>

                <div class="coluna-links col-md-3">
                    <h3 class="uppercase">{{trans('interface.assine_nossa_newsletter')}}</h3>

                    <div class="form-newsletter">
                        <input type="text" placeholder="{{trans('interface.seu_nome')}}">
                        <input type="email" placeholder="{{trans('interface.seu_email')}}">
                        <button type="submit">{{trans('interface.enviar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>
</html>