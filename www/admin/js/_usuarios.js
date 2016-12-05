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
  // Gerar nova senha
  jQuery(".gerar-nova-senha").click(function(){

    bootbox.alert('Uma nova senha foi gerada para o usuário "Fulano Beltrano".', function() {});

    return false;
  });  
  



  // Valida formulário
  jQuery("form[name='frm']").on('submit', function(){
    // var idFrom = $(this).attr("id");

    var mensagem = "";
    var ativo = true;
    if( jQuery("#grupo").val() == "" ){
      mensagem += "<div> - Grupo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#email").val() == "" ){
      mensagem += "<div> - E-mail;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#email_confirm").val() == "" ){
      mensagem += "<div> - Confirmação de E-mail;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#nome_completo").val() == "" ){
      mensagem += "<div> - Nome completo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;
    }else{
      tituloAux = jQuery("#nome_completo").val();
      tituloAux = tituloAux.split(" ");
      //console.log(tituloAux.length);
      if(tituloAux.length < 2){
        mensagem += "- Digite o nome completo.\n"; 
        ativo = false;
      }else if(tituloAux[0] == "" || tituloAux[1] == "" ){
        mensagem += "- Digite o nome completo.\n"; 
        ativo = false;
      }
    }


    if( jQuery("#cpf").val() == "" ){
      mensagem += "<div> - CPF;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");   
      ativo = false;       
    }

    if( jQuery("#idioma").val() == "" ){
      mensagem += "<div> - Idioma;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*",""); 
      ativo = false;         
    }

    if( jQuery("#telefone").val() == "" ){
      mensagem += "<div> - Telefone;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#CEP").val() == "" ){
      mensagem += "<div> - CEP;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*",""); 
      ativo = false;         
    }

    if( jQuery("#pais").val() == "" ){
      mensagem += "<div> - País;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*",""); 
      ativo = false;         
    }

    if( jQuery("#estado").val() == "" ){
      mensagem += "<div> - Estado;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*",""); 
      ativo = false;         
    }

    if( jQuery("#cidade").val() == "" ){
      mensagem += "<div> - Cidade;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#bairro").val() == "" ){
      mensagem += "<div> - Bairro;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#endereco").val() == "" ){
      mensagem += "<div> - Endereço;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#numero").val() == "" ){
      mensagem += "<div> - Número;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#escolaridade").val() == "" ){
      mensagem += "<div> - Nível de escolaridade;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#profissao").val() == "" ){
      mensagem += "<div> - Profissão;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*",""); 
      ativo = false;         
    }

    if( jQuery("#instituicao").val() == "" ){
      mensagem += "<div> - Instituição empregadora;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");  
      ativo = false;        
    }

    if( jQuery("#possui-crmv-sim").is( ':checked' ) ){
      if( jQuery("#num_crmv").val() == "" ){
        mensagem += "<div> - CRMV;</div>";
        mensagem = mensagem.replace(" *","");
        mensagem = mensagem.replace("*",""); 
      ativo = false;         
      }
    }

    // valida os checkbox
    // var areaadmin = false;
    // $('input[name="area-interesse[]"]').each(function(index){  
    //     var elemento = $(this);

    //     if ( elemento.is( ':checked' )){
    //       areaadmin = true;
    //     }

    //     // alert(
    //     //   ' Name: ' + elemento.attr('name') + 
    //     //   '\n Type: ' + elemento.attr('type') + 
    //     //   '\n Value: ' + elemento.val() +
    //     //   '\n checked: ' + elemento.attr('checked') +
    //     //   '\n Required: ' + elemento.attr('require')
    //     // );  

    // });

    // if( !areaadmin ){
    //   mensagem += "<div> - Área de interesse;</div>";
    //   ativo = false;  
    // }
    
    if(mensagem){
      if(ativo){
        bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
        jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");  
      }else{
        bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
        jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");   
      }

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

  $('.cnpj').mask('99.999.999/9999-99');
  $('.inscricao-estadual').mask('99,99,9999-9');
  $('.cep').blur(function(){
    var cep = $(this);
    num_cep = cep.val();
    num_cep = num_cep.replace(/[^\d]+/g, '')

    if( num_cep == "" ){
      // nao faz nada a pedido do robson
    }else if( num_cep.length < 10 ){
      bootbox.alert("<p class='lead blue'>Notificação</p><p>CEP inválido</p>", function() {});  
      cep.val(''); 
    }else if(
      num_cep == "00000000" ||
      num_cep == "11111111" ||
      num_cep == "22222222" || 
      num_cep == "33333333" || 
      num_cep == "44444444" || 
      num_cep == "55555555" || 
      num_cep == "66666666" || 
      num_cep == "77777777" || 
      num_cep == "88888888" || 
      num_cep == "99999999"
    ){
      cep.val('');
      bootbox.alert("<p class='lead blue'>Notificação</p><p>CEP inválido</p>", function() {});   
    }

  })  
  $('.cep').mask('99.999-999');
  //$('.ddd').mask('999');
  $('.telefone').blur(function(){
    var telefone = $(this);
    num_telefone = telefone.val();
    num_telefone = num_telefone.replace(/[^\d]+/g, '')

    if( num_telefone == "" ){
      // nao faz nada a pedido do robson
    }else if( num_telefone.length < 10 ){
      bootbox.alert("<p class='lead blue'>Notificação</p><p>Telefone inválido</p>", function() {});  
      telefone.val(''); 
    }else if(
      telefone == "00000000" ||
      telefone == "11111111" ||
      telefone == "22222222" || 
      telefone == "33333333" || 
      telefone == "44444444" || 
      telefone == "55555555" || 
      telefone == "66666666" || 
      telefone == "77777777" || 
      telefone == "88888888" || 
      telefone == "99999999" ||
      telefone == "000000000" || 
      telefone == "111111111" || 
      telefone == "222222222" || 
      telefone == "333333333" || 
      telefone == "444444444" || 
      telefone == "555555555" || 
      telefone == "666666666" || 
      telefone == "777777777" || 
      telefone == "888888888" || 
      telefone == "999999999"
    ){
      telefone.val('');
      bootbox.alert("<p class='lead blue'>Notificação</p><p>Telefone inválido</p>", function() {});   
    }

  })
  $('.telefone').mask('9999-9999');


  $('.cpf').mask('999.999.999-99');
  //$('.numero').mask('999999');
  $("input.numero").bind("keyup blur focus", function(e) {
    e.preventDefault();
    var expre = /[^0-9]/g;
    // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
    if ($(this).val().match(expre))
      $(this).val($(this).val().replace(expre,''));
  });                
      
  $("input.ddd").bind("keyup blur focus", function(e) {
    e.preventDefault();
    var expre = /[^0-9]/g;
    // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
    if ($(this).val().match(expre))
      $(this).val($(this).val().replace(expre,''));
  }); 

  $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
  });

});  
