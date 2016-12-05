
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
            'url'   => App::getLocale() . '/admin/projetos/destaques/salvar',
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
    {{ Form::hidden('p1', (isset($p1) ? $p1->record_id : ''), array('id' => 'p1')) }}
    {{ Form::hidden('p2', (isset($p2) ? $p2->record_id : ''), array('id' => 'p2')) }}

    {{ Form::hidden('project_id', (isset($projeto->id) ? $projeto->id : '')) }}

        <div class="col-xs-12 botoes-pj-pf">
            <a href="" data-route="/admin/projetos"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>

        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-home">Home</a></li>
                <li class=""><a data-toggle="tab" href="#aba-projetos">Página projetos</a></li>
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
                            <div rel="2" class="col-sm-4 posicao2 item">
                                <img src="{{ asset('admin/assets/images/posicao2.png') }}" alt="">
                                <div class="status margin-top-20">&nbsp;Página inicial - Posição H2</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Projeto selecionado</label>
                        <div class="col-sm-9 posicao-sel">
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>



                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar projeto *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select" id="projeto" name="projeto"  style="width: 100%;">
                                <option value="">Localizar projeto</option>

                                @foreach($projetos as $p)
                                    <?php $projeto = $p->toArray() ?>
                                    <option value="{{ $p['project_id'] }}">{{ $projeto['title'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->

                <div id="aba-projetos" class="tab-pane margin-bottom-45">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de destaque </label>
                        <div class="col-sm-9 posicoes_2">
                            <div rel="1" class="col-sm-4 posicao_1 item">
                                <img src="{{ asset('admin/assets/images/posicao18.png') }}" alt="">
                                <div class="status margin-top-20">&nbsp;Página projetos - Posição P1</div>
                            </div>
                            <div rel="2" class="col-sm-4 posicao_2 item">
                                <img src="{{ asset('admin/assets/images/posicao19.png') }}" alt="">
                                <div class="status margin-top-20">&nbsp;Página projetos - Posição P2</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Projeto selecionado</label>
                        <div class="col-sm-9 posicao-sel2">
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar projeto *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select2" id="projeto_2"  name="projeto_2"  style="width: 100%;">
                                <option value="">Localizar projeto</option>

                                @foreach($projetos as $p)
                                    <?php $projeto = $p->toArray() ?>
                                    <option value="{{ $p['project_id'] }}">{{ $projeto['title'] }}</option>
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
<script src="{{asset('admin/js/projetos_destaques.js')}}"></script>
{{--<script src="{{ asset('admin/js/cropbox.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/objetos-crop.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/ckeditor/ckeditor.js?v=2') }}"></script>--}}

@endsection('content')