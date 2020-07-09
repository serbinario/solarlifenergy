$(document).ready(function () {

    document.getElementById("copiar_media").addEventListener("click", CopiaMedia);

    function CopiaMedia() {
        const monthly_usage = document.getElementById('monthly_usage').value
        document.querySelectorAll('.fora-da-ponta').forEach(function(el) {
            el.value = monthly_usage;
        })
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




});