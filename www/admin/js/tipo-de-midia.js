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

  $('.checkbox_sim_nao').click(function(){
    if( jQuery('.checkbox_sim_nao .tipo').hasClass('sim') ){
      jQuery('.checkbox_sim_nao .tipo').removeClass('sim');
      jQuery('.checkbox_sim_nao .tipo').addClass('nao');
    }else{
      jQuery('.checkbox_sim_nao .tipo').removeClass('nao');
      jQuery('.checkbox_sim_nao .tipo').addClass('sim');
    }
  });  


  // Remove item da lista
  jQuery(".remover-item-lista").click(function(){
    var item = jQuery(this);
    bootbox.confirm('Você tem certeza que deseja excluir?', function(result) {
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

    bootbox.confirm('Você tem certeza que deseja excluir?', function(result) {
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

    if( jQuery("#tipo-de-midia").val() == "" ){
      mensagem += "<div> - Tipo de mídia</div>";
    }

    if( jQuery("#texto-alternativo-icone").val() == "" ){
      mensagem += "<div> - Texto alternativo da imagem</div>";
    }

    if( jQuery("#imagem-icon").val() == "" ){
      mensagem += "<div> - Imagem</div>";
    }

    if( jQuery("#texto-alternativo-capa").val() == "" ){
      mensagem += "<div> - Texto alternativo da imagem</div>";
    }

    if( jQuery("#imagem-capa").val() == "" ){
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


  $("#idioma_trad").change(function(){
    var $this = $(this);

    if( $this.val() == "EN"){
      $("#label_en").removeClass("inactive");
      $("#label_es").addClass("inactive");
    }

    if( $this.val() == "ES"){
      $("#label_en").addClass("inactive");
      $("#label_es").removeClass("inactive");
    }
  })

  $( "#id-btn-dialog1" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Tipo de mídia"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#tipo-de-midia").val() );
    $(".ui-widget-overlay").hide();
  });


  $( "#id-btn-dialog2" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Texto alternativo da imagem"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#texto-alternativo-icone").val() );
    $(".ui-widget-overlay").hide();
  });


  $( "#id-btn-dialog3" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Texto alternativo da imagem"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#texto-alternativo-capa").val() );
    $(".ui-widget-overlay").hide();
  });    

});  
