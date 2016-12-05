jQuery(document).ready(function(){

 
  // Valida formulário
  $(".salvar").click(function(e){
    e.preventDefault();
    var mensagem = "";

    if( $("#projeto").val() == "" ){
      mensagem += "<div> - Selecione o projeto - Página Home</div>";
    }

    if( $("#projeto_2").val() == "" ){
      mensagem += "<div> - Selecione o projeto - Página Projetos</div>";
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

    $(".posicao-sel p").html("Posição H" + posicao);
    $(".posicao-sel input").val(posicao);
    return false;
  });
  $(".posicoes_2 .item").click(function(){

    var posicao = $(this).attr("rel");

    $(".posicoes_2 .item").removeClass("active");

    $(this).addClass("active");

    $(".posicao-sel2 p").html("Posição P" + posicao);
    // $(".posicao-sel input").val(posicao);
    return false;
  });
  // Select chosen
  $(".chosen-select").chosen(); 
  $(".chosen-select2").chosen(); 
  // $('#chosen-multiple-style').on('click', function(e){
  //   var target = $(e.target).find('input[type=radio]');
  //   var which = parseInt(target.val());
  //   if(which == 2) $('.chosen-select').addClass('tag-input-style');
  //    else $('.chosen-select').removeClass('tag-input-style');
  // });

  $("#projeto").change(function(){
    $('.posicoes .active .status').html('&nbsp;' + $(this).val());
  });

  $("#projeto_2").change(function(){
    $('.posicoes_2 .active .status').html('&nbsp;' + $(this).val());
  });

});  
