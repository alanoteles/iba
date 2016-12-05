<section class="beh-noticiasdestaques col-md-8 col-xs-12">
    <h2 class="subtitle-area">{{trans('interface.noticias_em_destaque')}}<a href="noticias.html" class="btn-mais invert pull-right"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}</a></h2>
    <div class="col-md-6 col-xs-12 padding-right">
        @if(!empty($noticias))

            @foreach($noticias as $key => $noticia)

                @if(!empty($noticia->position))

                    @if($noticia->position == 'h1')
                        <div class="noticia noticia-grande">
                            <a href="" data-route="/noticias-detalhe/{{ $noticia->news_id }}">
                                <figure>
                                    @if(!empty($noticia->images->image))
                                        <img style="width: 335px;height: 188px;"  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}">
                                    @else
                                        <img style="width: 335px;height: 188px;"  src="{{ url('/') .'/uploads/noticias/img-fake-noticia.png' }}">
                                    @endif
                                <div class="info">
                                    <div class="entry-meta">
                                        <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>
                                        <span class="horario">{{ $noticia->created_at->format('H\hi') }}</span>
                                        <span class="autor">{{ $noticia->news_editorial->name }}</span>
                                    </div>
                                    <p class="description">{!!  \Iba\Helpers\Helper::tokenTruncate($noticia->title,80)!!}</p>
                                </div>
                            </a>
                        </div>

                    @endif
                @endif
            @endforeach
        @endif
    </div>
    <div class="col-md-6 col-xs-12 padding-left pull-right">
        @if(!empty($noticias))
            @foreach($noticias as $key => $noticia)
                    @if($noticia->position != 'h1')
                        <div class="noticia noticia-comum">
                            <a href="" data-route="/noticias-detalhe/{{ $noticia->id }}">
                                <figure>
                                    @if(!empty($noticia->images->image))
                                        <img  src="{{ url('/') .'/uploads/noticias/' . $noticia->images->image }}">
                                    @else
                                        <img  src="{{ url('/') .'/uploads/noticias/img-fake-noticia-p.png' }}">
                                    @endif
                                </figure>
                                <div class="info">
                                    <div class="entry-meta">
                                        <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }}</span>
                                        <span class="horario">{{ $noticia->created_at->format('H\hi') }}</span>
                                        <span class="autor">{{ $noticia->news_editorial->name }}</span>
                                    </div>
                                    <p class="description">{!!   \Iba\Helpers\Helper::tokenTruncate($noticia->title,55) !!}</p>
                                </div>
                            </a>
                        </div>
                    @endif
            @endforeach
        @endif
    </div>
</section>