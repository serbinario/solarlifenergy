$(document).ready(function () {

    var table = $('#visita_tecnica_arquivadas').DataTable({
        "dom": 'lCfrtip',
        "order": [],
        "colVis": {
            "buttonText": "Colunas",
            "overlayFade": 0,
            "align": "right"
        },
        "searching": false,
        "bLengthChange": false,
        processing: true,
        serverSide: true,
        bFilter: true,
        order: [[0, "desc"]],
        ajax: {
            url: "/index.php/visitaTecnica/grid",
            data: function (d) {
                d.arquivado = 1;
                d.nome = document.getElementById("nome").value;
                d.status_visita_id = $('select[name=status_visita_id] option:selected').val();
                d.integrador = document.getElementById("integrador").value;
            }
        },
        columns: [
            {data: 'id', name: 'id', targets: 0, visible: false},
            {data: 'codigo', name: 'pre_propostas.codigo', targets: 0, visible: true},
            {data: 'nome_empresa', name: 'clientes.nome_empresa', targets: 0, visible: true},
            {data: 'name', name: 'users.name', targets: 0, visible: true},
            {data: 'data_cadastro', name: 'data_cadastro', targets: 0, visible: true},
            {data: 'data_previsao', name: 'vt.data_previsao', targets: 0, visible: false},
            {data: 'data_visita', name: 'vt.data_visita', targets: 0, visible: false},
            {data: 'status', name: 'status', targets: 0, visible: true},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: '120px'}
        ]
    });

    var mascara = function (val) {
        return $('val.cpf_cnpj').mask('00.000.000/0000-00')
    }

    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    var cpfMascara = function (val) {
            return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
        },
        cpfOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(cpfMascara.apply({}, arguments), options);
            }
        };
    $('.mascara-cpfcnpj').mask(cpfMascara, cpfOptions);



    $(document).on('click', '#editModalContrato', function(){
        $('#modalContrato').modal();
    });

    $( "#localizar" ).click(function() {
        //console.log(document.getElementById("integrador").value);
        table.draw();
    });

    function formatMoney(n, c, d, t) {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
})

function arquivarVisitaTecnica(arquivar_id){
    swal({
            title: "Desarquivar Visita Técnica?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim, Arquivar!",
            cancelButtonText: "Não, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

                    }
                });
                data = {
                    'id': arquivar_id,
                    'arquivar': "0"
                }

                jQuery.ajax({
                    type: 'POST',
                    url: '/index.php/arquivarVisitaTecnica',
                    datatype: 'json',
                    data: data,
                }).done(function (retorno) {
                    if(retorno.success) {
                        swal("", retorno.msg, "success");
                        $('#visita_tecnica_arquivadas').DataTable().ajax.reload();

                    } else {
                        swal("Error", "Click no botão abaixo!", "error");
                    }
                });
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
}








