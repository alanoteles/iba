@foreach($resultados as $key => $biblioteca)
    <div class="item">
        @foreach($biblioteca->attachment as $a)
            <a href="javascript:void(0);" data-route="/biblioteca-detalhe/{{ $biblioteca->id }}">
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
                    <div>
                        <span class="autor pull-left">{{ $biblioteca->thread->title }}</span>
                        <span class="outro">{{ $biblioteca->topic->title }} </span>
                        <span class="outro">{{ $biblioteca->subtopic->title }} </span>
                    </div>
                </div>
                <p class="description">{{ $biblioteca->title }}</p>
            </div>
        </a>
    </div>
@endforeach