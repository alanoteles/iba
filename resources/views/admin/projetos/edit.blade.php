
@extends('admin.layouts.master')



@section('title','Projetos')

@section('content')



    <!-- WRAP DOS DADOS -->
<div class="wrap-content">

    {{--{!! Html::ul($errors->all()) !!}--}}

    <?php
        //foreach($errors->all() as $error){
//            echo '<pre>';
//            print_r($errors->all());
        //}
    ?>
    {{ Form::open(
        array(
            'url'   => App::getLocale() . '/admin/projetos/' .  (isset($projeto->id) ? $projeto->id : '' ),
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'method'    => (isset($projeto->id) ? 'PUT' : 'POST' ))
            )
        }}


    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($projeto->status) ? $projeto->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('array_proponentes',(isset($array_proponentes) ? $array_proponentes : ''),  array('id' => 'array_proponentes')) }}
    {{ Form::hidden('array_executores', (isset($array_executores) ? $array_executores : ''),    array('id' => 'array_executores')) }}
    {{ Form::hidden('array_anexos',     (isset($array_anexos) ? $array_anexos : ''),            array('id' => 'array_anexos')) }}
    {{ Form::hidden('project_id', (isset($projeto->id) ? $projeto->id : ''), array('id' => 'project_id')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}

    {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}
    {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($projeto))
                <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir projeto</a>
            @endif

            <a href="" data-route="/admin/projetos"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>


                    <li class=""><a data-toggle="tab" href="#aba-valores">Valores</a></li>
                    <li class=""><a data-toggle="tab" href="#aba-resultados">Resultados</a></li>
                    <li class=""><a data-toggle="tab" href="#aba-anexos">Anexos</a></li>
                @if(isset($projeto))
                    <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
                @endif
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">


                    <div class="exibir-sim-nao">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($projeto->status) ? ($projeto->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Sobre o projeto
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">

                        {{ Form::label('titulo', 'Título *', array('class' => 'col-sm-3 control-label no-padding-right')) }}
                        <div class="col-sm-9">
                            {{ Form::text('title', (isset($projeto->title) ? htmlentities($projeto->title) : ''), array('class' => 'col-sm-12', 'id' => 'title')) }}
                        </div>

                    </div>

                    <div class="form-group fotm-tab">
                        {{ Form::label('resumo', 'Resumo *', array('class' => 'col-sm-3 control-label no-padding-right', 'for' => 'form-field-1')) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('summary', (isset($projeto->summary) ? $projeto->summary : ''), array('class' => 'ckeditor col-sm-12', 'id' => 'summary')) }}
                            {{--{{ Form::textarea('content_data', $noticias->content_data, array('class' => 'ckeditor', 'placeholder' => 'Digite aqui o seu texto')) }}--}}
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        {{ Form::label('numero', 'Número *', array('class' => 'col-sm-3 control-label no-padding-right', 'for' => 'form-field-1')) }}
                        <div class="col-sm-3">
                            {{ Form::text('number', (isset($projeto->number) ? $projeto->number : ''), array('class' => 'col-sm-12', 'id' => 'number')) }}
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data de aprovação * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="icon-calendar bigger-110"></i>
                                </span>
                                {{ Form::text('meeting_date', (isset($projeto->meeting_date) ? date("d/m/Y",strtotime($projeto->meeting_date)) : ''), array('class' => 'form-control data', 'id' => 'meeting_date', 'placeholder' => '[dd / mm / aaaa]')) }}
                            </div>
                        </div>
                    </div>


                    @if(!empty($modalidades))
                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Modalidade *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'project_type_id',
                                                array_pluck($modalidades, 'name', 'id'),
                                                (isset($projeto->project_type_id) ? $projeto->project_type_id : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'project_type_id'
                                                ]
                                ) }}
                            </div>
                        </div>
                    @endif


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Período de execução * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                          <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>

                                <input class="form-control date-range-picker" type="text" name="periodo_execucao" id="periodo_execucao"
                                       value="{{ (isset($projeto->implementation_period_start) && isset($projeto->implementation_period_end) ? date("d/m/Y",strtotime($projeto->implementation_period_start)) . ' - ' . date("d/m/Y",strtotime($projeto->implementation_period_end)) : '') }}"/>
                            </div>
                        </div>
                    </div>


                    @if(!empty($situacoes))
                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Situação do projeto *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'project_situation_id',
                                                array_pluck($situacoes, 'name', 'id'),
                                                (isset($projeto->project_situation_id) ? $projeto->project_situation_id : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'project_situation_id'
                                                ]
                                ) }}
                            </div>
                        </div>
                    @endif


                    @if(!empty($atividades))
                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Atividade *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                                'project_activity_id',
                                                array_pluck($atividades, 'name', 'id'),
                                                (isset($projeto->project_activity_id) ? $projeto->project_activity_id : ''),
                                                [
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione',
                                                    'id'            => 'project_activity_id'
                                                ]
                                ) }}
                            </div>
                        </div>
                    @endif


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Parceiros
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Proponente * </label>
                        <div class="col-sm-6">

                            {{ Form::select(
                                                'proponentes',
                                                array_pluck($parceiros, 'name', 'id'),
                                                0,
                                                [
                                                    'id'            => 'proponentes',
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione'
                                                ]
                                ) }}
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-default bnt-add" id="addProponente" style="padding: 2px 15px;margin-top: -1px;">+</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-9">
                            <div class="tags col-sm-12 proponentenew" style="width: 100% !important; min-height: 100px !important;">
                                @if(isset($projeto->project_partner))
                                    @foreach($projeto->project_partner as $p)
                                        @if( $p->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                            <span class="tag proponente" data-id="{{ $p->id }}" id="proponentenew{{ $p->id }}">
                                                {{ $p->acronym }} - {{ $p->name }}<button type="button" class="close" onclick="removeProponenteNew({{ $p->id }})">×</button>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- ========================================================================== -->


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Executor * </label>
                        <div class="col-sm-6">
                            {{ Form::select(
                                                'executores',
                                                array_pluck($parceiros, 'name', 'id'),
                                                0,
                                                [
                                                    'id'            => 'executores',
                                                    'class'         =>'form-control col-sm-12',
                                                    'placeholder'   =>'Selecione'
                                                ]
                                ) }}
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-default bnt-add" id="addExecutor" style="padding: 2px 15px;margin-top: -1px;">+</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-9">
                            <div class="tags col-sm-12 executornew" style="width: 100% !important; min-height: 100px !important;">
                                @if(isset($projeto->project_partner))
                                    @foreach($projeto->project_partner as $p)
                                        @if( $p->pivot->type == Config::get('constants.PARTNERS_TYPE_EXECUTOR'))
                                            <span class="tag executor" data-id="{{ $p->id }}" id="executornew{{ $p->id }}">
                                                {{ $p->acronym }} - {{ $p->name }}<button type="button" class="close" onclick="removeExecutorNew({{ $p->id }})">×</button>
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
                <!-- / dados gerais -->

                {{--@if(isset($projeto))--}}


                    <div id="aba-valores" class="tab-pane  margin-top-45  margin-bottom-45">
                        <div class="form-group fotm-tab margin-top-35">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Valor total do projeto * R$</label>
                            <div class="col-sm-3">
                                {{ Form::text('valor_total', (!empty($projeto->project_value) ? number_format($projeto->project_value, 2, ',', '.') : ''), array('class' => 'col-sm-12 valor', 'id' => 'valor_total')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Observação </label>
                            <div class="col-sm-9">
                                {{--<input type="text" id="observacao" name="observacao" class="col-sm-12" required="true">--}}
                                {{ Form::text('comment', (isset($projeto->comment) ? $projeto->comment : ''), array('class' => 'col-sm-12', 'id' => 'comment')) }}
                            </div>
                        </div>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Anual
                        </h3>



                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 1 * </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[1]', !empty($projeto->project_year[0]) ? number_format($projeto->project_year[0]->value, 2, ',', '.') : '', array('class' => 'col-sm-12 valor', 'id' => 'ano1')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 2 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[2]', !empty($projeto->project_year[1]) ? $projeto->project_year[1]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 3 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[3]', !empty($projeto->project_year[2]) ? $projeto->project_year[2]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 4 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[4]', !empty($projeto->project_year[3]) ? $projeto->project_year[3]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 5 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[5]', !empty($projeto->project_year[4]) ? $projeto->project_year[4]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 6 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[6]', !empty($projeto->project_year[5]) ? $projeto->project_year[5]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 7 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[7]', !empty($projeto->project_year[6]) ? $projeto->project_year[6]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 8 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[8]', !empty($projeto->project_year[7]) ? $projeto->project_year[7]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 9 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[9]', !empty($projeto->project_year[8]) ? $projeto->project_year[8]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 10 </label>
                            <div class="col-sm-3">
                                {{ Form::text('ano[10]', !empty($projeto->project_year[9]) ? $projeto->project_year[9]->value : '', array('class' => 'col-sm-12 valor')) }}
                            </div>
                        </div>


                    </div>
                    <!-- /  -->

                    <!--  -->
                    <div id="aba-resultados" class="tab-pane  margin-top-45  margin-bottom-45">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Principais resultados esperados
                        </h3>

                        <textarea name="results" id="results" class="ckeditor">{{ (isset($projeto->results) ? $projeto->results : '') }}</textarea>


                    </div>
                    <!--  -->
                    <div id="aba-imagens" class="tab-pane  margin-top-45  margin-bottom-45">
                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                            Galeria de imagens
                        </h3>


                        <div class="form-group fotm-tab margin-top-40">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo de imagem</label>
                            <div class="col-sm-9">

                                <div>
                                    <button type="button" class="btn btn-sm abrir-boxfile" style="padding-top: 2px; padding-bottom: 2px; font-size: 12px; outline: none !important;">Selecionar arquivo</button>
                                    <input type="file" id="file" style="width:0px;height:0;">
                                </div>

                                <p class="dados-arquivo margin-top-20">Arquivo selecionado: <span style="font-weight: 700;color: #000;">nenhum arquivo selecionado</span></p>

                                <!-- crop -->
                                <div class="col-sm-6 no-padding-left">
                                    <div class="container-crop-parceiros">
                                        <div class="imageBox">
                                            <div class="thumbBox"></div>
                                            <div class="spinner" style="display: none">Loading...</div>
                                        </div>
                                        <div class="action">
                                            <input type="button" id="btnZoomOut" value="-">
                                            <input type="button" id="btnZoomIn" value="+">
                                        </div>
                                        <!-- <div class="cropped"></div> -->
                                    </div>
                                </div>

                                <div class="col-sm-6 align-right">
                                    <input type="button" id="btnCrop" value="Incluir na galeria" class="btn btn-sm btn-success salvar pull-right" style="padding: 1px 10px; margin-top: -35px;">
                                    <input type="button" id="btnCropCancelar" value="Cancelar" class="btn btn-sm salvar pull-right" style="padding: 1px 10px; margin: -35px 135px 0 0px;">
                                </div>
                                <!-- / crop -->
                            </div>
                        </div>


                        <div class="form-group fotm-tab margin-top-40">
                            <label class="col-sm-3 control-label no-padding-right"> Galeria</label>
                            <div class="col-sm-9">
                                <div class="parceiros-galeria margin-top-10"><img src="{{ asset('admin/assets/images/fundo-crop-parceiros.png') }}"  alt=""></div>
                            </div>
                        </div>

                    </div>
                    <!-- /  -->

                    <!--  -->
                    <div id="aba-anexos" class="tab-pane  margin-top-45  margin-bottom-45">
                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-5 margin-top-20" style="font-weight: 400;">
                            Localizar objetos
                        </h3>

                        <!-- Formulário de pesquisa -->
                        <div class="col-xs-12 no-padding margin-bottom-10 margin-top-10">
                            {{--<form name="frm_pesquisar_objetos" id="frm_pesquisar_objetos" action="/{{ App::getLocale()  }}/biblioteca-busca" method="post">--}}
                                <!-- ===== pesquisa ===== -->
                                <div id="area-pesquisa-c">
                                    <div class="col-sm-12 no-padding-left">
                                        <input type="text" id="palavra_chave_objetos" name="palavra_chave_objetos" placeholder="palavra-chave" class="col-xs-12 font-light">
                                    </div>
                                    <div class="row-fluid margin-top-15 display-inline-block">
                                        <div class="col-sm-4 no-padding-left">
                                            <select name="linha" id="linha" class="form-control" placeholder="Linha">
                                                <option value="">Todas os tipos</option>
                                                @foreach($linhas as $linha)

                                                    <option value="{{ $linha->id }}">{{ $linha->title }}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="tema" id="tema" disabled class="form-control" placeholder="Tema">
                                                <option value="">Todas as categorias</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="subtema" id="subtema" disabled class="form-control" placeholder="Subtema">
                                                <option value="">Todas as subcategorias</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" id="btn_pesquisa_objetos" class="btn btn-info btn-sm bnt-input-height pull-right btn-block">Localizar</button>
                                        </div>
                                    </div>
                                </div>
                                {{--{!! csrf_field() !!}--}}
                            {{--</form>--}}
                        </div>

                        <div class="col-sm-12 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>


                        <div id="busca_anexos">
                            <div class="col-sm-12 no-padding margin-top-40 margin-bottom-10">
                                <div class="widget-body" style="border: 0;">
                                    <div class="widget-main no-padding">
                                        <table class="table table-bordered table-striped produtos-pesquisados">
                                            <thead class="thin-border-bottom">
                                            <tr>
                                                <th>Título</th>
                                                <th>Linha</th>
                                                <th>Tema</th>
                                                <th>Sub tema</th>
                                                <th>Ações</th>
                                            </tr>
                                            </thead>

                                            <tbody id="resultado_ajax_objetos">


                                            </tbody>
                                        </table>
                                    </div><!-- /widget-main -->
                                </div><!-- /widget-body -->
                            </div>

                            <br clear="all" />
                        </div>


                        <br clear="all">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-5 margin-top-20" style="font-weight: 400;">
                            Objetos anexados
                        </h3>


                        <div class="col-sm-12 no-padding margin-top-40 margin-bottom-10">
                            <div class="widget-body" style="border: 0;">
                                <div class="widget-main no-padding">
                                    <table class="table table-bordered table-striped produtos-adicionados">
                                        <thead class="thin-border-bottom">
                                        <tr>
                                            <th>Título</th>
                                            <th>Linha</th>
                                            <th>Tema</th>
                                            <th>Sub tema</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>

                                        <tbody id="objetos_anexados">
                                            @if(!empty($objetos))
                                                @foreach($objetos as $o)
                                                    <tr data-id="{{ $o->id }}" class="anexos">
                                                        <td class="col-xs-3">{{ $o->title }}</td>
                                                        <td class="col-xs-3">{{ $o->thread->title }}</td>
                                                        <td class="col-xs-3">{{ $o->topic->title }}</td>
                                                        <td class="col-xs-2">{{ $o->subtopic->title }}</td>
                                                        <td class="col-xs-1 align-center">
                                                            <button type="button" class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div><!-- /widget-main -->
                            </div><!-- /widget-body -->
                        </div>

                        <br clear="all">

                    </div>
                    <!-- /  -->

                    <!--  -->
                    @if(isset($projeto))
                        <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                            <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                                Seleção do idioma
                            </h3>

                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse projeto </label>
                                <div class="col-sm-9 font-size-16 font-weight-700" >

                                    @foreach($idiomas as $key => $i)
                                        @if($i->name != 'pt_br')

                                            <span {{ ($projeto->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

                                            @if($key < ($idiomas->count()-1))
                                                {{  ' | ' }}
                                            @endif

                                        @endif
                                    @endforeach
                                </div>
                            </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma </label>
                            <div class="col-sm-3">
                                <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ $projeto->id }}">
                                    <option value="">Selecione</option>

                                    @foreach($idiomas as $key => $i)
                                        @if($i->name != 'pt_br')
                                            <option value="{{ $i->name }}">{{ $i->title }}</option>
                                        @endif
                                    @endforeach

                                </select>

                                </div>
                            </div>

                            <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                                Dados gerais
                            </h3>



                            <div class="form-group fotm-tab margin-top-35">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título *</label>
                                <div class="col-sm-8">
                                    <input type="text" id="title_trad" name="title_trad" class="col-sm-12">
                                </div>

                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>

                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo *</label>
                                <div class="col-sm-8">
                                    <textarea name="summary_trad" id="summary_trad" class="form-control descricao-grupo" placeholder="" ></textarea>
                                </div>
                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao" >
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>

                            <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                                Valores
                            </h3>

                            <div class="form-group fotm-tab margin-top-35">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Observação * </label>
                                <div class="col-sm-8">
                                    <input type="text" id="comment_trad" name="comment_trad" class="col-sm-12">
                                </div>
                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>


                            <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                                Resultados
                            </h3>
                            <div class="form-group fotm-tab">
                                <div class="col-sm-11">
                                    <textarea name="results_trad" id="results_trad" class="ckeditor" ></textarea>
                                </div>
                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>


                        </div>

                        <!-- /  -->
                    @endif

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{--</form>--}}
    {{ Form::close() }}
</div>
<!-- / WRAP DOS DADOS -->

</div>
<!-- / LATERAL DIREITA -->



</div><!-- /.main-container-inner -->
</div><!-- /.main-container -->


<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/projetos.js')}}"></script>
<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>

@endsection('content')