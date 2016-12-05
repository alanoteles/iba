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

    bootbox.confirm('Você tem certeza que deseja excluir o item selecionado?', function(result) {
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
  jQuery("form[name='frm']").on('submit', function(e){
    e.preventDefault();
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


    if( jQuery("#titulo").val() == "" ){
      mensagem += "<div> - Título;</div>";
    }

    if( jQuery("#resumo").val() == "" ){
      mensagem += "<div> - Resumo;</div>";
    }

    if( jQuery("#numero").val() == "" ){
      mensagem += "<div> - Número;</div>";
    }

    if( jQuery("#date-reuniao").val() == "" ){
      mensagem += "<div> - Data de reunião;</div>";
    }

    if( jQuery("#modalidade").val() == "" ){
      mensagem += "<div> - Modalidade;</div>";
    }

    if( jQuery("#id-date-range-picker-1").val() == "" ){
      mensagem += "<div> - Período execução;</div>";
    }

    if( jQuery("#situacao").val() == "" ){
      mensagem += "<div> - Situação;</div>";
    }

    if( jQuery("#atividade").val() == "" ){
      mensagem += "<div> - Atividade;</div>";
    }

    if( jQuery(".tagsnew").html() == "" ){
      mensagem += "<div> - Proponente;</div>";
    }    

    if( jQuery(".executornew").html() == "" ){
      mensagem += "<div> - Executor;</div>";
    }    

    if( jQuery("#valor_total").val() == "" ){
      mensagem += "<div> - Valor total do projeto;</div>";
    }

    if( jQuery("#observacao").val() == "" ){
      mensagem += "<div> - Observação;</div>";
    }

    if( jQuery("#ano1").val() == "" ){
      mensagem += "<div> - Ano 1;</div>";
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


  jQuery('.checkbox_sim_nao').click(function(){
    

    if( jQuery('.checkbox_sim_nao .tipo').hasClass('sim') ){
      jQuery('.checkbox_sim_nao .tipo').removeClass('sim');
      jQuery('.checkbox_sim_nao .tipo').addClass('nao');
    }else{
      jQuery('.checkbox_sim_nao .tipo').removeClass('nao');
      jQuery('.checkbox_sim_nao .tipo').addClass('sim');
    }

  });  



  // $('.telefone').mask('9999-9999');


  // $('.cpf').mask('999.999.999-99');
  //$('.numero').mask('999999');
  $("input.numero").bind("keyup blur focus", function(e) {
    e.preventDefault();
    var expre = /[^0-9]/g;
    // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
    if ($(this).val().match(expre))
      $(this).val($(this).val().replace(expre,''));
  });                
      
  // $("input.ddd").bind("keyup blur focus", function(e) {
  //   e.preventDefault();
  //   var expre = /[^0-9]/g;
  //   // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
  //   if ($(this).val().match(expre))
  //     $(this).val($(this).val().replace(expre,''));
  // }); 

  // $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
  //   $(this).prev().focus();
  // });


  $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function(){
    $(this).next().focus();
  });
  $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
  });  
  $("button.applyBtn").html("Aplicar");
  $("button.cancelBtn").html("Canelar");

  $("#addTags").click(function(){
    if ( $("#proponente").val() != '' ) {
      $id = Math.random() * (1000 - 10) + 10;
      $id = Math.floor($id * 10)      
      $(".tagsnew").append( '<span class="tag" id="tagnew'+$id+'">'+ $("#proponente").val() +'<button type="button" class="close" onClick="removeTagNew('+$id+')">×</button></span>' );
      $("#proponente").val('');
      $(".tagsnew").show();
    }  
    return false;
  })

  $("#addExecutor").click(function(){
    if ( $("#executor").val() != '' ) {
      $id = Math.random() * (1000 - 10) + 10;
      $id = Math.floor($id * 10)
      // $id = $id.replace(" ","_");
      // $id = $id.replace(" ","_");
      // $id = $id.replace(" ","_");
      // $id = $id.replace(" ","_");
      // $id = $id.replace(" ","_");
      $(".executornew").append( '<span class="tag" id="executornew'+ $id +'">'+ $("#executor").val() +'<button type="button" class="close" onClick="removeExecutorNew('+ $id +')">×</button></span>' );
      $("#executor").val('');
      $(".executornew").show();
    }  
    return false;
  })


  // Remove item da lista
  $(".add-item-table").click(function(){
    var item = $(this);
    bootbox.confirm('Você tem certeza que deseja adicionar o item selecionado?', function(result) {
      if(result) {
        // item.parent().parent().fadeOut(450);
        // $li = '';
        // $li += '<tr>';
        // $li += '  <td class="col-xs-3">Título 1</td>';
        // $li += '  <td class="col-xs-3">Linha</td>';
        // $li += '  <td class="col-xs-3">Tema</td>';
        // $li += '  <td class="col-xs-2">Sub tema</td>';
        // $li += '  <td class="col-xs-1 align-center">';
        // $li += '    <button type="button" class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button>';
        // $li += '  </td>';
        // $li += '</tr>';

        // $(".produtos-adicionados tbody").append($li );

      }
    });

    $(".bootbox .modal-footer .btn-default").html("Não");
    $(".bootbox .modal-footer .btn-primary").html("sim");

    return false;
  });  

  // Remove item da lista
  $(".remover-item-table").click(function(){
    var item = $(this);
    bootbox.confirm('Você tem certeza que deseja excluir o item selecionado?', function(result) {
      if(result) {
        item.parent().parent().fadeOut(450);
      }
    });

    $(".bootbox .modal-footer .btn-default").html("Cancelar");
    $(".bootbox .modal-footer .btn-primary").html("Concluir");

    return false;
  });

  // Dialog Titulo
  $( "#id-btn-dialog1" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Título"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#titulo").val() );
    $(".ui-widget-overlay").hide();
  });

  // Dialog resumo
  $( "#id-btn-dialog2" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Resumo"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#resumo").val() );
    $(".ui-widget-overlay").hide();
  });


  // Dialog Observacao
  $( "#id-btn-dialog3" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Observação"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#observacao").val() );
    $(".ui-widget-overlay").hide();
  });

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


});  

function removeTagNew(tag){
  $("#tagnew"+tag).fadeOut();
  setTimeout(function(){
    $("#tagnew"+tag).remove();
  },250)
}

function removeExecutorNew(tag){
  $("#executornew"+tag).fadeOut();
  setTimeout(function(){
    $("#executornew"+tag).remove();
  },250)
}