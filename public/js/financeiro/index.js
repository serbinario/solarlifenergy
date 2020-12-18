var gridDebitostable;
var fornecedorNome;
var valor_debito;
var numero_cobranca;
var id_debito; //id do debito

var meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul","Ago","Set","Out","Nov","Dez"];

var dateNow = new Date()
var dataPrev = new Date();
var dataNext;
var dataFilter1;
var dataFilter = new Date();
var dataTitle;
var periodo;

$(document).ready(function(){
    $('.lancamentos-note').hide()
    $('.lancamentos-repeat').hide()
});

function setNavPeriods(event) {
    console.log("< " + event + " periodo "+  periodo)
    if(periodo == 'now' && event == 'prev'){
        var date = removeDays(dataFilter, 1)
        this.dataFilter =  date
        updateTitle(getTitleDay(this.dataFilter))
    }

    if(periodo == 'now' && event == 'next'){
        var date = addDays(dataFilter, 1)
        this.dataFilter =  date
        updateTitle(getTitleDay(this.dataFilter))
    }




    if(periodo == 'month' && event == 'prev'){
        var date = removeMonth(this.dataFilter, 1)
        this.dataFilter =  date
        updateTitle(getTitleMonth(this.dataFilter))
    }
    if(periodo == 'week' && event == 'prev'){
        var date = removeWeek(this.dataFilter)
        this.dataFilter =  removeDays(this.dataFilter, 7)
        updateTitle(getTitleWeek(this.dataFilter))
    }
    console.log(this.dataFilter)
    //table.ajax.reload( addEventClick);
}

function setIntervaloData(periodo) {
    console.log(periodo)
    if(periodo == 'now'){
        dataTitle = getTitleDay(this.dataFilter)
        this.periodo = 'now'
    }
    if(periodo == 'week'){
        dataTitle = getTitleWeek(this.dataFilter)
        this.periodo = 'week'
    }
    if(periodo == 'month'){
        dataTitle = getTitleMonth(this.dataFilter)
        this.periodo = 'month'
    }

    updateTitle(dataTitle)
    //table.ajax.reload( addEventClick);
}
function getTitleDay(date) {
    return ((date.getDate() + " " + meses[(date.getMonth())] + " " + date.getFullYear()))
}

function getTitleMonth(date) {
    return (( meses[(date.getMonth())] + " " + date.getFullYear()))
}

function getTitleWeek(date) {
    var startOfWeek = moment(date).startOf('week').toDate();
    var endOfWeek   = moment(date).endOf('week').toDate();
    return startOfWeek.getDate() + " "+ meses[startOfWeek.getMonth()] + " à "+ endOfWeek.getDate() + " "+ meses[endOfWeek.getMonth()]
}

function removeDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() - days);
    return result;
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
}

function removeWeek(date) {
    var startOfWeek = moment(date).subtract(7,'d').startOf('week').toDate();
    var endOfWeek   = moment(date).subtract(7,'d').endOf('week').toDate();
    return data = {
        'startOfWeek': startOfWeek,
        'endOfWeek': endOfWeek
    } ;
}

function addMonth(date, month) {
    date.setMonth(date.getMonth() - 1);
    return date;
}
function removeMonth(date, month) {
    date.setMonth(date.getMonth() - 1);
    return date;
}



function updateTitle(title) {
    document.querySelector('.zze-period-text').innerHTML = title
}


function template(d){
    //console.log(d);
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
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: false,
    rowGroup: {
        startRender: null,
        endRender: function ( rows, group ) {
            //console.log(rows)
            var data = new Date(group);
            return '<span class=\"zze-date-number\">' + (data.getDate()+1) + '</span>' +
                '<span class=\"zze-date-month\">' + meses[(data.getMonth())] + '</span>'
        },
        dataSrc: 'data_vence'
    },
    ajax: {
        url: "/index.php/financeiro/grid",
        data: function (d) {
            d.dataFilter =  new Date(dataFilter)
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
                        '<span>' +  oData.descricao + '</span>'
                    );
                }
            }
        },
        {data: 'projeto_id', name: 'pg.projeto_id', targets: 0, visible: true},
        {data: 'conta', name: 'conta', targets: 0, visible: true},
        {data: 'valor_parcela', name: 'detalhe.valor_parcela',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                if(oData.tipo_id == 1){
                    $(nTd).html(
                        "<span class=\"text-info text-bold\">" + formatMoney(oData.valor_parcela) + "</span>"
                );
                }else{
                    $(nTd).html(
                    "<span class=\"text-danger text-bold\"> " + "-" + formatMoney(oData.valor_parcela) + "</span>"
                );
                }
            }
        },
        {data: 'data_vence', name: 'data_vence', targets: 0, visible: false, "render": function (data) {
                var data = new Date(data);
                var dataFormatada = ((data.getDate() + " " + meses[(data.getMonth())] + " " + data.getFullYear()));
                return dataFormatada
            }
         },
        {data: 'data_pago', name: 'data_pago', targets: 0, visible: true, "render": function (data) {

                if(data === null){
                    return null
                }
                var data = new Date(data);
                var dataFormatada = ((data.getDate() + " " + meses[(data.getMonth())] + " " + data.getFullYear()));
                return dataFormatada
            }
        },
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

    document.querySelectorAll('.pago').forEach(item => {
        item.addEventListener('click', event => {
            //console.log(event.target.parentNode.parentNode.id)
            updatePago(event.target.parentNode.parentNode.id)
        })
    })
}

function updatePago(id) {

    //console.log(id)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });

    data = {
        'id': id,
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/financeiro/pago',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            table.ajax.reload( addEventClick);
            // location.reload();
        } else {
            swal("Error", "Click no botão abaixo!", "error");
        }
    });
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












