@extends('admin.layouts.master')

@section('title','Projetos')

@section('content')

    @include('admin.includes.flashmessages')

    <div class="row">
        <div class="col-xs-12 align-right margin-top-10">
            {{--<a href="_projeto_numeros.html" class="btn cancelar btn-sm margin-right-7">Projetos em números</a>--}}
            <a href="{{ URL::to(App::getLocale() . '/admin/projetos/destaques') }}" class="btn cancelar btn-sm marzgin-right-20">Definir destaques</a>
            <a href="{{ URL::to(App::getLocale() . '/admin/projetos/create') }}" class="btn btn-sm btn-success">Novo projeto</a>
        </div>
    </div>




    @include('admin.includes.pesquisa')

{{--{{ $resultados }}--}}

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
                        <th>Número</th>
                        <th>Situação do proj.</th>
                        <th>Destaque</th>
                        <th>Exibir</th>
                        <th class="center">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- line -->
                    <!-- line -->
                    @foreach($resultados as $key => $resultado)
                        <!-- Lista apenas os registros em Português, já que existe a aba Tradução. -->
                        <?php $resultado_array = $resultado->toArray() ?>
                        @if($resultado_array['locale'] == App::getLocale())

                            <tr>
                                <td class="sel">
                                    <label>
                                        &nbsp; <input type="checkbox" class="ace">
                                        <span class="lbl"></span>
                                    </label>
                                </td>

                                <td><a href="" data-route="/admin/projetos/{{ (isset($resultado->project_id) ? $resultado->project_id : $resultado->id) }}/edit">{{ $resultado_array['title'] }}</a></td>
                                <td>{{ $resultado->number }}</td>
                                <td>{{ $resultado->project_situation->name }}</td>
                                <td>
                                    @foreach($resultado->cms_highlights->where('module', 'projetos') as $key => $r)

                                        {{ strtoupper($r->position) }}

                                        @if($key < ($resultado->cms_highlights->where('module', 'projetos')->count()-1))
                                            {{  ' | ' }}
                                        @endif

                                    @endforeach

                                <td>
                                    <select class="form-control transparent status" name="status" style="height: 22px;"  data-id="{{ (isset($resultado->project_id) ? $resultado->project_id : $resultado->id) }}">
                                        <option value="1" {{ ($resultado->status == '1') ? 'selected=selected' : ''  }}>Sim</option>
                                        <option value="0" {{ ($resultado->status == '0') ? 'selected=selected' : ''  }}>Não</option>
                                    </select>
                                </td>
                                <td class="acoes center">
                                    <div class="btn-group">
                                        <a href="" class="btn btn-xs btn-grey remover-item-lista excluir"  data-id="{{ (isset($resultado->project_id) ? $resultado->project_id : $resultado->id) }}">
                                            <i class="icon-trash bigger-120"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!--/ line -->
                        @endif
                @endforeach


                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    <!--/ ######### tabela responsiva ######### -->
    </div>

    @include('admin.includes.paginacao')

    <!-- scripts exclusivos desta area -->
    {{--<script src="{{asset('admin/js/_projetos.js')}}"></script>--}}

@endsection('content')