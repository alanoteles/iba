
@extends('admin.layouts.master')



@section('title','Banners')

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
            'url'   => App::getLocale() . '/admin/banners/destaques/salvar',
            'name'  => 'frm',
            'id'    => 'frm',
            'class' => 'form-horizontal',
            'role'  => 'form',
            'method'    => 'POST' )
            )
        }}


    {{ Form::hidden('locale', App::getLocale()) }}
    {{ Form::hidden('h1', (!empty($h1) ? $h1->banner_id : ''), array('id' => 'h1')) }}
    {{ Form::hidden('p1', (!empty($p1) ? $p1->banner_id : ''), array('id' => 'p1')) }}
    {{ Form::hidden('banner_id', (isset($banner->id) ? $banner->id : '')) }}

        <div class="col-xs-12 botoes-pj-pf">
            <a href="" data-route="/admin/banners"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>

        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-home">Home</a></li>
                <li class=""><a data-toggle="tab" href="#aba-interna">Internas</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-home" class="tab-pane margin-bottom-45 margin-top-35 active">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de destaque </label>
                        <div class="col-sm-9 posicoes">
                            <div rel="1" class="col-sm-4 posicao1 item">
                                <img src="{{ asset('admin/assets/images/posicao15.png') }}" alt="">
                                <div class="status margin-top-20">&nbsp;Página inicial - Posição H1</div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Banner ativo</label>
                        <div class="col-sm-9 posicao-sel">
                            <p class="lead padding-left-15 font-size-18">{{ (!empty($h1) ? $h1->title : '') }}</p>
                        </div>
                    </div>



                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar banner *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select" id="banner" name="banner"  style="width: 100%;">
                                <option value="">Localizar banner</option>

                                @foreach($banners as $b)
                                    <?php $banner = $b->toArray() ?>
                                    <option value="{{ $b['banner_id'] }}">{{ $banner['title'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->

                <div id="aba-interna" class="tab-pane margin-bottom-45">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de destaque </label>
                        <div class="col-sm-9 posicoes_2">
                            <div rel="1" class="col-sm-5 posicao_1 item">
                                <img src="{{ asset('admin/assets/images/posicao17.png') }}" alt="">
                                <div class="status margin-top-15">&nbsp;Barra lateral - Posição P1</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Banner ativo</label>
                        <div class="col-sm-9 posicao-sel2">
                            <p class="lead padding-left-15 font-size-18">{{ (!empty($p1) ? $p1->title : '') }}</p>
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar banner *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select2" id="banner_2"  name="banner_2"  style="width: 100%;">
                                <option value="">Localizar banner</option>

                                @foreach($banners as $b)
                                    <?php $banner = $b->toArray() ?>
                                    <option value="{{ $b['banner_id'] }}">{{ $banner['title'] }}</option>
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


<!-- scripts exclusivos desta area -->
<script src="{{asset('admin/js/banners_destaques.js')}}"></script>
{{--<script src="{{ asset('admin/js/cropbox.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>--}}

@endsection('content')