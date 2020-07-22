$(document).ready(function () {

    function logSubmit(event) {
        const valor = document.getElementById('preco')
        valor.value = realDolar(valor.value)
    }

    const form = document.getElementById('edit_produto_form');
    form.addEventListener('submit', logSubmit);

})