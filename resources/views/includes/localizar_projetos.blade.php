<section class="beh-projetoslocalizar">
    <h2 class="subtitle-area">{{trans('interface.localizar')}} {{trans('interface.projetos')}}</h2>
    <div class="filtros">
        <form action="/{{ App::getLocale()  }}/projetos-busca" method="post">
            <div class="line">
                <input type="text" name="termo" placeholder="{{trans('interface.label_pesquisa_projeto')}}"
                        {{ !is_null(Request::get('termo')) ? 'value='.Request::get('termo') : '' }}
                >
            </div>
            <div class="line pull-left">
                <div class="mes campo-margin pull-left">
                    <select name="mes_inicio">
                        <option value="" @if (Request::get('mes_inicio')=='') selected @endif>{{trans('interface.mes')}}</option>
                        <option value="1" @if (Request::get('mes_inicio')==1) selected @endif>{{trans('interface.janeiro')}}</option>
                        <option value="2" @if (Request::get('mes_inicio')==2) selected @endif>{{trans('interface.fevereiro')}}</option>
                        <option value="3" @if (Request::get('mes_inicio')==3) selected @endif>{{trans('interface.marco')}}</option>
                        <option value="4" @if (Request::get('mes_inicio')==4) selected @endif>{{trans('interface.abril')}}</option>
                        <option value="5" @if (Request::get('mes_inicio')==5) selected @endif>{{trans('interface.maio')}}</option>
                        <option value="6" @if (Request::get('mes_inicio')==6) selected @endif>{{trans('interface.junho')}}</option>
                        <option value="7" @if (Request::get('mes_inicio')==7) selected @endif>{{trans('interface.julho')}}</option>
                        <option value="8" @if (Request::get('mes_inicio')==8) selected @endif>{{trans('interface.agosto')}}</option>
                        <option value="9" @if (Request::get('mes_inicio')==9) selected @endif>{{trans('interface.setembro')}}</option>
                        <option value="10" @if (Request::get('mes_inicio')==10) selected @endif>{{trans('interface.outubro')}}</option>
                        <option value="11" @if (Request::get('mes_inicio')==11) selected @endif>{{trans('interface.novembro')}}</option>
                        <option value="12" @if (Request::get('mes_inicio')==12) selected @endif>{{trans('interface.dezembro')}}</option>
                    </select>
                </div>
                <div class="ano pull-left">
                    <select name="ano_inicio">
                        <option value="">{{trans('interface.ano')}}</option>
                        @for($year=2010; $year < \Carbon\Carbon::now('Y')->toDateString()+4; $year++)
                            <option value="{{$year}}" @if (Request::get('ano_inicio')==$year) selected @endif>{{$year}}</option>
                        @endfor
                    </select>
                </div>
                <div class="intervalo pull-left">A</div>
                <div class="mes campo-margin pull-left">
                    <select name="mes_fim">
                        <option value="" @if (Request::get('mes_fim')=='') selected @endif>{{trans('interface.mes')}}</option>
                        <option value="1" @if (Request::get('mes_fim')==1) selected @endif>{{trans('interface.janeiro')}}</option>
                        <option value="2" @if (Request::get('mes_fim')==2) selected @endif>{{trans('interface.fevereiro')}}</option>
                        <option value="3" @if (Request::get('mes_fim')==3) selected @endif>{{trans('interface.marco')}}</option>
                        <option value="4" @if (Request::get('mes_fim')==4) selected @endif>{{trans('interface.abril')}}</option>
                        <option value="5" @if (Request::get('mes_fim')==5) selected @endif>{{trans('interface.maio')}}</option>
                        <option value="6" @if (Request::get('mes_fim')==6) selected @endif>{{trans('interface.junho')}}</option>
                        <option value="7" @if (Request::get('mes_fim')==7) selected @endif>{{trans('interface.julho')}}</option>
                        <option value="8" @if (Request::get('mes_fim')==8) selected @endif>{{trans('interface.agosto')}}</option>
                        <option value="9" @if (Request::get('mes_fim')==9) selected @endif>{{trans('interface.setembro')}}</option>
                        <option value="10" @if (Request::get('mes_fim')==10) selected @endif>{{trans('interface.outubro')}}</option>
                        <option value="11" @if (Request::get('mes_fim')==11) selected @endif>{{trans('interface.novembro')}}</option>
                        <option value="12" @if (Request::get('mes_fim')==12) selected @endif>{{trans('interface.dezembro')}}</option>
                    </select>
                </div>
                <div class="ano pull-left">
                    <select name="ano_fim">
                        <option value="">{{trans('interface.ano')}}</option>
                        @for($year=2010; $year < \Carbon\Carbon::now('Y')->toDateString()+4; $year++)
                            <option value="{{$year}}" @if (Request::get('ano_fim')==$year) selected @endif>{{$year}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <label class="label-localizar-projeto"><input type="radio" name="tipo_data" value="R"
                                                              @if (Request::get('tipo_data')=='R') checked @endif>{{trans('interface.data_da_aprovacao')}}
                </label>
                <label class="label-localizar-projeto"><input type="radio" name="tipo_data" value="E"
                                                              @if (Request::get('tipo_data')=='E') checked @endif>{{trans('interface.data_da_execucao')}}
                </label>
            </div>
            <div class="line">
                <select name="associada_executora">
                    <option value="">{{trans('interface.todos_os_proponentes')}}</option>
                    @foreach($associadas_executoras as $associada_executora)
                        <option value="{{ $associada_executora->id }}"
                                @if (Request::get('associada_executora')==$associada_executora->id) selected @endif
                        >{{ $associada_executora->acronym}} - {{$associada_executora->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="line">
                <select name="atividade">
                    <option value="">{{trans('interface.todas_as_atividades')}}</option>
                    @foreach($atividades as $atividade)
                        <?php $a = $atividade->toArray(); ?>
                        <option value="{{ $atividade->project_activity_id }}"
                                @if (Request::get('atividade')==$atividade->project_activity_id) selected @endif
                        >{{ $a['name'] }}</option>

                    @endforeach
                </select>
            </div>
            <div class="line">
                <select name="situacao">
                    <option value="">{{trans('interface.todas_as_situacoes')}}</option>
                    @foreach($situacoes as $situacao)
                        <option value="{{ $situacao->id }}"
                                @if (Request::get('situacao')==$situacao->id) selected @endif
                        >{{ $situacao->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="line">
                <button type="submit">{{trans('interface.localizar')}}</button>
            </div>

            {!! csrf_field() !!}
        </form>
    </div>
</section>