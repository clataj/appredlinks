import  { storePublicityInit, updatePublicityInit, changeImageInit } from './publicities.js'

const createPublicityValidator = $('#form-save-publicity').validate({
  submitHandler: function() {
      storePublicityInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      sub_categoria: 'required',
      tipo: 'required',
      nombre: 'required',
      estado: 'required',
      fecha_inicio: 'required',
      fecha_fin: 'required',
      descripcion: 'required',
      img_publicity: 'required',
  },
  highlight: function ( element, errorClass, validClass ) { 
      $( element ).removeClass(errorClass);
      $( element ).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) { 
      $( element ).removeClass('is-invalid');
  }
});

const editPublicityValidator = $('#form-edit-publicity').validate({
  submitHandler: function() {
      updatePublicityInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      sub_categoria: 'required',
      tipo: 'required',
      nombre: 'required',
      estado: 'required',
      fecha_inicio: 'required',
      fecha_fin: 'required',
      descripcion: 'required',
  },
  highlight: function ( element, errorClass, validClass ) { 
      $( element ).removeClass(errorClass);
      $( element ).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) { 
      $( element ).removeClass('is-invalid');
  }
});

const editPublicityImageValidator = $('#form-publicity-edit-image').validate({
  submitHandler: function() {
      changeImageInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
    img_publicity: 'required',
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
      input.classList.remove('is-invalid');
      input.value = '';
  });

  // reset forms
  createPublicityValidator.resetForm();
  editPublicityValidator.resetForm();
  editPublicityImageValidator.resetForm();
});