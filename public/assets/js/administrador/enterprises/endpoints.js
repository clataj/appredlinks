export async function getEnterprise(id) {
    let data = await fetch(`/enterprises/${id}/show`);
    return data.json()
}

export async function storeEnterprise(form) {
    var formData = new FormData(form)
    let ruc = form['ruc'].value
    let razon_social = form['razon_social'].value
    let beneficio = form['beneficio'].value
    let nombre_comercial = form['nombre_comercial'].value
    let categoria_id = form['categoria_id'].value
    let direccion = form['direccion'].value
    let telefono = form['telefono'].value
    let correo = form['correo'].value
    let twitter = form['twitter'].value
    let facebook = form['facebook'].value
    let instagram = form['instagram'].value
    let website = form['website'].value
    let estado = form['estado'].value
    let ruta_small_2 = form['ruta_small_2'].files[0]
    let ruta_fondo = form['ruta_fondo'].files[0]
    let limite_cupon = form['limite_cupon'].value
    formData.append("ruc", ruc)
    formData.append("razon_soscial", razon_social)
    formData.append("beneficio", beneficio)
    formData.append("nombre_comercial", nombre_comercial)
    formData.append("categoria_id", categoria_id)
    formData.append("direccion", direccion)
    formData.append("telefono", telefono)
    formData.append("correo", correo)
    formData.append("twitter", twitter)
    formData.append("facebook", facebook)
    formData.append("instagram", instagram)
    formData.append("website", website)
    formData.append("estado", estado)
    formData.append("ruta_small_2", ruta_small_2)
    formData.append("ruta_fondo", ruta_fondo)
    formData.append("limite_cupon", limite_cupon)

    let response = await fetch('/enterprises', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()
}

export async function updateEnterprise(form, id) {
    let ruc = form['ruc'].value
    let razon_social = form['razon_social'].value
    let beneficio = form['beneficio'].value
    let nombre_comercial = form['nombre_comercial'].value
    let categoria_id = form['categoria_id'].value
    let direccion = form['direccion'].value
    let telefono = form['telefono'].value
    let correo = form['correo'].value
    let twitter = form['twitter'].value
    let facebook = form['facebook'].value
    let instagram = form['instagram'].value
    let website = form['website'].value
    let estado = form['estado'].value
    let limite_cupon = form['limite_cupon'].value

    let object = {
        ruc: ruc,
        razon_social : razon_social,
        beneficio: beneficio,
        nombre_comercial: nombre_comercial,
        categoria_id: categoria_id,
        direccion: direccion,
        telefono: telefono,
        correo: correo,
        twitter: twitter,
        facebook: facebook,
        instagram: instagram,
        website: website,
        estado: estado,
        limite_cupon: limite_cupon
    }

    let response = await fetch(`/enterprises/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: JSON.stringify(object),
    })
    return response.json()
}

export async function changeImageBackground(form, id) {
    let image_enterprise = form['image_enterprise_edit'].files[0]
    var formData = new FormData()
    formData.append("image_enterprise", image_enterprise)

    let response = await fetch(`/enterprises/${id}/image/background`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()
}

export async function changeImageContent(form, id) {
    let image_enterprise = form['image_enterprise_edit_content'].files[0]
    var formData = new FormData()
    formData.append("image_enterprise", image_enterprise)

    let response = await fetch(`/enterprises/${id}/image/content`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()
}

export async function deleteEnterprise(id) {
    fetch(`/enterprises/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
    }).then(res => res.json())
    .then(response => {
        $("#table-enterprise").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "Eliminado!",
            text: `Empresa ${response.nombre_comercial} eliminada éxitosamente`,
            icon: "success"
        });
    }).catch(error => console.log(error))
}
