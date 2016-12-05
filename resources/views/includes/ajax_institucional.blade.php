@foreach($resultados as $key => $i)
    <div class="itens">
        <div class="item">
            <a href="" data-route="/secao/{{ $i->id }}">

                <h2 class="title-projeto">{{ $i->title }}</h2>
                <p class="description">{!!  str_limit($i->content_data, $limit = 200, $end = '...') !!}</p>
                <p>&nbsp;</p>

            </a>
        </div>
    </div>
@endforeach