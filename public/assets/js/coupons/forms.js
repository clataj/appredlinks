import { storeCouponInit, updateCouponInit } from "./coupons.js";
import { jqValidationDefaultOptions } from "../helpers.js";

const createCouponValidator = $("#form-save-coupon").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        empresa_id: "required",
        nombre: "required",
        num_cupon: {
            required: true,
            number: true
        },
        cant_x_usua: {
            required: true,
            number: true
        },
        fecha_inicio: "required",
        hora_inicio: "required",
        fecha_fin: "required",
        hora_final: "required",
        descripcion: "required"
    },
    submitHandler: function() {
        storeCouponInit();
    }
});

const editCouponValidator = $("#form-coupon-edit").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        empresa_id: "required",
        nombre: "required",
        num_cupon: {
            required: true,
            number: true
        },
        cant_x_usua: {
            required: true,
            number: true
        },
        fecha_inicio: "required",
        hora_inicio: "required",
        fecha_fin: "required",
        hora_final: "required",
        descripcion: "required"
    },
    submitHandler: function() {
        updateCouponInit();
    }
});

$(".modal").on("hidden.bs.modal", function() {
    const inputs = $(this).find("input, select");
    [...inputs].forEach(input => {
        input.classList.remove("is-invalid");
        input.value = "";
    });

    // reset forms
    createCouponValidator.resetForm();
    editCouponValidator.resetForm();
});
