$(document).ready(function () {


    $("input[name=cpf_cnpj]").blur(function(){

        //Recupera o id do registro
        var cpf_cnpj = document.getElementById("cpf_cnpj");
        cpf_cnpj  = cpf_cnpj.value;

        console.log(cpf_cnpj)

        //Necessario para que o ajax envie o csrf-token
        //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var dados = {
            'cpf_cnpj': cpf_cnpj
        }

        jQuery.ajax({
            type: 'POST',
            data: dados,
            url: '/index.php/consultaCpfCnpf'
        }).done(function (retorno) {

            if(retorno.success) {
                swal(retorno.msg, "Click no botão abaixo!", "error");
            }
        });

    })


});