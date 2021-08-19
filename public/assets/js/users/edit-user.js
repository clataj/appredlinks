// Update User
let roleId = document.getElementById('role_id');
roleId.onchange = (event) => {
    if(event.target.value==2) {
        searchShow.style.display = ''
        buttonSave.onclick = () => {
            var arr_id = []

            $(":checkbox:checked").each(function(i) {
                arr_id[i] = $(this).val()
            })

            if(arr_id.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe seleccionar al menos una empresa para este usuario!',
                })
            }
        }

    } else {
        searchShow.style.display = 'none'
    }
}
