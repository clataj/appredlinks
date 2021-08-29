import { getEnterprise } from "../enterprises/endpoints.js";
import {
    loadDataEnterprise,
    responsePromise,
    showAlertDisabled,
    showAlertEnabled,
    showAlertWaiting
} from "../../helpers.js";
import {
    couponDisabled,
    couponEnabled,
    getCoupon,
    storeCoupon,
    updateCoupon
} from "./endpoints.js";

let limiteCupones = document.getElementById('limite_cupones')
let infoCupon = document.getElementById('infoCupon')
// Post Coupon

// Edit Coupon
let id = null
let empresaId = document.getElementById('empresaId')

export function storeCouponInit() {
    let form = document.forms['form-save-coupon']
    showAlertWaiting()
    storeCoupon(form).then(response => {
        if(empresaId !== null) {
            getEnterprise(empresaId.value).then(response => {
                const { data } = response
                loadDataEnterprise(data, limiteCupones, infoCupon);
            })
        }
        responsePromise(response, "#table-coupons", "#modalCoupon")
    })
}

// Show Text
$("#table-coupons").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let coupon = await getCoupon(id);
    const data  = coupon.data;
    Swal.close();
    let form = document.forms['form-coupon-edit'];
    $("#modalEditCoupon").modal('toggle')
    form['nombre'].value = data.texto

    // Numero de cupones de rol Empresa
    let numCupon = document.getElementById('num-cupon-edit')
    numCupon.innerText = data.num_cupon

    form['cant_x_usua'].value = data.cant_x_usua
    form['fecha_inicio'].value = moment(data.fecha_inicio).format('YYYY-MM-DD')
    form['hora_inicio'].value = moment(data.fecha_inicio).format('HH:mm:ss')
    form['fecha_fin'].value = moment(data.fecha_fin).format('YYYY-MM-DD')
    form['hora_final'].value = moment(data.fecha_fin).format('HH:mm:ss')
    form['descripcion'].value = data.descripcion
});

export function updateCouponInit() {
    let form = document.forms['form-coupon-edit']
    showAlertWaiting()
    updateCoupon(form, id).then(response => {
        responsePromise(response, "#table-coupons", "#modalEditCoupon")
    })
}

// Coupon Disabled
$("#table-coupons").DataTable().on('click', 'button.desactivate', async function() {
    id = $(this).attr('id');
    showAlertDisabled().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            couponDisabled(id)
        }
    })
})

// Coupon Disabled
$("#table-coupons").DataTable().on('click', 'button.activate', async function() {
    id = $(this).attr('id');
    showAlertEnabled().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            couponEnabled(id)
        }
    })
})

window.addEventListener('load', async function(){
    if(empresaId !== null) {
        const { data } = await getEnterprise(empresaId.value)
        loadDataEnterprise(data, limiteCupones, infoCupon);
    }
})
