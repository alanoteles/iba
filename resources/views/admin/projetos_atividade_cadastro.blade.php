@extends('admin.layouts.master')

@section('title','Cadastro de Atividades de Projeto')

@section('content')

    <form name="frm" id="frm" class="form-horizontal" role="form">

        <div class="col-xs-12 botoes-pj-pf">
            <button type="button" class="btn remover-item margin-right-20 margin-left-2">Excluir atividade</button>
            <a href="atividade.html"  class="btn cancelar btn-sm font-size-15 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#acesso">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#traducao">Tradução</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="acesso" class="tab-pane  margin-top-15  margin-bottom-45 active">


                    <div class="exibir-sim-nao margin-bottom-45">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo sim">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Atividade *</label>
                        <div class="col-sm-6">
                            <input type="text" id="nome" name="nome" class="col-sm-12" requery="true" value="{{$atividade[0]->name}}">
                        </div>
                    </div>

                </div>
                <!-- / dados gerais -->


                <div id="traducao" class="tab-pane  margin-top-15  margin-bottom-45">
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
                        Dados gerais
                    </h3>



                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Atividade *</label>
                        <div class="col-sm-8">
                            <input type="text" id="texto-alternativo-icone-trad" name="texto-alternativo-icone-trad" class="col-sm-12">
                        </div>

                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog1" ><img src="{{asset('admin/assets/images/icon_dialog.png')}}" alt=""></a>
                        </div>
                    </div>

                </div>

            </div>

            <br clear="all"><br clear="all">
        </div>

    </form>

    <!-- Script exclusivo desta area -->
    <script src="{{asset('admin/js/atividade.js')}}"></script>

@endsection('content')