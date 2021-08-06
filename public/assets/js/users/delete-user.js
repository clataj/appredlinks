let token = document.getElementById('token').value;
$("#table-user").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    deleteUser(id);
})

function deleteUser(id) {
    fetch(`/users/${id}`, {
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
