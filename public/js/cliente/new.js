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
                //$("input#cpf_cnpj").val( "" );
            }
        });

    })

    $("input[name=cep]").blur(function(){
        var cep_code = $(this).val();
        if( cep_code.length <= 0 ) return;
        $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
            //$.get("https://viacep.com.br/ws/51170-620/json/?callback=callback_name",
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
                $("input#endereco").val( result.address );
                $("input#estado").val( result.state );
                //alert("Dados recebidos e alterados");
            });
    });


});