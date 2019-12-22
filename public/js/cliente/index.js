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

var table = $('#cliente').DataTable({
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/cliente/grid",
        data: function (d) {
            d.nome = $('input[name=nome]').val();
            d.data_cadadastro_ini = dateToEN($('input[name=data_cadadastro_ini]').val());
            d.data_cadadastro_fim = dateToEN($('input[name=data_cadadastro_fim]').val())  + " 23:59:59";
        }
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'nome', name: 'nome'},
        {data: 'nome_empresa', name: 'nome_empresa'},
        {data: 'cpf_cnpj', "render": function ( data, type, row ) {
                return '<span id="'+"WW"+'">'+data+'</span>';
            }
        },
        {data: 'email', name: 'email'},
        {data: 'celular', name: 'celular'},
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
    $('input[name=data_cadadastro_ini]').val("");
    $('input[name=data_cadadastro_fim]').val("");
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
        onKeyPress: function(val, e, field, options) {
            field.mask(cpfMascara.apply({}, arguments), options);
        }
    };
$('.mascara-cpfcnpj').mask(cpfMascara, cpfOptions);






