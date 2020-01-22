
$("#qtd_paineis, #produto1_preco").on('change', function () {
    atualizaCampos()
}).change();

function atualizaCampos() {
    /*
    * 1 - MÓDULO FV DAH
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