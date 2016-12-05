jQuery(document).ready(function(){

  $(".salvar").on('click', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";


    if( $("#title").val() == "" ){
      mensagem += "<div> - Título;</div>";
    }


    if( $("#news_editorial_id").val() == "" ){
      mensagem += "<div> - Editoria da notícia;</div>";
    }

    if( $("#date_noticia").val() == "" ){
      mensagem += "<div> - Data da notícia;</div>";
    }

    if( $("#source").val() == "" ){
      mensagem += "<div> - Fonte;</div>";
    }


    if (CKEDITOR.instances.content_data.getData() == ""){
      mensagem += "<div> - Corpo da notícia;</div>";
    }

    if(mensagem){

      bootbox.alert("<h5>Os campos abaixo são de preenchimento obrigatório:</h5>"+mensagem, function() {});
      $(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }else{
      //alert('else');return false;
      $(this).submit();
    }

  })




  jQuery(".abrir-boxfile").click(function(){
    jQuery(this).parent().children("input").click();
  })

  jQuery(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    jQuery(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })


  // Select chosen
  $(".chosen-select").chosen(); 



  $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
  });




});  

