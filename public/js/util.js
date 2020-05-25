$("#estado_id").on('click', function () {

    var options_cidades = '';
    var str = "";

    estado_id = $('select[name=estado_id] option:selected').val()

    $.ajax({
        url: "/index.php/consultaCidades/" + estado_id ,
        success: function( data ) {
            $.each(data.cidades, function (key, val) {
                options_cidades += '<option value="' + key + '">' + val + '</option>';
            });
            $("#cidade_id").html(options_cidades);
        }
    });
}).change();

function formatMoney(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function realDolar(valor) {
    valor = valor.replace(/[$.]+/g,"");
    valor = valor.replace(",",".");
    return valor;
}

document.getElementById("calcular_media").addEventListener("click", CalculaMedia);

function CalculaMedia(){

    var jan = document.getElementById("jan").value;
    var feb = document.getElementById("feb").value;
    var mar = document.getElementById("mar").value;
    var apr = document.getElementById("apr").value;
    var may = document.getElementById("may").value;
    var jun = document.getElementById("jun").value;
    var jul = document.getElementById("jul").value;
    var aug = document.getElementById("aug").value;
    var sep = document.getElementById("sep").value;
    var oct = document.getElementById("oct").value;
    var nov = document.getElementById("nov").value;
    var dec = document.getElementById("dec").value;
    var media =
        parseInt(jan)
        + parseInt(feb)
        + parseInt(mar)
        + parseInt(apr)
        + parseInt(may)
        + parseInt(jun)
        + parseInt(jul)
        + parseInt(aug)
        + parseInt(sep)
        + parseInt(oct)
        + parseInt(nov)
        + parseInt(dec)

    document.getElementById("monthly_usage").value = parseInt(media /12)

}

