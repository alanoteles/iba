@extends('admin.layouts.master')


@section('title','Objetos')

@section('content')

    <link rel="stylesheet" href="{{ asset('admin/assets/js/jqFileUpload/css/jquery.fileupload.css') }}"/>
    <!-- WRAP DOS DADOS -->
    <div class="wrap-content">

        {!! Html::ul($errors->all()) !!}

        {{ Form::open(
            array(
                'url'   => App::getLocale() . '/admin/objetos/' .  (isset($objetos->id) ? $objetos->id : '' ),
                'name'  => 'frm',
                'id'    => 'frm',
                'class' => 'form-horizontal',
                'role'  => 'form',
                'files' => true,
                'method'    => (isset($objetos->id) ? 'PUT' : 'POST' ))
                )
            }}

        {{ Form::hidden('locale', App::getLocale()) }}
        {{ Form::hidden('active',       (isset($objetos->active) ? $objetos->active : '1'), array('id' => 'active')) }}
        {{ Form::hidden('array_tags',   (isset($array_tags) ? $array_tags : ''),array('id' => 'array_tags')) }}
        {{ Form::hidden('array_autores',   (isset($array_autores) ? $array_autores : ''),array('id' => 'array_autores')) }}
        {{ Form::hidden('object_id',    (isset($objetos->id) ? $objetos->id : '')) }}
        {{ Form::hidden('base64_image', '',array('id' => 'base64_image')) }}
        {{ Form::hidden('novas_tags', '',array('id' => 'novas_tags')) }}
        {{ Form::hidden('novos_autores', '',array('id' => 'novos_autores')) }}
        {{ Form::hidden('model',        (isset($model) ? $model : ''), array('id' => 'model')) }}
                <!-- Salva dados do arquivo enviado via upload -->
        {{ Form::hidden('file_info_uploaded', '',['id'=>'file_info_uploaded']) }}
        {{ Form::hidden('file_info_uploaded_translation', '',['id'=>'file_info_uploaded_translation']) }}
        {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($objetos))
                <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item"
                   style="padding: 3px 10px 4px 10px;">Excluir objeto</a>
            @endif

            <a href="" data-route="/admin/objetos" class="btn cancelar btn-sm font-size-14 margin-right-2"
               style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-nivel1">Nível 1 - Descrição</a></li>

                @if(isset($objetos))
                    <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
                @endif
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-nivel1" class="tab-pane  margin-top-45  margin-bottom-45 active">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20"
                        style="font-weight: 400;">
                        Permissões do objeto
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Objeto
                            público </label>
                        <div class="col-sm-9">

                            <div class="radio new-radio no-padding-left padding-top-2 margin-right-15">
                                <label>
                                    <input name="public" type="radio" class="ace"
                                           {{ (isset($objetos->public ) && $objetos->public == '1') ? 'checked="checked"' : ''  }} value="1">
                                    <span class="lbl"><div>Sim</div></span>
                                </label>
                            </div>

                            <div class="radio2 new-radio padding-top-2">
                                <label>
                                    <input name="public" type="radio" class="ace"
                                           {{ (isset($objetos->public ) && $objetos->public == '0') ? 'checked="checked"' : ''  }} value="0">
                                    <span class="lbl"><div>Não</div></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Permitir
                            colaboração </label>
                        <div class="col-sm-9">

                            <div class="radio new-radio no-padding-left padding-top-2 margin-right-15">
                                <label>
                                    <input name="allow_collab" type="radio" class="ace"
                                           {{ (isset($objetos->allow_collab ) && $objetos->allow_collab == '1') ? 'checked="checked"' : ''  }} value="1">
                                    <span class="lbl"><div>Sim</div></span>
                                </label>
                            </div>

                            <div class="radio2 new-radio padding-top-2">
                                <label>
                                    <input name="allow_collab" type="radio" class="ace"
                                           {{ (isset($objetos->allow_collab ) && $objetos->allow_collab == '0') ? 'checked="checked"' : ''  }} value="0">
                                    <span class="lbl"><div>Não</div></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Permitir
                            chancelamento </label>
                        <div class="col-sm-9">

                            <div class="radio new-radio no-padding-left padding-top-2 margin-right-15">
                                <label>
                                    <input name="allow_seals" type="radio" class="ace"
                                           {{ (isset($objetos->allow_seals) && $objetos->allow_seals == '1') ? 'checked="checked"' : ''  }} value="1">
                                    <span class="lbl"><div>Sim</div></span>
                                </label>
                            </div>

                            <div class="radio2 new-radio padding-top-2">
                                <label>
                                    <input name="allow_seals" type="radio" class="ace"
                                           {{ (isset($objetos->allow_seals) && $objetos->allow_seals == '0') ? 'checked="checked"' : ''  }} value="0">
                                    <span class="lbl"><div>Não</div></span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-40"
                        style="font-weight: 400;">
                        Dados gerais
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título * </label>
                        <div class="col-sm-9">
                            {{--<input type="text" id="titulo" name="titulo" class="col-sm-12" >--}}
                            {{ Form::text('title', (isset($objetos->title) ? $objetos->title : ''), array('class' => 'col-sm-12', 'id' => 'title')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo * </label>
                        <div class="col-sm-9">
                            {{--<textarea name="resumo" id="resumo" class="form-control descricao-grupo" placeholder="" ></textarea>--}}
                            {{ Form::textarea('preamble', (isset($objetos->preamble) ? $objetos->preamble : ''), array('class' => 'ckeditor', 'id' => 'preamble')) }}
                        </div>
                    </div>

                    {{--<div class="form-group fotm-tab">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Idioma * </label>--}}
                    {{--<div class="col-sm-3">--}}
                    {{--<select class="form-control col-sm-12" id="idioma" name="idioma"  >--}}
                    {{--<option value="">Selecione</option>--}}
                    {{--<option value="PT">Português</option>--}}
                    {{--<option value="EN">Inlgês</option>--}}
                    {{--<option value="SP">Espanhol</option>--}}
                    {{--<option value="FR">Francês</option>--}}
                    {{--</select>--}}
                    {{--{{ Form::select(--}}
                    {{--'locale',--}}
                    {{--array_pluck($idiomas, 'title', 'name'),--}}
                    {{--(isset($objetos->locale) ? $objetos->locale : ''),--}}
                    {{--[--}}
                    {{--'class'         => 'form-control col-sm-12',--}}
                    {{--'placeholder'   => 'Selecione',--}}
                    {{--'id'            => 'locale'--}}
                    {{--]--}}
                    {{--) }}--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data do objeto
                            * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{--<input class="form-control" type="text" name="data" id="data" placeholder="[dd / mm / aaaa]" />--}}
                                {{ Form::text('date', (isset($objetos->date) ? date("d/m/Y",strtotime($objetos->date)) : ''), array('class' => 'form-control data', 'id' => 'date_objeto', 'placeholder' => '[dd / mm / aaaa]')) }}
                                <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de
                            material </label>
                        <div class="col-sm-3">
                            {{ Form::select(
                                        'type_id',
                                        array_pluck($tipos_de_material, 'type', 'id'),
                                        (isset($objetos->type_id) ? $objetos->type_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12',
                                            'placeholder'   => 'Selecione',
                                            'id'            => 'type_id'
                                        ]
                                ) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tipo de
                            mídia </label>
                        <div class="col-sm-3">
                            {{--<select class="form-control col-sm-12" id="tipo-de-midia" name="tipo-de-midia">--}}
                            {{--<option value="">Selecione</option>--}}
                            {{--</select>--}}
                            {{ Form::select(
                                        'filetype_id',
                                        array_pluck($tipos_de_midia, 'type', 'id'),
                                        (isset($objetos->filetype_id) ? $objetos->filetype_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12',
                                            'placeholder'   => 'Selecione',
                                            'id'            => 'filetype_id'
                                        ]
                                ) }}
                        </div>
                    </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo
                                atual: </label>
                            <div class="col-sm-6">
                                @if(isset($objetos->attachment[0]->filename))
                                    <label class="control-label">{{$objetos->attachment[0]->filename}}</label>
                                    @else
                                    <label class="control-label">Nenhum arquivo cadastrado</label>
                                @endif
                            </div>
                            <div class="col-sm-1  no-padding-left">
                                @if(isset($objetos->attachment[0]->filename))
                                        <!-- Não apagar a sintaxe abaixo, set variável no blade -->
                                {{--*/ $extension = explode('.',$objetos->attachment[0]->filename) /*--}}
                                <button class="btn btn-sm btn-white btn-bold visualizar"
                                        data-link="/{{ 'download/' .  $objetos->attachment[0]->id.'_pt_br.'.$extension[count($extension)-1].'/'.$objetos->attachment[0]->filename }}">
                                    <i class="ace-icon icon-eye-open bigger-120 blue"></i>
                                    Visualizar arquivo
                                </button>
                                @endif
                            </div>
                        </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo * </label>
                        <div class="col-sm-6">
                            <div class="ace-file-input no-margin">
                                <input type="file" name="files" id="fileupload" class="input-file"
                                       style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                                <label class="file-label" data-title="Localizar">
                   <span class="file-name" data-title="Sem arquivo"><i
                               class="icon-upload-alt"></i></span>
                                </label>
                            </div>
                            <!-- The global progress bar -->
                            <div id="progress" class="progress" style="display: block;">
                                <div class="progress-bar"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <div id="files" class="files"></div>
                        </div>


                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fonte do
                            arquivo </label>
                        <div class="col-sm-6">
                            {{ Form::text('source', (isset($objetos->source) ? $objetos->source : ''), array('class' => 'col-sm-12', 'id' => 'source')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> ISSN do
                            arquivo </label>
                        <div class="col-sm-3">
                            {{ Form::text('issn', (isset($objetos->issn) ? $objetos->issn : ''), array('class' => 'col-sm-12', 'id' => 'issn')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Licença de
                            uso </label>
                        <div class="col-sm-6">
                            {{ Form::select(
                                        'license_id',
                                        array_pluck($licencas, 'name', 'id'),
                                        (isset($objetos->license_id) ? $objetos->license_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12',
                                            'placeholder'   => 'Selecione',
                                            'id'            => 'license_id'
                                        ]
                                ) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Autor do objeto
                            *</label>
                        <div class="col-sm-6" style="display: inline-flex;">
                            {{ Form::select(
                                        'created_by',
                                        array_pluck($created_by, 'name', 'id'),
                                        (isset($objetos->created_by) ? $objetos->created_by : ''),
                                        [
                                            'class'         => 'chosen-select form-control col-sm-11',
                                            'placeholder'   => 'Selecione o autor do objeto',
                                            'id'            => 'created_by'
                                        ]
                                ) }}
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Autor(es) do
                            conhecimento * </label>
                        <div class="col-sm-6 div-autores">
                            {{ Form::select(
                                         'autornew',
                                         array_pluck($autores, 'name', 'id'),
                                         0,
                                         [
                                             'class'         => 'chosen-select form-control col-sm-11',
                                             'placeholder'   => 'Selecione o autor do conhecimento',
                                             'id'            => 'autornew'
                                         ]
                                 ) }}
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-primary col-sm-12 bnt-add" id="addAutor"
                                    style="padding: 3px 9px;margin-top: -1px;">+
                            </button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-7 no-padding margin-bottom-10">
                            <hr class="no-margin margin-bottom-15 no-padding" style="width:100.5%">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-7">
                            <div class="tags col-sm-11 autores_conhecimento"
                                 style="width: 100% !important; min-height: 100px !important;">
                                @if($array_autores != '')
                                    @foreach($objetos->object_author as $o)
                                        <span class="tag autor" data-id="{{ $o->id }}">{{ $o->name }}
                                            <button type="button" class="close" onClick="removeAutor(this)">×
                                            </button></span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nível
                            escolar </label>
                        <div class="col-sm-6">

                            @foreach($nivel_escolar as $n)
                                <div class="checkbox no-padding margin-top-2 margin-bottom-10">
                                    <label>
                                        <input name="object_levels[]" type="checkbox" class="ace" value="{{ $n->id }}"
                                        @if(isset($objetos->object_levels))
                                            @foreach($objetos->object_levels as $o)
                                                @if($o->id == $n->id)
                                                    {{ ' checked="checked" ' }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                        >
                                        <span class="lbl"> {{ $n->name }}</span>
                                    </label>
                                </div>

                            @endforeach

                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Área do
                            conhecimento *</label>
                        <div class="col-sm-6">
                            <div>
                                {{ Form::select(
                                        'thread_id',
                                        array_pluck($linhas, 'title', 'id'),
                                        (isset($objetos->thread_id) ? $objetos->thread_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12 margin-top-10',
                                            'placeholder'   => 'Selecione a linha',
                                            'id'            => 'linha'
                                        ]
                                ) }}
                            </div>

                            <div>
                                {{ Form::select(
                                        'topic_id',
                                        array_pluck($temas, 'title', 'id'),
                                        (isset($objetos->topic_id) ? $objetos->topic_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12 margin-top-10',
                                            'placeholder'   => 'Selecione o tema',
                                            'id'            => 'tema'
                                        ]
                                ) }}
                            </div>

                            <div>
                                {{ Form::select(
                                        'subtopic_id',
                                        array_pluck($temas, 'title', 'id'),
                                        (isset($objetos->subtopic_id) ? $objetos->subtopic_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12 margin-top-10',
                                            'placeholder'   => 'Selecione o subtema',
                                            'id'            => 'subtema'
                                        ]
                                ) }}
                            </div>

                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> TAGs </label>
                        <div class="col-sm-6 div-tags">
                            {{-- <input type="text" id="tagsnew" placeholder="" class="col-sm-12"> --}}
                            {{ Form::select(
                                       'tagsnew',
                                       array_pluck($tags, 'name', 'id'),
                                       0,
                                       [
                                           'class'         => 'chosen-select form-control col-sm-11',
                                           'placeholder'   => 'Selecione uma tag',
                                           'id'            => 'tagsnew'
                                       ]
                               ) }}
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-primary col-sm-12 bnt-add" id="addTags"
                                    style="padding: 3px 9px;margin-top: -1px;">+
                            </button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-7 no-padding margin-bottom-10">
                            <hr class="no-margin margin-bottom-15 no-padding" style="width:100.5%">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-7">
                            <div class="tags col-sm-11 tagsnew"
                                 style="width: 100% !important; min-height: 100px !important;">
                                @if($array_tags != '')
                                    @foreach($objetos->object_tags as $o)
                                        <span class="tag item" data-id="{{ $o->id }}">{{ $o->name }}
                                            <button type="button" class="close" onClick="removeTag(this)">×
                                            </button></span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!--  -->


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-40"
                        style="font-weight: 400;">
                        Imagem de capa
                    </h3>

                    <div class="form-group fotm-tab margin-top-40">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo de
                            imagem</label>
                        <div class="col-sm-9">

                            <div>
                                <button type="button" class="btn btn-sm abrir-boxfile"
                                        style="padding-top: 2px; padding-bottom: 2px; font-size: 12px; outline: none !important;">
                                    Selecionar arquivo
                                </button>
                                <input type="file" id="file" style="width:0px;height:0;">
                            </div>

                            <p class="dados-arquivo margin-top-20">Arquivo selecionado: <span
                                        style="font-weight: 700;color: #000;">nenhum arquivo selecionado</span></p>

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
                                <input type="button" id="btnCrop" value="Incluir na galeria"
                                       class="btn btn-sm btn-success salvar pull-right"
                                       style="padding: 1px 10px; margin-top: -35px;">
                                <input type="button" id="btnCropCancelar" value="Cancelar"
                                       class="btn btn-sm salvar pull-right"
                                       style="padding: 1px 10px; margin: -35px 135px 0 0px;">
                            </div>
                            <!-- / crop -->
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-40">
                        <label class="col-sm-3 control-label no-padding-right"> Galeria</label>
                        <div class="col-sm-9">
                            <div class="parceiros-galeria margin-top-10">
                                @if(!empty($imagem))
                                    <img src="{{ asset('uploads/biblioteca/capas/' . $imagem) }}" alt="">
                                @else
                                    <img src="{{ asset('admin/assets/images/fundo-crop-parceiros.png') }}" alt="">
                                @endif

                            </div>
                        </div>
                    </div>


                </div>
                <!-- / dados gerais -->

                @if(isset($objetos))
                    <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45"
                            style="font-weight: 400;">
                            Seleção do idioma
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse
                                projeto </label>
                            <div class="col-sm-9 font-size-16 font-weight-700">

                                @foreach($idiomas as $key => $i)
                                    @if($i->name != 'pt_br')

                                        <span {{ ($objetos->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

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
                                <select class="form-control col-sm-12 idioma_trad" id="language" name="language"
                                        data-id="{{ $objetos->id }}">
                                    <option value="">Selecione</option>

                                    @foreach($idiomas as $key => $i)
                                        @if($i->name != 'pt_br')
                                            <option value="{{ $i->name }}">{{ $i->title }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45"
                            style="font-weight: 400;">
                            Nível 1 - Descrição
                        </h3>


                        {{--<div class="form-group fotm-tab">--}}
                        {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Situação da--}}
                        {{--tradução </label>--}}
                        {{--<div class="col-sm-9">--}}

                        {{--<div class="radio new-radio no-padding-left padding-top-2 margin-right-15">--}}
                        {{--<label>--}}
                        {{--<input name="sit_trad" type="radio" class="ace" checked="checked">--}}
                        {{--<span class="lbl"><div>Ativo</div></span>--}}
                        {{--</label>--}}
                        {{--</div>--}}

                        {{--<div class="radio2 new-radio padding-top-2">--}}
                        {{--<label>--}}
                        {{--<input name="sit_trad" type="radio" class="ace">--}}
                        {{--<span class="lbl"><div>Inativo</div></span>--}}
                        {{--</label>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}

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
                                {{ Form::textarea('preamble_trad', '', array('class' => 'ckeditor', 'id' => 'preamble_trad')) }}
                            </div>
                            <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                            </div>
                        </div>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo
                                * </label>
                            <div class="col-sm-6">
                                <div class="ace-file-input no-margin">
                                    <input type="file" name="file_translation" id="fileupload_translation"
                                           class="input-file"
                                           style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                                    <label class="file-label" data-title="Localizar">
                       <span class="file-name" data-title="Sem arquivo"><i
                                   class="icon-upload-alt"></i></span>
                                    </label>
                                </div>
                                <!-- The global progress bar -->
                                <div id="progress_translation" class="progress" style="display: block;">
                                    <div class="progress-bar"></div>
                                </div>
                                <!-- The container for the uploaded files -->
                                <div id="files_translation" class="files_translation"></div>
                            </div>
                        </div>

                    </div>
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



    {{--@include('admin.includes.paginacao')--}}

            <!-- scripts exclusivos desta area -->
    <script src="{{asset('admin/js/objetos.js')}}"></script>
    <script src="{{ asset('admin/js/cropbox.js') }}"></script>
    <script src="{{ asset('admin/js/objetos-crop.js') }}"></script>
    <script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>
    <script src="{{ asset('admin/assets/js/jqFileUpload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jqFileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jqFileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        /*jslint unparam: true */
        /*global window, $ */
        $(function () {
            'use strict';
            var url = window.location.href;
            var method_edit = false;

            url = url.split('/');
            url = url[0] + '//' + url[2] + '/' + url[3];
            url = url + '/admin/objetos/uploadAnexo';

            $('#fileupload').fileupload({
                url: url,
                type: 'POST',
                maxFileSize: 50000000,//50Mb
                dataType: 'json',
                add: function (e, data) {
                    //Modificando para POST somente para corrigir o envio
                    //ajax que conflitava com o update (PUT)
                    //Retorna para PUT após ajax
                    if ($('input[name=_method]').val() == 'PUT') {
                        $('input[name=_method]').val('POST');
                        method_edit = true;
                    }

                    data.submit();
                },
                done: function (e, data) {
                    $('<p/>').text('Arquivo enviado com sucesso: '
                            + data.result.file_info_uploaded.filename).appendTo('#files');
                    $('#file_info_uploaded').val(JSON.stringify(data.result.file_info_uploaded));
                    //Retorna PUT
                    if (method_edit) $('input[name=_method]').val('PUT');
                },
                error: function (data) {
                    console.log(data);
                    bootbox.dialog({
                        title: 'Erro ao enviar arquivo',
                        message: 'Verifique sua conexão com a internet, recarregue esta página e tente novamente',
                        className: 'medium'
                    });
                    return false;
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');

            $('#fileupload_translation').fileupload({
                url: url,
                type: 'POST',
                maxFileSize: 50000000,//50Mb
                dataType: 'json',
                add: function (e, data) {
                    //Modificando para POST somente para corrigir o envio
                    //ajax que conflitava com o update (PUT)
                    //Retorna para PUT após ajax
                    if ($('input[name=_method]').val() == 'PUT') {
                        $('input[name=_method]').val('POST');
                        method_edit = true;
                    }

                    data.submit();
                },
                done: function (e, data) {
                    $('<p/>').text('Arquivo enviado com sucesso: '
                            + data.result.file_info_uploaded.filename).appendTo('#files_translation');
                    $('#file_info_uploaded_translation').val(JSON.stringify(data.result.file_info_uploaded));
                    //Retorna PUT
                    if (method_edit) $('input[name=_method]').val('PUT');
                },
                error: function (data) {
                    console.log(data);
                    bootbox.dialog({
                        title: 'Erro ao enviar arquivo',
                        message: 'Verifique sua conexão com a internet, recarregue esta página e tente novamente',
                        className: 'medium'
                    });
                    return false;
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress_translation .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                }
            }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>

@endsection('content')