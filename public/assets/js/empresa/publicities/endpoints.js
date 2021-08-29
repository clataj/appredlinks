export async function storePublicity(form) {
    let nombre = form['nombre'].value;
    let descripcion = form['descripcion'].value;
    let imagen = form['imagen'].files[0];
    let tipo = form['tipo'].value;
    let sub_categoria = form['sub_categoria'].value;

    var formData = new FormData()
    formData.append("nombre", nombre)
    formData.append("descripcion", descripcion)
    formData.append("imagen", imagen)
    formData.append("tipo", tipo)
    formData.append("sub_categoria", sub_categoria)

    let response = await fetch('/my/publicities', {
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
    let tipo = form['tipo'].value;
    let sub_categoria = form['sub_categoria'].value;

    let response = await fetch(`/my/publicities/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN': window.CSRF_TOKEN
        },
        body: JSON.stringify({
            nombre : nombre,
            descripcion : descripcion,
            tipo : tipo,
            sub_categoria : sub_categoria
        })
    })
    return response.json()
}
