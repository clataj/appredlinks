import { jqValidationDefaultOptions } from "../helpers.js";
import { storeProfileInit } from "./profile.js";

const updateProfileValidator = $("#form-profile").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        name : 'required',
        email: {
            required: true,
            email: true
        }
    },
    submitHandler: function(){
        storeProfileInit()
    }
})
