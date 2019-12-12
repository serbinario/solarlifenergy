$(document).ready(function () {

    $('.date').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});

    //Verifica se o cpf esta preenchido os campos juridico sao acultados
    if($( "input[name='tipo']:checked").val() == 'Fisica'){
        document.getElementById('cnpj').remove()
        $('.tipo_juridico').hide()
        $('.fisica').show()
        $('.juridico').hide()

    }
    if($( "input[name='tipo']:checked").val() == 'Juridico')
    {
        document.getElementById('cpf').remove()
        $('.tipo_fisica').hide()
        $('.juridico').show()
        $('.fisica').hide()
    }

    //ao clicar aculta algum campo de cpf ou cnpj
    $('.tipoF').click(function () {
        $('.fisica').show()
        $('.juridico').hide()
    })
    $('.tipoJ').click(function () {
        $('.juridico').show()
        $('.fisica').hide()
    })

    //Ao submeter tirar as mascaras
    $("#edit_cliente_form").submit(function (event) {
        $('.cpf').unmask();
        $('.cnpj').unmask();
    });

    //Ao submeter tirar as mascaras
  //  $("#edit_projeto_form").submit(function (event) {
       // $('.kw').unmask();
   // });



    //Ao submeter tirar as mascaras
    $("#create_cliente_form").submit(function (event) {
        $('.cpf').unmask();
    });



    $("input[name=cep]").blur(function(){
        var cep_code = $(this).val();
        if( cep_code.length <= 0 ) return;
        //$.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
        $.get("https://viacep.com.br/ws/51170-620/json/?callback=callback_name",
            function(result){
            console.log(result)
                if( result.status!=1 ){
                    alert(result.message || "Houve um erro desconhecido");
                    return;
                }
                $("input#cep").val( result.code );
                $("input#estado").val( result.state );
                $("input#cidade").val( result.city );
                $("input#bairro").val( result.district );
                $("input#logradouro").val( result.address );
                $("input#estado").val( result.state );
                //alert("Dados recebidos e alterados");
            });
    });

    $('#map_coordenadas').click(function () {
        var width = (screen.availWidth - 100);
        var height = (screen.availHeight - 100);
        window.open("/cliente/coordenadas", "mpg_popup", "toolbar=0, location=0, directories=0, status=1, menubar=0, scrollbars=1, resizable=0, screenX=0, screenY=0, left=0, top=0, width=" + width + ", height=" + height);
        return true;
    })

    function mapa_get(callback, servidor) {

    }

    $(".add-more").click(function(){

        var html = '<div class="row copy">'
        html += '<div class="col-lg-6">'
        html +=     '<div class="form-group {{ $errors->has(\'num_contrato\') ? \'has-error\' : \'\' }}">'
        html +=         '<label for="num_contrato" class="col-sm-4 control-label">Contrato Celpe</label>'
        html +=         '<div class="col-md-3">'
        html += '           <input class="form-control input-sm" name="num_contrato[]" type="number" id="num_contrato" value="{{ old(\'contrato_celpe\', isset($contrato) ? $contrato->num_contrato : null) }}" placeholder="Contrato Celpe...">'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-lg-6">'
        html +=     '<div class="form-group {{ $errors->has(\'percentual\') ? \'has-error\' : \'\' }}">'
        html +=         '<label for="percentual" class="col-sm-4 control-label">Porcento.:</label>'
        html +=         '<div class="col-md-3">'
        html += '           <input class="form-control input-sm" name="percentual[]" type="number" id="percentual" value="{{ old(\'percentual\', isset($contrato) ? $contrato->percentual : null) }}" placeholder="Contrato Celpe...">'
        html +=         '</div>'
        html +=     '</div>'
        html += '</div>'
        html += '<div class="col-lg-6">'
        html += '<div class="form-group {{ $errors->has(\'num_contrato\') ? \'has-error\' : \'\' }}">'
        html += '<div class="col-md-2">'
        html += '<div class="">'
        html += '<label for="">'
        html += '<button class="btn btn-danger remove btn-sm" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>'
        html += '</label>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        html += '</div>'


        $(".after-add-more").after(html);

    });


    $("body").on("click",".remove",function(){

        console.log("wwwww");
        $(this).parents(".copy").remove();

    });


});