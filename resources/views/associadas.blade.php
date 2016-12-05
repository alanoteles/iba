@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render() !!}
@endsection



@section('content')
    <div class="content">
        <div class="container">

                @include('includes.associadas_listagem')

        </div>
    </div>

@endsection


@section('banner')

    @include('includes.banner')

@endsection
