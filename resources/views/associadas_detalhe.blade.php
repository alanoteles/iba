@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render('associadas-detalhe', $associada) !!}
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="beh-associadaslist pull-left">
                <div class="col-md-12">
                    <h1 class="title-page">{{ $associada->name }}</h1>
                    <figure class="associada">
                        @if($associada->images['image'] != '')
                            <img src="{{ url('/') .'/uploads/associadas/' . $associada->images['image'] }}">
                        @else
                            <img src="{{ url('/') .'/images/img-associada-default.jpg'}}">
                        @endif
                    </figure>
                    <p>{{ $associada->summary }}</p>
                    <p>{{$associada->content_data}}</p>

                    <div class="links">
                        <a href="http://{{ $associada->url }}" class="btn-site pull-left" target="_blank">visite o site</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--<div class="content">--}}
        {{--<div class="container">--}}
            {{--<div class="pull-left col-md-12 ">--}}
                {{--<section class="beh-graficosatividades">--}}
                    {{--<h2 class="title-comparativo">PROJETOS X ATIVIDADES</h2>--}}
                    {{--@foreach($lista as $l)--}}
                        {{--<div class="item">--}}
                            {{--<div class="info col-md-6 col-sm-12 col-xs-12">--}}
                                {{--<div class="nome">{{ $l->name }}</div>--}}
                                {{--<div class="valor">R$ {{ number_format($l->total_projetos,2,',','.') }}</div>--}}
                            {{--</div>--}}
                            {{--<div class="percentual col-md-6 col-sm-12 col-xs-12">--}}
                                {{--<div class="numero">{{ $l->porcentagem }}%</div>--}}
                                {{--<div class="percentual-bar" style="width:{{ $l->porcentagem }}%"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                    {{--<div class="item item-total">--}}
                        {{--<div class="info col-md-6 col-sm-12 col-xs-12">--}}
                            {{--<div class="nome">Total</div>--}}
                            {{--<div class="valor">R$ {{ number_format($vlr_total_projetos,2,',','.') }}</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</section>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="content">
        <div class="container">


            <div class="col-md-8 col-sm-12 col-xs-12 pull-left padding-bottom-sm">
                {{--<div class="col-md-6 col-xs-12 padding-bottom-xs padding-right-md">--}}
                    {{--<h2 class="subtitle-area">Projetos x Período</h2>--}}
                    {{--<input type="hidden" id="projetos_situacao_associada" class="projeto_situacao" value="{{$associada->id}}">--}}

                    {{--<select id="projetos_situacao" class="projeto_situacao">--}}
                        {{--<option>Todas as situações</option>--}}
                        {{--@foreach($situacoes as $situacao)--}}
                            {{--<option value="{{ $situacao->id }}">{{ $situacao->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    {{--<section class="beh-graficodefault">--}}
                        {{--<div id="graphic"></div>--}}

                    {{--</section>--}}

                {{--</div>--}}
                {{--<div class="col-md-6 col-xs-12 pull-right padding-left-md">--}}
                    {{--<h2 class="subtitle-area">Projetos x Atividades</h2>--}}
                    {{--<input type="hidden" id="projetos_atividades_associada" class="projeto_atividade" value="{{$associada->id}}">--}}

                    {{--<select id="projetos_atividades_atividade" class="projeto_atividade">--}}
                        {{--<option>Todas as atividades</option>--}}
                        {{--@foreach($atividades as $atividade)--}}
                            {{--<option value="{{ $atividade->id }}">{{ $atividade->name }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    {{--<section class="beh-graficodefault">--}}
                        {{--<div id="grafico-atividades"></div>--}}
                        {{--<script>--}}

                        {{--</script>--}}
                    {{--</section>--}}

                {{--</div>--}}

                <div class="padding-bottom-xs">

                    @include('includes.projetos_abas')
                </div>

            </div>

            <div class="col-md-4 col-sm-12 col-xs-12 pull-right">

                @include('includes.projetos_em_numeros_lateral')

                @include('includes.noticias_relacionadas_lateral')

                @include('includes.arquivos_associados_lateral')


            </div>

        </div>
    </div>

    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--atualizaProjetoSituacao();--}}
            {{--atualizaProjetoAtividade('grafico-atividades');--}}

        {{--});--}}

        {{--//Alterar selects, modificar gráfico--}}
        {{--$('.projeto_situacao').change(function () {--}}
            {{--atualizaProjetoSituacao();--}}
        {{--})--}}


        {{--$(".projeto_atividade").change(function () {--}}
            {{--atualizaProjetoAtividade('grafico-atividades');--}}
        {{--});--}}

    {{--</script>--}}

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection

