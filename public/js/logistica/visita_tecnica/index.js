$(document).ready(function () {
    var gridDebitostable;
    var fornecedorNome;
    var valor_debito;
    var numero_cobranca;
    var id_debito; //id do debito

    console.log("wwwwwwwww")

    var table = $('#visita_tecnica').DataTable({
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

            }
        },
        columns: [
            {data: 'id', name: 'id', targets: 0, visible: false},
            {data: 'codigo', name: 'pre_propostas.codigo', targets: 0, visible: true},
            {data: 'nome', name: 'clientes.nome', targets: 0, visible: true},
            {data: 'name', name: 'users.name', targets: 0, visible: true},
            {data: 'status', name: 'status', targets: 0, visible: true},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: '60px'}
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









