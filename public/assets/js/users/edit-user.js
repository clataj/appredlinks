// Update User
let roleId = document.getElementById('role_id');
let searchShow = document.getElementById('searchShow');
roleId.onchange = (event) => {
    if(event.target.value==2) {
        searchShow.style.display = ''
        $("#enterprises").select2({
            placeholder: "SELECCIONE.."
        });
    } else {
        searchShow.style.display = 'none'
    }
}
