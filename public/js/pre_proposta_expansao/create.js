$(document).ready(function () {



    //Simular
    document.getElementById('simular').addEventListener("click", simular);

    function simular(){
        var monthly_usage = document.getElementById('monthly_usage').value
        var estado_id = $('select[name=estado_id] option:selected').val()
        var cidade_id = $('select[name=cidade_id] option:selected').val()
        var modulo_id = $('select[name=modulo_id] option:selected').val()
        var qtd_paineis = document.getElementById('qtd_paineis').value
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

            }
        });
        data = {
            'monthly_usage': monthly_usage,
            'estado_id': estado_id,
            'cidade_id': cidade_id,
            'modulo_id': modulo_id,
            'qtd_paineis': qtd_paineis
        }

        jQuery.ajax({
            type: 'POST',
            url: '/index.php/simulador',
            datatype: 'json',
            data: data,
        }).done(function (retorno) {
            if(retorno.success) {
                document.getElementById('max_one_payment').innerHTML = "R$ " + formatMoney(retorno.total_nvestimento)
                document.getElementById('min_area').innerHTML = retorno.area_minima
                document.getElementById('installed_power').innerHTML = retorno.wkp
                document.getElementById('modulos').innerHTML = retorno.qtd_modulos
                document.getElementById('simulator').style.display = 'flex';
            } else {
                swal("Error", "Click no botão abaixo!", "error");
            }
        });
    }




    function formatMoney(n, c, d, t) {
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }


    $('#monthly_usage').change(function (e) {
        console.log("wwwwwwwww")
    })

});
