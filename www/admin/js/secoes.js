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

    
    ///* INICIO - CKFINDER */
  //var editor = CKEDITOR.replace('content_data');
  //
  //CKFinder.SetupCKEditor(editor, baseUrl + 'js/library/ckeditor/ckfinder/');
  ///* FIM - CKFINDER */

});  
