import { storeUser, updateUser, getUser, deleteUser } from "./endpoints.js"
import { responsePromise, showAlertDelete, showAlertWaiting } from "../helpers.js";

let id = null;

// Post User
let openModal = document.getElementById('openModal');
let saveButtonUser = document.getElementById('save-button');
let roleId = document.getElementById('role_id');
let searchShow = document.getElementById('searchShow');

// Edit User
let editButtonUser = document.getElementById('edit-button');

// Post User

roleId.onchange = (event) => {
    if(event.target.value==2) {
        searchShow.style.display = ''
        $('.searchEnterprise').empty()
        $('.searchEnterprise').select2({
            theme: 'bootstrap4',
            placeholder: 'Busque una empresa',
            language:{
                noResults: function(){
                    return "No hay resultados";
                },
                searching: function(){
                    return "Buscando..";
                },
            },
            ajax: {
                url: '/publicities/enterprises',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nombre_comercial,
                                id:item.id
                            }
                        })
                    };
                },
                cache: true
            },
        });
    } else {
        searchShow.style.display = 'none'
    }
}

openModal.onclick = () => {
    let form = document.forms['form-user'];
    searchShow.style.display = 'none'
    form.reset();
}

saveButtonUser.onclick = () => {
    let form = document.forms['form-user'];
    showAlertWaiting()
    storeUser(form)
    .then(response => {
        var table = "#table-user"
        var modal = "#modalUser"
        responsePromise(response, table, modal)
    })
    .catch(error => console.log(error))
}

// Edit User

$("#table-user").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let user = await getUser(id);
    const data = user.data;
    Swal.close();
    let form = document.forms['form-user-edit'];
    $("#modalUserEdit").modal('toggle')
    form['name'].value=data.name;
    form['role_id'].value=data.role_id;
    form['email'].value=data.email;
});

editButtonUser.onclick = () => {
    let form = document.forms['form-user-edit'];
    showAlertWaiting()
    updateUser(form, id)
    .then(response => {
        var table = "#table-user"
        var modal = "#modalUserEdit"
        responsePromise(response, table, modal)
    })
    .catch(err => console.log(err))
}

// Delete User
$("#table-user").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete()
    .then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deleteUser(id)
        }
    })

})
