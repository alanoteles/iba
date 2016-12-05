<!--Pedido do cliente para alterar somente a página-->
@if($pagina=='biblioteca')
    <section class="beh-share">
        <div class="share-button">
            <span class="uppercase">{{trans('interface.compartilhar')}}</span>

            <div class="share-box" >
                <h3 class="uppercase">{{trans('interface.compartilhe')}}</h3>
                <i class="material-icons close-share">close</i>
                <div class="addthis_sharing_toolbox"></div>
            </div>
        </div>

        <div class="print-button" style="margin-right: 35%">
            <span class="uppercase">{{trans('interface.imprimir')}}</span>
        </div>
    </section>
@else
    <section class="beh-share">
        <div class="share-button" >
            <span class="uppercase">{{trans('interface.compartilhar')}}</span>

            <div class="share-box">
                <h3 class="uppercase">{{trans('interface.compartilhe')}}</h3>
                <i class="material-icons close-share">close</i>
                <div class="addthis_sharing_toolbox"></div>
            </div>
        </div>

        <div class="print-button">
            <span class="uppercase">{{trans('interface.imprimir')}}</span>
        </div>
    </section>
@endif