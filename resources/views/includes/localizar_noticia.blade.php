<section class="beh-projetoslocalizar">
    <h2 class="subtitle-area">Localizar Notícia</h2>
    <div class="filtros">
        <form action="/{{ App::getLocale()  }}/noticias-busca" method="post">
            <div class="line">
                <input type="text" name="termo" placeholder="Palavra">
            </div>
            <div class="line pull-left">
                <div class="mes campo-margin pull-left">
                    <select name="mes_inicio">
                        <option value="">{{trans('interface.mes')}}</option>
                        <option value="1">{{trans('interface.janeiro')}}</option>
                        <option value="2">{{trans('interface.fevereiro')}}</option>
                        <option value="3">{{trans('interface.marco')}}</option>
                        <option value="4">{{trans('interface.abril')}}</option>
                        <option value="5">{{trans('interface.maio')}}</option>
                        <option value="6">{{trans('interface.junho')}}</option>
                        <option value="7">{{trans('interface.julho')}}</option>
                        <option value="8">{{trans('interface.agosto')}}</option>
                        <option value="9">{{trans('interface.setembro')}}</option>
                        <option value="10">{{trans('interface.outubro')}}</option>
                        <option value="11">{{trans('interface.novembro')}}</option>
                        <option value="12">{{trans('interface.dezembro')}}</option>
                    </select>
                </div>
                <div class="ano pull-left">
                    <select name="ano_inicio">
                        <option value="">{{trans('interface.ano')}}</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                </div>
                <div class="intervalo pull-left">A</div>
                <div class="mes campo-margin pull-left">
                    <select name="mes_fim">
                        <option value="">{{trans('interface.mes')}}</option>
                        <option value="1">{{trans('interface.janeiro')}}</option>
                        <option value="2">{{trans('interface.fevereiro')}}</option>
                        <option value="3">{{trans('interface.marco')}}</option>
                        <option value="4">{{trans('interface.abril')}}</option>
                        <option value="5">{{trans('interface.maio')}}</option>
                        <option value="6">{{trans('interface.junho')}}</option>
                        <option value="7">{{trans('interface.julho')}}</option>
                        <option value="8">{{trans('interface.agosto')}}</option>
                        <option value="9">{{trans('interface.setembro')}}</option>
                        <option value="10">{{trans('interface.outubro')}}</option>
                        <option value="11">{{trans('interface.novembro')}}</option>
                        <option value="12">{{trans('interface.dezembro')}}</option>
                    </select>
                </div>
                <div class="ano pull-left">
                    <select name="ano_fim">
                        <option value="">{{trans('interface.ano')}}</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                </div>
            </div>
            {{--<div class="line">--}}
                {{--<label><input type="radio"> Data da reunião</label>--}}
                {{--<label><input type="radio"> Data da execução</label>--}}
            {{--</div>--}}
            <div class="line">
                <select name="editoria">
                    <option value="">{{trans('interface.todas_as_editorias')}}</option>
                    @foreach($editorias as $editoria)

                        <option value="{{ $editoria->id }}">{{ $editoria->name }}</option>

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