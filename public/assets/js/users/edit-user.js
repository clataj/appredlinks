let editButtonUser = document.getElementById('edit-button');
let id = null


$("#table-user").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    let title = '¡Espere, Por favor!';
    let html = 'Cargando informacion...';
    showAlert(title, html);
    let user = await getUser(id);
    const data = user.data;
    Swal.close();
    let form = document.forms['form-user-edit'];
    $("#modalUserEdit").modal('toggle')
    printData(form, data)
});

editButtonUser.onclick = () => {
    let form = document.forms['form-user-edit'];
    updateUser(form, id).then(response => {
        if(response.type == 'validate') {
            let array = []
            for (const errors in response.errors) {
                array.push(response.errors[errors])
            }
            let list = '';
            for (let index = 0; index < array.length; index++) {

                list += "* " + array[index] + '<br>'
            }
            Swal.fire({
                title: "!Error!",
                html: list,
                icon : "error"
            })
        } else {
            $("#table-user").DataTable().ajax.reload(null,false);
            $("#modalUserEdit").modal('toggle')
            Swal.fire({
                title: "!Éxito!",
                text: response.message,
                icon: "success"
            });
        }
    }).catch(err => console.log(err))
}

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

function printData(form, data) {
    form['name'].value=data.name;
    form['email'].value=data.email;
}

async function getUser(id) {
    let data = await fetch(`/users/${id}/edit`);
    return data.json();
}

async function updateUser(form, id) {
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

