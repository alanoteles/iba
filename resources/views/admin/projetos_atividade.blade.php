@extends('admin.layouts.master')

@section('title','Atividades de projeto')

@section('content')

    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <a href="atividade_nova.html">
                <button class="btn btn-sm btn-success">Nova atividade</button>
            </a>
        </div>
    </div>


    <div class="row margin-top-15 ">
        <div class="col-xs-12">
            Pesquisa
            <hr class="margin-top-5 margin-bottom-5">
        </div>
    </div>

    <!-- Fomulario de pesquisa -->
    <div class="col-xs-12 no-padding margin-bottom-15 margin-top-10">
        {!! Form::open(array('url'=>'admin/projetos-atividade/search')) !!}
            <div class="col-xs-3 no-padding-left">
                {!! Form::text('palavra-chave',$palavra_chave,array('class'=>'col-xs-12', 'placeholder'=>'nome')) !!}
            </div>
            <div class="col-xs-3">
                {{ Form::select('select_exibir',['Não','Sim'],null,['class'=>'form-control transparent', 'placeholder'=>'Exibir todos']) }}
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Pesquisar',array('class'=>'btn btn-info btn-sm bnt-input-height')) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <!-- Fomulario de pesquisa -->


    <div class="row-fluid">
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover no-margin">
                <thead>
                <tr>
                    <th class="align-left acao-massa">
                        <label>
                            &nbsp; <input type="checkbox" class="ace">
                            <span class="lbl"></span>
                        </label>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-xs dropdown-toggle">
                                <span class="icon-caret-down icon-on-right"></span>
                            </button>

                            <ul class="dropdown-menu dropdown-inverse">
                                <li><a href="#" class="ativar-all">Ativar</a></li>
                                <li><a href="#">Desativar</a></li>
                                <li class="divider"></li>
                                <li><a href="#" class="excluir_massa">Excluir</a></li>
                            </ul>
                        </div>
                    </th>
                    <th style="width: 70%;">Atividade</th>
                    <th class="hidden-480">Exibir</th>
                    <th class="center">Ações</th>
                </tr>
                </thead>

                <tbody>
                <!-- line -->
                @foreach($results as $atividade)
                    <tr>
                        <td class="sel">
                            <label>
                                &nbsp; <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td class="nome-grupo" style="width: 70%;"><a
                                    href="{{'/admin/projetos-atividade/'.$atividade->id.'/edit'}}"
                                    data-route="/admin/projetos-atividade/{{$atividade->id}}/edit">{{$atividade->name}}</a>
                        </td>
                        <td class="hidden-480 situacao situacao-clientes">
                            <!--Select Laravel Exibir-->
                            {{ Form::select('form-field-select-1',['Não','Sim'],$atividade->status,['class'=>'form-control transparent']) }}
                        </td>
                        <td class="acoes center">
                            <div class="btn-group">
                                <a href="#" class="btn btn-xs btn-grey remover-item-lista">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                            <!--/ line -->

                </tbody>
            </table>
        </div><!-- /.table-responsive -->
        <!--/ ######### tabela responsiva ######### -->
    </div>

    <!-- PAGINAÇÃO -->
    @include('admin.includes.paginacao')
            <!--/ PAGINAÇÃO -->

    <!-- scripts exclusivos desta area -->
    <script src="{{asset('admin/js/atividade.js')}}"></script>

@endsection('content')