@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render() !!}
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="pull-left col-md-12 ">
                <h1 class="title-page">Projetos em números</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin
                    gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum
                    sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum,
                    nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget odio.</p>
            </div>
        </div>
    </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="pull-left col-md-12 ">
                <section class="beh-graficosatividades">
                    <h2 class="title-comparativo">PROJETOS X ATIVIDADES</h2>
                    @foreach($lista as $l)
                        <div class="item">
                            <div class="info col-md-6 col-sm-12 col-xs-12">
                                <div class="nome">{{ $l->name }}</div>
                                <div class="valor">R$ {{ number_format($l->total_projetos,2,',','.') }}</div>
                            </div>
                            <div class="percentual col-md-6 col-sm-12 col-xs-12">
                                <div class="numero">{{ $l->porcentagem }}%</div>
                                <div class="percentual-bar" style="width:{{ $l->porcentagem }}%"></div>
                            </div>
                        </div>
                    @endforeach
                    <div class="item item-total">
                        <div class="info col-md-6 col-sm-12 col-xs-12">
                            <div class="nome">Total</div>
                            <div class="valor">R$ {{ number_format($vlr_total_projetos,2,',','.') }}</div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">

            <div class="col-md-4 col-xs-12 full-widget padding-bottom-xs">
                <h2 class="subtitle-area">Projetos x Situação</h2>
                <select id="projetos_situacao_associada" class="projeto-situacao">
                    <option value="0">Todas associadas</option>
                    @foreach($associadas as $associada)
                        <option value="{{ $associada->id }}">{{ $associada->acronym }}</option>
                    @endforeach
                </select>
                <select id="projetos_situacao" class="projeto-situacao">
                    <option value="0">Todas as situações</option>
                    @foreach($situacoes as $situacao)
                        <option value="{{ $situacao->id }}">{{ $situacao->name }}</option>
                    @endforeach
                </select>
                <section class="beh-graficodefault">
                    <div id="graphic"></div>
                    <script></script>
            </div>
            <div class="col-md-4 col-xs-12 full-widget padding-bottom-xs">
                <h2 class="subtitle-area">Projetos x Atividades</h2>
                <select id="projetos_atividades_associada" class="projeto_atividade">
                    <option value="0">Todas associadas</option>
                    @foreach($associadas as $associada)
                        <option value="{{ $associada->id }}">{{ $associada->acronym }}</option>
                    @endforeach
                </select>
                <select id="projetos_atividades_atividade" class="projeto_atividade">
                    <option value="0">Todas as atividades</option>
                    @foreach($atividades as $atividade)
                        <option value="{{ $atividade->id }}">{{ $atividade->name }}</option>
                    @endforeach
                </select>
                <section class="beh-graficodefault">
                    <div id="grafico-atividades"></div>
                    <script></script>
            </div>
            <div class="col-md-4 pull-right full-widget">
                <section class="beh-projetovalores">
                    <h2 class="subtitle-area">Valor contratado</h2>
                    <ul class="itens">
                        @foreach($valor_contratado as $vc)
                            <li class="item">
                                <div class="nome">{{$vc['label']}}</div>
                                <div class="valor">R$ {{ number_format($vc['total_associada'],2,',','.') }}</div>
                            </li>
                        @endforeach
                        <li class="item item-total">
                            <div class="nome">TOTAL</div>
                            <div class="valor">
                                R$ {{ number_format($valor_contratado[0]['total_global'],2,',','.') }}</div>
                        </li>
                    </ul>
                </section>
            </div>


        </div>
    </div>

    <div class="content">
        <div class="container">
            <section class="beh-graficofull col-md-12">
                <h2 class="subtitle-area">Projetos x Associadas</h2>
                <div id="graphicfull">
                    <script type="text/javascript" charset="utf-8">

                        //Chamada Ajax para retornar os dados
                        var grafico = "graphicfull";
                        $.ajax({
                            url: '/' + $('#app_locale').val() + '/projetos-associada-situacao',
                            data: {associada: 0, grafico: grafico},
                            dataType: 'json',
                            beforeSend: function () {
                                $("#" + grafico).empty();
                            },
                            success: function (data, status) {
                                if (data == 0) {
                                    $('#' + grafico).html("<p style='text-align:center;margin-top:25%'>Não foi encontrado nenhum registro</p>");
                                } else {
                                    console.log(data);
                                    createGraphicfull(data);
                                }

                            }
                        });


                    </script>
                </div>
            </section>

        </div>
    </div>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            atualizaProjetoSituacao();
            atualizaProjetoAtividade('grafico-atividades');

        });

        //Alterar selects, modificar gráfico
        $('.projeto-situacao').change(function () {
            atualizaProjetoSituacao();
        })


        $(".projeto_atividade").change(function () {
            atualizaProjetoAtividade('grafico-atividades');
        });

        //Seleciona (deixa ativo) o segundo item do menu (projetos em números)
        selectSubNavbar(2);


    </script>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection

