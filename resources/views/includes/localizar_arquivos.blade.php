<section class="beh-projetoslocalizar">
    <h2 class="subtitle-area">{{trans('interface.localizar_arquivos')}}</h2>
    <div class="filtros">
        <form action="/{{ App::getLocale()  }}/biblioteca-busca" method="post">
            <div class="line">
                <input type="text" name="termo" placeholder="{{ucfirst(trans('interface.palavra'))}}">
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
                        @for($year=2010; $year < \Carbon\Carbon::now('Y')->toDateString()+4; $year++)
                            <option value="{{$year}}" @if (Request::get('ano_inicio')==$year) selected @endif>{{$year}}</option>
                        @endfor
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
                        @for($year=2010; $year < \Carbon\Carbon::now('Y')->toDateString()+4; $year++)
                            <option value="{{$year}}" @if (Request::get('ano_inicio')==$year) selected @endif>{{$year}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="line">
                <select name="linha" id="linha">
                    <option value="">{{ucfirst(trans('interface.todos_os_tipos'))}}</option>
                    @foreach($linhas as $linha)

                        <option value="{{ $linha->id }}">{{ $linha->title }}</option>

                    @endforeach
                </select>
            </div>
            <div class="line"><!-- Preenchidos via AJAX -->
                <select name="tema" id="tema" disabled>
                    <option value="">{{ucfirst(trans('interface.todas_as_categorias'))}}</option>
                </select>
            </div>
            <div class="line"><!-- Preenchidos via AJAX -->
                <select name="subtema" id="subtema" disabled>
                    <option value="">{{ucfirst(trans('interface.todas_as_subcategorias'))}}</option>
                </select>
            </div>
            <div class="line">
                <button type="submit">{{trans('interface.localizar')}}</button>
            </div>

            {!! csrf_field() !!}
        </form>
    </div>
</section>