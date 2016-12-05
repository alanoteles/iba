<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('interface.inicio'), route('home'));
});

// Home > Projetos
Breadcrumbs::register('projetos', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.projetos'), route('projetos'));
});

// Home > Projetos > Nome do projeto
Breadcrumbs::register('projetos-detalhe', function($breadcrumbs, $dados)
{
    $breadcrumbs->parent('projetos');
    $breadcrumbs->push($dados->title, route('projetos-detalhe', $dados->id));
});

// Home > Projetos > Nome do projeto
Breadcrumbs::register('projetos-busca', function($breadcrumbs)
{
    $breadcrumbs->parent('projetos');
    $breadcrumbs->push(trans('interface.resultado_da_busca'), route('projetos-busca'));
});


// Home > Notícias
Breadcrumbs::register('noticias', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.noticias'), route('noticias'));
});


// Home > Notícias > Título da notícia
Breadcrumbs::register('noticias-detalhe', function($breadcrumbs, $noticia)
{
    $breadcrumbs->parent('noticias');
    $breadcrumbs->push($noticia->title, route('noticias-detalhe', $noticia->id));
});


// Home > Notícias > Resultado da busca
Breadcrumbs::register('noticias-busca', function($breadcrumbs)
{
    $breadcrumbs->parent('noticias');
    $breadcrumbs->push(trans('interface.resultado_da_busca'), route('noticias'));
});


// Home > Biblioteca
Breadcrumbs::register('biblioteca', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.biblioteca'), route('biblioteca'));
});


// Home > Biblioteca > Nome do objeto
Breadcrumbs::register('biblioteca-detalhe', function($breadcrumbs, $objeto)
{
    $breadcrumbs->parent('biblioteca');
    $breadcrumbs->push($objeto->title, route('biblioteca-detalhe', $objeto->id));
});


// Home > Notícias > Resultado da busca
Breadcrumbs::register('biblioteca-busca', function($breadcrumbs)
{
    $breadcrumbs->parent('biblioteca');
    $breadcrumbs->push(trans('interface.resultado_da_busca'), route('biblioteca'));
});


// Home > Associadas
Breadcrumbs::register('associadas', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.associadas'), route('associadas'));
});

// Home > Associadas > Título da associada
Breadcrumbs::register('associadas-detalhe', function($breadcrumbs, $associada)
{
    $breadcrumbs->parent('associadas');
    $breadcrumbs->push($associada->name, route('associadas-detalhe', $associada->id));
});


// Home > Seções
Breadcrumbs::register('secao', function($breadcrumbs, $dados)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($dados->title, route('secao', $dados->id));
});

// Home > Fale conosco
Breadcrumbs::register('faleconosco', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.fale_conosco'), route('faleconosco'));
});
Breadcrumbs::register('faleconosco-envia', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('interface.fale_conosco'), route('faleconosco-envia'));
});