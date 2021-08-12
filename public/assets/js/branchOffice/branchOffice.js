import { responsePromise, showAlertWaiting } from "../helpers.js";
import { storeBranchOffice } from "./endpoints.js";

let openModalBranchOffice = document.getElementById('openModalBranchOffice');
let saveButton = document.getElementById('save-button');
let token = document.getElementById('token').value;
let tableBranchOffice = "#table-branch-office";
let modalCreate = "#modalBranchOffice";

// Post BranchOffice
openModalBranchOffice.onclick = () => {
    let form = document.forms['form-save-branch-office']
    form.reset()
}

saveButton.onclick = () => {
    let form = document.forms['form-save-branch-office']
    showAlertWaiting()
    storeBranchOffice(form).then(response => {
        responsePromise(response, tableBranchOffice, modalCreate)
    })
}
