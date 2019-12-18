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

    $(".propostas").click(function(){
        console.log("ss")
        console.log($( "#cep" ).val())

        var dados = {
            'lead[name]' : "Paulo+Vaz",
            'lead[email]' : "psgva@gmail.com",
            'lead[state]' : "PE",
            'lead[city]' : "Recife",
            'lead[postalcode]' : "51170620",
            'lead[monthly_usage]' : "7000",
            'lead[kind]' : "email"

        }

        jQuery.ajax({
            crossDomain: true,
            type: 'POST',
            data: dados,
            url: 'https://www.portalsolar.com.br/api/leads',
        }).success(function (retorno) {
            if(retorno.success) {
                console.log("ssssssssssss")

            } else {
                swal(retorno.msg, "Click no botão abaixo!", "error");
            }
        }).error(function (retorno) {
            console.log("ssssssssssss")
        });

       /* $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: 'https://www.portalsolar.com.br/api/leads',
            data: JSON.stringify(record),
            complete: function(xhr) {
                if (xhr.readyState == 4) {
                    if (xhr.status == 201) {
                        alert("Created");
                    }
                } else {
                    alert("NoGood");
                }
            }

        });*/
    });


    $("body").on("click",".remove",function(){

        //console.log("wwwww");
        $(this).parents(".copy").remove();

    });

    /*
    * Retorna as cardendas
     */
    $("#coordenadas_btn").click(function () { //user clicks button
        swal({
                title: "Deseja Alterar a Coordenada?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Sim, Pegar nova Coordenada",
                cancelButtonText: "Nao, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    if ("geolocation" in navigator){ //check geolocation available
                        //try to get user current location using getCurrentPosition() method
                        navigator.geolocation.getCurrentPosition(function(position){
                            //console.log(position.coords.latitude)
                            $("#coordenadas").val(position.coords.latitude + "," + position.coords.longitude);
                            swal("Novar coordenada alterada", "Click no botão abaixo!", "success");
                        });
                    }else{
                        swal("Seu Browser nao suporta", "Click no botão abaixo!", "error");
                    }
                }
        });
    });
});