export async function getPublicity(id) {
    let data = await fetch(`/publicities/${id}/show`)
    return data.json()
}
export async function storePublicity(form) {
    let nombre = form['nombre'].value;
    let descripcion = form['descripcion'].value;
    let fecha_inicio = form['fecha_inicio'].value;
    let fecha_fin = form['fecha_fin'].value;
    let estado = form['estado'].value;
    let imagen = form['imagen'].files[0];
    let tipo = form['tipo'].value;
    let sub_categoria = form['sub_categoria'].value;

    var formData = new FormData()
    formData.append("nombre", nombre)
    formData.append("descripcion", descripcion)
    formData.append("fecha_inicio", fecha_inicio)
    formData.append("fecha_fin", fecha_fin)
    formData.append("estado", estado)
    formData.append("imagen", imagen)
    formData.append("tipo", tipo)
    formData.append("sub_categoria", sub_categoria)

    let response = await fetch('/publicities', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()
}

export async function updatePublicity(form, id)
{
    let nombre = form['nombre'].value;
    let descripcion = form['descripcion'].value;
    let fecha_inicio = form['fecha_inicio'].value;
    let fecha_fin = form['fecha_fin'].value;
    let estado = form['estado'].value;
    let tipo = form['tipo'].value;
    let sub_categoria = form['sub_categoria'].value;

    let response = await fetch(`/publicities/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        body: JSON.stringify({
            nombre : nombre,
            descripcion : descripcion,
            fecha_inicio : fecha_inicio,
            fecha_fin : fecha_fin,
            estado : estado,
            tipo : tipo,
            sub_categoria : sub_categoria
        })
    })
    return response.json()
}

export async function changeImage(form, id) {
    let image_publicity = form['imageEdit'].files[0]
    var formData = new FormData()
    formData.append("imagen", image_publicity)

    let response = await fetch(`/publicities/${id}/image`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    debugger
    return response.json()
}
