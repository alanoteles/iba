$(document).ready(function(){


    $(".salvar").on('click', function(){

    // var idFrom = $(this).attr("id");

        var mensagem = "";


        if( $("#title").val() == "" ){
          mensagem += "<div> - Título;</div>";
        }

        //if( $("#summary").val() == "" ){
        //alert(CKEDITOR.instances.summary.getData());
        if (CKEDITOR.instances.summary.getData() == ""){
                mensagem += "<div> - Resumo;</div>";
        }

        if( $("#number").val() == "" ){
          mensagem += "<div> - Número;</div>";
        }

        if( $("#meeting_date").val() == "" ){
          mensagem += "<div> - Data da reunião;</div>";
        }

        if( $("#project_type_id").val() == "" ){
          mensagem += "<div> - Modalidade;</div>";
        }

        if( $("#periodo_execucao").val() == "" ){
          mensagem += "<div> - Período de execução;</div>";
        }

        if( $("#project_situation_id").val() == "" ){
          mensagem += "<div> - Situação do projeto;</div>";
        }

        if( $("#project_activity_id").val() == "" ){
            mensagem += "<div> - Atividade;</div>";
        }

        if( $("#array_proponentes").val() == "" ){
            mensagem += "<div> - Proponente(s);</div>";
        }

        if( $("#array_executores").val() == "" ){
            mensagem += "<div> - Executor(es);</div>";
        }

        if( $("#valor_total").val() == "" ){
            mensagem += "<div> - <b>Aba Valores</b> : Valor total do projeto;</div>";
        }

        //if( $("#comment").val() == "" ){
        //    mensagem += "<div> - <b>Aba Valores</b> : Observação;</div>";
        //}

        if( $("#ano1").val() == "" ){
            mensagem += "<div> - <b>Aba Valores</b> : Ano 1;</div>";
        }

        if (CKEDITOR.instances.results.getData() == ""){
            mensagem += "<div> - <b>Aba Resultados</b> : Principais resultados esperados;</div>";
        }

        if(mensagem){

          bootbox.alert("<h5>Os campos abaixo são de preenchimento obrigatório:</h5>"+mensagem, function() {});
          $(".bootbox .modal-footer .btn-primary").html("Fechar");
          return false;
        }else{
          //alert('else');return false;
           $(this).submit();
        }

    })





    //---- Trata das interações dox boxes de Proponente e Executor.--------//
    $("#addExecutor").click(function(){
        if ( $("#executores").val() != '' ) {

            id = parseInt($("#executores").find(":selected").val());

            novos_ids = [];
            $('.executor').each(function(){
                novos_ids[novos_ids.length] = parseInt($(this).data('id'));
            })

            //-- Verifica se o ID já existe no array. Não adiciona itens repetidos.
            if($.inArray(id, novos_ids) == -1){

                $(".executornew").append( '<span class="tag executor" data-id="' + id + '" id="executornew'+ id +'">'+ $("#executores").find(":selected").text() +'<button type="button" class="close" onClick="removeExecutorNew('+ id +')">×</button></span>' );
                $("#executores").val('');
                $(".executornew").show();

                novos_ids[novos_ids.length] = id;
                $('#array_executores').val(novos_ids.join(','));
            }
        }
        return false;
    })

    $("#addProponente").click(function(){
        if ( $("#proponentes").val() != '' ) {

            id = parseInt($("#proponentes").find(":selected").val());

            novos_ids = [];
            $('.proponente').each(function(){
                novos_ids[novos_ids.length] = parseInt($(this).data('id'));
            })

            //-- Verifica se o ID já existe no array. Não adiciona itens repetidos.
            if($.inArray(id, novos_ids) == -1) {
                $(".proponentenew").append('<span class="tag proponente" data-id="' + id + '"  id="proponentenew' + id + '">' + $("#proponentes").find(":selected").text() + '<button type="button" class="close" onClick="removeProponenteNew(' + id + ')">×</button></span>');
                $("#proponentes").val('');
                $(".proponentenew").show();

                novos_ids[novos_ids.length] = id;
                $('#array_proponentes').val(novos_ids.join(','));
            }
        }
        return false;
    })



});

