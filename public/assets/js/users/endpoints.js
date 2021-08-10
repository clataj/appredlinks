export async function getUser(id) {
    let data = await fetch(`/users/${id}/edit`);
    return data.json();
}

export async function storeUser(form) {
    let name = form['name'].value;
    let email = form['email'].value;
    let password = form['password'].value;
    let repassword = form['password-confirm'].value
    let token = form['token'].value;

    let object = {
        name : name,
        email : email,
        password : password,
        password_confirmation : repassword
    }

    const response = await fetch(`/users`, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : token
        },
        body: JSON.stringify(object),
    })
    return response.json();
}

export async function updateUser(form, id) {
    let name = form['name'].value;
    let email = form['email'].value;
    let token = form['token'].value;

    let object = {
        name : name,
        email : email,
    }
    const response = await fetch(`/users/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : token
        },
        body: JSON.stringify(object),
    })

    return response.json()
}

export function deleteUser(id, token) {
    fetch(`/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : token
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

