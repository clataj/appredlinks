export async function storeBranchOffice(form) {
    let empresa_id = form['empresa_id'].value;
    let ciudad_id = form['ciudad_id'].value;
    let estado = form['estado'].value;
    let qr = form['qr'].value;
    let nombre = form['nombre'].value;
    let direccion = form['direccion'].value;
    let telefono = form['telefono'].value;
    let longitud_map = form['longitud_map'].value;
    let latitud_map = form['latitud_map'].value;

    let object = {
        empresa_id : empresa_id,
        ciudad_id : ciudad_id,
        estado : estado,
        qr : qr,
        nombre : nombre,
        direccion : direccion,
        telefono : telefono,
        longitud_map : longitud_map,
        latitud_map : latitud_map
    }

    let response = await fetch('/branchOffices', {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : form['token'].value
        },
        body: JSON.stringify(object)
    })

    return response.json()
}
