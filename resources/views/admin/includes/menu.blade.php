<!-- BARA DA LATERAL ESQUERDA -->
<div class="sidebar" id="sidebar">

    <!-- Abas superiores -->
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">

        <!-- Icones na aba-->
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <div class="abas abas-active"><i class="icon-site" onclick="window.location.href='#site'"></i></div>
            <!--
            <div class="abas"><i class="icon-loja" onclick="window.location.href='#loja'"></i></div>
            <div class="abas"><i class="icon-banco" onclick="window.location.href='#banco'"></i></div>
             -->
        </div>

        <!-- Icones na aba em mobile-->
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!--/ Abas -->




    <!-- ############### Menu  ############### -->
    <ul class="nav nav-list menu-esquerdo">
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'projetos') ? 'active' : '' }}"><a href="" data-route="/admin/projetos"><i class="icon-dashboard"></i><span class="menu-text">Projetos</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'noticias') ? 'active' : '' }}"><a href="" data-route="/admin/noticias"><i class="icon-dashboard"></i><span class="menu-text">Notícias</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'objetos') ? 'active' : '' }}"><a href="" data-route="/admin/objetos"><i class="icon-dashboard"></i><span class="menu-text">Objetos</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'secoes') ? 'active' : '' }}"><a href="" data-route="/admin/secoes"><i class="icon-dashboard"></i><span class="menu-text">Seções</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'parceiros') ? 'active' : '' }}"><a href="" data-route="/admin/parceiros"><i class="icon-dashboard"></i><span class="menu-text">Parceiros</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'banners') ? 'active' : '' }}"><a href="" data-route="/admin/banners"><i class="icon-dashboard"></i><span class="menu-text">Banners</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'usuarios') ? 'active' : '' }}"><a href="" data-route="/admin/usuarios"><i class="icon-dashboard"></i><span class="menu-text">Usuários</span></a></li>
        <li class="{{ strpos(Route::getCurrentRoute()->getPath(),'tabelas-de-apoio') ? 'active' : '' }}"><a href="" data-route="/admin/tabelas-de-apoio"><i class="icon-dashboard"></i><span class="menu-text">Tabelas de apoio</span></a></li>
        {{--<li class="inactive"><a href=""><i class="icon-dashboard"></i><span class="menu-text">Ajuda e suporte</span></a></li>--}}
    </ul>
    <!-- / ############### Menu  ############### -->

</div>
<!-- / BARA DA LATERAL ESQUERDA -->