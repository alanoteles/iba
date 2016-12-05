jQuery(document).ready(function(){


  // Valida formulário
  jQuery("form[name='frm']").on('submit', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";

    // $('#'+idFrom+' input, #'+idFrom+' select, #'+idFrom+' textarea').each(function(index){  
    //     var elemento = $(this);

    //     if( elemento.attr('required')=="true" && elemento.val() == "" ){
    //       mensagem += "<div> - " + elemento.parent().parent().children("label").html() + ";</div>";
    //       mensagem = mensagem.replace(" *","");
    //       mensagem = mensagem.replace("*","");          
    //     }
    //     // alert(
    //     //   ' Name: ' + elemento.attr('name') + 
    //     //   '\n Type: ' + elemento.attr('type') + 
    //     //   '\n Value: ' + elemento.val() +
    //     //   '\n Required: ' + elemento.attr('require')
    //     // );  
    //   }
    // );


    if( jQuery("#name").val() == "" ){
      mensagem += "<div> - Nome;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#partner_group_id").val() == "" ){
      mensagem += "<div> - Grupo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#summary").val() == "" ){
      mensagem += "<div> - Resumo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }



    if(mensagem){

      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }
    
  })

  jQuery(".abrir-boxfile").click(function(){
    jQuery(this).parent().children("input").click();
  })

  jQuery(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    jQuery(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })

});  
