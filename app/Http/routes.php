<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});



//Route::get('licencas', 'LicenseController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('licencas', 'LicenseController@index');
    Route::get('projects', 'ProjectController@index');

    Route::get('/',                             ['as' => 'home',                        'uses' => 'IndexController@index']);
    Route::any('busca/{termo}',                    'IndexController@busca');

    //Route::get('/secao/{nomeDaSecao}',      'SecaoController@index');
    Route::get('/secao/{id}',           ['as' => 'secao', 'uses' => 'SecaoController@index']);

    Route::any('projetos',                      ['as' => 'projetos',                    'uses' => 'ProjetosController@index']);
    Route::get('projetos-detalhe/{id}',         ['as' => 'projetos-detalhe',            'uses' => 'ProjetosController@detalhe']);
    Route::any('projetos-busca',                ['as' => 'projetos-busca',              'uses' => 'ProjetosController@busca']);
    Route::get('projetos-numeros',              ['as' => 'projetos-busca',              'uses' => 'ProjetosController@numeros']);
    Route::get('projetos-situacao-atividade',   ['as' => 'projetos-situacao-atividade', 'uses' => 'ProjetosController@projetosSituacaoAtividade']);
    Route::get('projetos-associada-situacao',   ['as' =>'projetos-associada-situacao',  'uses' => 'ProjetosController@projetosAssociadaSituacao']);

    Route::any('noticias-busca',                ['as' => 'noticias-busca',              'uses' => 'NoticiasController@busca']);
    Route::any('noticias',                      ['as' => 'noticias',                    'uses' => 'NoticiasController@index']);
    Route::get('noticias-detalhe/{id}',         ['as' => 'noticias-detalhe',            'uses' => 'NoticiasController@detalhe']);

    Route::any('biblioteca-busca',              ['as' => 'biblioteca-busca',            'uses' => 'BibliotecaController@busca']);
    Route::any('biblioteca',                    ['as' => 'biblioteca',                  'uses' => 'BibliotecaController@index']);
    Route::get('biblioteca-detalhe/{id}',       ['as' => 'biblioteca-detalhe',          'uses' => 'BibliotecaController@detalhe']);

    Route::get('download/{filename}/{originalName}', ['as' => 'download',               'uses' =>'BibliotecaController@download']);

    Route::post('linhas-busca',                 ['as' => 'linhas-busca',                'uses' => 'BibliotecaController@linhas_busca']);
    Route::post('temas-busca',                  ['as' => 'temas-busca',                 'uses' => 'BibliotecaController@temas_busca']);

    Route::get('/associadas',                   ['as' => 'associadas',                  'uses' => 'AssociadasController@index']);
    Route::get('/associadas-detalhe/{id}',      ['as' => 'associadas-detalhe',          'uses' => 'AssociadasController@detalhe']);

    Route::get('/faleconosco',                  ['as' => 'faleconosco',                 'uses' => 'FaleConoscoController@index']);
    Route::post('faleconosco-envia',            ['as' => 'faleconosco-envia',           'uses' =>'FaleConoscoController@envia']);





    Route::get('city/{cityId}', function($cityId){

       $city = City::findOrFail($cityId);

        dd($city);
        return View::make('city_user')->with('city', $city);
    });

    Route::get('produtos','ProdutosController@index');
    Route::get('produtos/create','ProdutosController@create');
    Route::post('produtos/store','ProdutosController@store');
    Route::get('produtos/{id}/destroy','ProdutosController@destroy');
    Route::get('produtos/{id}/edit','ProdutosController@edit');
    Route::put('produtos/{id}/update','ProdutosController@update');



});

/**
 * Rotas do Módulo de Administração do Portal
 */

Route::group(['namespace' => 'Admin','prefix' => 'admin', 'middleware'=>['web', 'admin']], function () {

    // Login
    Route::get('/login', 'UsuariosController@showLogin');
    Route::post('/login', 'UsuariosController@doLogin');
    Route::get('/logout', 'UsuariosController@doLogout');
    //Route::get('/admin/logout', 'Auth\AuthController@logout');

    //Página Inicial
    Route::get('/', 'IndexController@index');

    //Projetos
//    Route::get('/projetos-em-numeros', 'ProjetosController@projetosEmNumeros');
//    Route::get('/projetos-destaques', 'ProjetosController@projetosDestaques');

    Route::get('/projetos/retorna-traducao','ProjetosController@retorna_traducao');
    Route::get('/projetos/pesquisa','ProjetosController@pesquisa');
    Route::get('/projetos/destaques','ProjetosController@destaques');
    Route::post('/projetos/destaques/salvar','ProjetosController@salva_destaques');
    Route::resource('/projetos', 'ProjetosController'); //Usando os verbos REST

    Route::get('/secoes/retorna-traducao','SecoesController@retorna_traducao');
    Route::get('/secoes/pesquisa','SecoesController@pesquisa');
    Route::resource('/secoes', 'SecoesController'); //Usando os verbos REST

    Route::get('/noticias/retorna-traducao','NoticiasController@retorna_traducao');
    Route::get('/noticias/pesquisa','NoticiasController@pesquisa');
    Route::get('/noticias/destaques','NoticiasController@destaques');
    Route::post('/noticias/destaques/salvar','NoticiasController@salva_destaques');
    Route::resource('/noticias', 'NoticiasController'); //Usando os verbos REST
    //Objeto
    Route::get('/objetos/retorna-traducao','ObjetosController@retorna_traducao');
    Route::post('/objetos/uploadAnexo','ObjetosController@uploadAnexo');
    Route::get('/objetos/pesquisa','ObjetosController@pesquisa');
    Route::resource('/objetos', 'ObjetosController'); //Usando os verbos REST

    Route::get('/parceiros/retorna-traducao','ParceirosController@retorna_traducao');
    Route::get('/parceiros/pesquisa','ParceirosController@pesquisa');
    Route::resource('/parceiros', 'ParceirosController'); //Usando os verbos REST

    Route::get('/banners/retorna-traducao','BannersController@retorna_traducao');
    Route::get('/banners/destaques','BannersController@destaques');
    Route::post('/banners/destaques/salvar','BannersController@salva_destaques');
    Route::get('/banners/pesquisa','BannersController@pesquisa');
    Route::resource('/banners', 'BannersController'); //Usando os verbos REST

    Route::get('/usuarios/nova_senha','UsuariosController@nova_senha');
    Route::get('/usuarios/busca_cep','UsuariosController@busca_cep');
    Route::get('/usuarios/pesquisa','UsuariosController@pesquisa');
    Route::resource('/usuarios', 'UsuariosController'); //Usando os verbos REST

    //--Tabelas de Apoio--//
    //Index
    Route::get('/tabelas-de-apoio','TabelasDeApoioController@index');

    //Idioma
    Route::get('/tabelas-de-apoio/idioma/pesquisa','ApoioIdiomaController@pesquisa');
    Route::resource('/tabelas-de-apoio/idioma', 'ApoioIdiomaController'); //Usando os verbos REST

    //Escolaridade
    Route::get('/tabelas-de-apoio/escolaridade/retorna-traducao','ApoioEscolaridadeController@retorna_traducao');
    Route::get('/tabelas-de-apoio/escolaridade/ordenacao','ApoioEscolaridadeController@ordenacao');
    Route::get('/tabelas-de-apoio/escolaridade/pesquisa','ApoioEscolaridadeController@pesquisa');
    Route::resource('/tabelas-de-apoio/escolaridade', 'ApoioEscolaridadeController'); //Usando os verbos REST

    //Modalidade de Projeto
    Route::get('/tabelas-de-apoio/modalidade-de-projeto/retorna-traducao','ApoioModalidadeDeProjetoController@retorna_traducao');
    Route::get('/tabelas-de-apoio/modalidade-de-projeto/pesquisa','ApoioModalidadeDeProjetoController@pesquisa');
    Route::resource('/tabelas-de-apoio/modalidade-de-projeto', 'ApoioModalidadeDeProjetoController'); //Usando os verbos REST

    //Atividade de Projeto
    Route::get('/tabelas-de-apoio/atividade-de-projeto/retorna-traducao','ApoioAtividadeDeProjetoController@retorna_traducao');
    Route::get('/tabelas-de-apoio/atividade-de-projeto/pesquisa','ApoioAtividadeDeProjetoController@pesquisa');
    Route::resource('/tabelas-de-apoio/atividade-de-projeto', 'ApoioAtividadeDeProjetoController'); //Usando os verbos REST

    //Situação do Projeto
    Route::get('/tabelas-de-apoio/situacao-do-projeto/retorna-traducao','ApoioSituacaoDoProjetoController@retorna_traducao');
    Route::get('/tabelas-de-apoio/situacao-do-projeto/pesquisa','ApoioSituacaoDoProjetoController@pesquisa');
    Route::resource('/tabelas-de-apoio/situacao-do-projeto', 'ApoioSituacaoDoProjetoController'); //Usando os verbos REST

    //Editoria da Notícia
    Route::get('/tabelas-de-apoio/editoria-da-noticia/retorna-traducao','ApoioEditoriaDaNoticiaController@retorna_traducao');
    Route::get('/tabelas-de-apoio/editoria-da-noticia/pesquisa','ApoioEditoriaDaNoticiaController@pesquisa');
    Route::resource('/tabelas-de-apoio/editoria-da-noticia', 'ApoioEditoriaDaNoticiaController'); //Usando os verbos REST

    //Editoria da Notícia
//    Route::get('/tabelas-de-apoio/editoria-da-noticia/pesquisa','ApoioEditoriaDaNoticiaController@pesquisa');
//    Route::resource('/tabelas-de-apoio/editoria-da-noticia', 'ApoioEditoriaDaNoticiaController'); //Usando os verbos REST

    //Grupo de Parceiros
    Route::get('/tabelas-de-apoio/grupo-de-parceiros/pesquisa','ApoioGrupoDeParceirosController@pesquisa');
    Route::resource('/tabelas-de-apoio/grupo-de-parceiros', 'ApoioGrupoDeParceirosController'); //Usando os verbos REST

    //Tipo de Material
    Route::get('/tabelas-de-apoio/tipo-de-material/retorna-traducao','ApoioTipoDeMaterialController@retorna_traducao');
    Route::get('/tabelas-de-apoio/tipo-de-material/pesquisa','ApoioTipoDeMaterialController@pesquisa');
    Route::resource('/tabelas-de-apoio/tipo-de-material', 'ApoioTipoDeMaterialController'); //Usando os verbos REST

    //Tipo de Mídia
    Route::get('/tabelas-de-apoio/tipo-de-midia/retorna-traducao','ApoioTipoDeMidiaController@retorna_traducao');
    Route::get('/tabelas-de-apoio/tipo-de-midia/pesquisa','ApoioTipoDeMidiaController@pesquisa');
    Route::resource('/tabelas-de-apoio/tipo-de-midia', 'ApoioTipoDeMidiaController'); //Usando os verbos REST

    //Licenças
    Route::get('/tabelas-de-apoio/licenca/retorna-traducao','ApoioLicencaController@retorna_traducao');
    Route::get('/tabelas-de-apoio/licenca/pesquisa','ApoioLicencaController@pesquisa');
    Route::resource('/tabelas-de-apoio/licenca', 'ApoioLicencaController'); //Usando os verbos REST

    //Tags
    Route::get('/tabelas-de-apoio/tag/retorna-traducao','ApoioTagController@retorna_traducao');
    Route::get('/tabelas-de-apoio/tag/pesquisa','ApoioTagController@pesquisa');
    Route::resource('/tabelas-de-apoio/tag', 'ApoioTagController'); //Usando os verbos REST

    //Redes Sociais
    Route::get('/tabelas-de-apoio/rede-social/retorna-traducao','ApoioRedeSocialController@retorna_traducao');
    Route::get('/tabelas-de-apoio/rede-social/pesquisa','ApoioRedeSocialController@pesquisa');
    Route::resource('/tabelas-de-apoio/rede-social', 'ApoioRedeSocialController'); //Usando os verbos REST

    //Níveis
    Route::any('/tabelas-de-apoio/nivel/apaga-niveis','ApoioNivelController@apaga_niveis');
    Route::any('/tabelas-de-apoio/nivel/adiciona-niveis','ApoioNivelController@adiciona_niveis');
    Route::get('/tabelas-de-apoio/nivel/retorna-traducao','ApoioNivelController@retorna_traducao');
    Route::get('/tabelas-de-apoio/nivel/retorna-traducao-nivel','ApoioNivelController@retorna_traducao_nivel');
    Route::resource('/tabelas-de-apoio/nivel', 'ApoioNivelController'); //Usando os verbos REST



});
