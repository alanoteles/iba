<div class="beh-projetosabas pull-left">
    <!-- CONTROLES DAS ABAS -->
    <ul class="nav nav-tabs nav-justified proj-abas">
        <li role="projetos" class="active"><a href="#em-andamento" data-toggle="tab">{{trans('interface.projetos_em_andamento')}}</a></li>
        {{--<li role="projetos"><a href="#em-analise">Projetos em análise</a></li>--}}
        <li role="projetos"><a href="#encerrados">{{trans('interface.projetos_encerrados')}}</a></li>
        {{--<li role="projetos"><a href="#cancelados">Projetos cancelados</a></li>--}}
    </ul>

    <!-- CONTEÚDO DAS ABAS -->
    <div class="tab-content">

        <!-- ABA 1 -->
        {{--@if(count($em_andamento) > 0)--}}
            <div role="tabpanel" class="tab-pane active" id="em-andamento">
                <div class="beh-maisrecentes beh-maisrecentes-projetos em_andamento" id="em_andamento">
                    @if(count($em_andamento) > 0)
                        @foreach($em_andamento as $andamento)
                            <div class="itens">
                                <div class="item" >
                                    <a href="" data-route="/projetos-detalhe/{{ $andamento->id }}">
                                        <h2 class="title-projeto"> {{ $andamento->title }}</h2>
                                        <p class="description"> {!!  str_limit($andamento->summary, $limit = 200, $end = '...') !!}</p>

                                        <div class="dados-gerais">
                                            <ul class="projeto-info">
                                                <li class="">
                                                    <span class="name">{{trans('interface.numero_do_projeto')}}</span>
                                                    <span class="number">{{ $andamento->number }}</span>
                                                </li>

                                                <li class="">
                                                    <span class="name">{{trans('interface.situacao')}}</span>
                                                    <span class="number">{{ $andamento->project_situation->name }}</span>
                                                </li>

                                                <li class="">
                                                    <span class="name">{{trans('interface.proponente')}}</span>
                                                    <span class="number">
                                                        @foreach($andamento->project_partner as $pp)
                                                            @if( $pp->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                                                {{ $pp->acronym }} - {{ $pp->name }}
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
                    @else
                        <div class="itens">
                            <div class="item" >
                                <h2 class="title-projeto"> Não existem projetos nessa situação.</h2>
                            </div>
                        </div>
                    @endif

                </div>


                @if ($itens_por_pagina < $em_andamento->total())
                    <div class="btn-moreresults">
                        <button type="submit" data-situation-id="1" data-proxima-pagina="{{ $em_andamento->nextPageUrl() }}">{{trans('interface.exibir_mais_resultados')}}</button>
                    </div>
                @endif
            </div>
        {{--@endif--}}

        <!-- ABA 2 --> <!-- OCULTADA POR SOLICITAÇÃO DA NATÁLIA EM 15/08/2016 -->
        {{--@if(count($em_analise) > 0)--}}
            {{--<div role="tabpanel" class="tab-pane" id="em-analise">--}}
                {{--<div class="beh-maisrecentes beh-maisrecentes-projetos em_analise">--}}
                    {{--@if(count($em_analise) > 0)--}}
                        {{--@foreach($em_analise as $analise)--}}
                            {{--<div class="itens">--}}
                                {{--<div class="item" >--}}
                                    {{--<a href="projetos-detalhe/{{ $analise->id }}">--}}
                                        {{--<h2 class="title-projeto"> {{ $analise->title }}</h2>--}}
                                        {{--<p class="description"> {{ $analise->summary }}</p>--}}

                                        {{--<div class="dados-gerais">--}}
                                            {{--<ul class="projeto-info">--}}
                                                {{--<li class="">--}}
                                                    {{--<span class="name">Número do Projeto</span>--}}
                                                    {{--<span class="number">{{ $analise->number }}</span>--}}
                                                {{--</li>--}}

                                                {{--<li class="">--}}
                                                    {{--<span class="name">Situação</span>--}}
                                                    {{--<span class="number">{{ $analise->project_situation->name }}</span>--}}
                                                {{--</li>--}}

                                                {{--<li class="">--}}
                                                    {{--<span class="name">Proponente</span>--}}
                                                    {{--<span class="number">--}}
                                                        {{--@foreach($analise->project_partner as $pp)--}}
                                                            {{--@if( $pp->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))--}}
                                                                {{--{{ $pp->acronym }} - {{ $pp->name }}--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--</span>--}}
                                                {{--</li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--<div class="itens">--}}
                            {{--<div class="item" >--}}
                                {{--<h2 class="title-projeto"> Não existem projetos nessa situação.</h2>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}


                {{--@if ($itens_por_pagina < $em_analise->total())--}}
                    {{--<div class="btn-moreresults">--}}
                        {{--<button type="submit" data-situation-id="2" data-proxima-pagina="{{ $em_analise->nextPageUrl() }}">Exibir mais resultados</button>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--@endif--}}

        <!-- ABA 3 -->
        @if(count($encerrados) > 0)
            <div role="tabpanel" class="tab-pane" id="encerrados">
                <div class="beh-maisrecentes beh-maisrecentes-projetos encerrados">
                    @if(count($encerrados) > 0)
                        @foreach($encerrados as $encerrado)
                            <div class="itens">
                                <div class="item" >
                                    <a href="projetos-detalhe/{{ $encerrado->id }}">
                                        <h2 class="title-projeto"> {{ $encerrado->title }}</h2>
                                        <p class="description"> {!!  str_limit($encerrado->summary, $limit = 200, $end = '...') !!}</p>

                                        <div class="dados-gerais">
                                            <ul class="projeto-info">
                                                <li class="">
                                                    <span class="name">Número do Projeto</span>
                                                    <span class="number">{{ $encerrado->number }}</span>
                                                </li>

                                                <li class="">
                                                    <span class="name">Situação</span>
                                                    <span class="number">{{ $encerrado->project_situation->name }}</span>
                                                </li>

                                                <li class="">
                                                    <span class="name">Proponente</span>
                                                    <span class="number">
                                                        @foreach($encerrado->project_partner as $pp)
                                                            @if( $pp->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                                                {{ $pp->acronym }} - {{ $pp->name }}
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
                    @else
                        <div class="itens">
                            <div class="item" >
                                <h2 class="title-projeto"> Não existem projetos nessa situação.</h2>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($itens_por_pagina < $encerrados->total())
                    <div class="btn-moreresults">
                        <button type="submit" data-situation-id="3" data-proxima-pagina="{{ $encerrados->nextPageUrl() }}">Exibir mais projetos</button>
                    </div>
                @endif
            </div>
        @endif

        <!-- ABA 4 -->
        <!-- OCULTADA POR SOLICITAÇÃO DA NATÁLIA EM 15/08/2016 -->
        {{--<div role="tabpanel" class="tab-pane" id="cancelados">--}}
            {{--<div class="beh-maisrecentes beh-maisrecentes-projetos cancelados">--}}
                {{--@if(count($cancelados) > 0)--}}
                    {{--@foreach($cancelados as $cancelado)--}}
                        {{--<div class="itens">--}}
                            {{--<div class="item" >--}}
                                {{--<a href="projetos-detalhe/{{ $cancelado->id }}">--}}
                                    {{--<h2 class="title-projeto"> {{ $cancelado->title }}</h2>--}}
                                    {{--<p class="description"> {{ $cancelado->summary }}</p>--}}

                                    {{--<div class="dados-gerais">--}}
                                        {{--<ul class="projeto-info">--}}
                                            {{--<li class="">--}}
                                                {{--<span class="name">Número do Projeto</span>--}}
                                                {{--<span class="number">{{ $cancelado->number }}</span>--}}
                                            {{--</li>--}}

                                            {{--<li class="">--}}
                                                {{--<span class="name">Situação</span>--}}
                                                {{--<span class="number">{{ $cancelado->project_situation->name }}</span>--}}
                                            {{--</li>--}}

                                            {{--<li class="">--}}
                                                {{--<span class="name">Proponente</span>--}}
                                                {{--<span class="number">--}}
                                                    {{--@foreach($cancelado->project_partner as $pp)--}}
                                                        {{--@if( $pp->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))--}}
                                                            {{--{{ $pp->acronym }} - {{ $pp->name }}--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</span>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}

                {{--@else--}}
                    {{--<div class="itens">--}}
                        {{--<div class="item" >--}}
                            {{--<h2 class="title-projeto"> Não existem projetos nessa situação.</h2>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--</div>--}}

            {{--@if ($itens_por_pagina < $cancelados->total())--}}
                {{--<div class="btn-moreresults">--}}
                    {{--<button type="submit" data-situation-id="4" data-proxima-pagina="{{ $cancelados->nextPageUrl() }}">Exibir mais resultados</button>--}}
                {{--</div>--}}
             {{--@endif--}}
        {{--</div>--}}


    </div> <!-- .tab-content -->
</div>