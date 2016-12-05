<div class="content-color">
    @if(count($noticias_relacionadas) > 0)
        <section class="beh-areasrelacionadas ">
            <div class="container">
                <div class="col-md-12">
                    <h2 class="subtitle-area">{{trans('interface.noticias_relacionadas')}}
                        <a href="#" data-route="/noticias" class="btn-mais pull-right">
                            <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}
                        </a>
                    </h2>
                </div>
                <div class="itens-noticias">
                    @foreach($noticias_relacionadas as $nr)
                        <div class="item
                         @if(count($noticias_relacionadas) == 1)
                        {{'col-md-8'}}
                        @else
                        {{'col-md-4'}}
                        @endif
                                pull-left">
                            <a href="" data-route="/noticias-detalhe/{{ $nr->id }}">
                                <figure>
                                    @if(!empty($nr->images->image))
                                        <img src="{{ url('/') .'/uploads/noticias/' . $nr->images->image }}">
                                        <!--style="min-width: 165px;">-->
                                    @else
                                        <img src="{{ url('/') .'/uploads/noticias/img-ultimasnoticias-fake.png' }}">
                                    @endif
                                </figure>
                                <div class="info">
                                    <div class="entry-meta">
                                        <span class="data">{{ date('d.m.Y',strtotime($nr->date)) }}</span>
                                        <span class="horario">{{ $nr->created_at->format('H\hi') }}</span>
                                        <span class="autor">{{ $nr->news_editorial->name }}</span>
                                    </div>
                                    <p class="description">{!!  Iba\Helpers\Helper::tokenTruncate($nr->title, 75) !!}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    @if(count($arquivos_relacionados ) > 0)
        <section class="beh-areasrelacionadas ">
            <div class="container">
                <div class="col-md-12">
                    <h2 class="subtitle-area">{{trans('interface.arquivos_relacionados')}}
                        <a href="#" data-route="/biblioteca" class="btn-mais pull-right">
                            <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}
                        </a>
                    </h2>
                </div>
                <div class="itens-arquivos col-md-12">

                    @foreach($arquivos_relacionados as $ar)
                        <div class="item col-md-4 pull-left">
                            @foreach($ar->attachment as $a)
                                {{-- Não apagar a sintaxe abaixo, set variável no blade --}}
                                {{--*/ $extension = explode('.',$a->filename) /*--}}
                                <a href=""
                                   data-route="/{{ 'download/' . $a->id.'_'.app()->getLocale().'.'.$extension[count($extension)-1] .'/'. $a->filename }}"
                                   target="_blank">
                                    <figure>
                                        @if( substr($a->filename,-3) == 'pdf')
                                            <img src="{{ asset('images/icon-pdf.png') }}">
                                        @elseif( substr($a->filename,-3) == 'doc' || substr($a->filename,-4) == 'docx')
                                            <img src="{{ asset('images/icon-doc.png') }}">
                                        @elseif( substr($a->filename,-3) == 'xls' || substr($a->filename,-4) == 'xlsx')
                                            <img src="{{ asset('images/icon-xls.png') }}">
                                        @elseif( substr($a->filename,-3) == 'ppt' || substr($a->filename,-4) == 'pptx')
                                            <img src="{{ asset('images/icon-ppt.png') }}">
                                        @elseif( substr($a->filename,-3) == 'zip' || substr($a->filename,-3) == 'tgz')
                                            <img src="{{ asset('images/icon-zip.png') }}">
                                        @elseif( substr($a->filename,-3) == 'mp3')
                                            <img src="{{ asset('images/icon-mp3.png') }}">
                                        @endif
                                    </figure>
                                    @endforeach

                                    <div class="info">
                                        <div class="entry-meta">
                                            <span class="data">{{ $ar->created_at->format('d.m.Y') }} </span>
                                            <span class="horario">{{ $ar->created_at->format('H\hi') }}</span>
                                            <span class="autor">{{ $ar->thread->title }}</span>
                                            <span class="outro">{{ $ar->topic->title }}</span>
                                        </div>
                                        <p class="description">{{ $ar->title }}</p>
                                    </div>
                                </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(count($projetos_relacionados) > 0)
        <section class="beh-areasrelacionadas">
            <div class="container">
                <div class="col-md-12">
                    <h2 class="subtitle-area">{{trans('interface.projetos_relacionados')}}
                        <a href="" data-route="/projetos" class="btn-mais pull-right">
                            <span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>
                            {{trans('interface.mais')}}
                        </a>
                    </h2>
                </div>
                <div class="itens-projetos">

                    @foreach($projetos_relacionados as $pr)
                        <div class="col-md-4">
                            <a href="" data-route="/projetos-detalhe/{{ $pr->id }}" class="item ">
                                <h3 class="subtitle-conteudo">{!!  Iba\Helpers\Helper::tokenTruncate($pr->title, 100) !!}</h3>
                                <p class="description">

                                    {!! Iba\Helpers\Helper::tokenTruncate($pr->summary, 65) !!}

                                </p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>