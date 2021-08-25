import { jqValidationDefaultOptions } from "../helpers.js";
import { storeProfileInit, updateProfileCredentialsInit } from "./profile.js";

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

const updateCredentialsValidator = $("#form-credentials").validate({
    ...jqValidationDefaultOptions(),
    rules: {
        password: 'required',
        newpassword: 'required',
        repassword: {
            required: true,
            equalTo: "#newpassword"
        },
    },
    submitHandler: function() {
        updateProfileCredentialsInit()
    }
})
