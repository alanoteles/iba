@extends('admin.layouts.master')

@section('title','Seções')

@section('content')

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
       array(
           'url'   => App::getLocale() . '/admin/secoes/' .  (isset($resultado->id) ? $resultado->id : '' ),
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
    {{ Form::hidden('page_id',  (isset($resultado->id) ? $resultado->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}
    {{ Form::hidden('array_anexos',     (isset($array_anexos) ? $array_anexos : ''),            array('id' => 'array_anexos')) }}

         <div class="col-xs-12 botoes-pj-pf">
            <!-- <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir notícia</a> -->
             <a href="" data-route="/admin/secoes"   class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#aba-imagens">Imagens</a></li>
                <li class=""><a data-toggle="tab" href="#aba-anexos">Anexos</a></li>
                <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Título da página
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título * </label>
                        <div class="col-sm-9">
                            {{ Form::text('title', (isset($resultado->title) ? $resultado->title : ''), array('class' => 'col-sm-12', 'id' => 'title', 'required' =>'true')) }}
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Conteúdo
                    </h3>
                    {{ Form::textarea('content_data', (isset($resultado->content_data) ? $resultado->content_data : ''), array('class' => 'ckeditor', 'id' => 'content_data', 'placeholder' => 'Digite aqui o seu texto')) }}




                </div>
                <!-- / dados gerais -->

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
                                <input type="hidden" name="base64_image" id="base64_image">
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
                            <div class="parceiros-galeria margin-top-10">
                                @if(!empty($imagem))
                                    <img src="{{ asset('uploads/secoes/' . $imagem) }}"  alt="">
                                @else
                                    <img src="{{ asset('admin/assets/images/fundo-crop-parceiros.png') }}"  alt="">
                                @endif


                            </div>
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
                @if(isset($resultado))
                    <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Seleção do idioma
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções dessa seção </label>
                            <div class="col-sm-9 font-size-16 font-weight-700" >

                                @foreach($idiomas as $key => $i)
                                    @if($i->name != 'pt_br')

                                        <span {{ ($resultado->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

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

                                <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ $resultado->id }}">
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


                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Conteúdo
                        </h3>


                        <div class="form-group fotm-tab">
                            <div class="col-sm-11">
                                <textarea name="content_data_trad" id="content_data_trad" class="ckeditor" ></textarea>
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


@include('admin.includes.paginacao')

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/secoes.js')}}"></script>
<script src="{{ asset('admin/js/cropbox.js') }}"></script>
<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>

@endsection('content')