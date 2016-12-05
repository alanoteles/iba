@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render('secao', $dados) !!}
@endsection



@section('content')
    <div class="content">
        <div class="container">

            @if($pagina == 'projetos')

                <script type="text/javascript" charset="utf-8">
                    //Selecionar o item correto de submenu
                    selectSubNavbar({{$dados->id -1}});
                </script>

                <div class="share-wrap">
                    @include('includes.compartilhar')
                </div>

                <div class="col-md-8 col-sm-12 col-xs-12 pull-left">

                    @else

                        <div class="col-md-8 col-sm-12 col-xs-12 pull-left">

                            @include('includes.compartilhar')

                            @endif

                            @include('includes.secao')

                            {{--@include('includes.arquivos_anexos')--}}
                        </div>
                        <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                            @include('includes.destaques_biblioteca_lateral')

                            @include('includes.projetos_em_numeros_lateral')

                            @include('includes.banner_interna')
                        </aside>
                </div>
        </div>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection