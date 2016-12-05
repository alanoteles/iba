
@extends('admin.layouts.master')



@section('title','Parceiros')

@section('content')


    <!-- WRAP DOS DADOS -->
<div class="wrap-content">

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
        array(
            'url'   => App::getLocale() . '/admin/parceiros/' .  (isset($parceiros->id) ? $parceiros->id : '' ),
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'files' => true,
            'method'    => (isset($parceiros->id) ? 'PUT' : 'POST' ))
            )
        }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($parceiros->status) ? $parceiros->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('partner_id',  (isset($parceiros->id) ? $parceiros->id : '')) }}
    {{ Form::hidden('base64_image', '',array('id' => 'base64_image')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}
    {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($parceiros))
                <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir parceiro</a>
            @endif

            <a href="" data-route="/admin/parceiros"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#aba-imagens">Imagens</a></li>
                <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>

            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">

                    <div class="exibir-sim-nao">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($parceiros->status) ? ($parceiros->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Sobre o parceiro
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        {{ Form::label('nome', 'Nome *', array('class' => 'col-sm-3 control-label no-padding-right')) }}
                        <div class="col-sm-9">
                            {{ Form::text('name', (isset($parceiros->name) ? $parceiros->name : ''), array('class' => 'col-sm-12', 'id' => 'name')) }}
                        </div>

                    </div>

                    <div class="form-group fotm-tab">
                        {{ Form::label('sigla', 'Sigla', array('class' => 'col-sm-3 control-label no-padding-right', 'for' => 'form-field-1')) }}
                        <div class="col-sm-9">
                            {{ Form::text('acronym', (isset($parceiros->acronym) ? $parceiros->acronym : ''), array('class' => 'col-sm-12', 'id' => 'acronym')) }}
                        </div>
                    </div>



                    {{--@if(!empty($partner_groups))--}}
                        <div class="form-group fotm-tab">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Grupo *</label>
                            <div class="col-sm-3">

                                {{ Form::select(
                                        'partner_group_id',
                                        array_pluck($partner_groups, 'name', 'id'),
                                        (isset($parceiros->partner_group_id) ? $parceiros->partner_group_id : ''),
                                        [
                                            'class'         => 'form-control col-sm-12',
                                            'placeholder'   => 'Selecione',
                                            'id'            => 'partner_group_id'
                                        ]
                                ) }}
                            </div>
                        </div>
                    {{--@endif--}}



                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL do site </label>
                        <div class="col-sm-6">
                            {{ Form::text('url', (isset($parceiros->url) ? $parceiros->url : ''), array('class' => 'col-sm-12', 'id' => 'url')) }}
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo * </label>
                        <div class="col-sm-9">
                            {{ Form::textarea('summary', (isset($parceiros->summary) ? $parceiros->summary : ''), array('class' => 'form-control', 'placeholder' => 'Digite aqui o seu texto', 'id' => 'summary')) }}
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Conteúdo
                    </h3>
                    {{ Form::textarea('content_data', (isset($parceiros->content_data) ? $parceiros->content_data : ''), array('class' => 'ckeditor','id' => 'content_data', 'placeholder' => 'Digite aqui o seu texto')) }}




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
                                        <img src="{{ asset('uploads/associadas/' . $imagem) }}"  alt="">
                                    @else
                                        <img src="{{ asset('admin/assets/images/fundo-crop-parceiros.png') }}"  alt="">
                                    @endif


                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /  -->


                    <!--  -->
                    @if(isset($parceiros))
                        <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                            <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                                Seleção do idioma
                            </h3>

                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse parceiro </label>
                                <div class="col-sm-9 font-size-16 font-weight-700" >

                                    @foreach($idiomas as $key => $i)
                                        @if($i->name != 'pt_br')

                                            <span {{ ($parceiros->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

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
                                    <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ $parceiros->id }}">
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nome *</label>
                                <div class="col-sm-8">
                                    <input type="text" id="name_trad" name="name_trad" class="col-sm-12">
                                </div>

                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>

                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sigla </label>
                                <div class="col-sm-3">
                                    <input type="text" id="acronym_trad" name="acronym_trad" class="col-sm-12">
                                </div>

                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>


                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL do site </label>
                                <div class="col-sm-8">
                                    <input type="text" id="url_trad" name="url_trad" class="col-sm-12">
                                </div>

                                <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                                    <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                                </div>
                            </div>

                            <div class="form-group fotm-tab">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo * </label>
                                <div class="col-sm-8">
                                    <textarea name="summary_trad" id="summary_trad" class="form-control descricao-grupo"></textarea>
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
<script src="{{asset('admin/js/parceiros.js')}}"></script>
<script src="{{ asset('admin/js/cropbox.js') }}"></script>
<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>
<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>

@endsection('content')