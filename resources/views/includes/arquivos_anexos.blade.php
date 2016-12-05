@if(count($objetos) > 0)
    <section class="beh-arquivosanexos">
        <h2 class="subtitle-area">{{trans('interface.arquivos_anexos')}}</h2>
        <div class="itens">

            @foreach($objetos as $objeto)
                <div class="item">
                    @foreach($objeto->attachment as $a)
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
                                    <span class="data">{{ $objeto->created_at->format('d.m.Y') }} </span>
                                    <span class="horario">{{ $objeto->created_at->format('H\hi') }}</span>
                                    <span class="autor">{{ $objeto->thread->title }}</span>
                                    <span class="outro">{{ $objeto->topic->title }} </span>
                                </div>
                                <p class="description">{{ $objeto->title }}</p>
                                {{--<p class="description">{!!  $objeto->preamble !!}</p>--}}
                            </div>
                        </a>
                </div>
            @endforeach

        </div>
    </section>
@endif