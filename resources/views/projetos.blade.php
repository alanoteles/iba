@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render() !!}
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left padding-bottom-sm">

                @if(isset($tipo))

                    @include('includes.resultado_busca_projetos')

                @else
                    @include('includes.projetos_em_destaque')

                    @include('includes.projetos_abas')
                @endif
            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                @include('includes.localizar_projetos')

                @include('includes.destaques_biblioteca_lateral')

                @include('includes.projetos_em_numeros_lateral')

                {{--@include('includes.banner_interna')--}}
            </aside>
        </div>
    </div>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection

