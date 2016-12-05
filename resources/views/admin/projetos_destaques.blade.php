@extends('admin.layouts.master')

@section('title','Projetos em números')

@section('content')

    <form name="frm" id="frm" class="form-horizontal" role="form" method="post">

        <div class="col-xs-12 botoes-pj-pf">

            <a href="_projetos.html" class="btn cancelar btn-sm font-size-14 margin-right-2"
               style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="button" class="btn btn-success salvar no-margin">Salvar</button>
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
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de
                            destaque </label>
                        <div class="col-sm-9 posicoes">
                            <div rel="1" class="col-sm-4 posicao1 item">
                                <img src="{{asset('admin/assets/images/posicao1.png')}}" alt="">
                                <div class="status margin-top-20">&nbsp;Página inicial - Posição H1</div>
                            </div>
                            <div rel="2" class="col-sm-4 posicao2 item">
                                <img src="{{asset('admin/assets/images/posicao2.png')}}" alt="">
                                <div class="status margin-top-20">&nbsp;Página inicial - Posição H2</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Área
                            selecionada</label>
                        <div class="col-sm-9 posicao-sel">
                            <input type="hidden" name="posicao" value=""/>
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar projeto
                            *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select" id="projeto" required="true" name="projeto"
                                    data-placeholder="Choose a Country..." style="width: 100%;">
                                <option value="">Localizar projeto</option>
                                <option value="Projeto 01">Projeto 01</option>
                            </select>
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->

                <!--  -->
                <div id="aba-projetos" class="tab-pane margin-bottom-45">
                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Áreas de
                            destaque </label>
                        <div class="col-sm-9 posicoes_2">
                            <div rel="1" class="col-sm-4 posicao_1 item">
                                <img src="{{asset('admin/assets/images/posicao18.png')}}" alt="">
                                <div class="status margin-top-20">&nbsp;Página projetos - Posição P1</div>
                            </div>
                            <div rel="2" class="col-sm-4 posicao_2 item">
                                <img src="{{asset('admin/assets/images/posicao19.png')}}" alt="">
                                <div class="status margin-top-20">&nbsp;Página projetos - Posição P2</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-30 height-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Área
                            selecionada</label>
                        <div class="col-sm-9 posicao-sel2">
                            <input type="hidden" name="posicoes_2" value=""/>
                            <p class="lead padding-left-15 font-size-18"></p>
                        </div>
                    </div>


                    <div class="form-group fotm-tab margin-top-30">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Selecionar projeto
                            *</label>
                        <div class="col-sm-8 padding-left-25">
                            <select class="chosen-select2" id="projeto_2" required="true" name="projeto_2"
                                    data-placeholder="Choose a Country..." style="width: 100%;">
                                <option value="">Localizar projeto</option>
                                <option value="Projeto 01">Projeto 01</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /  -->


            </div>

            <br clear="all"><br clear="all">
        </div>
    </form>

    <!-- Script exclusivo desta area -->
    <!-- <script src="js/cropbox.js')}}"></script> -->
    <script src="{{asset('admin/js/_projetos_posicoes.js')}}"></script>
    <!--<script src="js/projeto1-crop.js')}}"></script>-->
    <!--<script src="js/ckeditor/ckeditor.js?v=2"></script> -->

@endsection('content')