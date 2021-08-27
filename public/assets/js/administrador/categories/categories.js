import { storeCategory, getCategory, changeImage, updateCategory, deleteCategory } from "./endpoints.js"
import { responsePromise, showAlertDelete, showAlertWaiting } from "../../helpers.js";

let id = null

// Post Category
let imgCategory = document.getElementById('img_category')
let openModalCreateCategory = document.getElementById('openModalCategory');
let imageCategory = document.getElementById('image_category');

// Edit Category Image
let imageCategoryEdit = document.getElementById('image_category_edit')
let imgCategoryEdit = document.getElementById('img_category_edit')


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

export function storeCategoryInit() {
    let form = document.forms['form-category']
    showAlertWaiting()
    storeCategory(form).then(response => {
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

export function changeImageInit() {
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
    $("#modalCategoryEdit").modal('toggle');
    form['name-edit'].value = data.nombre;
    form['status-edit'].value = data.estado;
})

export function updateCategoryInit() {
    let form = document.forms['form-category-edit'];
    showAlertWaiting()
    updateCategory(form, id).then(response => {
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
