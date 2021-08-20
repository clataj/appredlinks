import { storeCategoryInit, updateCategoryInit, changeImageInit } from './categories.js'

const createCategoryValidator = $('#form-category').validate({
  submitHandler: function() {
      storeCategoryInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      name: 'required',
      status: 'required',
      image_category: 'required',
  },
  highlight: function ( element, errorClass, validClass ) { 
      $( element ).removeClass(errorClass);
      $( element ).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) { 
      $( element ).removeClass('is-invalid');
  }
});

const editCategoryValidator = $('#form-category-edit').validate({
    submitHandler: function() {
        updateCategoryInit();
    },
    errorElement: 'div',
    lang: 'es',
    errorClass: "invalid-feedback",
    rules: {
        name: 'required',
        status: 'required',
    },
    highlight: function ( element, errorClass, validClass ) { 
        $( element ).removeClass(errorClass);
        $( element ).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) { 
        $( element ).removeClass('is-invalid');
    }
});

const editCategoryImageValidator = $('#form-category-edit-image').validate({
    submitHandler: function() {
        changeImageInit();
    },
    errorElement: 'div',
    lang: 'es',
    errorClass: "invalid-feedback",
    rules: {
        image_category: 'required',
    },
    highlight: function ( element, errorClass, validClass ) { 
        $( element ).removeClass(errorClass);
        $( element ).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) { 
        $( element ).removeClass('is-invalid');
    }
});

$('.modal').on('hidden.bs.modal', function() {
    const inputs = $( this ).find('input, select');
    [...inputs].forEach(input => {
        input.classList.remove('is-invalid')
        input.value = '';
    });

    // reset forms
    createCategoryValidator.resetForm();
    editCategoryValidator.resetForm();
    editCategoryImageValidator.resetForm();
});