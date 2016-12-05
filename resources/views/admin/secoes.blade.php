@extends('admin.layouts.master')

@section('title','Seções')

@section('content')
    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <!--                 <a href="_noticias_posicoes.html" class="btn cancelar btn-sm margin-right-20">Definir destaques</a>
                            <a href="_noticias_novo.html" class="btn btn-sm btn-success">Nova notícia</a> -->
        </div>
    </div>


    @include('admin.includes.pesquisa')


    <div class="row-fluid">
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover no-margin">
                <thead>
                <tr>
                    <th>Título da página</th>
                </tr>
                </thead>

                <tbody>
                <!-- line -->
                    @foreach($resultados as $key => $resultado)
                        <tr>
                            <td><a href="_secoes_novo.html">{{ $resultado->title }}</a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div><!-- /.table-responsive -->
        <!--/ ######### tabela responsiva ######### -->
    </div>

    @include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/secoes.js')}}"></script>

@endsection('content')