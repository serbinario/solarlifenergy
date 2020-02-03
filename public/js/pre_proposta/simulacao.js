
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

    produto6_nf =  $('input[name=produto6_nf]').val()
    produto7_nf = $('input[name=produto7_nf]').val()
    produto8_nf = $('input[name=produto8_nf]').val()
    produto9_nf = $('input[name=produto9_nf]').val()
    produto10_nf = $('input[name=produto10_nf]').val()
    produto11_nf = $('input[name=produto11_nf]').val()
    //console.log(realDolar(produto1_nf));
    soma_equipamentos =  parseFloat(realDolar(produto1_nf)) + parseFloat(realDolar(produto2_nf)) + parseFloat(realDolar(produto3_nf)) + parseFloat(realDolar(produto4_nf)) + parseFloat(realDolar(produto5_nf))
    soma_servico_operacional =  parseFloat(realDolar(produto6_nf)) + parseFloat(realDolar(produto7_nf)) + parseFloat(realDolar(produto8_nf)) + parseFloat(realDolar(produto9_nf)) + parseFloat(realDolar(produto10_nf)) + parseFloat(realDolar(produto11_nf))
    somatotal = soma_equipamentos + soma_servico_operacional


    $('input[name=preco_medio_instalado]').val(formatMoney(somatotal))
    $('.span_preco_medio_instalado span').text('R$ ' + formatMoney(somatotal))
    $('.total_servico_operacional span').text('R$ ' + formatMoney(soma_servico_operacional))
    $('.total_equipamentos span').text('R$ ' + formatMoney(soma_equipamentos))


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
    //console.log(produto3_nf)
    $('input[name=produto3_nf]').val(formatMoney(produto3_nf))

    //4 - STRING BOX
    qtd_string_box = $('input[name=qtd_string_box]').val()
    produto4_preco = (produto1_nf + produto2_nf + produto3_nf) * 0.03
    $('input[name=produto4_preco]').val(formatMoney(produto4_preco))
    produto4_nf = qtd_string_box * produto4_preco
    //console.log(produto4_nf)
    $('input[name=produto4_nf]').val(formatMoney(produto4_nf))

    //5 - KIT MONITORAMENTO WIFI
    qtd_kit_monitoramento = $('input[name=qtd_kit_monitoramento]').val()
    produto5_preco = (produto1_nf + produto2_nf + produto3_nf) * 0.01
    $('input[name=produto5_preco]').val(formatMoney(produto5_preco))
    produto5_nf = qtd_kit_monitoramento * produto5_preco
    //console.log(produto5_nf)
    $('input[name=produto5_nf]').val(formatMoney(produto5_nf))

}
/*
/ Serviços Operacionais
 */
$("#produto6_preco, #qtd_homologacao").on('change', function () {
    qtd_homologacao = $('input[name=qtd_homologacao]').val()
    produto6_preco = $('input[name=produto6_preco]').val()
    produto6_nf = qtd_homologacao * realDolar(produto6_preco)
    $('input[name=produto6_nf]').val(formatMoney(produto6_nf))
    total()
}).change();

$("#produto7_preco, #qtd_mao_obra").on('change', function () {
    qtd_mao_obra = $('input[name=qtd_mao_obra]').val()
    produto7_preco = $('input[name=produto7_preco]').val()
    produto7_nf = qtd_mao_obra * realDolar(produto7_preco)
    $('input[name=produto7_nf]').val(formatMoney(produto7_nf))
    total()
}).change();

$("#produto8_preco, #qtd_inst_pde").on('change', function () {
    qtd_inst_pde = $('input[name=qtd_inst_pde]').val()
    produto8_preco = $('input[name=produto8_preco]').val()
    produto8_nf = qtd_inst_pde * realDolar(produto8_preco)
    $('input[name=produto8_nf]').val(formatMoney(produto8_nf))
    total()
}).change();

$("#produto9_preco, #qtd_mud_pde").on('change', function () {
    qtd_mud_pde = $('input[name=qtd_mud_pde]').val()
    produto9_preco = $('input[name=produto9_preco]').val()
    produto9_nf = qtd_mud_pde * realDolar(produto9_preco)
    $('input[name=produto9_nf]').val(formatMoney(produto9_nf))
    total()
}).change();

$("#produto10_preco, #qtd_substacao").on('change', function () {
    qtd_substacao = $('input[name=qtd_substacao]').val()
    produto10_preco = $('input[name=produto10_preco]').val()
    produto10_nf = qtd_substacao * realDolar(produto10_preco)
    $('input[name=produto10_nf]').val(formatMoney(produto10_nf))
    total()
}).change();

$("#produto11_preco, #qtd_refor_estrutura").on('change', function () {
    qtd_refor_estrutura = $('input[name=qtd_refor_estrutura]').val()
    produto11_preco = $('input[name=produto11_preco]').val()
    produto11_nf = qtd_refor_estrutura * realDolar(produto11_preco)
    $('input[name=produto11_nf]').val(formatMoney(produto11_nf))
    total()
}).change();