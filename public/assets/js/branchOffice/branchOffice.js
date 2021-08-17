import { responsePromise, showAlertDelete, showAlertWaiting } from "../helpers.js";
import { deleteBranchOffice, getBranchOffice, storeBranchOffice, updateBranchOffice } from "./endpoints.js";

// Post
let openModalBranchOffice = document.getElementById('openModalBranchOffice');
let saveButton = document.getElementById('save-button');

// Update
let editButton = document.getElementById('edit-button');
let id = null;


// Post BranchOffice
openModalBranchOffice.onclick = () => {
    let form = document.forms['form-save-branch-office']
    form.reset()
}

saveButton.onclick = () => {
    let form = document.forms['form-save-branch-office']
    showAlertWaiting()
    storeBranchOffice(form).then(response => {
        responsePromise(response, "#table-branch-office", "#modalBranchOffice")
    })
}

// Show Info for Update
$("#table-branch-office").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let branchOffice = await getBranchOffice(id)
    const data = branchOffice.data
    Swal.close()
    let form = document.forms['form-edit-branch-office'];
    $("#modalEditBranchOffice").modal('toggle')
    form['ciudad_id'].value=data.ciudad_id;
    form['estado'].value=data.estado;
    form['qr'].value=data.qr;
    form['nombre'].value=data.nombre;
    form['direccion'].value=data.direccion;
    form['telefono'].value=data.telefono;
    form['longitud_map'].value=data.longitud_map;
    form['latitud_map'].value=data.latitud_map;
})

// Update Info
editButton.onclick = () => {
    let form = document.forms['form-edit-branch-office']
    showAlertWaiting()
    updateBranchOffice(form, id).then(response => {
        responsePromise(response, "#table-branch-office", "#modalEditBranchOffice")
    })
}

// Delete BranchOffice
$("#table-branch-office").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deleteBranchOffice(id)
        }
    })
})
