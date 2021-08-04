let token = document.getElementById('token').value;
debugger
$("#table-user").DataTable().on('click', 'a', function() {
    id = $(this).attr('id');
    deleteUser(id);
})

function showAlert(title, html) {
    Swal.fire({
        title: title,
        html: html,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
}


function deleteUser(id) {
    fetch(`/users/${id}/delete`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : token
        },
    }).then(res => res.json())
    .then(response => {
        $("#table-user").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "!Éxito!",
            text: `Usuario ${response.name} eliminado éxitosamente`,
            icon: "success"
        });
    }).catch(error => console.log(error))
}
