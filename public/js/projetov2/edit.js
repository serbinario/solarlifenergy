$(document).ready(function () {
    var o = this;

    $('#rootwizard1').bootstrapWizard({
        onTabClick: function(tab, navigation, index){
            return true
        },
        onTabShow: function(tab, navigation, index) {
            handleTabShow(tab, navigation, index, $('#rootwizard1'));

        },

    });

    function handleTabShow(tab, navigation, index, wizard){
        var total = navigation.find('li').length;
        var current = index + 0;
        var percent = (current / (total - 1)) * 100;
        var percentWidth = 100 - (100 / total) + '%';
        console.log(percent)
        navigation.find('li').removeClass('done');
        navigation.find('li.active').prevAll().addClass('done');

        wizard.find('.progress-bar').css({width: percent + '%'});
        $('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});
    };

    var count = 2
    var current = count + 0;
    var percent = (current / (4 - 1)) * 100;
    var percentWidth = 100 - (100 / 4) + '%';

    //$('#tabs-solar div.tab-pane').removeClass('active')
   // console.log($($('#tabs-solar div.tab-pane')[count]).addClass('active'))

    //for(i = 0 ; i < count ; i++){
       // $($( '#teste > li' )[i]).addClass('done');
    //}
   // count = 0

    //$('#rootwizard1').find('.progress-bar').css({width: percent + '%'});
    //$('.form-wizard-horizontal').find('.progress').css({'width': percentWidth});




    $(".add-more").click(function(){


        var html = '<div class="row copy">'
        html += '<div class="col-sm-3">'
        html +=     '<div class="form-group">'
        html +=         '<label for="num_contacontrato" class="col-sm-6 control-label text-bold">C/Contrato.:</label>'
        html +=         '<div class="col-md-6">'
        html += '           <div class="">'
        html +=                     '<input class="form-control input-sm" name="num_contacontratoN[]" type="text" id="num_contacontrato[]" value="">'
        html +=             '</div>'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-sm-1">'
        html += '   <div class="form-group">'
        html += '       <div class="col-md-4">'
        html += '           <div class="checkbox checkbox-styled">'
        html += '               <label>'
        html += '                   <input id="contrato_titularidadeN[]" class="" name="contrato_titularidadeN[]" type="checkbox" value="1" checked>'
        html += '               </label>'
        html += '           </div>'
        html += '       </div>'
        html += '   </div>'
        html += '</div>'
        html += '<div class="col-sm-2">'
        html +=     '<div class="form-group">'
        html +=         '<label for="percentual" class="col-sm-6 control-label text-bold">Percentual.:</label>'
        html +=         '<div class="col-md-6">'
        html +=             '<input class="form-control input-sm" name="percentualN[]" type="text" id="percentual[]" value="" placeholder="%">'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-sm-5">'
        html += '   <div class="form-group">'
        html += '       <label for="image" class="col-sm-3 control-label text-bold">Link Arquivo</label>'
        html += '       <div class="col-md-9">'
        html += '           <input readonly class="form-control input-sm" name="imageN[]" type="file" id="image[]" value="">'
        html += '       </div>'
        html += '   </div>'
        html += '</div>'
        html += '<div class="col-sm-1">'
        html +=     '<div class="form-group">'
        html +=         '<div class="col-md-2">'
        html +=             '<button class="btn btn-danger remove btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i></button>'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '</div>'


        $(".after-add-more").before(html);



    });

    $(".add-more-documento").click(function(){


        var html = '<div class="row copy">'
        html += '<div class="col-sm-6">'
        html +=     '<div class="form-group">'
        html +=         '<label for="descricao" class="col-sm-4 control-label text-bold">Descrição.:</label>'
        html +=         '<div class="col-md-8">'
        html +=               '<input class="form-control input-sm" name="descricaoN[]" type="text" id="descricaoN[]" value="">'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-sm-5">'
        html += '   <div class="form-group">'
        html += '       <label for="image" class="col-sm-3 control-label text-bold">Link Arquivo</label>'
        html += '       <div class="col-md-9">'
        html += '           <input readonly class="form-control input-sm" name="descricao_imageN[]" type="file" id="descricao_imageN[]" value="">'
        html += '       </div>'
        html += '   </div>'
        html += '</div>'
        html += '<div class="col-sm-1">'
        html +=     '<div class="form-group">'
        html +=         '<div class="col-md-2">'
        html +=             '<button class="btn btn-danger remove btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i></button>'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'


        $(".after-add-more-documento").before(html);
    });

    $("body").on("click",".remove",function(){
        console.log("wwwww");
        $(this).parents(".copy").remove();
    });

    $("#modalContrato").on('click', function () {
        $('#formModal').modal();
        //var projeto_id =  document.getElementById("id").value
        //criarContrato(projeto_id)
    })

    $("#novoContrato").on('click', function () {

        criarContrato()
    })


    function criarContrato(projeto_id)
    {

        //Necessario para que o ajax envie o csrf-token
        //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

            }
        });
        var projeto_id =  document.getElementById("id").value;

        var ano =  document.getElementById("ano").value;

        var selector = document.getElementById('minuta_contrato');
        var minuta_contrato = selector[selector.selectedIndex].value;

        data = {
            'ano': ano,
            'projeto_id': projeto_id,
            'minuta_contrato': minuta_contrato
        }

        jQuery.ajax({
            type: 'POST',
            url: '/index.php/criarContrato',
            datatype: 'json',
            data: data,
        }).done(function (retorno) {
            if(retorno.success) {
                swal("", "Contrato Cadastrado com sucesso", "success");
                $('#formModal').modal('toggle');

            } else {
                swal("Error", "Click no botão abaixo!", "error");
            }
        });
    }

});