import {
    storeCategoryInit,
    updateCategoryInit,
    changeImageInit
} from "./categories.js";
import { jqValidationDefaultOptions } from "../helpers.js";

const createCategoryValidator = $("#form-category").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        name: "required",
        status: "required",
        image_category: "required"
    },
    submitHandler: function() {
        storeCategoryInit();
    }
});

const editCategoryValidator = $("#form-category-edit").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        name: "required",
        status: "required"
    },
    submitHandler: function() {
        updateCategoryInit();
    }
});

const editCategoryImageValidator = $("#form-category-edit-image").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        image_category: "required"
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
    createCategoryValidator.resetForm();
    editCategoryValidator.resetForm();
    editCategoryImageValidator.resetForm();
});
