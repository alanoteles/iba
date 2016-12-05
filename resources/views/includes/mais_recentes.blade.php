<section class="beh-maisrecentes">
    <h2 class="subtitle-area">{{trans('interface.mais_recentes')}}</h2>
    <div class="itens" id="recentes">
        @foreach($mais_recentes as $key => $recente)
            <div class="item" >
                <a href="javascript:void(0);" data-route="/biblioteca-detalhe/{{ $recente->id }}">
                @foreach($recente->attachment as $a)
                        <figure>
                            @if( substr($a->filename,-3) == 'pdf')
                                <img src="{{ asset('images/icon-pdf.png') }}">
                            @elseif( substr($a->filename,-3) == 'doc' || substr($a->filename,-3) == 'docx')
                                <img src="{{ asset('images/icon-doc.png') }}">
                            @endif
                        </figure>
                        @endforeach
                    <div class="info">
                        <div class="entry-meta">
                            {{--<span class="data">29.11.2011 </span>--}}
                            {{--<span class="horario">14h34</span>--}}
                            <div>
                                <span class="autor pull-left">{{ $recente->thread->title }}</span>
                                <span class="outro">{{ $recente->topic->title }} </span>
                                <span class="outro">{{ $recente->subtopic->title }} </span>
                            </div>
                        </div>
                        <p class="description">{{ $recente->title }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if ($itens_por_pagina < $mais_recentes->total())
        <div class="btn-moreresults">
            <button type="submit" data-situation-id="recentes" data-proxima-pagina="{{ $mais_recentes->nextPageUrl() }}">{{ucfirst(trans('interface.exibir_mais_resultados'))}}</button>
        </div>
    @endif
</section>