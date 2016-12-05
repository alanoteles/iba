@extends('admin.layouts.master')

@section('title','Projetos em números')

@section('content')

    <form name="frm" id="frm" class="form-horizontal" role="form">

        <div class="col-xs-12 botoes-pj-pf">
            <a href="_projetos.html"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados da página</a></li>
                <li class=""><a data-toggle="tab" href="#aba-valores">Gráficos</a></li>
                <li class=""><a data-toggle="tab" href="#aba-traducoes">Tradução</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">



                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Texto de introdução da página
                    </h3>


                    <textarea name="explicacao" id="explicacao" class="ckeditor" placeholder="Lorem ipsum dolor est sit amet consectetur est ipsum dolor. Lorem ipsum dolor est sit amet consectetur est ipsum dolor ipsum dolor est sit amet consectetur est ipsum dolor."></textarea>




                </div>
                <!-- / dados gerais -->

                <!--  -->
                <div id="aba-valores" class="tab-pane  margin-top-45  margin-bottom-45">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Período dos gráficos gerados
                    </h3>



                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Período * </label>
                        <div class="col-sm-6">
                            <div class="input-group">
                          <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>

                                <input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /  -->

                <!--  -->
                <div id="aba-traducoes" class="tab-pane  margin-top-45  margin-bottom-45">

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
                            <select class="form-control col-sm-12" id="idioma_trad" name="idioma_trad"  required="true">
                                <option value="">Selecione</option>
                                <option value="EN">Inlgês</option>
                                <option value="ES">Espanhol</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Dados da página
                    </h3>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-11">
                            <textarea name="resultados_trad" id="resultados_trad" class="ckeditor" placeholder="Lorem ipsum dolor est sit amet consectetur est ipsum dolor. Lorem ipsum dolor est sit amet consectetur est ipsum dolor ipsum dolor est sit amet consectetur est ipsum dolor."></textarea>
                        </div>
                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog1" ><img src="{{asset('admin/assets/images/icon_dialog.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <!-- /  -->

            </div>

            <br clear="all"><br clear="all">
        </div>

    </form>

    <!-- Script exclusivo desta area -->
    <script src="{{asset('admin/js/cropbox.js')}}"></script>
    <script src="{{asset('admin/js/_projeto_numeros.js')}}"></script>
    <!--<script src="{{asset('admin/js/projeto1-crop.js')}}"></script>-->
    <script src="{{asset('admin/js/ckeditor/ckeditor.js?v=2')}}"></script>
@endsection('content')