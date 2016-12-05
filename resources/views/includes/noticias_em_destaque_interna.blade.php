<section class="beh-destaquesnoticias container-fluid">
    <h2 class="subtitle-area">{{trans('interface.noticias_em_destaque')}}</h2>
    @foreach($noticias as $key => $noticia)

        @if($noticia->position == 'p1' || $noticia->position == 'p2')
            <div class="noticia noticia-grande col-md-6 col-sm-12 col-xs-12 padding-<?php echo $key ? 'left' : 'right' ;?>">
                <a href="" data-route="/noticias-detalhe/{{ $noticia->id }}">
                    {{--<figure><img src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}"></figure>--}}
                    <figure>
                        @if(!empty($noticia->images->image))
                            <img  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}">
                        @else
                            <img  src="{{ url('/') .'/uploads/noticias/img-fake-noticia.png' }}">
                        @endif
                    </figure>
                    <div class="info">
                        <div class="entry-meta">
                            <div>
                                <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>
                                <span class="horario">{{ $noticia->created_at->format('H\hi') }}</span>
                            </div>
                            <div class="autor">{{ $noticia->news_editorial->name }}</div>
                        </div>
                        <p class="description">{!!  str_limit($noticia->title, $limit = 80, $end = '...') !!}</p>
                    </div>
                </a>
            </div>
        @endif
    @endforeach


    <div class="outrosdestaques">
        @foreach($noticias as $key => $noticia)
            @if($noticia->position != 'p1' && $noticia->position != 'p2')
                <div class="noticia col-md-6 col-sm-12 col-xs-12 padding-<?php echo ($key % 2 == 0) ? 'right' : 'left' ;?>">
                    <a href="" data-route="/noticias-detalhe/{{ $noticia->id }}">
                        {{--<figure><img src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}"></figure>--}}
                        <figure>
                            @if(!empty($noticia->images->image))
                                <img  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}">
                            @else
                                <img  src="{{ url('/') .'/uploads/noticias/img-fake-noticia.png' }}">
                            @endif
                        </figure>
                        <div class="info">
                            <div class="entry-meta">
                                <div>
                                    <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>
                                    <span class="horario">{{ $noticia->created_at->format('H\hi') }}</span>
                                </div>
                                <div class="autor">{{ $noticia->news_editorial->name }}</div>
                            </div>
                            <p class="description">{!!  str_limit($noticia->title, $limit = 55, $end = '...') !!}</p>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</section>