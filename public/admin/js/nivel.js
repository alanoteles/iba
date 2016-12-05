jQuery(document).ready(function(){

    var url = window.location.href;
    url = url.split('/');
    url = url[0]+'//'+url[2];

    $('.select_nivel').on('change', function () {

    id = parseInt($(this).find(":selected").val());
    var $tipo = $('#id').val();

    if($tipo == 'T'){
      $destino = '/pt_br/linhas-busca';
    }else if($tipo == 'S'){
      $destino = '/pt_br/temas-busca';
    }


    $('#subtema').attr('disabled', true);

    $.ajax({
      url: url + $destino,
      type: 'POST',
      data: {id: id},
      dataType: 'json',
      success: function (data) {

        //$('#tema').attr('disabled', false);
        $('.tags').children().remove();

        $.each(data, function(name, value){
          console.log(value['id']);
          //$('#tema').append( '<option value="' + value['id'] + '">' + value['title'] + '</option>' );
          $('.tags').append( '<span class="tag item" data-id="' + value['id'] + '">' + value['title'] +
              '<button type="button" class="close" onClick="removeNivel(this)">×</button></span>');

        });
      }
    });
    });



    $("#addLinha, #addTema, #addSubtema").click(function(){

    //novo_nivel = $('.novonivel').val();

    var item = $(this);

    novo_nivel = item.parent().parent().find('.novonivel').val();

    if($('#id').val() == 'L'){


        id_linha = '0';
        $('#novos_niveis').val(id_linha + '#' + novo_nivel);

        $('input[name=_method]').val('POST');
        $('#frm').attr('method','POST');
        $('#frm').attr('action', url + '/pt_br/admin/tabelas-de-apoio/nivel/adiciona-niveis');


        $('#frm').submit();


    }


    if($('#id').val() == 'T'){

      if($('#linha_nivel').val() == '0'){
        bootbox.alert("<h5>Operação NÃO concluída !</h5><br>É necessário escolher uma Linha antes de incluir um Tema.", function () {
        });
        $(".bootbox .modal-footer .btn-primary").html("Fechar");
        return false;

      }else{
        id_linha = $('#linha_nivel').val();
        $('#novos_niveis').val(id_linha + '#' + novo_nivel);

        $('input[name=_method]').val('POST');
        $('#frm').attr('method','POST');
        $('#frm').attr('action', url + '/pt_br/admin/tabelas-de-apoio/nivel/adiciona-niveis');


        $('#frm').submit();
      }

    }

    if($('#id').val() == 'S'){

      if($('#tema_nivel').val() == '0'){
        bootbox.alert("<h5>Operação NÃO concluída !</h5><br>É necessário escolher um Tema antes de incluir um Subtema.", function () {
        });
        $(".bootbox .modal-footer .btn-primary").html("Fechar");
        return false;

      }else{
        id_tema = $('#tema_nivel').val();
        $('#novos_niveis').val(id_tema + '#' + novo_nivel);

        $('input[name=_method]').val('POST');
        $('#frm').attr('method','POST');
        $('#frm').attr('action', url + '/pt_br/admin/tabelas-de-apoio/nivel/adiciona-niveis');


        $('#frm').submit();
      }

    }


    novos_ids   = [];
    novos_niveis  = [];
    $('.tag.item').each(function () {
      if(novo_nivel != '' && $(this).data('id') == '') {

        novos_niveis[novos_niveis.length] = $(this)
            .clone()
            .children()
            .remove()
            .end()
            .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.

        $('#novos_niveis').val(novos_niveis.join(','));

      }
    })

    return false;
    })


    //-- Habilita select box de Idioma --//
    $(".nivel_trad").change(function(){
        $(".idioma_nivel_trad").removeAttr("disabled");
        $(".idioma_nivel_trad").val('');
    })



    //-- Retorna os dados relativos ao idioma selecionado na aba Traduções --->
    $(".idioma_nivel_trad").change(function(){
        var $this = $(this);

        //console.log($(".nivel_trad").val());
        //return false;
        var $tipo       = $("#id").val();
        var $id_nivel   = $(".nivel_trad").val();

        url = window.location.pathname.substring(0,window.location.pathname.substring(0, window.location.pathname.indexOf('/edit')).lastIndexOf('/'));

        $('#aba-traducoes input').val('');

        if($this.val() != '') {

            $.ajax({
                url: url + '/retorna-traducao-nivel',
                type: 'GET',
                data: {id: $id_nivel, model: $('#model').val(), locale: $this.val(), tipo: $tipo},
                dataType: 'json',
                success: function (data) {

                    if (data.length != 0) {
                        resultado = data[0];


                        $('#aba-traducoes input').each(function () {
                            if (resultado.hasOwnProperty($(this).attr('id')) != -1) {

                                attrib_limpo = $(this).attr('id').substring(0, $(this).attr('id').indexOf('_trad'));

                                $(this).val(resultado[attrib_limpo]);

                            }
                        });

                    }

                }
            });
        }
    })

});

function removeNivel(nivel){

    var $id   = $(nivel).parent().data('id');
    var $tipo = $('#id').val();

    var url = window.location.href;
    url = url.split('/');
    url = url[0]+'//'+url[2];

    bootbox.confirm("Confirma a EXCLUSÃO desse registro ?", function(result) {

        if(result) {
            if ($id != '') { //Verifica se existe algum objeto associado aquele nível. Não permite a exclusão, caso exista.
                $.ajax({
                url: url + '/pt_br/admin/tabelas-de-apoio/nivel/apaga-niveis',
                type: 'POST',
                data: {id: $id, tipo: $tipo},
                dataType: 'json',
                success: function (data) {


                    if (data == 0) {
                        bootbox.alert("<h5>Operação NÃO concluída !</h5><br>Não é possível excluir o nível selecionado pois ele está associado a 1 ou mais objetos.", function () {
                        });
                        $(".bootbox .modal-footer .btn-primary").html("Fechar");
                        return false;
                    } else {

                        $(nivel).parent().remove();

                        if($('#niveis_apagados').val() != ''){
                          $niveis_apagados = $('#niveis_apagados').val().split(',');
                          $niveis_apagados[$niveis_apagados.length] = $id;
                          $('#niveis_apagados').val($niveis_apagados.join(','));
                        }else{
                          $('#niveis_apagados').val($id);
                        }


                      //bootbox.alert("<h5>Operação concluída com sucesso !</h5><br>O nível foi excluído.", function () {
                        //});
                        //$(".bootbox .modal-footer .btn-primary").html("Fechar");
                        //return false;
                    }
                }
                });

            } else { // Exclui apenas os itens que foram adicionados antes de salvar, pois não possuem ID ainda.

                $('#novos_niveis').val('');
                $(nivel).parent().remove();

                novos_ids = [];
                novos_niveis = [];
                $('.tag.item').each(function () {
                  if ($(this).data('id') == '') {
                      novos_niveis[novos_niveis.length] = $(this)
                          .clone()
                          .children()
                          .remove()
                          .end()
                          .text(); //-- Essa implementação pega só o texto do span, sem o "x" do button.
                      $('#novos_niveis').val(novos_niveis.join(','));

                  }
                })

            }
        }
    });

}