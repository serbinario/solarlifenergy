var gridDebitostable;
var fornecedorNome;
var valor_debito;
var numero_cobranca;
var id_debito; //id do debito

function template(d){
    console.log(d);
    //Retirar os "&quot" da array aditivos
    //var aditivos = JSON.parse(d.aditivos.replace(/&quot;/g,'"'))

    var html = "<table class='table table-bordered'>";
    html += "<thead>" +
        "<tr><td>Profile</td><td>Grupo</td></tr>" +
        "</thead>";



    html += "<tr>";
    html += "<td>"  + d.profile + "</td>";
    html += "<td>"  + d.grupo + "</td>";

    html += "</tr>"

    html += "</table>";

    return  html;
}

var table = $('#financeiro').DataTable({
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
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/financeiro/grid",
        data: function (d) {
        }
    },
    columns: [
        {data: 'id', name: 'id', targets: 0, visible: false},


        {data: 'descricao', name: 'pg.descricao',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                if(oData.qtd_parcelas > 1){
                    $(nTd).html(
                        oData.descricao + "  -   " + oData.parcela_numero + "/"+ oData.qtd_parcelas
                    );
                }else{
                    $(nTd).html(
                        oData.descricao
                    );
                }
            }
        },


        {data: 'conta', name: 'conta', targets: 0, visible: true},


        {data: 'valor_parcela', name: 'detalhe.valor_parcela',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                if(oData.tipo_id == 1){
                    $(nTd).html(
                     formatMoney(oData.valor_parcela)
                );
                }else{
                    $(nTd).html(
                     "-" + formatMoney(oData.valor_parcela)
                );
                }
            }
        },
        {data: 'data_vence', name: 'data_vence', targets: 0, visible: true},
        {data: 'data_pago', name: 'data_pago', targets: 0, visible: true},
        {data: 'action', name: 'action', orderable: false, searchable: false}

    ],
    "initComplete": function(settings, json) {

        addEventClick()

    }
});

function addEventClick() {
    document.querySelectorAll('.delete').forEach(item => {
        item.addEventListener('click', event => {
        deletar(event.target.parentNode.parentNode.id)
        })
    })
}

function deletar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });

    swal({
            title: "",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Exluir esse lancamento!",
            cancelButtonText: "Cancelar!",
            closeOnConfirm: false,
            closeOnCancel: false,
            customClass: ".swal-back",
        },
        function(isConfirm) {
            if (isConfirm) {

                data = {
                    'id': id,
                }

                jQuery.ajax({
                    type: 'POST',
                    url: '/index.php/financeiro/destroy',
                    datatype: 'json',
                    data: data,
                }).done(function (retorno) {
                    if(retorno.success) {
                        swal('', retorno.msg, "success");
                        table.ajax.reload( addEventClick);
                       // location.reload();
                    } else {
                        swal("Error", "Click no botão abaixo!", "error");
                    }
                });
            }
        });
}

var mascara = function (val) {
    return $('val.cpf_cnpj').mask('00.000.000/0000-00')
}

$('.cpf').mask('000.000.000-00', {reverse: true});
$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
var cpfMascara = function (val) {
        return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
    },
    cpfOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(cpfMascara.apply({}, arguments), options);
        }
    };
$('.mascara-cpfcnpj').mask(cpfMascara, cpfOptions);

formatMoney = (n, c, d, t) => {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}









