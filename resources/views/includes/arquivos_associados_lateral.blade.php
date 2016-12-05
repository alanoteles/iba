<section class="beh-destaquesbiblioteca padding-bottom-xs">
    <h2 class="subtitle-area"><span class="hidden-xs">{{trans('interface.arquivos')}} </span>{{trans('interface.associados')}} <a href="" data-route="/biblioteca" class="btn-mais pull-right"><span class="glyphicon glyphicon-plus-sign glyphicon-align-left "></span>{{trans('interface.mais')}}</a></h2>
    <div class="itens">
        @foreach($arquivos_relacionados as $destaque)
            <div class="item">
                @foreach($destaque->attachment as $a)
                    <a href="" data-route="/biblioteca-detalhe/{{ $a->id }}">
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
                            <span class="autor">{{ $destaque->thread->title }}</span>
                            <span class="autor">{{ $destaque->topic->title }}</span>
                            {{--<span class="autor">{{ $destaque->subtopic->title }}</span>--}}
                        </div>
                        <p class="description">{{ $destaque->title }}</p>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
</section>