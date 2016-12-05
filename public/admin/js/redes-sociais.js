jQuery(document).ready(function(){


  // Valida formulário
  //jQuery("form[name='frm']").on('submit', function(){
  $(".salvar").on('click', function(){
    var mensagem = "";

    if( jQuery("#name").val() == "" ){
      mensagem += "<div> - Nome</div>";
    }

    if( jQuery("#url").val() == "" ){
      mensagem += "<div> - URL</div>";
    }

    if( jQuery("#image_alt").val() == "" ){
      mensagem += "<div> - Texto alternativo da imagem</div>";
    }

    if( jQuery("#imagem_icon").val() == "" ){
      mensagem += "<div> - Imagem</div>";
    }

    if(mensagem){
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");
      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }

  })


});  
