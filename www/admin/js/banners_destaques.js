jQuery(document).ready(function(){

 
  // Valida formulário
  $(".salvar").click(function(e){
    e.preventDefault();
    var mensagem = "";

    if( $("#h1").val() == "" ){
      mensagem += "<div> - Selecione o banner - Página Home</div>";
    }

    if( $("#p1").val() == "" ){
      mensagem += "<div> - Selecione o banner - Barra lateral</div>";
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

    banner_id = $("#h" + posicao ).val();

    if($('#banner').val() != ''){
        $(".posicao-sel p").html($('#banner option[value=' + banner_id + ']').text());
        $('#h1').val($('#banner').val());

    }


    return false;
  });

  $(".posicoes_2 .item").click(function(){
        //$(".posicao1.item").click(function(){
        var posicao = $(this).attr("rel");

        $(".posicoes_2 .item").removeClass("active");

        $(this).addClass("active");

        banner_id = $("#p" + posicao ).val();

        if($('#banner_2').val() != '') {
            $(".posicao-sel2 p").html($('#banner_2 option[value=' + banner_id + ']').text());
            $('#p1').val($('#banner_2').val());
        }

        return false;
    });





  // Select chosen
  $(".chosen-select").chosen(); 
  $(".chosen-select2").chosen(); 


  $("#banner").change(function(){

      banner_id = this.value;

      $('#h1').val(banner_id);
  });


  $("#banner_2").change(function(){

      banner_id = this.value;

      $('#p1').val(banner_id);
    });



});  
