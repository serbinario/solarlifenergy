
$("#qtd_paineis").on('change', function () {
    atualizaPaineis()
}).change();
$("#qtd_inversores").on('change', function () {
    //atualizaInversor()
}).change();
$("#qtd_estrutura").on('change', function () {
    //atualizaEstrutura()
}).change();
$("#qtd_string_box").on('change', function () {
    //atualizaString()
}).change();
$("#qtd_kit_monitoramento").on('change', function () {
    //atualizaKit()
}).change();

//1 - MÓDULO FV DAH
$("#produto1_preco, #qtd_paineis").on('change', function () {
    atualizaPaineis()
    total()
}).change();

//2 - INVERSOR KSTAR
$("#produto2_preco, #qtd_inversores").on('change', function () {
    atualizaInversor();
    total()
}).change();

//3 - ESTRUTURA
$("#produto3_preco, #qtd_estrutura").on('change', function () {
    atualizaEstrutura()
    total()
}).change();

//4 - STRING
$("#produto4_preco, #qtd_string_box").on('change', function () {
    atualizaString()
    total()
}).change();

//5 -  KIT MONITORAMENTO WIFI
$("#produto5_preco, #qtd_kit_monitoramento").on('change', function () {
    atualizaKit()
    total()
}).change();

function atualizaPaineis() {
    /*
    * 1 - MÓDULO FV DAH
     */
    qtd_paineis = $('input[name=qtd_paineis]').val()
    produto1_preco = $('input[name=produto1_preco]').val()
    produto1_nf = qtd_paineis * realDolar(produto1_preco)
    $('input[name=produto1_nf]').val(formatMoney(produto1_nf))

    atualizaInversor()

}

function atualizaInversor() {

    //2 - INVERSOR KSTAR
    qtd_inversores = $('input[name=qtd_inversores]').val()
    produto2_preco = $('input[name=produto2_preco]').val()
    produto2_nf = qtd_inversores * realDolar(produto2_preco)
    $('input[name=produto2_nf]').val(formatMoney(produto2_nf))

    atualizaEstrutura()

}

function atualizaEstrutura() {


    //3 - ESTRUTURA
    qtd_estrutura = $('input[name=qtd_estrutura]').val()
    produto3_preco = $('input[name=produto3_preco]').val()
    produto3_preco = realDolar(produto3_preco)
    produto3_nf = qtd_estrutura * produto3_preco
    $('input[name=produto3_nf]').val(formatMoney(produto3_nf))

}

function atualizaString() {


    //4 - STRING BOX
    qtd_string_box = $('input[name=qtd_string_box]').val()
    produto4_preco = $('input[name=produto4_preco]').val()
    produto4_preco = realDolar(produto4_preco)
    produto4_nf = qtd_string_box * produto4_preco
    $('input[name=produto4_nf]').val(formatMoney(produto4_nf))

}

function atualizaKit() {

    //5 - KIT MONITORAMENTO WIFI
    qtd_kit_monitoramento = $('input[name=qtd_kit_monitoramento]').val()
    produto5_preco = $('input[name=produto5_preco]').val()
    produto5_preco = realDolar(produto5_preco)
    produto5_nf = qtd_kit_monitoramento * produto5_preco
    $('input[name=produto5_nf]').val(formatMoney(produto5_nf))

}

function total() {
    produto1_nf =  $('input[name=produto1_nf]').val()
    produto2_nf = $('input[name=produto2_nf]').val()
    produto3_nf = $('input[name=produto3_nf]').val()
    produto4_nf = $('input[name=produto4_nf]').val()
    produto5_nf = $('input[name=produto5_nf]').val()
    console.log(realDolar(produto1_nf));
    somatotal =  parseFloat(realDolar(produto1_nf)) + parseFloat(realDolar(produto2_nf)) + parseFloat(realDolar(produto3_nf)) + parseFloat(realDolar(produto4_nf)) + parseFloat(realDolar(produto5_nf))
    console.log(somatotal)
    $('input[name=preco_medio_instalado]').val(formatMoney(somatotal))

}

$(".atualizar").on('click', function () {
    atualizaCampos()
    total()
}).change();


function atualizaCampos() {
    /*
    * 1 - MÃ“DULO FV DAH
     */
    qtd_paineis = $('input[name=qtd_paineis]').val()
    produto1_preco = $('input[name=produto1_preco]').val()
    produto1_nf = qtd_paineis * realDolar(produto1_preco)
    $('input[name=produto1_nf]').val(formatMoney(produto1_nf))

    //2 - INVERSOR KSTAR
    qtd_inversores = $('input[name=qtd_inversores]').val()
    produto2_preco = qtd_paineis * realDolar(produto1_preco)* 0.35
    $('input[name=produto2_preco]').val(formatMoney(produto2_preco))
    produto2_nf = qtd_inversores * produto2_preco
    $('input[name=produto2_nf]').val(formatMoney(produto2_nf))

    //3 - ESTRUTURA
    qtd_estrutura = $('input[name=qtd_estrutura]').val()
    produto3_preco = produto1_nf * 0.18
    $('input[name=produto3_preco]').val(formatMoney(produto3_preco))
    produto3_nf = qtd_estrutura * produto3_preco
    console.log(produto3_nf)
    $('input[name=produto3_nf]').val(formatMoney(produto3_nf))

    //4 - STRING BOX
    qtd_string_box = $('input[name=qtd_string_box]').val()
    produto4_preco = (produto1_nf + produto2_nf + produto3_nf) * 0.03
    $('input[name=produto4_preco]').val(formatMoney(produto4_preco))
    produto4_nf = qtd_string_box * produto4_preco
    console.log(produto4_nf)
    $('input[name=produto4_nf]').val(formatMoney(produto4_nf))

    //5 - KIT MONITORAMENTO WIFI
    qtd_kit_monitoramento = $('input[name=qtd_kit_monitoramento]').val()
    produto5_preco = (produto1_nf + produto2_nf + produto3_nf) * 0.01
    $('input[name=produto5_preco]').val(formatMoney(produto5_preco))
    produto5_nf = qtd_kit_monitoramento * produto5_preco
    console.log(produto5_nf)
    $('input[name=produto5_nf]').val(formatMoney(produto5_nf))

}