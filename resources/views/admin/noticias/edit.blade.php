
@extends('admin.layouts.master')



@section('title','Notícias')

@section('content')


    <!-- WRAP DOS DADOS -->
<div class="wrap-content">

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
        array(
            'url'   => App::getLocale() . '/admin/noticias/' .  (isset($noticias->id) ? $noticias->id : '' ),
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'files' => true,
            'method'    => (isset($noticias->id) ? 'PUT' : 'POST' ))
            )
        }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($noticias->status) ? $noticias->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('array_anexos',     (isset($array_anexos) ? $array_anexos : ''),array('id' => 'array_anexos')) }}
    {{ Form::hidden('array_tags',   (isset($array_tags) ? $array_tags : ''),array('id' => 'array_tags')) }}
    {{ Form::hidden('novas_tags', '',array('id' => 'novas_tags')) }}
    {{ Form::hidden('news_id',  (isset($noticias->id) ? $noticias->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}
    {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($noticias))
                <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir notícia</a>
            @endif

            <a href="" data-route="/admin/noticias"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>

                    <li class=""><a data-toggle="tab" href="#aba-imagens">Imagens</a></li>
                    <li class=""><a data-toggle="tab" href="#aba-anexos">Anexos</a></li>
                @if(isset($noticias))
                    <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
                @endif
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">

                    <div class="exibir-sim-nao">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($noticias->status) ? ($noticias->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Sobre a notícia
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título * </label>--}}
                        {{ Form::label('titulo', 'Título *', array('class' => 'col-sm-3 control-label no-padding-right')) }}
                        <div class="col-sm-9">
                            {{--<input type="text" id="titulo" name="titulo" class="col-sm-12" requery="true">--}}
                            {{ Form::text('title', (isset($noticias->title) ? $noticias->title : ''), array('class' => 'col-sm-12', 'id' => 'title')) }}
                        </div>

                    </div>

                    <div class="form-group fotm-tab">
                        {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título para o destaque </label>--}}
                        {{ Form::label('titulo_destaque', 'Título para o destaque', array('class' => 'col-sm-3 control-label no-padding-right', 'for' => 'form-field-1')) }}
                        <div class="col-sm-9">
                            {{--<input type="text" id="titulo_dest" name="titulo_dest" class="col-sm-12" requery="true">--}}
                            {{ Form::text('featured_title', (isset($noticias->featured_title) ? $noticias->featured_title : ''), array('class' => 'col-sm-12', 'id' => 'featured_title')) }}
                        </div>
                    </div>



                    @if(!empty($editorias))
                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Editoria *</label>
                            <div class="col-sm-3">
                                {{--<select class="form-control col-sm-12" id="editoria" name="editoria">--}}
                                    {{--<option value="">Selecione</option>--}}
                                    {{--@foreach($editorias as $editoria)--}}
                                        {{--@if($editoria->locale == 'pt_br')--}}
                                            {{--<option value="{{ $editoria->id }}">{{ $editoria->name }}</option>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}

                                {{ Form::select(
                                        'news_editorial_id',
                                        array_pluck($editorias, 'name', 'id'),
                                        (isset($noticias->news_editorial_id) ? $noticias->news_editorial_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12',
                                            'placeholder'   => 'Selecione',
                                            'id'            => 'news_editorial_id'
                                        ]
                                ) }}
                            </div>
                        </div>
                    @endif

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{--<input class="form-control" type="text" name="data" id="data" placeholder="[dd / mm / aaaa]" />--}}
                                {{ Form::text('date', (isset($noticias->date) ? date("d/m/Y",strtotime($noticias->date)) : ''), array('class' => 'form-control data', 'id' => 'date_noticia', 'placeholder' => '[dd / mm / aaaa]')) }}
                          <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fonte * </label>
                        <div class="col-sm-6">
                            {{--<input type="text" id="fonte" name="fonte" class="col-sm-12" requery="true">--}}
                            {{ Form::text('source', (isset($noticias->source) ? $noticias->source : ''), array('class' => 'col-sm-12', 'id' => 'source')) }}
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
                                    @foreach($noticias->news_tags as $o)
                                        <span class="tag item" data-id="{{ $o->id }}">{{ $o->name }}
                                            <button type="button" class="close" onClick="removeTag(this)">×
                                            </button></span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!--  -->

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Conteúdo
                    </h3>
                    {{--<textarea name="conteudo" id="conteudo" class="ckeditor" placeholder="Lorem ipsum dolor est sit amet consectetur est ipsum dolor. Lorem ipsum dolor est sit amet consectetur est ipsum dolor ipsum dolor est sit amet consectetur est ipsum dolor."></textarea>--}}
                    {{ Form::textarea('content_data', (isset($noticias->content_data) ? $noticias->content_data : ''), array('class' => 'ckeditor', 'id' =>'content_data', 'placeholder' => 'Digite aqui o seu texto')) }}




                </div>
                <!-- / dados gerais -->

                {{--@if(isset($noticias))--}}
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
                                    <input type="file" id="file" name="file" style="width:0px;height:0;">
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
                                    <input type="button" id="btnCrop" value="Incluir na galeria" class="btn btn-sm btn-success  pull-right" style="padding: 1px 10px; margin-top: -35px;">
                                    <input type="button" id="btnCropCancelar" value="Cancelar" class="btn btn-sm pull-right" style="padding: 1px 10px; margin: -35px 135px 0 0px;">
                                </div>
                                <!-- / crop -->
                            </div>
                        </div>


                        <div class="form-group fotm-tab margin-top-40">
                            <label class="col-sm-3 control-label no-padding-right"> Galeria</label>
                            <div class="col-sm-9">
                                <div class="parceiros-galeria margin-top-10">
                                    @if(!empty($imagem))
                                        <img src="{{ asset('uploads/noticias/' . $imagem) }}"  alt="">
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
                @if(isset($noticias))
                    <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                        <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                            Seleção do idioma
                        </h3>

                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções dessa notícia </label>
                            <div class="col-sm-9 font-size-16 font-weight-700" >

                                @foreach($idiomas as $key => $i)
                                    @if($i->name != 'pt_br')

                                        <span {{ ($noticias->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

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
                                <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ $noticias->id }}">
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título para o destaque </label>
                            <div class="col-sm-8">
                                <input type="text" id="featured_title_trad" name="featured_title_trad" class="col-sm-12">
                            </div>

                            <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                            </div>
                        </div>


                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fonte * </label>
                            <div class="col-sm-6">
                                <input type="text" id="source_trad" name="source_trad" class="col-sm-12">
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
<script src="{{asset('admin/js/noticias.js')}}"></script>
<script src="{{ asset('admin/js/cropbox.js') }}"></script>
<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>

@endsection('content')