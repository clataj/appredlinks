let token = document.getElementById('token').value;
let deleteButton = document.getElementById('delete-button');

$("#table-category").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    $("#modalDelete").modal('toggle')
    deleteButton.onclick = () => {
        deleteCategory(id)
    }
})

function deleteCategory(id) {
    fetch(`/categories/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : token
        },
    }).then(res => res.json())
    .then(response => {
        $("#table-category").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "!Éxito!",
            text: `Categoria ${response.nombre} eliminada éxitosamente`,
            icon: "success"
        });
        $("#modalDelete").modal('toggle')
    }).catch(error => console.log(error))
}
