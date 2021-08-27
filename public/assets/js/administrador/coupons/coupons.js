import { responsePromise, showAlertDisabled, showAlertEnabled, showAlertWaiting } from "../../helpers.js";
import { getEnterprise } from "../../enterprises/endpoints.js"
import { couponDisabled, couponEnabled, getCoupon, storeCoupon, updateCoupon } from "./endpoints.js"

let openModalCoupon = document.getElementById('openModalCoupon');
// Post Coupon

// Edit Coupon
let id = null

// Post Coupon
openModalCoupon.onclick = () => {
    let form = document.forms['form-save-coupon']
    $('.searchEnterprise').empty()
    $('.searchEnterprise').select2({
        theme: 'bootstrap4',
        placeholder: 'Busque una empresa',
        language:{
            noResults: function(){
                return "No hay resultados";
            },
            searching: function(){
                return "Buscando..";
            },
        },
        ajax: {
            url: '/enterprises/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre_comercial,
                            id:item.id
                        }
                    })
                };
            },
            cache: true
        },
    });
    $(".searchEnterprise").on('select2:select', async function(e) {
        var enterprise = e.params.data
        showAlertWaiting()
        const { data } = await getEnterprise(enterprise.id)
        let numCupon = document.getElementById('num_cupon')
        numCupon.innerText = data.limite_cupon
        Swal.close()
    })
    let numCupon = document.getElementById('num_cupon')
    numCupon.innerText = ''
    form.reset()
}

export function storeCouponInit() {
    let form = document.forms['form-save-coupon']
    showAlertWaiting()
    storeCoupon(form).then(response => {
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

    let numCupon = document.getElementById('num_cupon_edit')
    numCupon.innerText = data.num_cupon

    form['cant_x_usua'].value = data.cant_x_usua

    form['fecha_inicio'].value = moment(data.fecha_inicio).format('YYYY-MM-DD')
    form['hora_inicio'].value = moment(data.fecha_inicio).format('HH:mm:ss')

    form['fecha_fin'].value = moment(data.fecha_fin).format('YYYY-MM-DD')
    form['hora_final'].value = moment(data.fecha_fin).format('HH:mm:ss')


    form['descripcion'].value = data.descripcion
    $('.searchEnterpriseEdit').select2({
        theme: 'bootstrap4',
        placeholder: 'Busque una empresa',
        language:{
            noResults: function(){
                return "No hay resultados";
            },
            searching: function(){
                return "Buscando..";
            },
        },
        ajax: {
            url: '/enterprises/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre_comercial,
                            id:item.id
                        }
                    })
                };
            },
            cache: true
        },
    });
    var enterprise = new Option(data.enterprise.nombre_comercial, data.empresa_id, true, true)
    $(".searchEnterpriseEdit").append(enterprise).trigger('change')

    $(".searchEnterpriseEdit").on('select2:select', async function(e) {
        var enterprise = e.params.data
        showAlertWaiting()
        const { data } = await getEnterprise(enterprise.id)
        let numCupon = document.getElementById('num_cupon_edit')
        debugger
        numCupon.innerText = data.limite_cupon
        Swal.close()
    })
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
