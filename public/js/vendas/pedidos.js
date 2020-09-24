var gridDebitostable;
var fornecedorNome;
var valor_debito;
var numero_cobranca;
var id_debito; //id do debito
function template(d){
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

var table = $('#pedidos').DataTable({
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
    order: [[ 0, "desc" ]],
    ajax: {
        url: "/index.php/orcamento/grid",
        data: function (d) {
        }
    },
    columns: [
        {data: "id",name: 'id' },
        {data: 'created_at', name: 'pedidos.created_at'},
        {data: 'faturado_por', name: 'faturado_por',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                if(oData.faturado_por == 1){
                    $(nTd).html("    <span class=\"badge badge-primary\">"+ "Pelo  credenciado</span>")
                }else{
                    $(nTd).html("    <span class=\"badge badge-primary\">" + "Pelo  cliente</span>");
                }
            }
        },
        {data: 'total', name: 'total', "render": function (data) { return parseFloat(data).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})} },
        {data: 'status', name: 'pedido_status.status'},
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








