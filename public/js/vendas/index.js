
var numeros = [1, 2, 3, 4, 5]; //vetor original

var quadrados = numeros.map(function(item){
    return Math.pow(item, 2); //retorna o item original elevado ao quadrado
});

var products;

function addCellInversores(inversores) {
    var table_inversores = document.getElementById("table_inversores");
    inversores.map(function (inversor) {
        var row = table_inversores.insertRow(0);
        row.id = inversor.id;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell4.className = 'text-right'

        cell1.innerHTML = "<input style=\"width: 54px;\" type=\"number\" value=\"1\"/>";
        cell2.innerHTML = inversor.produto;
        cell3.innerHTML = inversor.preco_revenda;
        cell4.innerHTML = "<button type=\"button\" class=\"btn btn-succes\"  data-placement=\"top\" data-original-title=\"Edit row\"><i class=\"glyphicon glyphicon-plus\"></i></button>";
    })
}

function addCellModulos(products) {
    var table_modulos = document.getElementById("table_modulos");
    products.map(function (product) {
        var row = table_modulos.insertRow(0);
        row.id = product.id;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell4.className = 'text-right'

        cell1.innerHTML = "<input style=\"width: 54px;\" type=\"number\" value=\"1\"/>";
        cell2.innerHTML = product.produto;
        cell3.innerHTML = product.preco_revenda;
        cell4.innerHTML = "<button type=\"button\" class=\"btn btn-succes\"  data-placement=\"top\" data-original-title=\"Edit row\"><i class=\"glyphicon glyphicon-plus\"></i></button>";
    })
}


function addCellEstrutura(products) {
    var table_estrutura = document.getElementById("table_estrutura");
    products.map(function (product) {
        var row = table_estrutura.insertRow(0);
        row.id = product.id;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell4.className = 'text-right'

        cell1.innerHTML = "<input style=\"width: 54px;\" type=\"number\" value=\"1\"/>";
        cell2.innerHTML = product.produto;
        cell3.innerHTML = product.preco_revenda;
        cell4.innerHTML = "<button type=\"button\" class=\"btn btn-succes\"  data-placement=\"top\" data-original-title=\"Edit row\"><i class=\"glyphicon glyphicon-plus\"></i></button>";
    })
}

function addCellEletrica(products) {
    var table_eletrica = document.getElementById("table_eletrica");
    products.map(function (product) {
        var row = table_eletrica.insertRow(0);
        row.id = product.id;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        cell4.className = 'text-right'

        cell1.innerHTML = "<input style=\"width: 54px;\" type=\"number\" value=\"1\"/>";
        cell2.innerHTML = product.produto;
        cell3.innerHTML = product.preco_revenda;
        cell4.innerHTML = "<button type=\"button\" class=\"btn btn-succes\"  data-placement=\"top\" data-original-title=\"Edit row\"><i class=\"glyphicon glyphicon-plus\"></i></button>";
    })
}

function checkModulos(grupo) {
    return grupo.grupo_id == 1;
}
function checkInversores(grupo) {
    return grupo.grupo_id == 2;
}
function checkEstrutura(grupo) {
    return grupo.grupo_id == 3;
}
function checkEletrica(grupo) {
    return grupo.grupo_id == 4;
}

function getAllProducts(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.getElementsByName("_token")[0].value

        }
    });
    jQuery.ajax({
        type: 'GET',
        url: '/index.php/pedido/getallproducts',
        datatype: 'json',
    }).done(function (retorno) {
       products = retorno
        var modulos = products.filter(checkModulos)
        var inversores = products.filter(checkInversores)
        var estrutura = products.filter(checkEstrutura)
        var eletrica = products.filter(checkEletrica)
        addCellInversores(inversores)
        addCellModulos(modulos)
        addCellEstrutura(estrutura)
        addCellEletrica(eletrica)
    });

};

products = getAllProducts();

