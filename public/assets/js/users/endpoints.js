export async function getUser(id, enterpriseId = null) {
    let data = await fetch(`/users/${id}/show/${enterpriseId}`);
    return data.json();
}

export function deleteUser(id) {
    fetch(`/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
    })
    .then(res => res.json())
    .then(response => {

        $("#table-user").DataTable().ajax.reload(null,false);
        Swal.fire(
            'Eliminado!',
            `Usuario ${response.name} eliminado correctamente`,
            'success'
        )
    })
    .catch(error => console.log(error))
}

