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
    bootbox.confirm("<p class='lead blue'>Notificação</p>Deseja realmente remover?", function(result) {
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



  // Remove item da lista
  jQuery(".remover-item-table").click(function(){
    var item = jQuery(this);
    bootbox.confirm('Você tem certeza que deseja excluir o objeto selecionado?', function(result) {
      if(result) {
        item.parent().parent().fadeOut(450);
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




  // Valida formulário nivel 1
  jQuery("form[name='frm1']").on('submit', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";

    if( jQuery("#podem-visualizar").val() == "" ){
      mensagem += "<div> - Podem visualizar;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }


    if( jQuery("#titulo").val() == "" ){
      mensagem += "<div> - Título;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#resumo").val() == "" ){
      mensagem += "<div> - Resumo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#idioma").val() == "" ){
      mensagem += "<div> - Idioma;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#arquivo").val() == "" ){
      mensagem += "<div> - Arquivo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#autor_obj").val() == "" ){
      mensagem += "<div> - Autor do objeto;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if(mensagem){

      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }else{
      jQuery(this).submit();
    }
    
  })




  // Valida formulário nivel 2
  jQuery("form[name='frm2']").on('submit', function(){
    jQuery(this).submit();
  })




  // Valida formulário nivel 1
  jQuery("form[name='frm4']").on('submit', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";

    if( jQuery("#prop_discussao").val() == "" ){
      mensagem += "<div> - Proposta para discussão;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if(mensagem){

      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }else{
      jQuery(this).submit();
    }
    
  })








  // Valida formulário
  jQuery("form[name='frm']").on('submit', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";

    if( jQuery("#grupo").val() == "" ){
      mensagem += "<div> - Grupo;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    alert(mensagem);
    return false;

    if( jQuery("#email").val() == "" ){
      mensagem += "<div> - E-mail;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#email_confirm").val() == "" ){
      mensagem += "<div> - E-mail de confirmação;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#nome_completo").val() == "" ){
      mensagem += "<div> - Nome;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }else{
      tituloAux = jQuery("#nome_completo").val();
      tituloAux = tituloAux.split(" ");
      //console.log(tituloAux.length);
      if(tituloAux.length < 2){
        mensagem += "- Digite o nome completo.\n"; 
      }else if(tituloAux[0] == "" || tituloAux[1] == "" ){
        mensagem += "- Digite o nome completo.\n"; 
      }
    }




    if( jQuery("#cpf").val() == "" ){
      mensagem += "<div> - CPF;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#idioma").val() == "" ){
      mensagem += "<div> - Idioma;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#telefone").val() == "" ){
      mensagem += "<div> - Telefone;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#CEP").val() == "" ){
      mensagem += "<div> - CEP;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#pais").val() == "" ){
      mensagem += "<div> - País;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#estado").val() == "" ){
      mensagem += "<div> - Estado;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#cidade").val() == "" ){
      mensagem += "<div> - Cidade;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#bairro").val() == "" ){
      mensagem += "<div> - Bairro;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#endereco").val() == "" ){
      mensagem += "<div> - Endereço;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#numero").val() == "" ){
      mensagem += "<div> - Número;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#escolaridade").val() == "" ){
      mensagem += "<div> - Escolaridade;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#profissao").val() == "" ){
      mensagem += "<div> - Profissão;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#instituicao").val() == "" ){
      mensagem += "<div> - Instituição empregadora;</div>";
      mensagem = mensagem.replace(" *","");
      mensagem = mensagem.replace("*","");          
    }

    if( jQuery("#possui-crmv-sim").is( ':checked' ) ){
      if( jQuery("#num_crmv").val() == "" ){
        mensagem += "<div> - CRMV;</div>";
        mensagem = mensagem.replace(" *","");
        mensagem = mensagem.replace("*","");          
      }
    }

    // valida os checkbox
    var areaadmin = false;
    $('input[name="area-interesse[]"]').each(function(index){  
        var elemento = $(this);

        if ( elemento.is( ':checked' )){
          areaadmin = true;
        }

        // alert(
        //   ' Name: ' + elemento.attr('name') + 
        //   '\n Type: ' + elemento.attr('type') + 
        //   '\n Value: ' + elemento.val() +
        //   '\n checked: ' + elemento.attr('checked') +
        //   '\n Required: ' + elemento.attr('require')
        // );  

    });

    if( !areaadmin ){
      mensagem += "<div> - Área de interesse;</div>";
    }





    if(mensagem){

      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }
    
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

  jQuery(".abrir-boxfile").click(function(){
    jQuery(this).parent().children("input").click();
  })

  jQuery(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    jQuery(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })


  // Carrega os dados do objeto a relacionar selecionado
  jQuery("#obj_a_relacionar").change(function(){
    var idObj = $(this).val();
    

    var titulo = "Lorem ipsum dolor est sit amet";
    var descricao = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque eros in tempus mattis. Cras porttitor orci eget dignissim porttitor. Vestibulum et tortor faucibus, ultrices turpis eu, porttitor sem.";
    var classificacao = "Linha - Lorem ipsum dolor est<br/>Tema - Dolor est<br />Sub tema - Cras porttitor";
    var tipo_de_midia = "Imagem";
    var tipo_de_material = "Artigo";
    var nivel = "Fundamental | Básico";
    var autor = "Fulano Beltrano Cicarano";
    var criado_em = "12.05.2014";

    jQuery("#rel_titulo").html(titulo);
    jQuery("#rel_descricao").html(descricao);
    jQuery("#rel_classificacao").html(classificacao);
    jQuery("#rel_tipo_de_midia").html(tipo_de_midia);
    jQuery("#rel_tipo_de_material").html(tipo_de_material);
    jQuery("#rel_nivel").html(nivel);
    jQuery("#rel_autor").html(autor);
    jQuery("#rel_criado_em").html(criado_em);

    jQuery(".rel_visualizar_obj_portal").removeClass("hide");
    jQuery(".rel_relacionar").removeClass("hide");


  })

  // Relaciona o objeto e exibe na tabela
  jQuery("#rel_relacionar").click(function(){
    jQuery("#item-marcacao").remove();    

    html='';
    html+='<tr>';
    html+='<td class="col-xs-7">Lorem ipsum dolor est sit amet</td>';
    html+='<td class="col-xs-4">Fulano Beltrano Cicrano</td> ';
    html+='<td class="col-xs-1"><button class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button></td>';
    html+='</tr>';

    jQuery(".obj-relacionados-lista tbody").append(html);
    
    
    return false;
  })  



  // Carrega os dados do objeto a relacionar selecionado para discussao
  jQuery("#obj_a_relacionar_disc").change(function(){
    var idObj = $(this).val();
    

    var titulo = "Lorem ipsum dolor est sit amet";
    var descricao = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam scelerisque eros in tempus mattis. Cras porttitor orci eget dignissim porttitor. Vestibulum et tortor faucibus, ultrices turpis eu, porttitor sem.";
    var classificacao = "Linha - Lorem ipsum dolor est<br/>Tema - Dolor est<br />Sub tema - Cras porttitor";
    var tipo_de_midia = "Imagem";
    var tipo_de_material = "Artigo";
    var nivel = "Fundamental | Básico";
    var autor = "Fulano Beltrano Cicarano";
    var criado_em = "12.05.2014";

    jQuery("#rel_titulo_disc").html(titulo);
    jQuery("#rel_descricao_disc").html(descricao);
    jQuery("#rel_classificacao_disc").html(classificacao);
    jQuery("#rel_tipo_de_midia_disc").html(tipo_de_midia);
    jQuery("#rel_tipo_de_material_disc").html(tipo_de_material);
    jQuery("#rel_nivel_disc").html(nivel);
    jQuery("#rel_autor_disc").html(autor);
    jQuery("#rel_criado_em_disc").html(criado_em);

    jQuery(".rel_visualizar_obj_portal_disc").removeClass("hide");
    jQuery(".rel_relacionar_disc").removeClass("hide");


  })

  // Relaciona o objeto e exibe na tabela de discussao
  jQuery("#rel_relacionar_disc").click(function(){
    jQuery("#item-marcacao-disc").remove();    

    html='';
    html+='<tr>';
    html+='<td class="col-xs-7">Lorem ipsum dolor est sit amet</td>';
    html+='<td class="col-xs-4">Fulano Beltrano Cicrano</td> ';
    html+='<td class="col-xs-1"><button class="btn btn-xs btn-grey btn remover-item-table"><i class="icon-trash no-margin"></i></button></td>';
    html+='</tr>';

    jQuery(".obj-relacionados-lista-disc tbody").append(html);
    
    
    return false;
  })  






  // Select chosen
  $(".chosen-select").chosen(); 


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



  jQuery("#addAutor").click(function(){
    jQuery(".tags_conhecimento").append( '<span class="tag" id="10">'+ jQuery("#autor_conhecimento").val() +'<button type="button" class="close" onClick="removeTag(10)">×</button></span>' );
    jQuery("#autor_conhecimento").val('');
    jQuery("#autor_conhecimento").focus();
    jQuery(".tags_conhecimento").show();
    return false;
  })

  jQuery("#addTags").click(function(){
    jQuery(".tagsnew").append( '<span class="tag" id="tagnew10">'+ jQuery("#tagsnew").val() +'<button type="button" class="close" onClick="removeTagNew(10)">×</button></span>' );
    jQuery("#tagsnew").val('');
    jQuery("#tagsnew").focus();
    jQuery(".tagsnew").show();
    return false;
  })

});  

function removeTag(tag){
  jQuery("#"+tag).fadeOut();
}

function removeTagNew(tag){
  jQuery("#tagnew"+tag).fadeOut();
}
