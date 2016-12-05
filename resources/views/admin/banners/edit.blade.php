
@extends('admin.layouts.master')



@section('title','Banners')

@section('content')


    <!-- WRAP DOS DADOS -->
<div class="wrap-content">

    {!! Html::ul($errors->all()) !!}

    {{ Form::open(
        array(
            'url'   => App::getLocale() . '/admin/banners/' .  (isset($banners->id) ? $banners->id : '' ),
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'files' => true,
            'method'    => (isset($banners->id) ? 'PUT' : 'POST' ))
            )
        }}

    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('status', (isset($banners->status) ? $banners->status : '1'), array('id' => 'status')) }}
    {{ Form::hidden('banner_id',  (isset($banners->id) ? $banners->id : '')) }}
    {{ Form::hidden('model', (isset($model) ? $model : ''), array('id' => 'model')) }}
    {{--<form name="frm" id="frm" class="form-horizontal" role="form">--}}

        <div class="col-xs-12 botoes-pj-pf">
            @if(isset($banners))
                <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir parceiro</a>
            @endif

            <a href="" data-route="/admin/banners"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#aba-imagens">Imagens</a></li>

                @if(isset($banners))
                    <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
                @endif

            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">

                    <div class="exibir-sim-nao">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo {{ isset($banners->status) ? ($banners->status == '1' ? 'sim' : 'nao') : '1' }}">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Sobre o banner
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        {{ Form::label('titulo', 'Título * ', array('class' => 'col-sm-3 control-label no-padding-right')) }}
                        <div class="col-sm-9">
                            {{ Form::text('title', (isset($banners->title) ? $banners->title : ''), array('class' => 'col-sm-12', 'id' => 'title')) }}
                        </div>

                    </div>

                   <div class="form-group fotm-tab">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Observações </label>
                      <div class="col-sm-9">
                        {{ Form::textarea('comment', (isset($banners->comment) ? $banners->comment : ''), array('rows' => '4', 'class' => 'form-control', 'placeholder' => 'Digite aqui o seu texto', 'id' => 'comment')) }}
                      </div>
                    </div>  



                    
                  
                  


                </div>
                <!-- / dados gerais -->

                {{--@if(isset($noticias))--}}
                    <!--  -->
                    <div id="aba-imagens" class="tab-pane  margin-top-45  margin-bottom-45">
                       
                       <div class="form-group fotm-tab margin-top-50">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL * </label>
                          <div class="col-sm-6">
                           
                            {{ Form::text('url', (isset($banners->url) ? $banners->url : ''), array('class' => 'col-sm-12', 'id' => 'url')) }}
                          </div>
                        </div>  

                                             
                        <div class="form-group fotm-tab">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                          <div class="col-sm-6">
                            
                            {{ Form::text('image_alt', (isset($banners->image_alt) ? $banners->image_alt : ''), array('class' => 'col-sm-12', 'id' => 'image_alt')) }}
                          </div>
                        </div>  

                        <div class="form-group fotm-tab ">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Arquivo de imagem </label>
                            {{-- <div class="col-sm-9"> --}}

                                <div class="col-sm-6">
                                    <div class="ace-file-input no-margin">
                                        <input type="file" name="arquivo" id="arquivo"  class="input-file" style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                                        <label class="file-label" data-title="Localizar">
                                            <span class="file-name" data-title="{{ (isset($banners->image)) ? $banners->image : 'Nenhum arquivo'}}"><i class="icon-upload-alt"></i></span>
                                        </label>
                                        <a class="remove" href="#"><i class="icon-remove"></i></a>
                                    </div>
                                    {{--<p>Dica: Formato PNG com fundo transparente &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Tamanho 80px X 80px</p>--}}
                                    <p>Tamanho 1.110px X 98px ou 350px X 240px</p>

                                </div>

                            </div>
                        {{-- </div> --}}


                        <div class="form-group fotm-tab margin-top-40">
                            <label class="col-sm-3 control-label no-padding-right"> Galeria</label>
                            <div class="col-sm-9">
                                <div class="banners-galeria margin-top-10">
                                     @if(!empty($banners->image))
                                        <img src="{{ asset('uploads/banners/' . $banners->image) }}"  alt="">
                                        <a class="remove" href="#"><i class="icon-remove"></i></a>
                                    {{-- @else--}}
                                        {{--<img src="{{ asset('admin/assets/images/fundo-crop-banners.png') }}"  alt="">--}}
                                    @endif


                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /  -->

                @if(isset($resultado))
                    <!--  -->
                    <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                      Seleção do idioma
                    </h3>       

                    <div class="form-group fotm-tab">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Traduções desse objeto </label>
                      <div class="col-sm-9 font-size-16 font-weight-700" >

                          @foreach($idiomas as $key => $i)
                              @if($i->name != 'pt_br')

                                  <span {{ ($banners->translation->contains('locale', strtolower($i->name))) ? '' : ' class=inactive' }}>{{ strtoupper($i->name) }}</span>

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

                          <select class="form-control col-sm-12 idioma_trad" id="language" name="language" data-id="{{ isset($banners->id) ? $banners->id : '' }}">
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


                    {{--<div class="form-group fotm-tab margin-top-35">--}}
                      {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título *</label>--}}
                      {{--<div class="col-sm-6">--}}
                        {{--<input type="text" id="titulo_trad" name="titulo_trad" class="col-sm-12">--}}
                      {{--</div>--}}

{{--<!--                       <div class="col-sm-1 align-right padding-top-3">--}}
                        {{--<a href="javascript:void(0)" id="id-btn-dialog1" ><img src="assets/images/icon_dialog.png" alt=""></a>--}}
                      {{--</div> -->--}}
                    {{--</div>--}}

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título</label>
                        <div class="col-sm-6">
                            {{ Form::text('title_trad', '', array('class' => 'col-sm-12', 'id' => 'title_trad')) }}
                        </div>

                        <div class="col-sm-1 align-right padding-top-3 dialog-traducao">
                            <a href=""><img src="{{ asset('admin/assets/images/icon_dialog.png') }}" alt=""></a>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                      Imagens
                    </h3>  

                    <div class="form-group fotm-tab margin-top-50">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL * </label>
                      <div class="col-sm-6">
                        <input type="text" id="url_trad" name="url_trad" class="col-sm-12">
                      </div>
                    </div>  
                    
                    <div class="form-group fotm-tab">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Texto alternativo da imagem * </label>
                      <div class="col-sm-6">
                        {{--<input type="text" id="texto-alternativo" name="texto-alternativo" class="col-sm-12">--}}
                          {{ Form::text('image_alt_trad', '', array('class' => 'col-sm-12', 'id' => 'image_alt_trad')) }}
                      </div>
                    </div>  

                    <div class="form-group fotm-tab">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Imagem * </label>
                      <div class="col-sm-6">
                        <div class="ace-file-input no-margin">
                          <input type="file" name="image" id="image" class="input-file" style="position: absolute;z-index: 1;opacity: 0;width: 100%; height: 29px;cursor: pointer;">
                          <label class="file-label" data-title="Localizar">
                            <span class="file-name" data-title="Sem imagem"><i class="icon-upload-alt"></i></span>
                          </label>
                          <a class="remove" href="#"><i class="icon-remove"></i></a>
                        </div>
                        {{--<p>Dica: Formato PNG com fundo transparente &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Tamanho 80px X 80px</p>--}}
                          <p>Tamanho 1.110px X 98px ou 350px X 240px</p>
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
<script src="{{asset('admin/js/banners.js')}}"></script>
{{--<script src="{{ asset('admin/js/cropbox.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>--}}

@endsection('content')