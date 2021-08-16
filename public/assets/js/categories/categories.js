import { storeCategory, getCategory, changeImage, updateCategory, deleteCategory } from "./endpoints.js"
import { responsePromise, showAlertDelete, showAlertWaiting } from "../helpers.js";

let id = null

// Post Category
let imgCategory = document.getElementById('img_category')
let openModalCreateCategory = document.getElementById('openModalCategory');
let imageCategory = document.getElementById('image_category');
let saveButtonCategory = document.getElementById('save-button');
let status = document.getElementById('status');
let statusSave = ''

// Edit Category Image
let imageCategoryEdit = document.getElementById('image_category_edit')
let changeImageButton = document.getElementById('change-image-button');
let imgCategoryEdit = document.getElementById('img_category_edit')


// Edit Text Category
let editButtonCategory = document.getElementById('edit-button');
let statusEdit = document.getElementById('status-edit');
let statusSaveEdit = statusEdit.value

// Post Category

openModalCreateCategory.onclick = () => {
    let form = document.forms['form-category'];
    form.reset()
    imgCategory.textContent='Escoger una imagen'
}

imageCategory.onchange = () => {
    let form = document.forms['form-category']
    var imgCategory = document.getElementById('img_category')
    imgCategory.textContent=form['image_category'].value.replace(/C:\\fakepath\\/i, '')
}

status.onchange = (event) => {
    statusSave = event.target.value
}

saveButtonCategory.onclick = () => {
    let form = document.forms['form-category']
    showAlertWaiting()
    storeCategory(form, statusSave).then(response => {
        responsePromise(response, "#table-category", "#modalCategory")
    })
}

// Update Image Category

$("#table-category").DataTable().on('click', 'button.change-image', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    $("#modalImageEdit").modal("toggle")
    let form = document.forms['form-category-edit-image'];
    form['img-category'].src=data.ruta_img;
    imgCategoryEdit.textContent='Escoger una imagen'
})

imageCategoryEdit.onchange = () => {
    let form = document.forms['form-category-edit-image']
    imgCategoryEdit.textContent=form['image_category_edit'].value.replace(/C:\\fakepath\\/i, '')
}

changeImageButton.onclick = () => {
    let form = document.forms['form-category-edit-image']
    showAlertWaiting()
    changeImage(form, id).then(response => {
        responsePromise(response, "#table-category", "#modalImageEdit")
    })
}

// Update Text Category

$("#table-category").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    let form = document.forms['form-category-edit'];
    $("#modalCategoryEdit").modal('toggle')
    form['name'].value=data.nombre;
    form['status-edit'].value=data.estado;
})

statusEdit.onchange = (event) => {
    statusSaveEdit = event.target.value
}

editButtonCategory.onclick = () => {
    let form = document.forms['form-category-edit'];
    showAlertWaiting()
    updateCategory(form, statusSaveEdit, id).then(response => {
        responsePromise(response, "#table-category", "#modalCategoryEdit")
    })
}

// Show Image
$("#table-category").DataTable().on('click', 'button.view', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let category = await getCategory(id)
    const data = category.data
    Swal.close()
    showImage(data)
})

// Delete Category
$("#table-category").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deleteCategory(id)
        }
    })
})

function showImage(data) {
    Swal.fire({
        title: data.nombre,
        imageUrl: data.ruta_img,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: data.nombre,
    })
}
