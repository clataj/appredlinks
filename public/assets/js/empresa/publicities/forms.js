import { jqValidationDefaultOptions } from "../../helpers.js";
import {
    storePublicityInit,
    updatePublicityInit,
    changeImageInit
} from "./publicities.js";

const createPublicityValidator = $("#form-save-publicity").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        sub_categoria: "required",
        tipo: "required",
        nombre: "required",
        descripcion: "required",
        img_publicity: "required"
    },
    submitHandler: function() {
        storePublicityInit();
    }
});

const editPublicityValidator = $("#form-edit-publicity").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        sub_categoria: "required",
        tipo: "required",
        nombre: "required",
        estado: "required",
        fecha_inicio: "required",
        fecha_fin: "required",
        descripcion: "required"
    },
    submitHandler: function() {
        updatePublicityInit();
    }
});

const editPublicityImageValidator = $("#form-publicity-edit-image").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        img_publicity: "required"
    },
    submitHandler: function() {
        changeImageInit();
    }
});

$(".modal").on("hidden.bs.modal", function() {
    const inputs = $(this).find("input, select");

    [...inputs].forEach(input => {
        input.classList.remove("is-invalid");
        input.value = "";
    });

    // reset forms
    createPublicityValidator.resetForm();
    editPublicityValidator.resetForm();
    editPublicityImageValidator.resetForm();
});
