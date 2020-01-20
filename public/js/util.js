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