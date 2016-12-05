<section class="beh-maisrecentes">
    <h2 class="subtitle-area">Resultado da busca</h2>
    <div class="itens" id="ultimas">
        @foreach($biblioteca as $key => $bib)
            <div class="item">
                @foreach($bib->attachment as $a)
                    <a href="" data-route="/biblioteca-detalhe/{{ $bib->id }}">
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
                            {{--<span class="data">29.11.2011 </span>--}}
                            {{--<span class="horario">14h34</span>--}}
                            <div>
                                <span class="autor pull-left">{{ $bib->thread->title }}</span>
                                <span class="outro">{{ $bib->topic->title }} </span>
                                <span class="outro">{{ $bib->subtopic->title }} </span>
                            </div>
                        </div>
                        <p class="description">{{ $bib->title }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if ($itens_por_pagina < $biblioteca->total())
        <div class="btn-moreresults">
            <button type="submit" data-situation-id="ultimas" data-proxima-pagina="{{ $biblioteca->nextPageUrl() }}">Exibir mais resultados</button>
        </div>
    @endif
</section>