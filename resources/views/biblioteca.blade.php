@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render() !!}
@endsection



@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">

                @if(isset($tipo))

                    @include('includes.resultado_busca_biblioteca')

                @else
                    @include('includes.destaques_biblioteca_interna')

                    @include('includes.mais_recentes')
                @endif

                {{--<div class="btn-moreresults"><button type="submit">EXIBIR MAIS resultados</button></div>--}}

            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                @include('includes.localizar_arquivos')

                @include('includes.destaques_biblioteca_lateral')

                @include('includes.banner_interna')
            </aside>
        </div>
    </div>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection