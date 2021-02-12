
function pop(e) {
    window.localStorage.setItem('data-title', e.getAttribute("data-title"));

}
if ( window.localStorage.getItem('data-title') === null) {
    $var = 'cliente'
}else{
    $var = window.localStorage.getItem('data-title')
}

$('a[data-title="' + $var + '"]').addClass('active')