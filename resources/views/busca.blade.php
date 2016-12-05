@extends('master')

@section('breadcrumb')
    {{--{!! Breadcrumbs::render() !!}--}}
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left ">
                <div class="search-results">
                    <h2 class="subtitle-area">Resultado da busca</h2>
                    <h2 class="subtitle-search">{{ $projetos->total() + $noticias->total() + $biblioteca->total() + $institucional->total() }}
                        registros encontrados</h2>
                </div>
                <section class="beh-maisrecentes beh-maisrecentes-projetos">

                    <div class="itens em_andamento">
                        <h2 class="subtitle-area">Projetos</h2>
                        <div id="em_andamento">
                            @foreach($projetos as $key => $projeto)
                                <div class="itens">
                                <div class="item">
                                    <a href="" data-route="/projetos-detalhe/{{ $projeto->id }}">

                                        <h2 class="title-projeto">{{ $projeto->title }}</h2>
                                        <p class="description">{!!  str_limit($projeto->summary, $limit = 200, $end = '...') !!}</p>


                                        <div class="dados-gerais">
                                            <ul class="projeto-info">
                                                <li class="">
                                                    <span class="name">Número do Projeto</span>
                                                    <span class="number">{{ $projeto->number }}</span>
                                                </li>
                                                <li class="">
                                                    <span class="name">Situação</span>
                                                    <span class="number">{{ $projeto->project_situation->name }}</span>
                                                </li>
                                                <li class="">
                                                    <span class="name">Proponente</span>
                                                    <span class="number">
                                                        @foreach($projeto->project_partner as $p)
                                                            @if( $p->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                                                {{ $p->acronym }} - {{ $p->name }}
                                                            @endif
                                                        @endforeach
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>

                                    </a>
                                </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>


                    @if ($itens_por_pagina < $projetos->total())
                        <div class="btn-moreresults">
                            <button type="submit" data-situation-id="1" data-proxima-pagina="{{ $projetos->nextPageUrl() }}">Exibir mais resultados</button>
                        </div>
                    @endif
                </section>

                <section class="beh-maisrecentes noticias">
                    <h2 class="subtitle-area">Notícias</h2>
                    <div class="ultimas">
                        <div class="itens" id="ultimas">
                            @foreach($noticias as $key => $noticia)
                                <div class="item">
                                    <a href="" data-route="/noticias-detalhe/{{ $noticia->id }}">
                                        {{--<figure><img src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}"></figure>--}}
                                        <figure>
                                            @if(!empty($noticia->images->image))
                                                <img  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}" style="height: 80px;">
                                            @else
                                                <img  src="{{ url('/') .'/uploads/noticias/img-ultimasnoticias-fake.png' }}">
                                            @endif
                                        </figure>
                                        <div class="info">
                                            <div class="entry-meta">
                                                <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>

                                                <div>
                                                    <span class="autor pull-left">{{ $noticia->news_editorial->name }}</span>
                                                    {{--<span class="outro">OUTRO SUBITEM DO DESTAQUE </span>--}}
                                                    {{--<span class="outro">OUTRO SUBITEM DO DESTAQUE </span>--}}
                                                </div>
                                            </div>
                                            <p class="description">{!!  $noticia->title !!}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        @if ($itens_por_pagina < $noticias->total())
                            <div class="btn-moreresults">
                                <button type="submit" data-situation-id="ultimas" data-proxima-pagina="{{ $noticias->nextPageUrl() }}">Exibir mais resultados</button>
                            </div>
                        @endif
                    </div>
                </section>
<p>&nbsp;</p>
<p>&nbsp;</p>
                <section class="beh-maisrecentes biblioteca">
                    <h2 class="subtitle-area">Biblioteca</h2>
                    <div class="itens" id="recentes">
                            @foreach($biblioteca as $key => $bib)
                                <div class="item">
                                    @foreach($bib->attachment as $a)
                                        <a href="" data-route="/biblioteca-detalhe/{{ $a->id }}">
                                            <figure>
                                                @if( substr($a->filename,-3) == 'pdf')
                                                    <img src="{{ asset('images/icon-pdf.png') }}">
                                                @elseif( substr($a->filename,-3) == 'doc' || substr($a->filename,-4) == 'docx')
                                                    <img src="{{ asset('images/icon-doc.png') }}">
                                                @elseif( substr($a->filename,-3) == 'xls' || substr($a->filename,-4) == 'xlsx')
                                                    <img src="{{ asset('images/icon-xls.png') }}">
                                                @elseif( substr($a->filename,-3) == 'ppt' || substr($a->filename,-4) == 'pptx')
                                                    <img src="{{ asset('images/icon-ppt.png') }}">
                                                @elseif( substr($a->filename,-3) == 'zip' || substr($a->filename,-3) == 'tgz')
                                                    <img src="{{ asset('images/icon-zip.png') }}">
                                                @elseif( substr($a->filename,-3) == 'mp3')
                                                    <img src="{{ asset('images/icon-mp3.png') }}">
                                                @endif
                                            </figure>
                                            @endforeach
                                            <div class="info">
                                                <div class="entry-meta">
                                                    {{--<span class="data">29.11.2011 </span>--}}
                                                    {{--<span class="horario">14h34</span>--}}
                                                    <div>
                                                        <span class="autor pull-left">{{ $bib->thread->title }}</span>
                                                        <span class="outro">{{ $bib->topic->title }} </span>
                                                        <span class="outro">{{ $bib->subtopic->title }} </span>
                                                    </div>
                                                </div>
                                                <p class="description">{{ $bib->title }}</p>
                                            </div>
                                        </a>
                                </div>
                            @endforeach
                        </div>

                    @if ($itens_por_pagina < $biblioteca->total())
                        <div class="btn-moreresults">
                            <button type="submit" data-situation-id="recentes" data-proxima-pagina="{{ $biblioteca->nextPageUrl() }}">Exibir mais resultados</button>
                        </div>
                    @endif
                </section>

<p>&nbsp;</p>
<p>&nbsp;</p>
                <section class="beh-maisrecentes institucional">
                    <h2 class="subtitle-area">Institucional</h2>
                    <div class="institucional">
                        <div class="itens" id="institucional">
                            @foreach($institucional as $key => $i)
                                <div class="itens">
                                    <div class="item">
                                        <a href="" data-route="/secao/{{ $i->id }}">

                                            <h2 class="title-projeto">{{ $i->title }}</h2>
                                            <p class="description">{!!  str_limit($i->content_data, $limit = 200, $end = '...') !!}</p>
                                            <p>&nbsp;</p>

                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($itens_por_pagina < $institucional->total())
                            <div class="btn-moreresults">
                                <button type="submit" data-situation-id="institucional" data-proxima-pagina="{{ $institucional->nextPageUrl() }}">Exibir mais resultados</button>
                            </div>
                        @endif
                    </div>
                </section>

            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                <section class="beh-projetoslocalizar">
                    <h2 class="subtitle-area">Filtrar Busca</h2>
                    <div class="filtros">
                        <ul class="uppercase filtrar-busca">
                            <a href="#" data-section="todos">
                                <li class="filtro-total">
                                    <span class="nome-filtro">Todos</span>
                                    <span class="valor-filtro todos">{{ $projetos->total() + $noticias->total() + $biblioteca->total() + $institucional->total() }}</span>
                                </li>
                            </a>

                            <a href="#" data-section="beh-maisrecentes-projetos">
                                <li>
                                    <span class="nome-filtro">Projetos</span>
                                    <span class="valor-filtro beh-maisrecentes-projetos">{{ $projetos->total() }}</span>
                                </li>
                            </a>

                            <a href="#" data-section="noticias">
                                <li>
                                    <span class="nome-filtro">Notícias</span>
                                    <span class="valor-filtro noticias">{{ $noticias->total() }}</span>
                                </li>
                            </a>

                            <a href="#" data-section="biblioteca">
                                <li>
                                    <span class="nome-filtro">Documentos</span>
                                    <span class="valor-filtro biblioteca">{{ $biblioteca->total() }}</span>
                                </li>
                            </a>

                            <a href="#" data-section="institucional">
                                <li>
                                    <span class="nome-filtro">Institucional</span>
                                    <span class="valor-filtro institucional">{{ $institucional->total() }}</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </section>

                {{--@include('includes.projetos_em_numeros_lateral')--}}

                {{--@include('includes.banner_interna')--}}
            </aside>
        </div>
    </div>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection

