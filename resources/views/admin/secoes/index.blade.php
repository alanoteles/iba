@extends('admin.layouts.master')

@section('title','Seções')

@section('content')

    @include('admin.includes.flashmessages')

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
                            <td><a href="" data-route="/admin/secoes/{{$resultado->id}}/edit">{{$resultado->title}}</a></td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div><!-- /.table-responsive -->
        <!--/ ######### tabela responsiva ######### -->
    </div>

    @include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/secoes.js')}}"></script>--}}

@endsection('content')