@extends('admin.layouts.master')

@section('title','Grupo de Parceiros')

@section('content')

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
       array(
           'url'   => App::getLocale() . '/admin/tabelas-de-apoio/grupo-de-parceiros/' .  (isset($resultado->id) ? $resultado->id : '' ),
           'name'  => 'frm',
           'id'    => 'frm',
           'class' => 'form-horizontal',
           'role'  => 'form',
           'files' => true,
           'method'    => (isset($resultado->id) ? 'PUT' : 'POST' ))
           )
       }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($resultado->status) ? $resultado->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('id',  (isset($resultado->id) ? $resultado->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($resultado->id)) <button type="button" class="btn remover-item margin-right-20 margin-left-2 excluir" data-id="{{$resultado->id}}">Excluir grupo</button> @endif
            <a href="" data-route="/admin/tabelas-de-apoio/atividade-de-projeto"  class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#traducao">Tradução</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-45  margin-bottom-45 active">

                    <div class="exibir-sim-nao margin-bottom-45">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($resultado->status) ? ($resultado->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Grupo *</label>
                        <div class="col-sm-6">
                            {{ Form::text('name', (isset($resultado->name) ? $resultado->name : ''), array('class' => 'col-sm-12', 'id' => 'name', 'maxlength' =>'100')) }}
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->


                <div id="traducao" class="tab-pane margin-top-45 margin-bottom-45">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Seleção do idioma
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse objeto </label>
                        <div class="col-sm-9 font-size-16 font-weight-700" >
                            <span id="label_en">EN</span> |
                            <span id="label_es" class="inactive">ES</span>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma </label>
                        <div class="col-sm-3">
                            <select class="form-control col-sm-12 idioma_trad" id="locale_translation" name="locale_translation" >
                                <option value="">Selecione</option>
                                <option value="en">Inlgês</option>
                                <option value="es">Espanhol</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Dados gerais
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Grupo</label>
                        <div class="col-sm-8">
                            {{ Form::text('name_translation', '', array('class' => 'col-sm-12', 'id' => 'name_translation', 'maxlength' =>'100')) }}
                        </div>

                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog1" ><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                        </div>
                    </div>

                </div>

            </div>

            <br clear="all"><br clear="all">
        </div>

    {{ Form::close() }}


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
{{--<script src="{{asset('admin/js/modalidade.js')}}"></script>--}}

@endsection('content')