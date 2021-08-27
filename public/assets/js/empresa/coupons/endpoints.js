export async function getCoupon(id) {
    let data = await fetch(`/coupons/${id}/show`)
    return data.json()
}

export async function storeCoupon(form) {
    let texto = form['nombre'].value

    let empresa_id = form['empresa_id'].value

    let cant_x_usua = form['cant_x_usua'].value

    let fechaInicio = form['fecha_inicio'].value

    let hora_inicio = form['hora_inicio'].value

    let dateTime = moment(fechaInicio + ' ' + hora_inicio, 'YYYY-MM-DD HH:mm:ss')

    let fecha_inicio = dateTime.format('Y-MM-DD HH:mm:ss')

    let fechaFin = form['fecha_fin'].value
    let hora_fin = form['hora_final'].value

    let dateTimeEnd = moment(fechaFin + ' ' + hora_fin, 'YYYY-MM-DD HH:mm:ss')
    let fecha_fin = dateTimeEnd.format('Y-MM-DD HH:mm:ss')


    let descripcion = form['descripcion'].value

    let response = await fetch('/coupons', {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        body: JSON.stringify({
            texto : texto,
            empresa_id : empresa_id,
            cant_x_usua : cant_x_usua,
            fecha_inicio : fecha_inicio,
            fecha_fin : fecha_fin,
            descripcion : descripcion
        })
    })
    return response.json()
}

export async function updateCoupon(form, id) {
    let texto = form['nombre'].value

    let empresa_id = form['empresa_id'].value

    let cant_x_usua = form['cant_x_usua'].value


    let fechaInicio = form['fecha_inicio'].value

    let hora_inicio = form['hora_inicio'].value

    let dateTime = moment(fechaInicio + ' ' + hora_inicio, 'YYYY-MM-DD HH:mm:ss')

    let fecha_inicio = dateTime.format('Y-MM-DD HH:mm:ss')

    let fechaFin = form['fecha_fin'].value
    let hora_fin = form['hora_final'].value

    let dateTimeEnd = moment(fechaFin + ' ' + hora_fin, 'YYYY-MM-DD HH:mm:ss')
    let fecha_fin = dateTimeEnd.format('Y-MM-DD HH:mm:ss')


    let descripcion = form['descripcion'].value

    let response = await fetch(`/coupons/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        body: JSON.stringify({
            texto : texto,
            empresa_id : empresa_id,
            cant_x_usua : cant_x_usua,
            fecha_inicio : fecha_inicio,
            fecha_fin : fecha_fin,
            descripcion : descripcion
        })
    })
    return response.json()
}

export function couponDisabled(id) {
    fetch(`/coupons/${id}/disabled`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        }
    })
    .then(res => res.json())
    .then(response => {
        $("#table-coupons").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "Desactivado!",
            text: `Cupon ${response.texto} ha sido desactivado`,
            icon: "success"
        });
    })
}

export function couponEnabled(id) {
    fetch(`/coupons/${id}/enabled`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        }
    })
    .then(res => res.json())
    .then(response => {
        $("#table-coupons").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "Activado!",
            text: `Cupon ${response.texto} ha sido activado`,
            icon: "success"
        });
    })
}
