function toggle(source) {
    console.log("wwwwwwwwwwww")
    checkboxes = document.getElementsByName('permission[]');

    for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
    }
}