$(document).ready(function () {
    $.ajax({
        url: "/index.php/alert/lastForAlerts",
        dataType: "json",
        success: function( alerts ) {
            document.getElementById('lert-count').innerHTML = alerts.length;
            alerts.forEach(function (alert) {
                var meses = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul","Ago","Set","Out","Nov","Dez"];
                var data = new Date(alert.created_at);
                var dataFormatada = ((data.getDate() + " " + meses[(data.getMonth())] + " " + data.getFullYear()));
                var html = '<li>'
                html += '<a class="alert alert-callout alert-warning" href="javascript:void(0);">'
                html +=     '<strong>' + alert.title  + '</strong><br/>'
                html +=     '<small>' +alert.description + '</small>'
                html +=     '<small class="alert-date">' +dataFormatada + '</small>'
                html += '</a>'
                html += '</li>'

                $("#alert-solar ul").append(html);
            })
        }
    });
});








