$(document).ready(function(){
    $('.lancamentos-note').hide()
    $('.lancamentos-repeat').hide()
});

document.getElementById('btn-receita').addEventListener('click', function (ev) {
    $('#formModalReceita').modal()

    $.ajax({
        url: "/index.php/financeiro/paramsdefault",
        dataType: "json",
        success: function( result ) {
           // var receita = result.categories.filter((categoria) => {
               // return parseInt(categoria.parent_id) === 12;
           // })

           // document.getElementById('category-receitas').innerHTML = ''
           // $('#category-receitas').append('<option></option>')
           // receita.forEach(function (param) {
              //  $('#category-receitas').append('<option value=' + param.id + ">"+ param.name + '</option>')
            //})

            document.querySelectorAll('.contas')[0].innerHTML = ''
            document.querySelectorAll('.contas')[1].innerHTML = ''
            $('.contas').append('<option></option>')
            result.contas.forEach(function (param) {
                $('.contas').append('<option value=' + param.id + ">"+ param.name + '</option>')
            })
        }
    });
})


document.getElementById('btn-note').addEventListener('click', function (ev) {
    var x = document.getElementById("note");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
})

document.getElementById('btn-repeat').addEventListener('click', function (ev) {
    var x = document.getElementById("repeat");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
})


$('.btn-save-receita').click(function (event) {
    var btn = $(this);
    btn.button('loading');

    var description = $('form[name=modalReceita] input[name=description]').val()
    var projeto_id = $('form[name=modalReceita] input[name=projeto_id]').val()
    var valor = $('form[name=modalReceita] input[name=valor]').val()
    var data_vencimento = $('input[name=data_vencimento]').val()
    var conta = $('form[name=modalReceita] select[name=conta] option:selected').val();
    var category = $('form[name=modalReceita] select[name=category] option:selected').val();
    var lancamento_obs = $('form[name=modalReceita] textarea[name=lancamento_obs]').val()
    var qtd_parcelas = $('form[name=modalReceita] input[name=qtd_parcelas]').val()

    console.log(description, projeto_id, valor, data_vencimento,  conta, category, lancamento_obs, qtd_parcelas)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'description': description,
        'projeto_id': projeto_id,
        'tipo_id': 1,
        'data_vencimento': dateToEN(data_vencimento),
        'valor': realDolar(valor),
        'conta_id': conta,
        'category_id': category,
        'lancamento_obs': lancamento_obs,
        'status_id': 2,
        'qtd_parcelas': qtd_parcelas
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/financeiro',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            swal('', "Cadastro realizado com sucesso", "success");
            btn.button('reset');
            table.ajax.reload( addEventClick);
        } else {
            swal("Error", "Click no botão abaixo!", "error");
        }
    });
})

function realDolar(valor) {
    valor = valor.replace(".","");
    if (valor.length > 10) {
        valor = valor.replace(".","");

    }
    valor = valor.replace(",",".");
    //console.log(valor)
    return valor;
}


/*
Despesas
 */

$('.btn-save-despesa').click(function (event) {
    var btn = $(this);
    btn.button('loading');

    var description = $('form[name=modalDespesa] input[name=description]').val()
    var projeto_id = $('form[name=modalDespesa] input[name=projeto_id]').val()
    var valor = $('form[name=modalDespesa] input[name=valor]').val()
    var data_vencimento = $('form[name=modalDespesa] input[name=data_vencimento]').val()
    var conta = $('form[name=modalDespesa] select[name=conta] option:selected').val();
    var category = $('form[name=modalDespesa] select[name=category] option:selected').val();
    var lancamento_obs = $('form[name=modalDespesa] textarea[name=lancamento_obs]').val()
    var qtd_parcelas = $('form[name=modalDespesa] input[name=qtd_parcelas]').val()

    console.log(description, projeto_id, valor, data_vencimento,  conta, category, lancamento_obs, qtd_parcelas)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    data = {
        'description': description,
        'projeto_id': projeto_id,
        'tipo_id': 2,
        'data_vencimento': dateToEN(data_vencimento),
        'valor': realDolar(valor),
        'conta_id': conta,
        'category_id': category,
        'lancamento_obs': lancamento_obs,
        'status_id': 2,
        'qtd_parcelas': qtd_parcelas
    }

    jQuery.ajax({
        type: 'POST',
        url: '/index.php/financeiro',
        datatype: 'json',
        data: data,
    }).done(function (retorno) {
        if(retorno.success) {
            swal('', "Cadastro realizado com sucesso", "success");
            btn.button('reset');
            table.ajax.reload( addEventClick);
        } else {
            swal("Error", "Click no botão abaixo!", "error");
        }
    });
})

document.getElementById('btn-despesa').addEventListener('click', function (ev) {
    $('#formModalDespesa').modal()

    $.ajax({
        url: "/index.php/financeiro/paramsdefault",
        dataType: "json",
        success: function( result ) {
            //var despesa = result.categories.filter((categoria) => {
               // return parseInt(categoria.parent_id) === 11;
            //})
            //document.getElementById('category-despesas').innerHTML = ''
            //$('#category-despesas').append('<option></option>')
            //despesa.forEach(function (param) {
               // $('#category-despesas').append('<option value=' + param.id + ">"+ param.name + '</option>')
            //)

            document.querySelectorAll('.contas')[0].innerHTML = ''
            document.querySelectorAll('.contas')[1].innerHTML = ''
            $('.contas').append('<option></option>')
            result.contas.forEach(function (param) {
                $('.contas').append('<option value=' + param.id + ">"+ param.name + '</option>')
            })
        }
    });
})

/* Teste para apagar */
document.getElementById('btn-teste').addEventListener('click', function (ev) {
    $('#teste').modal()


})

document.getElementById('btn-note-despesa').addEventListener('click', function (ev) {
    var x = document.getElementById("note-despesa");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
})

document.getElementById('btn-repeat-despesa').addEventListener('click', function (ev) {
    var x = document.getElementById("repeat-despesa");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
})


/*
Teste
 */

$.ajax({
    url: "/index.php/financeiro/paramsdefault",
    dataType: "json",
    success: function( result ) {

        var selectList = $('#category-despesas');

        var despesas = result.categories.filter((categoria) => {
            return parseInt(categoria.category_id) == 11;
        })

        var grupos = despesas.filter((categoria) => {
            return parseInt(categoria.group) == 1;
        })

        grupos.map(function (item) {
            $(document.createElement('optgroup')).attr('value', item.id) // use cat_group
                .attr('label', item.name) // use cat_group
                .appendTo(selectList);
        })

        $.each(despesas, function (key, value) {
            var newElem;
            var newOptGroup = value.parent_id; // use cat_group

            //get the target optgroup
            var targetGroup = $('#' + selectList.attr('id') + ' optgroup[value="' + value.parent_id + '"]');
            //console.log(targetGroup)

            newElem = $(document.createElement('option')).attr('value', value.parent_id) // use item_id
                .attr('label', value.name); // use item_desc

            //create the text node for the option
            var t = $(document.createTextNode(value.name));
            newElem.append(t); //add it to the option
            targetGroup.append(newElem); //add the option to the optgroup

        });


        var selectListReceita = $('#category-receitas');

        var receitas = result.categories.filter((categoria) => {
            return parseInt(categoria.category_id) == 12;
    })

        var grupos = receitas.filter((categoria) => {
            return parseInt(categoria.group) == 1;
    })

        grupos.map(function (item) {
            $(document.createElement('optgroup')).attr('value', item.id) // use cat_group
                .attr('label', item.name) // use cat_group
                .appendTo(selectListReceita);
        })

        $.each(receitas, function (key, value) {
            var newElem;
            var newOptGroup = value.parent_id; // use cat_group

            //get the target optgroup
            var targetGroup = $('#' + selectListReceita.attr('id') + ' optgroup[value="' + value.parent_id + '"]');
            //console.log(targetGroup)

            newElem = $(document.createElement('option')).attr('value', value.parent_id) // use item_id
                .attr('label', value.name); // use item_desc

            //create the text node for the option
            var t = $(document.createTextNode(value.name));
            newElem.append(t); //add it to the option
            targetGroup.append(newElem); //add the option to the optgroup

        });
    }
});



