@extends('admin.layouts.master')

@section('title','Banners')

@section('content')

    @include('admin.includes.flashmessages')

    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            <a href="{{ URL::to(App::getLocale() . '/admin/banners/destaques') }}" class="btn cancelar btn-sm margin-right-20">Definir posição</a>
            <a href="{{ URL::to(App::getLocale() . '/admin/banners/create') }}" class="btn btn-sm btn-success">Novo banner</a>
        </div>
    </div>

    @include('admin.includes.pesquisa')


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
                    <th>Título</th>
                    <th>Posição</th>
                    <th>Exibir</th>
                    <th class="center">Ações</th>
                </tr>
                </thead>

                <tbody>

                <!-- line -->
                    @foreach($resultados as $key => $resultado)

                        <!-- Lista apenas os registros em Português, já que existe a aba Tradução. -->
                        {{--@if($resultado->locale == App::getLocale())--}}
                            <tr>
                                <td class="sel">
                                    <label>
                                        &nbsp; <input type="checkbox" class="ace">
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <?php $res = $resultado->toArray() ?>
                                <td><a href="" data-route="/admin/banners/{{ $resultado->id }}/edit">{{ $res['title'] }}</a></td>
                                <td align="center">

                                    {{ strtoupper($resultado->positions['position']) }}
                                </td>
                                <td>
                                    <select class="form-control transparent status" name="status" style="height: 22px;"  data-id="{{ (isset($resultado->banner_id) ? $resultado->banner_id : $resultado->id) }}">
                                        <option value="1" {{ ($resultado->status == '1') ? 'selected=selected' : ''  }}>Sim</option>
                                        <option value="0" {{ ($resultado->status == '0') ? 'selected=selected' : ''  }}>Não</option>
                                    </select>
                                </td>
                                <td class="acoes center">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-xs btn-grey remover-item-lista excluir"  data-id="{{ (isset($resultado->banner_id) ? $resultado->banner_id : $resultado->id)  }}">
                                            <i class="icon-trash bigger-120"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        {{--@endif--}}
                    @endforeach



                </tbody>
            </table>
        </div><!-- /.table-responsive -->
        <!--/ ######### tabela responsiva ######### -->
    </div>


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/parceiros.js')}}"></script>--}}

@endsection('content')