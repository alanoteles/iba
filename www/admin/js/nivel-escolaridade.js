jQuery(document).ready(function(){

  $('.ordena-baixo').click(function(){
      ordenaEscolaridade('down',$(this).data('id'));
    location.reload(true);
  });

  $('.ordena-cima').click(function(){
      ordenaEscolaridade('up',$(this).data('id'));
    location.reload(true);
  });


  // Dialog Nome do nível
  $( "#id-btn-dialog1" ).on('click', function(e) {
    e.preventDefault();
    var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
      title: "Nome do nível"
    });
    $("#dialog-message").html('');
    $("#dialog-message").html( $("#name").val() );
    $(".ui-widget-overlay").hide();
  });
});  


function ordenaEscolaridade(posicao, id){

  $.ajax({
    url: url + '/pt_br/admin/tabelas-de-apoio/escolaridade/ordenacao',
    type: 'GET',
    data: {id: id, posicao: posicao},
    dataType: 'json',
    success: function (data) {
      //
    }
  });

}