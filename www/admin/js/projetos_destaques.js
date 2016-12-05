jQuery(document).ready(function(){

 
  // Valida formulário
  $(".salvar").click(function(e){
    e.preventDefault();
    var mensagem = "";

    if( $("#h1").val() == "" || $("#h2").val() == "" ){
      mensagem += "<div> - Selecione os projetos - Página Home</div>";
    }

    if( $("#p1").val() == "" || $("#p2").val() == "" ){
      mensagem += "<div> - Selecione os projetos - Página Projetos</div>";
    }



    if(mensagem){
      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      jQuery(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }else{
      $('#frm').submit();
    }

  })


  // Marca item da posicao
  $(".posicoes .item").click(function(){
    var posicao = $(this).attr("rel");

    $(".posicoes .item").removeClass("active");

    $(this).addClass("active");

    project_id = $("#h" + posicao ).val();

    $(".posicao-sel p").html($('#projeto option[value=' + project_id + ']').text());

    return false;
  });


  $(".posicoes_2 .item").click(function(){

      var posicao = $(this).attr("rel");

      $(".posicoes_2 .item").removeClass("active");

      $(this).addClass("active");

      project_id = $("#p" + posicao ).val();

      $(".posicao-sel2 p").html($('#projeto_2 option[value=' + project_id + ']').text());

      return false;
  });




  // Select chosen
  $(".chosen-select").chosen(); 
  $(".chosen-select2").chosen(); 


  $("#projeto").change(function(){

      project_id = this.value;

      $(".posicoes .item").each(function(){

          if($(this).hasClass('active')){
              $("#h" +  $(this).attr('rel') ).val(project_id);
          }
      });

  });

  $("#projeto_2").change(function(){

      project_id = this.value;

      $(".posicoes_2 .item").each(function(){

          if($(this).hasClass('active')){
              $("#p" +  $(this).attr('rel') ).val(project_id);
          }
      });

  });

});  
