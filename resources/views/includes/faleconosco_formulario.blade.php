<article class="beh-post ">
    <h1 class="title-page">{{ucfirst(trans('interface.fale_conosco'))}}</h1>
    <p>O IBA é conduzido pelos princípios das melhores práticas de governança, com uma estrutura composta pela assembleia, conselho gestor, conselho fiscal, diretoria executiva, auditoria interna e auditoria externa.</p>

    <section class="beh-formulariocontato">
        <form action="faleconosco-envia" method="post" id="form">
            <div class="col-md-6 col-xs-12 padding-right">
                <div class="line">
                    <input type="text" name="seu_nome" id="nome" placeholder="{{trans('interface.seu_nome')}}">
                </div>
                <div class="line">
                    <input type="email" name="seu_email" id="email" placeholder="{{trans('interface.seu_email')}}">
                </div>
                <select name="assunto" id="assunto">
                    <option value="">{{trans('interface.escolha_um_assunto')}}</option>
                    <option value="duvida">{{trans('interface.duvida')}}</option>
                    <option value="elogio">{{trans('interface.elogio')}}</option>
                    <option value="reclamacao">{{trans('interface.reclamacao')}}</option>
                </select>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="line">
                    <textarea name="mensagem" id="mensagem" class="form-textarea" placeholder="{{trans('interface.digite_aqui_sua_mensagem')}}"></textarea>
                </div>
                <div class="line">
                    <button type="submit" id="enviar_faleconosco">{{trans('interface.enviar')}}</button>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </section>


</article>

{{--<div id="lightbox">--}}
    {{--<p>Click to close</p>--}}
    {{--<div id="content">--}}
        {{--<img src='/images/gif-loading.gif' />--}}
    {{--</div>--}}
{{--</div>--}}

{{--<script type="text/javascript">--}}
    {{--function ShowLoading(e) {--}}
        {{--var div = document.createElement('div');--}}
        {{--var img = document.createElement('img');--}}
        {{--img.src = '/images/gif-loading.gif';--}}
        {{--div.innerHTML = "Loading...<br />";--}}
        {{--div.style.cssText = 'float: left; margin: 150px 0 0 47%; z-index: 5000; width: 6%;';--}}
        {{--div.appendChild(img);--}}
        {{--document.body.appendChild(div);--}}
        {{--return true;--}}
        {{--// These 2 lines cancel form submission, so only use if needed.--}}
        {{--window.event.cancelBubble = true;--}}
        {{--e.stopPropagation();--}}
    {{--}--}}
{{--</script>--}}