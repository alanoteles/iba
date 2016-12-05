@extends('admin.layouts.master')

@section('title','Cadastro de Projetos')

@section('content')

    <form name="frm" id="frm" class="form-horizontal" role="form">

        <div class="col-xs-12 botoes-pj-pf">
            <a class="btn btn-sm font-size-14 margin-right-20 margin-left-2 remover-item" style="padding: 3px 10px 4px 10px;">Excluir projeto</a>
            <a href="_projetos.html"  class="btn cancelar btn-sm font-size-14 margin-right-2" style="padding: 3px 10px 4px 10px;">Cancelar</a>
            <button type="submit" class="btn btn-success salvar no-margin">Salvar</button>
        </div>
        <br clear="all"/>
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a data-toggle="tab" href="#aba-gerais">Dados gerais</a></li>
                <li class=""><a data-toggle="tab" href="#aba-valores">Valores</a></li>
                <li class=""><a data-toggle="tab" href="#aba-resultados">Resultados</a></li>
                <li class=""><a data-toggle="tab" href="#aba-anexos">Anexos</a></li>
                <li class=""><a data-toggle="tab" href="#aba-traducoes">Traduções</a></li>
            </ul>

            <div class="tab-content">


                <!-- dados gerais -->
                <div id="aba-gerais" class="tab-pane margin-bottom-45 active">

                    <div class="exibir-sim-nao">
                        <span>Exibir</span>
                        <div class="checkbox_sim_nao pull-right margin-left-30">
                            <div class="tipo sim">
                                <div class="icon">✓</div>
                                <div class="texto"></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Sobre o projeto
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título * </label>
                        <div class="col-sm-9">
                            <input type="text" id="titulo" name="titulo" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo * </label>
                        <div class="col-sm-9">
                            <textarea name="resumo" id="resumo" class="form-control descricao-grupo" placeholder="" required="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Número * </label>
                        <div class="col-sm-3">
                            <input type="text" id="numero" name="numero" class="col-sm-12 numero" required="true">
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Data de reunião * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                          <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>

                                <input class="form-control date-picker" type="text" name="date-reuniao" id="date-reuniao" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Modalidade *</label>
                        <div class="col-sm-3">
                            <select class="form-control col-sm-12" id="modalidade" name="modalidade">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Período de execução * </label>
                        <div class="col-sm-3">
                            <div class="input-group">
                          <span class="input-group-addon">
                            <i class="icon-calendar bigger-110"></i>
                          </span>

                                <input class="form-control" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Situação do projeto * </label>
                        <div class="col-sm-3">
                            <select class="form-control col-sm-12" id="situacao" name="situacao">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Atividade * </label>
                        <div class="col-sm-3">
                            <select class="form-control col-sm-12" id="atividade" name="atividade">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Parceiros
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Proponente * </label>
                        <div class="col-sm-6">
                            <select class="form-control col-sm-12" id="proponente" name="proponente">
                                <option value="">Selecione</option>
                                <option value="Proponente 01">Proponente 01</option>
                                <option value="Proponente 02">Proponente 02</option>
                            </select>
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-default bnt-add" id="addTags" style="padding: 2px 15px;margin-top: -1px;">+</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-9">
                            <div class="tags col-sm-12 tagsnew" style="width: 100% !important; min-height: 100px !important;"></div>
                        </div>
                    </div>

                    <!-- ========================================================================== -->


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Executor * </label>
                        <div class="col-sm-6">
                            <select class="form-control col-sm-12" id="executor" name="executor">
                                <option value="">Selecione</option>
                                <option value="executor 01">executor 01</option>
                                <option value="executor 02">executor 02</option>
                            </select>
                        </div>
                        <div class="col-sm-1  no-padding-left">
                            <button class="btn btn-sm btn-default bnt-add" id="addExecutor" style="padding: 2px 15px;margin-top: -1px;">+</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>
                    </div>

                    <div class="form-group fotm-tab">
                        <div class="col-sm-3">
                            &nbsp;
                        </div>
                        <div class="col-sm-9">
                            <div class="tags col-sm-12 executornew" style="width: 100% !important; min-height: 100px !important;"></div>
                        </div>
                    </div>


                </div>
                <!-- / dados gerais -->

                <!--  -->
                <div id="aba-valores" class="tab-pane  margin-top-45  margin-bottom-45">
                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Valor total do projeto * </label>
                        <div class="col-sm-3">
                            <input type="text" id="valor_total" name="valor_total" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Observação * </label>
                        <div class="col-sm-9">
                            <input type="text" id="observacao" name="observacao" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Anual
                    </h3>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 1 * </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano1" name="ano1" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 2 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano2" name="ano2" class="col-sm-12" required="true">
                        </div>
                    </div>


                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 3 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano3" name="ano3" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 4 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano4" name="ano4" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 5 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano5" name="ano5" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 6 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano6" name="ano6" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 7 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano7" name="ano7" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 8 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano8" name="ano8" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 9 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano9" name="ano9" class="col-sm-12" required="true">
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ano 10 </label>
                        <div class="col-sm-3">
                            <input type="text" id="ano10" name="ano10" class="col-sm-12" required="true">
                        </div>
                    </div>


                </div>
                <!-- /  -->

                <!--  -->
                <div id="aba-resultados" class="tab-pane  margin-top-45  margin-bottom-45">

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-20" style="font-weight: 400;">
                        Principais resultados esperados
                    </h3>

                    <textarea name="explicacao" id="explicacao" class="ckeditor" placeholder="Lorem ipsum dolor est sit amet consectetur est ipsum dolor. Lorem ipsum dolor est sit amet consectetur est ipsum dolor ipsum dolor est sit amet consectetur est ipsum dolor."></textarea>


                </div>
                <!-- /  -->

                <!--  -->
                <div id="aba-anexos" class="tab-pane  margin-top-45  margin-bottom-45">
                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-5 margin-top-20" style="font-weight: 400;">
                        Localizar objetos
                    </h3>

                    <!-- Formulário de pesquisa -->
                    <div class="col-xs-12 no-padding margin-bottom-10 margin-top-10">
                        <form name="frm_pesquisar" method="post" action="">
                            <!-- ===== pesquisa ===== -->
                            <div id="area-pesquisa-c">
                                <div class="col-sm-12 no-padding-left">
                                    <input type="text" id="palavra-chave" name="palavra-chave" placeholder="palavra-chave" class="col-xs-12 font-light">
                                </div>
                                <div class="row-fluid margin-top-15 display-inline-block">
                                    <div class="col-sm-4 no-padding-left">
                                        <select class="form-control" id="linha" name="linha">
                                            <option value="">Linha</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="tema" name="tema">
                                            <option value="">Tema</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="subtema" name="subtema">
                                            <option value="">Sub tema</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2"><button type="button" class="btn btn-info btn-sm bnt-input-height pull-right btn-block">Localizar</button></div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-sm-12 no-padding margin-bottom-10"><hr class="no-margin margin-bottom-15 no-padding" style="width:100%"></div>


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

                                    <tbody>
                                    <tr>
                                        <td class="col-xs-3">Título 1</td>
                                        <td class="col-xs-3">Linha</td>
                                        <td class="col-xs-3">Tema</td>
                                        <td class="col-xs-2">Sub tema</td>
                                        <td class="col-xs-1 align-center"><a href="#" class="add-item-table"><img src="{{asset('admin/assets/images/icon_adicionar_ativo.png')}}" alt=""></a></td>
                                    </tr>
                                    <!-- -->
                                    <tr>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-2">-</td>
                                        <td class="col-xs-1 align-center"><a href="javascript:void(0)" class=""><img src="{{asset('admin/assets/images/icon_adicionar.png')}}" alt=""></a></td>
                                    </tr>
                                    <!-- -->
                                    <tr>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-2">-</td>
                                        <td class="col-xs-1 align-center"><a href="javascript:void(0)" class=""><img src="{{asset('admin/assets/images/icon_adicionar.png')}}" alt=""></a></td>
                                    </tr>
                                    <!-- -->
                                    <tr>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-2">-</td>
                                        <td class="col-xs-1 align-center"><a href="javascript:void(0)" class=""><img src="{{asset('admin/assets/images/icon_adicionar.png')}}" alt=""></a></td>
                                    </tr>
                                    <!-- -->
                                    <tr>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-2">-</td>
                                        <td class="col-xs-1 align-center"><a href="javascript:void(0)" class=""><img src="{{asset('admin/assets/images/icon_adicionar.png')}}" alt=""></a></td>
                                    </tr>
                                    <!-- -->
                                    </tbody>
                                </table>
                            </div><!-- /widget-main -->
                        </div><!-- /widget-body -->
                    </div>

                    <br clear="all" />

                    <!-- PAGINAÇÃO -->
                    <div class="row">
                        <div class="col-xs-12 container-pag no-margin padding-15" >
                            <div class="col-xs-6 no-padding-left padding-top-10">
                                1 a 5 registros de 37
                            </div>
                            <div class="col-xs-6 align-right no-padding-right padding-top-5">
                                <ul class="pagination no-margin">
                                    <li class="disabled">
                                        <a href="#">
                                            <i class="icon-double-angle-left"></i>
                                        </a>
                                    </li>

                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>

                                    <li>
                                        <a href="#">2</a>
                                    </li>

                                    <li>
                                        <a href="#">3</a>
                                    </li>

                                    <li>
                                        <a href="#">4</a>
                                    </li>

                                    <li>
                                        <a href="#">5</a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="icon-double-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/ PAGINAÇÃO -->

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

                                    <tbody>
                                    <tr>
                                        <td class="col-xs-3">Título 1</td>
                                        <td class="col-xs-3">Linha</td>
                                        <td class="col-xs-3">Tema</td>
                                        <td class="col-xs-2">Sub tema</td>
                                        <td class="col-xs-1 align-center">
                                            <button type="button" class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button>
                                        </td>
                                    </tr>
                                    <!-- -->
                                    <tr>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-3">-</td>
                                        <td class="col-xs-2">-</td>
                                        <td class="col-xs-1 align-center">-</td>
                                    </tr>
                                    <!-- -->
                                    </tbody>
                                </table>
                            </div><!-- /widget-main -->
                        </div><!-- /widget-body -->
                    </div>

                    <br clear="all">

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
                        Dados gerais
                    </h3>


                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Título *</label>
                        <div class="col-sm-8">
                            <input type="text" id="titulo_trad" name="titulo_trad" class="col-sm-12">
                        </div>

                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog1" ><img src="{{asset('admin/assets/images/icon_dialog.png')}}" alt=""></a>
                        </div>
                    </div>

                    <div class="form-group fotm-tab">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumo *</label>
                        <div class="col-sm-8">
                            <textarea name="resumo_trad" id="resumo_trad" class="form-control descricao-grupo" placeholder="" ></textarea>
                        </div>
                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog2" ><img src="{{asset('admin/assets/images/icon_dialog.png')}}" alt=""></a>
                        </div>
                    </div>

                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Valores
                    </h3>

                    <div class="form-group fotm-tab margin-top-35">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Observação * </label>
                        <div class="col-sm-8">
                            <input type="text" id="observacao_trad" name="observacao_trad" class="col-sm-12">
                        </div>
                        <div class="col-sm-1 align-right padding-top-3">
                            <a href="javascript:void(0)" id="id-btn-dialog3" ><img src="{{asset('admin/assets/images/icon_dialog.png')}}" alt=""></a>
                        </div>
                    </div>


                    <h3 class="header smaller lighter blue font-size-18 margin-bottom-25 margin-top-45" style="font-weight: 400;">
                        Resultados
                    </h3>

                    <textarea name="resultados_trad" id="resultados_trad" class="ckeditor" placeholder="Lorem ipsum dolor est sit amet consectetur est ipsum dolor. Lorem ipsum dolor est sit amet consectetur est ipsum dolor ipsum dolor est sit amet consectetur est ipsum dolor."></textarea>

                </div>
                <!-- /  -->

            </div>

            <br clear="all"><br clear="all">
        </div>

    </form>

    <!-- Script exclusivo desta area -->
    <script src="{{asset('admin/js/cropbox.js')}}"></script>
    <script src="{{asset('admin/js/_projeto_novo.js')}}"></script>
    <!--<script src="{{asset('admin/js/projeto1-crop.js')}}"></script>-->
    <script src="{{asset('admin/js/ckeditor/ckeditor.js?v=2')}}"></script>

@endsection('content')