jQuery(document).ready(function(){

 
  // Valida formulário
  $(".salvar").click(function(e){
    e.preventDefault();
    var mensagem = "";

    if( $("#h1").val() == "" || $("#h2").val() == "" || $("#h3").val() == "" || $("#h4").val() == "" ){
      mensagem += "<div> - Selecione as notícias - Página Home</div>";
    }

    if( $("#p1").val() == "" || $("#p2").val() == "" || $("#p3").val() == "" || $("#p4").val() == "" || $("#p5").val() == "" || $("#p6").val() == "" ){
      mensagem += "<div> - Selecione as notícias - Página Projetos</div>";
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
  //$(".posicao1.item").click(function(){
    var posicao = $(this).attr("rel");

    $(".posicoes .item").removeClass("active");

    $(this).addClass("active");

    news_id = $("#h" + posicao ).val();

    $(".posicao-sel p").html($('#noticia option[value=' + news_id + ']').text());

    return false;
  });

  $(".posicoes_2 .item").click(function(){
        //$(".posicao1.item").click(function(){
        var posicao = $(this).attr("rel");

        $(".posicoes_2 .item").removeClass("active");

        $(this).addClass("active");

        news_id = $("#p" + posicao ).val();

        $(".posicao-sel2 p").html($('#noticia_2 option[value=' + news_id + ']').text());

        return false;
    });





  // Select chosen
  $(".chosen-select").chosen(); 
  $(".chosen-select2").chosen(); 


  $("#noticia").change(function(){

      news_id = this.value;

      $(".posicoes .item").each(function(){

          if($(this).hasClass('active')){
              $("#h" +  $(this).attr('rel') ).val(news_id);
          }
      });
  });

  $("#noticia_2").change(function(){

        news_id = this.value;

        $(".posicoes_2 .item").each(function(){

            if($(this).hasClass('active')){
                $("#p" +  $(this).attr('rel') ).val(news_id);
            }
        });
    });



});  
