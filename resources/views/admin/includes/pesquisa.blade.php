<div class="row margin-top-15 banco-curriculo-pesquisa">
    <div class="col-xs-12">
        <a href="#" id="pesquisaC" class="active">Pesquisa</a>
        <!-- &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="#" id="pesquisaAC" class="inactive">Pesquisa avançada</a> -->
        <hr class="margin-top-5 margin-bottom-5">
    </div>
</div>


<!-- Formulário de pesquisa -->
<div class="col-xs-12 no-padding margin-bottom-15 margin-top-10">
    <form name="frm" id="pesquisar" method="get" action="/{{ $action }}">
        <input type="hidden" id="model" name="model" value="{{ $model }}"/>
        <input type="hidden" name="table" value="{{ $table }}"/>
        <input type="hidden" name="view" value="{{ $view }}"/>
        <input type="hidden" name="table_translation" value="{{ $table_translation or ''}}"/>
        <input type="hidden" name="fk" value="{{ $fk or ''}}"/>


        <!--  pesquisa  -->
        <div id="area-pesquisa-c">
            <div class="col-xs-3 no-padding-left">
                <input type="text" id="palavra-chave" name="palavra_chave" value="{{ (!empty($palavra_chave) ? $palavra_chave : '') }}" placeholder="palavra-chave" class="col-xs-12 font-light">
            </div>

            @if(!empty($grupos))
                <div class="col-xs-2">
                    <select class="form-control" id="grupo" name="grupo">
                        <option value="">Grupo</option>
                        @foreach($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif


            @if(!empty($idiomas))
                <div class="col-xs-2">
                    <select class="form-control" id="idioma" name="idioma">
                        <option value="">Idioma</option>
                        @foreach($idiomas as $idioma)
                            <option value="{{ $idioma->name }}">{{ $idioma->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif



            @if(!empty($atividades))
                <div class="col-xs-2">
                    <select class="form-control" id="atividade" name="atividade">
                        <option value="">Atividades</option>
                        @foreach($atividades as $atividade)
                            @if($atividade->locale == 'pt_br')
                                <option value="{{ $atividade->id }}">{{ $atividade->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif


            @if(!empty($editorias))
                <div class="col-xs-2">
                    <select class="form-control" id="editoria" name="editoria">
                        <option value="">Editorias</option>
                        @foreach($editorias as $editoria)
                            @if($editoria->locale == 'pt_br')
                                <option value="{{ $editoria->id }}">{{ $editoria->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif



        @if(!empty($modalidades))
                <div class="col-xs-2">
                    <select class="form-control" id="modalidade" name="modalidade">
                        <option value="">Modalidades</option>
                        @foreach($modalidades as $modalidade)
                            @if($modalidade->locale == 'pt_br')
                                <option value="{{ $modalidade->id }}">{{ $modalidade->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif


            @if(!empty($tipos_de_midia))
                <div class="col-xs-2">
                    <select class="form-control" id="tipo_de_midia" name="tipo_de_midia">
                        <option value="">Tipo de mídia</option>
                        @foreach($tipos_de_midia as $tipo_de_midia)
                            @if($tipo_de_midia->locale == 'pt_br')
                                <option value="{{ $tipo_de_midia->id }}">{{ $tipo_de_midia->type }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif


            @if(isset($exibir))
                <div class="col-xs-2">
                    <select class="form-control" id="exibir" name="exibir">
                        <option value="">Exibir</option>
                        <option value="">Exibir Todos</option>
                        <option value="S">Exibir Sim</option>
                        <option value="N">Exibir Não</option>
                    </select>
                </div>
            @endif

            @if(!empty($situacoes))
                <div class="col-xs-2">
                    <select class="form-control" id="situacao" name="situacao">
                        <option value="">Situações</option>
                        @foreach($situacoes as $situacao)
                            @if($situacao->locale == 'pt_br')
                                <option value="{{ $situacao->id }}">{{ $situacao->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif



            @if(!empty($linhas))
                <div class="col-xs-2">
                    <select class="form-control" id="linha" name="linha">
                        <option value="">Linhas</option>
                        @foreach($linhas as $linha)
                            @if($linha->locale == 'pt_br')
                                <option value="{{ $linha->id }}">{{ $linha->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif

{{--{{ $temas }}--}}
{{--@foreach($temas as $key => $tema)--}}
{{--{{ $tema->id }} *** {!!  $tema->title !!}<br>--}}
    {{--{{ $tema }}--}}
{{--@endforeach--}}

            @if(!empty($temas))
                <div class="col-xs-2">
                    <select class="form-control" id="tema" name="tema">
                        <option value="">Temas</option>
                        @foreach($temas as $tema)
                            @if($tema->locale == 'pt_br' && $tema->subtopic_id == 0)
                                <option value="{{ $tema->id }}">{{ $tema->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            @endif

            @if(Route::getCurrentRoute()->getPath() == 'pt_br/admin/projetos')

                <!-- AJUSTAR  A POSIÇÃO CONFORME O NUMERO DE COLUNAS -->
                {{--<div class="col-xs-5">--}}
                    {{--<div class="form-group fotm-tab">--}}

                        {{--<label class="margin-top-4 margin-right-15 pull-left" for="form-field-1"> Período </label>--}}

                        {{--<div class="new-radio margin-top-2 margin-right-15">--}}
                            {{--<label>--}}
                                {{--<input name="periodo" type="radio" class="ace" checked="checked">--}}
                                {{--<span class="lbl"><div>Execução</div></span>--}}
                            {{--</label>--}}
                        {{--</div>--}}

                        {{--<div class="new-radio margin-top-2 margin-right-15">--}}
                            {{--<label>--}}
                                {{--<input name="periodo" type="radio" class="ace">--}}
                                {{--<span class="lbl"><div>reunião</div></span>--}}
                            {{--</label>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-xs-6">--}}
                    {{--<select id="mes" name="mes" class="pull-left margin-right-8" style="width: 23%;">--}}
                        {{--<option value="">Mês</option>--}}
                    {{--</select>--}}

                    {{--<select id="ano" name="ano" class="pull-left" style="width: 23%;">--}}
                        {{--<option value="">Ano</option>--}}
                    {{--</select>--}}

                    {{--<div class="pull-left margin-top-9">&nbsp;&nbsp;a&nbsp;&nbsp;</div>--}}

                    {{--<select id="mes" name="mes" class="pull-left margin-right-8" style="width: 23%;">--}}
                        {{--<option value="">Mês</option>--}}
                    {{--</select>--}}

                    {{--<select id="ano" name="ano" class="pull-left" style="width: 23%;">--}}
                        {{--<option value="">Ano</option>--}}
                    {{--</select>--}}

                {{--</div>--}}
            @endif


            <div class="col-xs-3">
                <button type="submit" class="btn btn-info btn-sm bnt-input-height">Pesquisar</button>
            </div>
        </div>
        {!! csrf_field() !!}
    </form>
</div>
<!-- / Formulário de pesquisa -->