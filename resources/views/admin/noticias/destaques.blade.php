
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
            'url'   => App::getLocale() . '/admin/noticias/destaques/salvar',
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'method'    => 'POST' )
            )
        }}


    {{ Form::hidden('locale', App::getLocale()) }}

    {{ Form::hidden('h1', (isset($h1) ? $h1->record_id : ''), array('id' => 'h1')) }}
    {{ Form::hidden('h2', (isset($h2) ? $h2->record_id : ''), array('id' => 'h2')) }}
    {{ Form::hidden('h3', (isset($h3) ? $h3->record_id : ''), array('id' => 'h3')) }}
    {{ Form::hidden('h4', (isset($h4) ? $h4->record_id : ''), array('id' => 'h4')) }}

    {{ Form::hidden('p1', (isset($p1) ? $p1->record_id : ''), array('id' => 'p1')) }}
    {{ Form::hidden('p2', (isset($p2) ? $p2->record_id : ''), array('id' => 'p2')) }}
    {{ Form::hidden('p3', (isset($p3) ? $p3->record_id : ''), array('id' => 'p3')) }}
    {{ Form::hidden('p4', (isset($p4) ? $p4->record_id : ''), array('id' => 'p4')) }}
    {{ Form::hidden('p5', (isset($p5) ? $p5->record_id : ''), array('id' => 'p5')) }}
    {{ Form::hidden('p6', (isset($p6) ? $p6->record_id : ''), array('id' => 'p6')) }}

    {{ Form::hidden('news_id', (isset($noticia->id) ? $noticia->id : '')) }}

        <div class="col-xs-12 botoes-pj-pf">
            <a href="" data-route="/admin/projetos"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>

        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-home">Home</a></li>
                <li class=""><a data-toggle="tab" href="#aba-noticias">Página notícias</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-home" class="tab-pane margin-bottom-45 margin-top-35 active">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de destaque </label>
                        <div class="col-sm-9 posicoes">
                            <div rel="1" class="col-sm-4 posicao1 item">
                                <img src="{{ asset('admin/assets/images/posicao1.png') }}" alt="">
                                <div class="status margin-top-20">&nbsp;Página inicial - Posição H1</div>
                            </div>
                            <div class="col-sm-4">
                                <div rel="2" class="posicao2 item">
                                    <img src="{{ asset('admin/assets/images/posicao4.png') }}" alt="">
                                    <div class="status margin-top-5">&nbsp;Página inicial - Posição H2</div>
                                </div>
                                <div rel="3" class="posicao3 item margin-top-15">
                                    <img src="{{ asset('admin/assets/images/posicao5.png') }}" alt="">
                                    <div class="status margin-top-5">&nbsp;Página inicial - Posição H3</div>
                                </div>
                                <div rel="4" class="posicao4 item margin-top-15">
                                    <img src="{{ asset('admin/assets/images/posicao6.png') }}" alt="">
                                    <div class="status margin-top-5">&nbsp;Página inicial - Posição H4</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Área selecionada</label>
                        <div class="col-sm-9 posicao-sel">
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>



                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar notícia *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select" id="noticia" name="noticia"  style="width: 100%;">
                                <option value="">Localizar notícia</option>

                                @foreach($noticias as $n)
                                    <?php $noticia = $n->toArray() ?>
                                    <option value="{{ $n['news_id'] }}">{{ $noticia['title'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->

                <div id="aba-noticias" class="tab-pane margin-bottom-45">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de destaque </label>
                        <div class="col-sm-9 posicoes_2">
                            <div rel="1" class="col-sm-5 posicao_1 item">
                                <img src="{{ asset('admin/assets/images/posicao8.png') }}" alt="">
                                <div class="status margin-top-15">&nbsp;Página inicial - Posição H1</div>
                            </div>
                            <div rel="2" class="col-sm-5 posicao_2 item">
                                <img src="{{ asset('admin/assets/images/posicao9.png') }}" alt="">
                                <div class="status margin-top-15">&nbsp;Página inicial - Posição H2</div>
                            </div>

                            <div rel="3" class="col-sm-5 posicao_3 item margin-top-25">
                                <img src="{{ asset('admin/assets/images/posicao11.png') }}" alt="" class="pull-left">
                                <div class="status margin-top-50" class="pull-left">&nbsp;Página inicial - Posição H3</div>
                            </div>
                            <div rel="4" class="col-sm-5 posicao_4 item margin-top-25">
                                <img src="{{ asset('admin/assets/images/posicao12.png') }}" alt="" class="pull-left">
                                <div class="status margin-top-50" class="pull-left">&nbsp;Página inicial - Posição H4</div>
                            </div>
                            <div rel="5" class="col-sm-5 posicao_3 item margin-top-25">
                                <img src="{{ asset('admin/assets/images/posicao13.png') }}" alt="" class="pull-left">
                                <div class="status margin-top-50" class="pull-left">&nbsp;Página inicial - Posição H5</div>
                            </div>
                            <div rel="6" class="col-sm-5 posicao_4 item margin-top-25">
                                <img src="{{ asset('admin/assets/images/posicao14.png') }}" alt="" class="pull-left">
                                <div class="status margin-top-50" class="pull-left">&nbsp;Página inicial - Posição H6</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Notícia selecionada</label>
                        <div class="col-sm-9 posicao-sel2">
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar notícia *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select2" id="noticia_2"  name="noticia_2"  style="width: 100%;">
                                <option value="">Localizar notícia</option>

                                @foreach($noticias as $n)
                                    <?php $noticia = $n->toArray() ?>
                                    <option value="{{ $n['news_id'] }}">{{ $noticia['title'] }}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                </div>

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



<!-- #dialog-message -->
<div id="dialog-message" class="hide"></div>
<!-- / #dialog-message -->



{{--@include('admin.includes.paginacao')--}}

<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/noticias_destaques.js')}}"></script>
{{--<script src="{{ asset('admin/js/cropbox.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>--}}
<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>

@endsection('content')