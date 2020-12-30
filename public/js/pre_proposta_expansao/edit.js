$(document).ready(function () {

    $("#edit_pre_proposta_form").submit(function(evt) {
        $('.money').each(function(index, elem){
            $(elem).val(realDolar($(elem).val()));        });

        $("#preco_kwh").val(realDolar($("#preco_kwh").val()));
        $("#potencia_instalada").val(realDolar($("#potencia_instalada").val()));

    });

    var fora_da_ponta = document.querySelectorAll('fora-da-ponta');

    /*
    * Gera uma pre-proposta
     */
    $("#pre-proposta").click(function () { //user clicks button
        swal({
                title: "Deseja Gerar a Pré-Proposta?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Sim, Gerar Pré-Proposta",
                cancelButtonText: "Nao, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    var cep = $('input[name="cep"]').val()
                    var kwh = $('input[name="monthly_usage"]').val()


                    //console.log(kwh)
                    //console.log(cep)
                    if(cep == ""){
                        swal("Cep do cliente está faltando", "Click no botão abaixo!", "error");
                    }
                    if(kwh == ""){
                        swal("Kwh do projeto está faltando", "Click no botão abaixo!", "error");
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').val()
                        }
                    });

                    var dados = {
                        'cep': cep,
                        'kwh': kwh
                    }

                    console.log(kwh)
                    jQuery.ajax({
                        type: 'POST',
                        data: dados,
                        url: '/index.php/simulaGeracao'
                    }).done(function (retorno) {
                        console.log(retorno.dados)
                        if(retorno.success) {
                            atualizaCampos(retorno.dados)
                            swal(retorno.msg, "Click no botão abaixo!", "success");
                        }
                    });
                }
            });
    });

    function atualizaCampos(retorno) {
        $('input[name="quantity"]').val(retorno.quantity)
        $('input[name="minimum_area"]').val(retorno.minimum_area)
        $('input[name="average_weight"]').val(retorno.average_weight)
        $('input[name="value"]').val(retorno.value)
        $('input[name="yearly_usage"]').val(retorno.yearly_usage)
        $('input[name="jan"]').val(retorno.months.jan)
        $('input[name="feb"]').val(retorno.months.feb)
        $('input[name="mar"]').val(retorno.months.mar)
        $('input[name="apr"]').val(retorno.months.apr)
        $('input[name="may"]').val(retorno.months.may)
        $('input[name="jun"]').val(retorno.months.jun)
        $('input[name="jul"]').val(retorno.months.jul)
        $('input[name="aug"]').val(retorno.months.aug)
        $('input[name="sep"]').val(retorno.months.sep)
        $('input[name="oct"]').val(retorno.months.oct)
        $('input[name="nov"]').val(retorno.months.nov)
        $('input[name="dec"]').val(retorno.months.dec)
        $('input[name="real_power"]').val(retorno.real_power)
        $('input[name="panel_power"]').val(retorno.panel_power)
    }

    $("#novo_projeto").on('click', function () {
        var projeto_id =  $('input[name="id"]').val()
        criarProjeto(projeto_id)
    })

    function criarProjeto(projeto_id)
    {
        //Necessario para que o ajax envie o csrf-token
        //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            type: 'get',
            url: '/index.php/criarProjeto/' + projeto_id,
            datatype: 'json'
        }).done(function (retorno) {
            if(retorno.success) {
                swal("", "Projeto Cadastrado com sucesso", "success");
                location.reload();

            } else {
                swal("Error", "Click no botão abaixo!", "error");
                table.ajax.reload();
            }
        });
    }
    $("#moduloId").change(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dados = {
            'product_id': $(this).val()
        }

        jQuery.ajax({
            type: 'get',
            data: dados,
            url: '/index.php/produto/all'
        }).done(function (retorno) {
           var qtd_paineis = document.getElementById('qtd_paineis').value
            console.log(parseInt(qtd_paineis) * parseFloat(realDolar(retorno.valor)))
            var valor_total_painel =  parseInt(qtd_paineis) * parseFloat(realDolar(retorno.valor))
            document.getElementById('produto1_nf').value = valor_total_painel.toLocaleString('pt-BR',{ minimumFractionDigits: 2  });

        });

    });

    $("#inversorId").change(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dados = {
            'product_id': $(this).val()
        }

        jQuery.ajax({
            type: 'get',
            data: dados,
            url: '/index.php/produto/all'
        }).done(function (retorno) {
            var qtd_paineis = document.getElementById('qtd_inversores').value
            console.log(parseInt(qtd_paineis) * parseFloat(realDolar(retorno.valor)))
            var valor_total_inversor =  parseInt(qtd_paineis) * parseFloat(realDolar(retorno.valor))
            document.getElementById('produto2_nf').value = valor_total_inversor.toLocaleString('pt-BR',{ minimumFractionDigits: 2  });

        });

    });
});

