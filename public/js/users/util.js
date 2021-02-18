$("#franquia_id").on('click', function () {

    var roles = '';
    var str = "";

    franquia_id = $('select[name=franquia_id] option:selected').val()

    $.ajax({
        url: "/index.php/consultaGrupos/" + franquia_id ,
        success: function( data ) {
            $.each(data.roles, function (key, val) {
                roles += '<option value="' + key + '">' + val + '</option>';
            });
            $("#role_id").html(roles);
        }
    });
}).change();