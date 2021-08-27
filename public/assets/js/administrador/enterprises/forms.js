import {
    storeEnterpriseInit,
    updateEnterpriseInit,
    changeImageBackgroundInit,
    changeImageContentInit
} from "./enterprises.js";
import { jqValidationDefaultOptions } from "../../helpers.js";

const createEnterpriseValidator = $("#form-enterprise").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        nombre_comercial: "required",
        categoria_id: "required",
        ruc: {
            required: true,
            digits: true
        },
        razon_social: "required",
        beneficio: "required",
        estado: "required",
        direccion: "required",
        limite_cupon: {
            required: true,
            digits: true
        },
        telefono: "required",
        correo: {
            required: false,
            email: true
        },
        website: {
            required: false
        },
        facebook: {
            required: false
        },
        twitter: {
            required: false
        },
        instagram: {
            required: false
        },
        img_fondo: "required",
        img_small: "required"
    },
    submitHandler: function() {
        storeEnterpriseInit();
    }
});

const editEnterpriseValidator = $("#form-enterprise-edit").validate({
    ...jqValidationDefaultOptions(),

    rules: {
        nombre_comercial: "required",
        categoria_id: "required",
        ruc: {
            required: true,
            digits: true
        },
        razon_social: "required",
        beneficio: "required",
        estado: "required",
        limite_cupon: {
            required: true,
            digits: true
        },
        direccion: "required",
        telefono: "required",
        correo: {
            required: false,
            email: true
        },
        website: {
            required: false
        },
        facebook: {
            required: false
        },
        twitter: {
            required: false
        },
        instagram: {
            required: false
        }
    },
    submitHandler: function() {
        updateEnterpriseInit();
    }
});

const editEnterpriseImageBgValidator = $(
    "#form-enterprise-edit-image"
).validate({
    ...jqValidationDefaultOptions(),
    rules: {
        img_enterprise_bg: "required"
    },
    submitHandler: function() {
        changeImageBackgroundInit();
    }
});

const editEnterpriseImageContentValidator = $(
    "#form-enterprise-edit-image-content"
).validate({
    ...jqValidationDefaultOptions(),
    rules: {
        img_enterprise_cont: "required"
    },
    submitHandler: function() {
        changeImageContentInit();
    }
});

$(".modal").on("hidden.bs.modal", function() {
    const inputs = $(this).find("input, select");
    [...inputs].forEach(input => {
        input.classList.remove("is-invalid");
        input.value = "";
    });

    // reset forms
    createEnterpriseValidator.resetForm();
    editEnterpriseValidator.resetForm();
    editEnterpriseImageBgValidator.resetForm();
    editEnterpriseImageContentValidator.resetForm();
});
