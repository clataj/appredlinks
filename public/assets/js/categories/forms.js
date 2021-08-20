import { storeCategoryInit } from './categories.js'

$('#form-category').validate({
  submitHandler: function() {
      storeCategoryInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  showErrors: function(errorMap, errorList) {
      this.defaultShowErrors();
  },
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