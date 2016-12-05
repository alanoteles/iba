<section class="beh-maisrecentes beh-maisrecentes-projetos">
    <h2 class="subtitle-area">{{trans('interface.resultado_da_busca')}}</h2>

    @foreach($projetos as $key => $projeto)
        <div class="itens" id="ultimas">
            <div class="item">
                <a href="" data-route="/projetos-detalhe/{{ $projeto->id }}">

                    <h2 class="title-projeto">{{ $projeto->title }}</h2>
                    <p class="description">{!!  str_limit($projeto->summary, $limit = 200, $end = '...') !!}</p>


                    <div class="dados-gerais">
                        <ul class="projeto-info">
                            <li class="">
                                <span class="name">{{trans('interface.numero_do_projeto')}}</span>
                                <span class="number">{{ $projeto->number }}</span>
                            </li>
                            <li class="">
                                <span class="name">{{trans('interface.situacao')}}</span>
                                <span class="number">{{ $projeto->project_situation->name }}</span>
                            </li>
                            <li class="">
                                <span class="name">{{trans('interface.proponente')}}</span>
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

    @if ($itens_por_pagina < $projetos->total())
        <div class="btn-moreresults">
            <button type="submit" data-situation-id="ultimas" data-proxima-pagina="{{ $projetos->nextPageUrl() }}">{{trans('interface.exibir_mais_resultados')}}</button>
        </div>
    @endif

</section>