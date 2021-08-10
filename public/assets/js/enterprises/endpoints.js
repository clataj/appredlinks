export async function getEnterprise(id) {
    let data = await fetch(`/enterprises/${id}/edit`);
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

    let response = await fetch('/enterprises', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : form['token'].value
        },
        body: formData
    })
    return response.json()
}
