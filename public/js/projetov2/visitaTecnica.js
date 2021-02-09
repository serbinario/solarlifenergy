
function criarVisitaTecnica(projeto_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

            }
        });
        data = {
            'projeto_id': projeto_id,
        }

        jQuery.ajax({
            type: 'POST',
            url: '/index.php/visitaTecnica',
            datatype: 'json',
            data: data,
        }).done(function (retorno) {
            if(retorno.success) {
                swal("", retorno.msg, "success");

            } else {

            }
        });
}


function listarVisitaTecnica(projeto_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'projeto_id': projeto_id,
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/visitaTecnica/visitaPorProjeto',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {

            let html = ""
            retorno.data.map(function(item){
                html += format(item)
            });
            $(".vt-tr").remove();
            $(".listaVistaPorProjeto").append(html);

        } else {

        }
    });
}

function format ( d ) {
    return '<tr class="vt-tr">'+
        '<td>'+d.codigo+'</td>'+
        '<td>'+d.data_cadastro+'</td>'+
        '<td>'+d.data_visita+'</td>'+
        '<td>'+d.status+'</td>'+
        '</tr>'
}



