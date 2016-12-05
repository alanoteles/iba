
    <section class="beh-projetosdestaques">
        @if( $pagina == 'index' || $pagina == 'projetos' )
            <h2 class="subtitle-area">{{trans('interface.projetos_em_destaque')}}
                <a href="" data-route="/projetos" class="btn-mais pull-right">
                    <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>
                    {{trans('interface.mais')}}
                </a>
            </h2>
        @endif

        @foreach($projetos as $key => $projeto)

            <div class="col-md-6 col-xs-12 padding-<?php echo $key ? 'left' : 'right' ;?>">
                <div class="projeto">
                    <a href="" data-route="/projetos-detalhe/{{ $projeto->id }}">

                        <h3 class="subtitle-conteudo">{!!  str_limit($projeto->title, $limit = 80, $end = '...') !!}</h3>
                        <p class="description">{!!  str_limit($projeto->summary, $limit = 90, $end = '...') !!}</p>
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
                                <span class="name">{{trans('interface.periodo_de_execucao')}}</span>
                                <span class="number">{{ date('d/m/Y', strtotime($projeto->implementation_period_start)) }}  a {{ date('d/m/Y', strtotime($projeto->implementation_period_end)) }}</span>
                            </li>
                            {{--<li class="">--}}
                                {{--<span class="name">Data da Aprovação</span>--}}
                                {{--<span class="number">{{ date('d/m/Y', strtotime($projeto->meeting_date)) }}</span>--}}
                            {{--</li>--}}
                            <li class="">
                                <span class="name">{{trans('interface.proponente')}}</span>
                                <span class="number">
                                    @foreach($projeto->project_partner as $p)
                                        @if( $p->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                            {{ $p->acronym }} - {!!  str_limit($p->name, $limit = 45, $end = '...') !!}
                                        @endif
                                    @endforeach
                                </span>
                            </li>
                            <li class="">
                                <span class="name">{{trans('interface.executora')}}</span>
                                <span class="number">
                                    @foreach($projeto->project_partner as $p)
                                        @if( $p->pivot->type == Config::get('constants.PARTNERS_TYPE_EXECUTOR'))
                                            {{ $p->acronym }} - {!!  str_limit($p->name, $limit = 45, $end = '...') !!}
                                        @endif
                                    @endforeach
                                </span>
                            </li>
                        </ul>
                    </a>
                </div>
            </div>
        @endforeach
        {{--<div class="col-md-6 col-xs-12 padding-left">--}}
            {{--<div class="projeto">--}}
                {{--<a href="" data-route="/projetos-detalhe/{{ $left->id }}">--}}
                    {{--<h3 class="subtitle-conteudo">{{ $left->title }}</h3>--}}
                    {{--<p class="description">{{ $left->summary }}</p>--}}
                    {{--<ul class="projeto-info">--}}
                        {{--<li class="">--}}
                            {{--<span class="name">Número do Projeto</span>--}}
                            {{--<span class="number">{{ $left->number }}</span>--}}
                        {{--</li>--}}
                        {{--<li class="">--}}
                            {{--<span class="name">Situação</span>--}}
                            {{--<span class="number">{{ $left->project_situation->name }}</span>--}}
                        {{--</li>--}}
                        {{--<li class="">--}}
                            {{--<span class="name">Período de Execução</span>--}}
                            {{--<span class="number">{{ date('d/m/Y', strtotime($left->implementation_period_start)) }}  a {{ date('d/m/Y', strtotime($left->implementation_period_end)) }}</span>--}}
                        {{--</li>--}}
                        {{--<li class="">--}}
                            {{--<span class="name">Proponente</span>--}}
                            {{--<span class="number">--}}
                                {{--@foreach($left->project_partner as $l)--}}
                                    {{--@if( $l->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))--}}
                                        {{--{{ $l->acronym }} - {{ $l->name }}--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</span>--}}
                        {{--</li>--}}
                        {{--<li class="">--}}
                            {{--<span class="name">Executora</span>--}}
                            {{--<span class="number">--}}
                                {{--@foreach($left->project_partner as $l)--}}
                                    {{--@if( $l->pivot->type == Config::get('constants.PARTNERS_TYPE_EXECUTOR'))--}}
                                        {{--{{ $l->acronym }} - {{ $l->name }}--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</span>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </section>
