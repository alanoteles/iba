{{--Solicitado por Natália IBA--}}
{{--<section class="beh-projetosnumeros">--}}
    {{--<h2 class="subtitle-area">Projetos em Números <a data-route="/projetos-numeros/" class="btn-mais pull-right"><span--}}
                    {{--class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.more')}}</a></h2>--}}
    {{--<div class="">--}}
        {{--<select id="projetos_atividades_associada" class="projeto_atividade">--}}
            {{--<option value="0">Todas as associadas</option>--}}
            {{--@foreach($associadas as $associada)--}}

                {{--<option value="{{ $associada->id }}">{{ $associada->acronym }}</option>--}}

            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}
    {{--<div class="">--}}
        {{--<select id="projetos_atividades_atividade" class="projeto_atividade">--}}
            {{--<option value="0">Todas as atividades</option>--}}
            {{--@foreach($atividades as $atividade)--}}

                {{--<option value="{{ $atividade->id }}">{{ $atividade->name }}</option>--}}

            {{--@endforeach--}}
        {{--</select>--}}
    {{--</div>--}}

    {{--<div class="graphics">--}}
        {{--<section class="beh-graficodefault">--}}
            {{--<div id="graphic"></div>--}}
            {{--<script type="text/javascript" charset="utf-8">--}}
                {{--$(document).ready(function () {--}}
                    {{--atualizaProjetoAtividade('graphic');--}}

                {{--});--}}

                {{--$(".projeto_atividade").change(function () {--}}
                    {{--atualizaProjetoAtividade('graphic');--}}
                {{--});--}}

            {{--</script>--}}

            {{--<div id="canvas-circle">--}}
                {{--@for($i=0;$i<count($top_activities);$i++)--}}
                    {{--<div class="box-circle">--}}
                        {{--<div class="circle" id="circles-{{$i+1}}"></div>--}}
                        {{--<div class="tooltip">{{$top_activities[$i]['activity']}}</div>--}}
                        {{--<div class="circles-text"></div>--}}
                    {{--</div>--}}
                {{--@endfor--}}
            {{--</div>--}}
        {{--</section>--}}
    {{--</div>--}}
    {{--<script>--}}
         {{--@for($i=0;$i<count($top_activities);$i++)--}}
                    {{--var myCircle = Circles.create({--}}
                        {{--id: 'circles-{{$i+1}}',--}}
                        {{--size: 'md-1',--}}
                        {{--start_angle: 90,--}}
                        {{--value: {{$top_activities[$i]['perc']}},--}}
                        {{--maxValue: 100,--}}
                        {{--text: function (value) {--}}
                            {{--return value + '%';--}}
                        {{--},--}}
                        {{--backgroundColor: '#dbe1e4',--}}
                        {{--duration: 400,--}}
                        {{--wrpClass: 'circles-wrp',--}}
                        {{--textClass: 'circles-text',--}}
                        {{--valueStrokeClass: 'circles-valueStroke',--}}
                        {{--maxValueStrokeClass: 'circles-maxValueStroke',--}}
                        {{--styleWrapper: true,--}}
                        {{--styleText: true,--}}
                        {{--state: '0{{$i+1}}'--}}
                    {{--});--}}
        {{--@endfor--}}

    {{--</script>--}}
{{--</section>--}}
