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

var table = $('#projetov2').DataTable({
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
        url: "/index.php/projetov2/grid",
        data: function (d) {
            d.nome = $('input[name=nome]').val();

        }
    },
    columns: [
        {data: "id",name: 'id' , visible: false },
        {data: 'nome_empresa', name: 'nome_empresa'},
        {data: 'codigo', name: 'codigo', visible: false},
        {data: 'preco_medio_instalado', name: 'preco_medio_instalado', "render": function (data) { return formatMoney(data) }},
        {data: 'potencia_instalada', name: 'potencia_instalada'},

        {data: 'data_financiamento_bancario', name: 'data_financiamento_bancario'},
        {data: 'data_prevista_parcela', name: 'data_prevista_parcela'},

        {data: 'data_prevista', name: 'data_prevista'},
        {data: 'data_conexao', name: 'data_conexao', visible: false},
        {data: 'prioridade_nome', name: 'prioridade_nome', visible: false},
        {data: 'integrador', name: 'integrador'},
        {data: 'franquaia', name: 'franquaia', visible: false},
        {data: 'status_nome', name: 'status_nome'},
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

$('#status').multiselect();


$( "#limpar" ).click(function() {
    $('input[name=nome]').val("");
    $('input[name=data_ini]').val("");
    $('input[name=data_fim]').val("");
    $('input[name=cod_projeto]').val("");
    $('input[name=integrador]').val("");
});

function formatMoney(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function report() {
    var e = document.getElementById('prioridade')
    var prioridade = e.options[e.selectedIndex].value;

    var t = document.getElementById('status')
    var statusText = t.options[t.selectedIndex].text;

   // var s = document.getElementById('status')
    //var status = s.options[s.selectedIndex].value;

    const selected = document.querySelectorAll('#status option:checked');
    const status = Array.from(selected).map(el => el.value);


    //alert(status);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    var dados = {
        'status': status,
        'ordenar1': prioridade
    }
    var url = '/index.php/report/reportProjetos?status=' + status + "&ordenar1=" +  prioridade + "&titulo=" + statusText;
    window.open(url, '_blank');


}








