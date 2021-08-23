import { chargeInfo, responsePromise, showAlertDisabled, showAlertEnabled, showAlertWaiting } from "../helpers.js";
import { couponDisabled, couponEnabled, getCoupon, storeCoupon, updateCoupon } from "./endpoints.js";
import { getEnterprise } from "../enterprises/endpoints.js";
let limiteCupones = document.getElementById('limite_cupones')
let openModalCouponByUser = document.getElementById('openModalCouponByUser');
let infoCupon = document.getElementById('infoCupon')
// Post Coupon

// Edit Coupon
let id = null
let empresaId = document.getElementById('empresaId')

// Post Coupon
if(openModalCouponByUser !== null) {

    openModalCouponByUser.onclick = () => {
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
                url: '/publicities/enterprises',
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
        form.reset()
    }
}

export function storeCouponInit() {
    let form = document.forms['form-save-coupon']
    showAlertWaiting()
    storeCoupon(form).then(response => {
        if(empresaId !== null) {
            getEnterprise(empresaId.value).then(response => {
                const { data } = response
                if(data.limite_cupon > 0) {
                    if(data.limite_cupon == 1) {
                        limiteCupones.innerText = `Usted tiene ${data.limite_cupon} un cupon`
                    } else {
                        limiteCupones.innerText = `Usted tiene ${data.limite_cupon} cupones `
                    }
                    chargeInfo()
                } else {
                    let showButtonAdd = document.getElementById('showButtonAdd')
                    showButtonAdd.parentNode.removeChild(showButtonAdd)
                    infoCupon.style.display = ''
                    limiteCupones.innerText = ''
                    infoCupon.innerText = 'Se han agotado los cupones'
                }
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
    form['num_cupon'].value = data.num_cupon
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
            url: '/publicities/enterprises',
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
        if(data.limite_cupon > 0) {
            if(data.limite_cupon == 1) {
                limiteCupones.innerText = `Usted tiene ${data.limite_cupon} un cupon`
            } else {
                limiteCupones.innerText = `Usted tiene ${data.limite_cupon} cupones `
            }
            chargeInfo()
        } else {
            let showButtonAdd = document.getElementById('showButtonAdd')
            if(showButtonAdd !== null) {
                showButtonAdd.parentNode.removeChild(showButtonAdd)
            }
            limiteCupones.innerText = ''
            infoCupon.style.display = ''
            infoCupon.innerText = 'Se han agotado los cupones'
        }
    }
})
