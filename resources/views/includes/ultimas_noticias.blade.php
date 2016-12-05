<section class="beh-maisrecentes">
    <h2 class="subtitle-area">{{trans('interface.mais_recentes')}}</h2>
    <div class="ultimas">
        <div class="itens" id="ultimas">
            @foreach($ultimas_noticias as $key => $noticia)
                <div class="item ">
                    <a href="" data-route="/noticias-detalhe/{{ $noticia->id }}">
                        {{--<figure><img src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}"></figure>--}}
                        <figure>
                            @if(!empty($noticia->images->image))
                                <img  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}" style="height: 80px;">
                            @else
                                <img  src="{{ url('/') .'/uploads/noticias/img-ultimasnoticias-fake.png' }}">
                            @endif
                        </figure>
                        <div class="info">
                            <div class="entry-meta">
                                <div>
                                    <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>
                                    <span class="outro">{{ $noticia->news_editorial->name }}</span>
                                </div>
                            </div>
                            <p class="description">{!!  $noticia->title !!}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if ($itens_por_pagina < $ultimas_noticias->total())
            <div class="btn-moreresults">
                <button type="submit" data-situation-id="ultimas" data-proxima-pagina="{{ $ultimas_noticias->nextPageUrl() }}">{{trans('interface.exibir_mais_resultados')}}</button>
            </div>
        @endif
    </div>
</section>