@if(count($noticias_relacionadas) > 0)
    <section class="beh-areasrelacionadas beh-areasrelacionadas-aside">
        <h2 class="subtitle-area">{{trans('interface.ultimas_noticias')}}
            <a href="" data-route="/noticias" class="btn-mais pull-right">
                <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}
            <a/>
        </h2>
        <div class="itens-noticias">

            @foreach($noticias_relacionadas as $noticia_relacionada)
                <div class="item pull-left">
                    <a href="" data-route="/noticias-detalhe/{{ $noticia_relacionada->id }}">
                        <div class="entry-meta">
                            <div>
                                <span class="data">{{ date('d.m.Y',strtotime($noticia_relacionada->date)) }} </span>
                                <span class="outro">{{ $noticia_relacionada->news_editorial->name }}</span>
                            </div>
                        </div>
                        <p class="description">{!!  str_limit($noticia_relacionada->title, $limit = 80, $end = '...') !!}</p>
                    </a>
                </div>
            @endforeach


        </div>
    </section>
@endif