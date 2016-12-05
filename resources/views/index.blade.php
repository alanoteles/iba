@extends('master')


@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                @include('includes.projetos_em_destaque')
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
                {{--Comentado temporariamente a pedido do IBA--}}
                {{--@include('includes.projetos_em_numeros_lateral')--}}
                <!--Localizar projetos temporário-->
                @include('includes.localizar_projetos')

            </div>

        </div>
    </div>
@endsection

@section('content-color')
    <div class="content-color">
        <div class="container">

            @include('includes.noticias_em_destaque')

            @include('includes.criando_gerenciando_projetos')

        </div>
    </div>
@endsection

@section('destaques_institucionais_biblioteca')
    <div class="content">
        <div class="container">

            <div class="col-md-8">
                @include('includes.destaques_institucionais')
            </div>
            <div class="col-md-4 pull-right">
                @include('includes.destaques_biblioteca_lateral')
            </div>

        </div>

    </div>
@endsection

@section('banner')

    @include('includes.banner')

@endsection


@section('associadas')

    @include('includes.associadas')

@endsection


{{--@section('content')--}}

{{--<div class="container">--}}
     {{--<h1>Produtos</h1>--}}

    {{--<table class="table table-striped table-bordered table-hover">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{--<th>ID</th>--}}
            {{--<th>Nome</th>--}}
            {{--<th>Descrição</th>--}}
            {{--<th>Ação</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
            {{--@foreach($cities as $city)--}}
                {{--<tr>--}}
                    {{--<td>{{ $city->id }}</td>--}}
                    {{--<td>{{ $city->name }}</td>--}}
                    {{--<td>{{ $city->state->name }} - {{ $city->state->country->name }}</td>--}}
                    {{--<td></td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}

            {{----}}
        {{--</tbody>--}}
    {{--</table>--}}



{{--</div>--}}
{{--@endsection--}}
