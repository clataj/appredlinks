import {
    responsePromise,
    showAlertDelete,
    showAlertWaiting,
} from "../helpers.js";
import {
    deleteBranchOffice,
    getBranchOffice,
    storeBranchOffice,
    updateBranchOffice
} from "./endpoints.js";

// Post
let openModalBranchOffice = document.getElementById('openModalBranchOffice');
let empresaId = document.getElementById('empresa_id').value

// Update
let id = null;


// Post BranchOffice
openModalBranchOffice.onclick = () => {
    let form = document.forms['form-save-branch-office']
    form.reset()
}

export function storeBranchOfficeInit() {
    let form = document.forms['form-save-branch-office']
    showAlertWaiting()
    storeBranchOffice(form, empresaId).then(response => {
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
    form['dias_laborales'].value=data.dias_laborales;
    form['dia_no_laboral_1'].value=data.dia_no_laboral_1;
    form['dia_no_laboral_2'].value=data.dia_no_laboral_2;
})

// Update Info
export function updateBranchOfficeInit() {
    let form = document.forms['form-edit-branch-office']
    showAlertWaiting()
    updateBranchOffice(form, id, empresaId).then(response => {
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
