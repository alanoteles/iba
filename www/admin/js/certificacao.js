jQuery(document).ready(function(){

  jQuery('.acao-massa .ace').click(function(){
    
    var checked = jQuery(this).attr('checked');
    
    if( checked == undefined ){
      jQuery(this).attr("checked",true)      
      checked = jQuery(this).attr('checked');
    }else{
      if(checked){
        jQuery(this).attr("checked",false)      
      }else{
        jQuery(this).attr("checked",true)      
      }
      checked = jQuery(this).attr('checked');        
    }
    
    if( checked ){
      //jQuery(".sel .ace").attr('checked',true);
      jQuery(".sel .ace").click();
    }else{
      //jQuery(".sel .ace").attr('checked',false);
      jQuery(".sel .ace").click();
    }  
  });  

  // Remove item da lista
  jQuery(".remover-item-lista").click(function(){
    var item = jQuery(this);
    bootbox.confirm('Você tem certeza que deseja excluir o usuário "Fulano Beltrano"?', function(result) {
      if(result) {
        item.parent().parent().parent().fadeOut(450);
      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");

    return false;
  });

  // Remove item aberto
  jQuery(".remover-item").click(function(){

    bootbox.confirm('Você tem certeza que deseja excluir o usuário "Fulano Beltrano"?', function(result) {
      if(result) {

      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");

    return false;
  });

  // Excluir item em massa
  jQuery(".excluir_massa").click(function(){

    bootbox.confirm("Você tem certeza que deseja excluir os 10 usuários selecionados?", function(result) {
      if(result) {

      }
    });

    jQuery(".bootbox .modal-footer .btn-default").html("Cancelar");
    jQuery(".bootbox .modal-footer .btn-primary").html("Concluir");
    return false;
  }); 

  // Valida formulário
  jQuery("form[name='frm']").on('submit', function(){

    var mensagem = "";

    if( jQuery("#nome").val() == "" ){
      mensagem += "<div> - Nome</div>";
    }

    if( jQuery("#texto-alternativo").val() == "" ){
      mensagem += "<div> - Texto alternativo</div>";
    }

    if( jQuery("#imagem").val() == "" ){
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


  jQuery(".input-file").change(function(){
    var imagem = $(this).val();
    imagem = $(this).val().split("\\");
    $(this).parent().children(".file-label").children(".file-name").attr("data-title",imagem[imagem.length - 1]);
  })

  jQuery(".banco-curriculo-pesquisa #pesquisaAC").click(function(){
    jQuery(".banco-curriculo-pesquisa a").removeClass("active");
    jQuery(".banco-curriculo-pesquisa a").removeClass("inactive");

    jQuery(".banco-curriculo-pesquisa #pesquisaAC").addClass("active");
    jQuery(".banco-curriculo-pesquisa #pesquisaC").addClass("inactive");

    jQuery("#area-pesquisa-c").slideUp(250);
    setTimeout(function(){
      jQuery("#area-pesquisa-ac").slideDown(250);
    },350);
    return false;
  });

  jQuery(".banco-curriculo-pesquisa #pesquisaC").click(function(){
    jQuery(".banco-curriculo-pesquisa a").removeClass("active");
    jQuery(".banco-curriculo-pesquisa a").removeClass("inactive");

    jQuery(".banco-curriculo-pesquisa #pesquisaC").addClass("active");
    jQuery(".banco-curriculo-pesquisa #pesquisaAC").addClass("inactive");

    jQuery("#area-pesquisa-ac").slideUp(250);
    setTimeout(function(){
      jQuery("#area-pesquisa-c").slideDown(250);
    },350);   
    return false;
  }); 

});  
