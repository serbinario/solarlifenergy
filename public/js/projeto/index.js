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

var table = $('#projeto').DataTable({
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 0, "desc" ]],
    ajax: {
        url: "/index.php/projeto/grid",
        data: function (d) {
            d.inativo = 'sss';
        }
    },
    columns: [
        {data: 'id', name: 'projetos.id'},
        {data: 'nome', name: 'clientes.nome'},
        {data: 'projeto_codigo', name: 'projetos.projeto_codigo'},
        {data: 'name', name: 'users.name'},
        {data: 'created_at', name: 'created_at'},
        {data: 'kw', name: 'kw'},
        {data: 'prioridade', name: 'prioridade'},
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

$(document).on("keyup", "#localizar", function () {
    table.draw();
});

$(document).on("change", "#status", function () {
    table.draw();
});
$(document).on("change", "#vencimento", function () {
    table.draw();
});

$(document).on("change", "#data_instalacao_fin", function () {
    table.draw();
});

$(document).on("change", "#grupo_id", function () {
    table.draw();
});

$(document).on("change", "#inativo", function () {
    table.draw();


});

function dateToEN(date)
{
    return date.split('/').reverse().join('-');
}





