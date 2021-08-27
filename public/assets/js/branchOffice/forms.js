import { jqValidationDefaultOptions } from "../helpers.js";
import { storeBranchOfficeInit, updateBranchOfficeInit } from "./branchOffice.js";


const createBranchOfficeValidate = $("#form-save-branch-office").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        nombre: 'required',
        ciudad_id: 'required',
        estado: 'required',
        qr: 'required',
        telefono: 'required',
        direccion: 'required',
        dias_laborales: 'required',
        latitud_map: {
            required: true,
            number: true
        },
        longitud_map: {
            required: true,
            number: true
        }
    },
    submitHandler: function() {
        storeBranchOfficeInit();
    }
})

const updateBranchOfficeValidate = $("#form-edit-branch-office").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        nombre: 'required',
        ciudad_id: 'required',
        estado: 'required',
        qr: 'required',
        telefono: 'required',
        direccion: 'required',
        dias_laborales: 'required',
        latitud_map: {
            required: true,
            number: true
        },
        longitud_map: {
            required: true,
            number: true
        }
    },
    submitHandler: function() {
        updateBranchOfficeInit();
    }
})

$(".modal").on("hidden.bs.modal", function() {
    const inputs = $(this).find("input, select");
    [...inputs].forEach(input => {
        input.classList.remove("is-invalid");
        input.value = "";
    });

    // reset forms
    createBranchOfficeValidate.resetForm();
    updateBranchOfficeValidate.resetForm();
});
