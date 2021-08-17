export async function getBenefit(id) {
    let data = await fetch(`/benefits/${id}`)
    return data.json()
}

export async function storeBenefit(form) {
    let empresa_id = form['empresa_id'].value;
    let descripcion = form['descripcion'].value;

    let object = {
        empresa_id : empresa_id,
        descripcion : descripcion
    }

    let response = await fetch('/benefits', {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: JSON.stringify(object)
    })

    return response.json()
}

export async function updateBenefit(form, id) {
    let empresa_id = form['empresa_id'].value;
    let descripcion = form['descripcion'].value;

    let object = {
        empresa_id : empresa_id,
        descripcion : descripcion
    }

    let response = await fetch(`/benefits/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: JSON.stringify(object)
    })

    return response.json()
}

export async function deleteBenefit(id) {
    fetch(`/benefits/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
    }).then(res => res.json())
    .then(response => {
        $("#table-benefits").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "Eliminado!",
            text: `Beneficio ${response.descripcion} eliminado éxitosamente`,
            icon: "success"
        });
    }).catch(error => console.log(error))
}
