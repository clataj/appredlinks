import { getUser, deleteUser } from "./endpoints.js"
import { showAlertDelete, showAlertWaiting } from "../helpers.js";

let id = null;

// Post User
let roleId = document.getElementById('role_id');
let searchShow = document.getElementById('searchShow');
let buttonSave = document.getElementById('save-button');
let empresa_id = document.getElementById('empresa_id')

// Post User

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
    form['role_id_edit'].value=data.role_id;
    form['email'].value=data.email;
    if(data.role_id == 2) {
        searchShowEdit.style.display = ''
    }
});

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
