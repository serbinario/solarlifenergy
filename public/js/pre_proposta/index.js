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

var table = $('#preProposta').DataTable({
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
        url: "/index.php/preProposta/grid",
        data: function (d) {
            d.nome = $('input[name=nome]').val();
            d.codigo = $('input[name=codigo]').val();
            d.integrador = $('input[name=integrador]').val();
            d.data_ini = dateToEN($('input[name=data_ini]').val());
            d.data_fim = dateToEN($('input[name=data_fim]').val())  + " 23:59:59";
            d.filtro_por = $("input[name='filtro_por']:checked").val();
        }
    },
    columns: [
        {data: 'id', name: 'id',  targets: 0, visible: false},
        {data: 'nome', name: 'clientes.nome'},
        {data: 'codigo', name: 'codigo'},
        {data: 'preco_medio_instalado', name: 'pre_propostas.preco_medio_instalado'},
        {data: 'data_validade', name: 'pre_propostas.data_validade'},
        {data: 'created_at', name: 'pre_propostas.created_at'},
        {data: 'updated_at', name: 'pre_propostas.updated_at',  targets: 0, visible: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

// Add event listener for opening and closing details
$('#cliente tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( template(row.data()) ).show();
        tr.addClass('shown');
    }
});

$( "#localizar" ).click(function() {
    table.draw();
});


$( "#limpar" ).click(function() {
    $('input[name=nome]').val("");
    $('input[name=data_ini]').val("");
    $('input[name=data_fim]').val("");
    $('input[name=codigo]').val("");
    $('input[name=integrador]').val("");
});

function dateToEN(date)
{
    return date.split('/').reverse().join('-');
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






