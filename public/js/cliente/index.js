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
    order: [[ 6, "desc" ]],
    ajax: {
        url: "/index.php/cliente/grid",
        data: function (d) {
            d.nome = $('input[name=nome]').val();
            d.data_ini = dateToEN($('input[name=data_ini]').val());
            d.data_fim = dateToEN($('input[name=data_fim]').val())  + " 23:59:59";
            d.filtro_por = $("input[name='filtro_por']:checked").val();
        }
    },
    columns: [
        {data: 'id', name: 'id', targets: 0, visible: false},
        {data: 'nome_empresa', name: 'nome_empresa',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                if(oData.propostas == '0'){
                    $(nTd).html(oData.nome_empresa  + "    <span class=\"badge badge-warning\">" +oData.propostas + "  propostas</span>")
                }else{
                    $(nTd).html(oData.nome_empresa  + "    <span class=\"badge badge-primary\">" +oData.propostas + "  propostas</span>");
                }
            }
        },
        {data: 'nome', name: 'nome', visible: false},
        {data: 'cpf_cnpj', "render": function ( data, type, row ) {
                return '<span id="'+"WW"+'">'+data+'</span>';
            }
        },
        {data: 'email', name: 'email', targets: 0, visible: false},
        {data: 'celular', name: 'celular'},
        {data: 'created_at', name: 'created_at', visible: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    "fnDrawCallback": function( oSettings ) {
        //if ( data.DT_RowAttr ) $.each( data.DT_RowAttr, function( key, value ) {
          //  $(tr).attr( key, value );
        //});
        $('tbody tr').each( function() {

          //  this.setAttribute( 'title', '<span data-toggle="tooltip" title="ssss"</span>' );
        } );
        /* Apply the tooltips */
        table.$('span').tooltip( {
           // placement : 'top',
            html : true } );
    }
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






