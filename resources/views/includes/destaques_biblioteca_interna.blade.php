<section class="beh-destaquesbiblioteca painel">
    <h2 class="subtitle-area">{{trans('interface.destaques')}}</h2>
    <div class="itens">
        @foreach($destaques_biblioteca as $destaque)
            <div class="item pull-left">
                <a href="" data-route="/biblioteca-detalhe/{{ $destaque->id }}">
                @foreach($destaque->attachment as $a)
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
                            <span class="data">{{ date('d.m.Y',strtotime($destaque->created_at)) }}</span>
                            {{--<span class="horario">14h34</span>--}}
                            <span class="autor">{{ $destaque->thread->title }}</span>
                            <span class="outro">{{ $destaque->topic->title }}</span>
                            <span class="outro">{{ $destaque->subtopic->title }}</span>
                        </div>
                        <p class="description">{{ \Iba\Helpers\Helper::tokenTruncate($destaque->title,30) }}</p>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
</section>