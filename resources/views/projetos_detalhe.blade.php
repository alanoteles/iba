@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render('projetos-detalhe', $dados) !!}
@endsection



@section('content')
    <div class="content">
        <div class="container">
            <div class="share-wrap">
                @include('includes.compartilhar')
            </div>

            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                <article class="beh-post ">
                    <h1 class="title-page">{{ $dados->title }} </h1>
                    <p>{!! $dados->summary !!}</p>
                    <section class="beh-projetoinfo">
                        <div class="dados-gerais">
                            <ul class="projeto-info">
                                <li class="">
                                    <span class="name">{{trans('interface.numero_do_projeto')}}</span>
                                    <span class="number">{{ $dados->number }}</span>
                                </li>
                                <li class="">
                                    <span class="name">{{trans('interface.situacao')}}</span>
                                    <span class="number">{{ $dados->project_situation->name }}</span>
                                </li>
                                <li class="">
                                    <span class="name">{{trans('interface.data_da_aprovacao')}}</span>
                                    <span class="number">{{ date('d/m/Y', strtotime($dados->meeting_date)) }}</span>
                                </li>
                                <li class="">
                                    <span class="name">{{trans('interface.periodo_de_execucao')}}</span>
                                    <span class="number">{{ date('d/m/Y', strtotime($dados->implementation_period_start)) }}  a {{ date('d/m/Y', strtotime($dados->implementation_period_end)) }}</span>
                                </li>
                                <li class="">
                                    <span class="name">{{trans('interface.proponente')}}</span>
                                    <span class="number">
                                        @foreach($dados->project_partner as $d)
                                            @if( $d->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                                {{ $d->acronym }} - {{ $d->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                <li class="">
                                    <span class="name">{{trans('interface.executora')}}</span>
                                    <span class="number">
                                         @foreach($dados->project_partner as $d)
                                            @if( $d->pivot->type == Config::get('constants.PARTNERS_TYPE_EXECUTOR'))
                                                {{ $d->acronym }} - {{ $d->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </section>
                </article>

                @include('includes.arquivos_anexos')

            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                <section class="beh-projetoinfo">
                    <h2 class="subtitle-area">{{trans('interface.valor_do_projeto')}}</h2>

                    <div class="itens">

                        <div class="item">
                            <strong>{{trans('interface.valor_total_do_projeto')}}</strong>
                            <span>R$ {{ number_format($dados->project_value,2,',','.') }}</span>
                        </div>

                        @foreach($dados->project_year as $key => $year)
                            <div class="item">
                                <strong>{{trans('interface.ano'.($key+1)) }}</strong>
                                <span>R$ {{ number_format($year->value,2,',','.') }} </span>
                            </div>
                        @endforeach

                    </div>

                </section>

                <section class="beh-projetoinfo">
                    <h2 class="subtitle-area">{{trans('interface.principais_resultados_esperados')}}</h2>
                    {!! $dados->results !!}
                </section>

            </aside>
        </div>
    </div>

    @include('includes.conteudo_relacionado')

@endsection

@section('banner')

    @include('includes.banner')

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection

