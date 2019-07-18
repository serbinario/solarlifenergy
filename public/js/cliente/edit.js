$(document).ready(function () {


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
        $('.mascara-cpfcnpj').unmask();
    });

    //Ao submeter tirar as mascaras
    $("#edit_cliente_form").submit(function (event) {
        $('.mascara-cpfcnpj').unmask();
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


});