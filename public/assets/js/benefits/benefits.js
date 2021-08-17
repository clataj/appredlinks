import { responsePromise, showAlertDelete, showAlertWaiting } from "../helpers.js";
import { deleteBenefit, getBenefit, storeBenefit, updateBenefit } from "./endpoints.js";

// Post
let openModalBenefits = document.getElementById('openModalBenefits');
let saveButton = document.getElementById('save-button');

// Update
let editButton = document.getElementById('edit-button');
let id = null

// Post Benefits
openModalBenefits.onclick = () => {
    let form = document.forms['form-save-benefit']
    form.reset()
}

saveButton.onclick = () => {
    let form = document.forms['form-save-benefit']
    showAlertWaiting()
    storeBenefit(form).then(response => {
        responsePromise(response, "#table-benefits", "#modalBenefits")
    })
}

// Show Info for Update
$("#table-benefits").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let benefit = await getBenefit(id)
    const data = benefit.data
    Swal.close()
    let form = document.forms['form-edit-benefit'];
    $("#modalEditBenefit").modal('toggle')
    form['descripcion'].value=data.descripcion;
})

// Update Info
editButton.onclick = () => {
    let form = document.forms['form-edit-benefit']
    showAlertWaiting()
    updateBenefit(form, id).then(response => {
        responsePromise(response, "#table-benefits", "#modalEditBenefit")
    })
}

// Delete Benefit
$("#table-benefits").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deleteBenefit(id)
        }
    })
})
