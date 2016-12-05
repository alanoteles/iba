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

    var idFrom = $(this).attr("id");

    var mensagem = "";

    $('#'+idFrom+' input, #'+idFrom+' select').each(function(index){  
        var elemento = $(this);

        if( elemento.attr('required')=="true" && elemento.val() == "" ){
          mensagem += "<div> - " + elemento.parent().parent().children("label").html() + ";</div>";
        }
        // alert(
        //   ' Name: ' + elemento.attr('name') + 
        //   '\n Type: ' + elemento.attr('type') + 
        //   '\n Value: ' + elemento.val() +
        //   '\n Required: ' + elemento.attr('require')
        // );  
      }
    );

    if(mensagem){
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");
      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
    }

    jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");

    return false;
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
      title: "Nome da área"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#nome").val() );
    $(".ui-widget-overlay").hide();
  });

});  
