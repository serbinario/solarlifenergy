$(document).ready(function(){
    $('.lancamentos-note').hide()
    $('.lancamentos-repeat').hide()
});

document.getElementById('btn-receita').addEventListener('click', function (ev) {
    $('#formModalReceita').modal()
    var data_vencimento = new Date();
    var dataFormatada = ((data_vencimento.getDate() + "/" + (data_vencimento.getMonth()+1) + "/" + data_vencimento.getFullYear()));
    document.querySelector('#formModalReceita [name=\"data_vencimento\"]').value = dataFormatada



    $.ajax({
        url: "/index.php/financeiro/paramsdefault",
        dataType: "json",
        success: function( result ) {
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
    var category = $('form[name=modalDespesa] [data-category-value]').attr("data-category-value");
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
            $('#formModalReceita').modal('toggle');
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


$("input[name='category-receitas']").click(function (event) {
    document.querySelector('.zze-component_popover').style.display = 'block'

})

function handleCategoryReceita(event) {
    $("input[name='category-receitas']").val(event.target.innerText)
    $("input[name='category-receitas']").focus()
    var dataCategoryValue = document.querySelector("[data-category-value")
    dataCategoryValue.setAttribute('data-category-value', event.target.dataset.value)
    dataCategoryValue.setAttribute('value', event.target.dataset.value)
    document.querySelector('.receitas .zze-component_popover').style.display = 'none'
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
    var category = $('form[name=modalDespesa] [data-category-value]').attr("data-category-value");
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
            $('#formModalDespesa').modal('toggle');
        } else {
            swal("Error", "Click no botão abaixo!", "error");
        }
    });
})

document.getElementById('btn-despesa').addEventListener('click', function (ev) {
    $('#formModalDespesa').modal()

    var data_vencimento = new Date();
    var dataFormatada = ((data_vencimento.getDate() + "/" + (data_vencimento.getMonth()+1) + "/" + data_vencimento.getFullYear()));
    document.querySelector('#formModalDespesa [name=\"data_vencimento\"]').value = dataFormatada

    $.ajax({
        url: "/index.php/financeiro/paramsdefault",
        dataType: "json",
        success: function( result ) {
            document.querySelectorAll('.contas')[0].innerHTML = ''
            document.querySelectorAll('.contas')[1].innerHTML = ''
            $('.contas').append('<option></option>')
            result.contas.forEach(function (param) {
                $('.contas').append('<option value=' + param.id + ">"+ param.name + '</option>')
            })
        }
    });
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

        var despesas = result.categories.filter((categoria) => {
            return categoria.category_id == 11 && categoria.group != 1;
        })

        var grupos = result.categories.filter((categoria) => {
            return categoria.category_id == 11 && categoria.group == 1;
        })

        grupos.map(function (item) {
            //console.log(item)
            var element = document.createElement('li')
                element.setAttribute('data-group', item.id)
                element.setAttribute("onclick", "handleCategory(event)");

            document.querySelector('.despesas .popover-content').appendChild(element);
            element.innerHTML = item.name
        })

        $.each(despesas, function (key, value) {
            var newOptGroup = value.parent_id; // use cat_group

            var element = document.createElement('li')
            element.setAttribute('class', "sub-category") // use cat_group
            element.setAttribute('data-value', value.id) // use cat_group
            element.setAttribute("onclick", "handleCategory(event)");
            element.innerHTML = value.name
            console.log('.despesas '+ ' [data-group=' + '"' + newOptGroup  + '"' + ' ]')
            var grupo = document.querySelector('.despesas '+ ' [data-group=' + '"' + newOptGroup  + '"' + ' ]')
            grupo.after(element)
        });



        var receitas = result.categories.filter((categoria) => {
            return categoria.category_id == 12 && categoria.group != 1;
        })

        var grupos = result.categories.filter((categoria) => {
            return categoria.category_id == 12 && categoria.group == 1;
        })

        grupos.map(function (item) {
            //console.log(item)
            var element = document.createElement('li')
            element.setAttribute('data-group', item.id)
            element.setAttribute("onclick", "handleCategory(event)");
            document.querySelector('.receitas .popover-content').appendChild(element);
            element.innerHTML = item.name
        })

        $.each(receitas, function (key, value) {
            var newOptGroup = value.parent_id; // use cat_group
            var element = document.createElement('li')
            element.setAttribute('class', "sub-category") // use cat_group
            element.setAttribute('data-value', value.id) // use cat_group
            element.setAttribute("onclick", "handleCategoryReceita(event)");
            element.innerHTML = value.name
            var grupo = document.querySelector('.receitas '+ ' [data-group=' + '"' + newOptGroup  + '"' + ' ]')
            grupo.after(element)

        });
    }
});

$("input[name='category']").click(function (event) {
    document.querySelector('.despesas .zze-component_popover').style.display = 'block'

})

function handleCategory(event) {
    $("input[name='category']").val(event.target.innerText)
    $("input[name='category']").focus()
    var dataCategoryValue = document.querySelector("[data-category-value")
    dataCategoryValue.setAttribute('data-category-value', event.target.dataset.value)
    dataCategoryValue.setAttribute('value', event.target.dataset.value)
    document.querySelector('.despesas .zze-component_popover').style.display = 'none'

}



