let editButtonCategory = document.getElementById('edit-button');
let imageCategoryEdit = document.getElementById('image_category_edit')
let statusEdit = document.getElementById('status-edit');
let statusSaveEdit = statusEdit.value
let id = null
let changeImageButton = document.getElementById('change-image-button');

imageCategoryEdit.onchange = () => {
    let form = document.forms['form-category-edit-image']
    var imgCategory = document.getElementById('img_category_edit')
    imgCategory.textContent=form['image_category_edit'].value.replace(/C:\\fakepath\\/i, '')
}

changeImageButton.onclick = () => {
    let form = document.forms['form-category-edit-image']
    changeImage(form).then(response => {
        if(response.type == 'validate') {
            let array = []
            for (const errors in response.errors) {
                array.push(response.errors[errors])
            }
            let list = '';
            for (let index = 0; index < array.length; index++) {

                list += "* " + array[index] + '<br>'
            }
            Swal.fire({
                title: "!Error!",
                html: list,
                icon : "error"
            })
        } else {
            $("#table-category").DataTable().ajax.reload(null,false);
            $("#modalImageEdit").modal('toggle')
            Swal.fire({
                title: "!Éxito!",
                text: response.message,
                icon: "success"
            });
        }
    })
}

editButtonCategory.onclick = () => {
    let form = document.forms['form-category-edit'];
    updateCategory(form).then(response => {
        if(response.type == 'validate') {
            let array = []
            for (const errors in response.errors) {
                array.push(response.errors[errors])
            }
            let list = '';
            for (let index = 0; index < array.length; index++) {

                list += "* " + array[index] + '<br>'
            }
            Swal.fire({
                title: "!Error!",
                html: list,
                icon : "error"
            })
        } else {
            $("#table-category").DataTable().ajax.reload(null,false);
            $("#modalCategoryEdit").modal('toggle')
            Swal.fire({
                title: "!Éxito!",
                text: response.message,
                icon: "success"
            });
        }
    })

}

statusEdit.onchange = (event) => {
    statusSaveEdit = event.target.value
}

$("#table-category").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlert('¡Espere, Por favor!', 'Cargando informacion...')
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    let form = document.forms['form-category-edit'];
    $("#modalCategoryEdit").modal('toggle')
    printData(form, data)
})

$("#table-category").DataTable().on('click', 'button.view', async function() {
    id = $(this).attr('id');
    showAlert('¡Espere, Por favor!', 'Cargando informacion...')
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    Swal.fire({
        title: data.nombre,
        imageUrl: data.ruta_img,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: data.nombre,
    })
})

$("#table-category").DataTable().on('click', 'button.change-image', async function() {
    id = $(this).attr('id');
    showAlert('¡Espere, Por favor!', 'Cargando informacion...')
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    $("#modalImageEdit").modal("toggle")
    let form = document.forms['form-category-edit-image'];
    printImage(form, data)
})



async function changeImage(form) {
    let image_category = form['image_category_edit'].files[0]
    var formData = new FormData()
    formData.append("image_category", image_category)

    let response = await fetch(`/categories/${id}/image`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : form['token'].value
        },
        body: formData
    })
    return response.json()
}

async function updateCategory(form) {
    let name = form['name'].value;
    let status = statusSaveEdit;

    let object = {
        name : name,
        status : status
    }

    let response = await fetch(`/categories/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : form['token'].value
        },
        body: JSON.stringify(object)
    })
    return response.json()

}

function printData(form, data) {
    form['name'].value=data.nombre;
    form['status-edit'].value=data.estado;
}

function printImage(form, data) {
    var imgCategory = document.getElementById('img_category_edit')
    imgCategory.textContent=form['image_category_edit'].value=''
    form['img-category'].src=data.ruta_img;

}

function showAlert(title, html) {
    Swal.fire({
        title: title,
        html: html,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
}

async function getCategory(id) {
    let data = await fetch(`/categories/${id}/edit`);
    return data.json();
}
