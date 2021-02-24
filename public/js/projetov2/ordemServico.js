
function criarOsCorretiva(projeto_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

            }
        });
        data = {
            'projeto_id': projeto_id,
            'tipo': 1
        }

        jQuery.ajax({
            type: 'POST',
            url: '/index.php/osCorretiva',
            datatype: 'json',
            data: data,
        }).done(function (retorno) {
            if(retorno.success) {
                swal("", retorno.msg, "success");
                retorno.data.tipo = "Corretiva"
                let html = format(retorno.data)
                $(".listaOrdemServico").append(html);

            } else {

            }
        });
}


function criarOsPreventiva(projeto_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'projeto_id': projeto_id,
        'tipo': 2
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/osPreventiva',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            swal("", retorno.msg, "success");
            retorno.data.tipo = "Preventiva"
            let html = format(retorno.data)
            $(".listaOrdemServico").append(html);

        } else {

        }
    });
}

function criarOsInstalacao(projeto_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'projeto_id': projeto_id,
        'tipo': 3
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/osInstalacao',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            swal("", retorno.msg, "success");
            retorno.data.tipo = "Instalacao"
            let html = format(retorno.data)
            $(".listaOrdemServico").append(html);

        } else {

        }
    });
}


function criarosCorretiva(projeto_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'projeto_id': projeto_id,
        'tipo': tipo
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/ordemServico',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            swal("", retorno.msg, "success");
            console.log(retorno.data);
            let html = format(retorno.data)
            $(".listaOrdemServico").append(html);

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
        '<td>'+d.created_at+'</td>'+
        '<td>'+d.data_visita+'</td>'+
        '<td>'+d.tipo+'</td>'+
        '<td>'+d.status+'</td>'+
        '</tr>'
}



