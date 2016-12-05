$(document).ready(function(e){

    //e.preventDefault();
    //Verifica se algum arquivo já foi enviado
    $('#fileupload').on('click', function(){
        if($('#file_info_uploaded').val()!=''){
            bootbox.alert("<p>Um arquivo já foi enviado para atualização. Clique em salvar e faça um novo envio.</p>", function() {});
            $(".bootbox .modal-footer .btn-primary").html("Fechar");
            return false;
        }
    });

  // Valida formulário nivel 1
  //$("form[name='frm1']").on('submit', function(){
    $(".salvar").on('click', function(){

    // var idFrom = $(this).attr("id");

    var mensagem = "";

    if( $("#podem-visualizar").val() == "" ){
      mensagem += "<div> - Podem visualizar;</div>";
    }


    if( $("#titulo").val() == "" ){
      mensagem += "<div> - Título;</div>";
    }

    if( $("#resumo").val() == "" ){
      mensagem += "<div> - Resumo;</div>";
    }

    if( $("#idioma").val() == "" ){
      mensagem += "<div> - Idioma;</div>";
    }

    if( $("#date_objeto").val() == "" ){
          mensagem += "<div> - Data do objeto;</div>";
    }

    if( $("#linha").val() == "" ){
      mensagem += "<div> - Área do conhecimento - Linha;</div>";
    }

    if( $("#tema").val() == "" ){
      mensagem += "<div> -  Área do conhecimento - Tema;</div>";
    }

    if( $("#subtema").val() == "" ){
      mensagem += "<div> -  Área do conhecimento - Subtema;</div>";
    }

    if( $("#array_autores").val() == "" ){
      mensagem += "<div> - Autor(es) do conhecimento;</div>";
    }

    //if( $("#file_info_uploaded").val() == "" ){
    //  mensagem += "<div> - Arquivo;</div>";
    //  mensagem = mensagem.replace(" *","");
    //  mensagem = mensagem.replace("*","");
    //}

    if( $("#autor_obj").val() == "" ){
      mensagem += "<div> - Autor do objeto;</div>";
    }


    if(mensagem){

      bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});   
      $(".bootbox .modal-footer .btn-primary").html("Fechar");
      return false;
    }else{
      $(this).submit();
    }
    
  })














  // Valida formulário
  //$("form[name='frm']").on('submit', function(){
  //
  //  // var idFrom = $(this).attr("id");
  //
  //  var mensagem = "";
  //
  //
  //
  //  // // valida os checkbox
  //  // var areaadmin = false;
  //  // $('input[name="area-interesse[]"]').each(function(index){
  //  //     var elemento = $(this);
  //
  //  //     if ( elemento.is( ':checked' )){
  //  //       areaadmin = true;
  //  //     }
  //
  //  //     // alert(
  //  //     //   ' Name: ' + elemento.attr('name') +
  //  //     //   '\n Type: ' + elemento.attr('type') +
  //  //     //   '\n Value: ' + elemento.val() +
  //  //     //   '\n checked: ' + elemento.attr('checked') +
  //  //     //   '\n Required: ' + elemento.attr('require')
  //  //     // );
  //
  //  // });
  //
  //  // if( !areaadmin ){
  //  //   mensagem += "<div> - Área de interesse;</div>";
  //  // }
  //
  //
  //
  //
  //
  //  if(mensagem){
  //
  //    bootbox.alert("<p>Os campos abaixo são de preenchimento obrigatório:</p>"+mensagem, function() {});
  //    $(".bootbox .modal-footer .btn-primary").html("Fechar");
  //    return false;
  //  }
  //
  //})


  

  

  $(".abrir-boxfile").click(function(){
    $(this).parent().children("input").click();
  })

  $(".ace-file-input input").change(function(){
    var nome_arquivo = $(this).val();
    $(".ace-file-input .file-name").attr("data-title",nome_arquivo);
  })


  




  // Select chosen
  $(".chosen-select").chosen(); 


 

  $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
    $(this).prev().focus();
  });



  $("#addAutor").click(function(){
    
    novo_autor   = ($('#autornew_chosen > div.chosen-drop > ul.chosen-results > li.no-results > span').text() != '') ?
                    $('#autornew_chosen > div.chosen-drop > ul.chosen-results > li.no-results > span').text() : '' ;

    texto       = ($("#autornew").val() != '') ? $("#autornew option:selected").text() : '';
    id_autor    = ($("#autornew").val() != '') ? $("#autornew").val() : '';

    //id      = Math.floor((Math.random() * 10000) + 1); //-- Gera ID randômico

    $(".autores_conhecimento").append( '<span class="tag autor"  data-id="'+ id_autor +'">'+ (texto != '' ? texto : novo_autor ) +'<button type="button" class="close" onClick="removeAutor(this)">×</button></span>' );
    $("#autornew").val('');
    $("#autornew").focus();
    $(".autores_conhecimento").show();


    novos_ids       = [];
    novos_autores   = [];
    $('.tag.autor').each(function(){
        if(novo_autor != '' && $(this).data('id') == '') {
            novos_autores[novos_autores.length] = $(this)
                                                        .clone()
                                                        .children()
                                                        .remove()
                                                        .end()
                                                        .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.
            $('#novos_autores').val(novos_autores.join(','));
        }else {
            if ($(this).data('id') != ''){
                novos_ids[novos_ids.length] = parseInt($(this).data('id'));
                $('#array_autores').val(novos_ids.join(','));
            }
        }
    })

    return false;
  })






  //$("#idioma_trad").change(function(){
  //  var $this = $(this);
  //
  //  if( $this.val() == "EN"){
  //    $("#label_en").removeClass("inactive");
  //    $("#label_es").addClass("inactive");
  //  }
  //
  //  if( $this.val() == "ES"){
  //    $("#label_en").addClass("inactive");
  //    $("#label_es").removeClass("inactive");
  //  }
  //})


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
      title: "Nível escolar"
    });
    $("#dialog-message").html('');

    $dados = '';
    $("input[name='nivel-escolar[]']").each(function(idx, obj){
      if( $(obj).is( ':checked' ) ){
        // console.log(idx + ' - ' + obj.value);
        $dados += '<p>' + obj.value + '</p>';
      }

      $("#dialog-message").html( $dados );    
    })


    

    $(".ui-widget-overlay").hide();
  });

});  




function removeAutor(autor){
  
    //$("#"+autor).remove();
    $(autor).parent().remove();

    novos_ids   = [];
    novos_autores = [];
    $('.tag.autor').each(function(){
        if($(this).data('id') == '') {
            novos_autores[novos_autores.length] = $(this)
                                                .clone()
                                                .children()
                                                .remove()
                                                .end()
                                                .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.
            $('#novos_autores').val(novos_autores.join(','));
        }else{
            novos_ids[novos_ids.length] = parseInt($(this).data('id'));
            $('#array_autores').val(novos_ids.join(','));
        }
    })

    if($('.tag.autor').length == 0){
        $('#array_autores').val('');
    }
        
}
