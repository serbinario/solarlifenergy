$(document).ready(function () {

    var documento_franquia_id
    var table = $('#documentos').DataTable({
        "stateSave": false,
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
            url: "/index.php/documento/grid",
            data: function (d) {
                d.documento = document.getElementById("documento").value;
                d.franquia_id = $('select[name=franquia_id] option:selected').val();

            }
        },
        columns: [
            {data: 'id', name: 'id', visible: false},
            {data: 'nome', name: 'franquias.nome'},
            {data: 'descricao', name: 'descricao',
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                        "<a target='_blank' href=/storage/" + oData.image + ">" + oData.descricao + ""
                    );
                }
            },
            {data: 'created_at', name: 'documentos.created_at'},

            {data: 'upload', name: 'documentos_upload.image',
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    if(oData.upload == null){
                        $(nTd).html("<span class=\"badge badge-danger\">"+ "Pendente</span>")
                    }else{
                        $(nTd).html(
                            "<a target='_blank' href=/storage/" + oData.upload + "><span class=\"badge badge-primary\">" + "Dispoível" +" </span></a>"
                        );
                    }

                }
            },

            {data: 'upload_created_at', name: 'documentos_upload.created_at'},

            {data: 'status', name: 'documento_status.descricao'},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: '60px'}
        ]
    });

    $( "#localizar" ).click(function() {
        //console.log(document.getElementById("integrador").value);
        table.draw();
    });

});

$('#documentos').on( 'click', '.edit', function (event) {

    if(event.target.id){
        document.getElementById('documento_franquia_id').value = event.target.id
    }else{
        document.getElementById('documento_franquia_id').value = event.target.children[0].id
    }
    $('#formModalUpload').modal();
});


$('#formUpload').on('submit', function(e) {
    e.preventDefault();

    console.log("ssssss")

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    $.ajax({
        url : '/index.php/documentoUpload/upload',
        type : 'POST',
        data : new FormData(this),
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        dataType: 'JSON',
        cache: false,
        success : function(data) {
            $('#documentos').DataTable().ajax.reload();
            $('#formModalUpload').modal('hide');
            console.log(data)
        }
    })
});

