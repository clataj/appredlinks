import { storeEnterpriseInit, updateEnterpriseInit, changeImageBackgroundInit, changeImageContentInit } from './enterprises.js';

function highlight( element, errorClass, validClass ) {
  $( element ).removeClass(errorClass);
  $( element ).addClass('is-invalid');
}

function unhighlight(element, errorClass, validClass) {
  $( element ).removeClass('is-invalid');
}

const createEnterpriseValidator = $('#form-enterprise').validate({
  submitHandler: function() {
      storeEnterpriseInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      nombre_comercial: 'required',
      categoria_id: 'required',
      ruc: {
        required: true,
        digits: true,
      },
      razon_social: 'required',
      beneficio: 'required',
      estado: 'required',
      direccion: 'required',
      limite_cupon: {
        required: true,
        digits: true,
      },
      telefono: 'required',
      correo: {
        required: false,
        email: true,
      },
      website: {
        required: false,
      },
      facebook: {
        required: false,
      },
      twitter: {
        required: false,
      },
      instagram: {
        required: false,
      },
      img_fondo: 'required',
      img_small: 'required',
  },
  highlight,
  unhighlight,
});

const editEnterpriseValidator = $('#form-enterprise-edit').validate({
  submitHandler: function() {
      updateEnterpriseInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      nombre_comercial: 'required',
      categoria_id: 'required',
      ruc: {
        required: true,
        digits: true,
      },
      razon_social: 'required',
      beneficio: 'required',
      estado: 'required',
      limite_cupon: {
        required: true,
        digits: true,
      },
      direccion: 'required',
      telefono: 'required',
      correo: {
        required: false,
        email: true,
      },
      website: {
        required: false,
      },
      facebook: {
        required: false,
      },
      twitter: {
        required: false,
      },
      instagram: {
        required: false,
      },
  },
  highlight,
  unhighlight,
});

const editEnterpriseImageBgValidator = $('#form-enterprise-edit-image').validate({
  submitHandler: function() {
      changeImageBackgroundInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      img_enterprise_bg: 'required',
  },
  highlight,
  unhighlight,
});

const editEnterpriseImageContentValidator = $('#form-enterprise-edit-image-content').validate({
  submitHandler: function() {
      changeImageContentInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      img_enterprise_cont: 'required',
  },
  highlight,
  unhighlight,
});

$('.modal').on('hidden.bs.modal', function() {
  const inputs = $( this ).find('input, select');
  [...inputs].forEach(input => {
      input.classList.remove('is-invalid');
      input.value = '';
  });

  // reset forms
  createEnterpriseValidator.resetForm();
  editEnterpriseValidator.resetForm();
  editEnterpriseImageBgValidator.resetForm();
  editEnterpriseImageContentValidator.resetForm();
});
