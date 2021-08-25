export async function getCategory(id) {
    let data = await fetch(`/categories/${id}/show`);
    return data.json();
}

export async function storeCategory(form) {

    let name = form['name'].value;
    let status = form['status'].value;
    let image_category = form['image_category'].files[0]
    var formData = new FormData()
    formData.append("name", name);
    formData.append("image_category", image_category)
    formData.append("status", status)
    let response = await fetch('/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()

}

export async function updateCategory(form, id) {
    let name = form['name-edit'].value;
    let status = form['status-edit'].value

    let object = {
        name : name,
        status : status
    }

    let response = await fetch(`/categories/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: JSON.stringify(object)
    })
    return response.json()

}

export async function changeImage(form, id) {
    let image_category = form['image_category_edit'].files[0]
    var formData = new FormData()
    formData.append("image_category", image_category)

    let response = await fetch(`/categories/${id}/image`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: formData
    })
    return response.json()
}

export function deleteCategory(id) {
    fetch(`/categories/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
    }).then(res => res.json())
    .then(response => {
        $("#table-category").DataTable().ajax.reload(null,false);
        Swal.fire({
            title: "Eliminado!",
            text: `Categoria ${response.nombre} eliminada éxitosamente`,
            icon: "success"
        });
    }).catch(error => console.log(error))
}
