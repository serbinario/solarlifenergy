$(document).ready(function(){
    $('#note').hide()
    $('#repeat').hide()
});

document.getElementById('btn-receita').addEventListener('click', function (ev) {
    $('#formModalReceita').modal()
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




