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

    if( jQuery("#titulo-carrossel").val() == "" ){
      mensagem += "<div> - Título</div>";
    }

    if( jQuery("#URL").val() == "" ){
      mensagem += "<div> - URL</div>";
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


  // Valida formulário
  jQuery("form[name='frmPos']").on('submit', function(){

    var mensagem = "";

    if( jQuery("#publicidade").val() == "" ){
      mensagem += "<div> - Publicidade</div>";
    }


    if(mensagem){
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");
      bootbox.alert("<p class='lead blue'>Notificação</p><p>Favor preencher os campos abaixo:</p>"+mensagem, function() {});   
      return false;
    }

  })

  jQuery(".input-file").change(function(){
    var imagem = $(this).val();
    imagem = $(this).val().split("\\");
    $(this).parent().children(".file-label").children(".file-name").attr("data-title",imagem[imagem.length - 1]);
  })

  // Marca item da posicao
  jQuery(".posicoes .item").click(function(){

    var posicao = jQuery(this).attr("rel");

    jQuery(".posicoes .item").removeClass("active");

    jQuery(this).addClass("active");

    jQuery(".posicao-sel p").html("Posicao " + posicao);
    jQuery(".posicao-sel input").val(posicao);
    return false;
  });

  // Select chosen
  $(".chosen-select").chosen(); 
  $('#chosen-multiple-style').on('click', function(e){
    var target = $(e.target).find('input[type=radio]');
    var which = parseInt(target.val());
    if(which == 2) $('.chosen-select').addClass('tag-input-style');
     else $('.chosen-select').removeClass('tag-input-style');
  });


});  
