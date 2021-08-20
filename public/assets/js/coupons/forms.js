import { storeCouponInit, updateCouponInit } from './coupons.js';

function highlight( element, errorClass, validClass ) { 
  $( element ).removeClass(errorClass);
  $( element ).addClass('is-invalid');
}

function unhighlight(element, errorClass, validClass) { 
  $( element ).removeClass('is-invalid');
}

const createCouponValidator = $('#form-save-coupon').validate({
  submitHandler: function() {
      storeCouponInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      empresa_id: 'required',
      nombre: 'required',
      num_cupon: {
        required: true,
        number: true,
      },
      cant_x_usua: {
        required: true,
        number: true,
      },
      fecha_inicio: 'required',
      hora_inicio: 'required',
      fecha_fin: 'required',
      hora_final: 'required',
      descripcion: 'required',
  },
  highlight,
  unhighlight,
});

const editCouponValidator = $('#form-coupon-edit').validate({
  submitHandler: function() {
      updateCouponInit();
  },
  errorElement: 'div',
  lang: 'es',
  errorClass: "invalid-feedback",
  rules: {
      empresa_id: 'required',
      nombre: 'required',
      num_cupon: {
        required: true,
        number: true,
      },
      cant_x_usua: {
        required: true,
        number: true,
      },
      fecha_inicio: 'required',
      hora_inicio: 'required',
      fecha_fin: 'required',
      hora_final: 'required',
      descripcion: 'required',
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
  createCouponValidator.resetForm();
  editCouponValidator.resetForm();
});