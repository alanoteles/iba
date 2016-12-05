@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render('noticias-detalhe', $noticia) !!}
@endsection



@section('content')
    <div class="content">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">

                @include('includes.compartilhar')


                <article class="beh-post">
                    <div class="entry-meta">
                        <div>
                            <span class="data">{{ date('d.m.Y',strtotime($noticia->date)) }} </span>
                            <span class="horario">{{ $noticia->created_at->format('H\hi') }}</span>
                        </div>
                        <div>
                            <span class="autor">{{ $noticia->news_editorial->name }}</span>
                            {{--<span class="outro">OUTRO SUBITEM DO DESTAQUE </span>--}}
                        </div>
                    </div>
                    <h1 class="title-arquivo">{{ $noticia->title }}</h1>

                    <div class="fonte">Fonte: {{ $noticia->source }}</div>

                    <h1 class="title-arquivo"><em>{{ $noticia->featured_title }}</em></h1>

                    <p>{!! $noticia->content_data !!}</p>


                </article>

                @include('includes.arquivos_anexos')
            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                @include('includes.noticias_relacionadas_lateral')

                @include('includes.projetos_em_numeros_lateral')

                {{--@include('includes.banner')--}}
            </aside>
        </div>
    </div>

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection