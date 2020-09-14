
var numeros = [1, 2, 3, 4, 5]; //vetor original

var quadrados = numeros.map(function(item){
    return Math.pow(item, 2); //retorna o item original elevado ao quadrado
});