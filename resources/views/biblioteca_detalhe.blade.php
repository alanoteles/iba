@extends('master')

@section('breadcrumb')
    {!! Breadcrumbs::render('biblioteca-detalhe', $objeto) !!}
@endsection


@section('content')
    <div class="content">
        <div class="container">

            @include('includes.compartilhar')

            <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                <article class="beh-post">
                    <div class="entry-meta">
                        <div>
                            <span class="data">{{ date('d.m.Y',strtotime($objeto->created_at)) }} </span>
                            <span class="horario">{{ $objeto->created_at->format('H\hi') }}</span>
                        </div>
                        <div>
                            <span class="autor">{{ $objeto->thread->title }}</span>
                            <span class="outro">{{ $objeto->topic->title }}</span>
                        </div>
                    </div>
                    <h1 class="title-arquivo">{{ $objeto->title }}</h1>

                    <p>{!! $objeto->preamble !!}</p>

                </article>

            </div>
            <aside class="col-md-4 col-sm-12 col-xs-12 pull-right">

                <section class="beh-arquivodownload">
                    <strong>{{ucfirst(trans('interface.baixar_o_arquivo'))}}</strong>

                    <span>{{ucfirst(trans('interface.tamanho_do_arquivo'))}}</span>
                    <strong>{{ number_format(($objeto->attachment[0]->size/(1000*1000)),2,',','.') }}Mb</strong>

                    <span>{{ucfirst(trans('interface.formato_do_arquivo'))}}</span>
                    <strong>{{ strtoupper($objeto->attachment[0]->extension) }}</strong>

                    <div class="line">
                        <button type="submit" id="download" data-link="/{{ 'download/' . $objeto->attachment[0]->filename.'/'. $objeto->attachment[0]->originalName}}">CLIQUE AQUI PARA BAIXAR</button>
                    </div>

                </section>
            </aside>
        </div>
    </div>

    @include('includes.conteudo_relacionado')

@endsection

@section('associadas')

    @include('includes.associadas')

@endsection