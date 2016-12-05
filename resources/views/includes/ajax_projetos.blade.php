@foreach($resultados as $resultado)
    <div class="itens">
        <div class="item">
            <a href="" data-route="/projetos-detalhe/{{ $resultado->id }}">
                <h2 class="title-projeto">{{ $resultado->title }}</h2>
                <p class="description">{!!  str_limit($resultado->summary, $limit = 200, $end = '...') !!}</p>

                <div class="dados-gerais">
                    <ul class="projeto-info">
                        <li class="">
                            <span class="name">Número do Projeto</span>
                            <span class="number">{{ $resultado->number }}</span>
                        </li>

                        <li class="">
                            <span class="name">Situação</span>
                            <span class="number">{{ $resultado->project_situation->name }}</span>
                        </li>

                        <li class="">
                            <span class="name">Proponente</span>
                            <span class="number">
                                @foreach($resultado->project_partner as $pp)
                                    @if( $pp->pivot->type == Config::get('constants.PARTNERS_TYPE_PROPONENTE'))
                                        {{ $pp->acronym }} - {{ $pp->name }}
                                    @endif
                                @endforeach
                            </span>
                        </li>
                    </ul>
                </div>
            </a>
        </div>
    </div>
@endforeach