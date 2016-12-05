jQuery(document).ready(function(){


  // Valida formulário
    jQuery(".salvar").on('click', function() {


        var mensagem = "";

        if (jQuery("#title").val() == "") {
            mensagem += "<div> - Título;</div>";
            mensagem = mensagem.replace(" *", "");
            mensagem = mensagem.replace("*", "");
        }


        if (jQuery("#url").val() == "") {
          mensagem += "<div> - URL;</div>";
          mensagem = mensagem.replace(" *", "");
          mensagem = mensagem.replace("*", "");
        }


        if (jQuery("#image_alt").val() == "") {
          mensagem += "<div> - Texto alternativo da imagem;</div>";
          mensagem = mensagem.replace(" *", "");
          mensagem = mensagem.replace("*", "");
        }

        if(mensagem){

            bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});
            $(".bootbox .modal-footer .btn-primary").html("Fechar");
            return false;
        }else{
            $(this).submit();
        }
  })



  jQuery(".abrir-boxfile").click(function(){
    jQuery(this).parent().children("input").click();
  })

  jQuery(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    jQuery(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })



})

