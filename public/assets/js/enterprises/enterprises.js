import { responsePromise, showAlertWaiting } from '../helpers.js';
import { changeImageBackground, changeImageContent, getEnterprise, storeEnterprise, updateEnterprise } from './endpoints.js'

let id = null

// Post Enterprise
let imgFondo = document.getElementById('img_fondo')
let imgSmall = document.getElementById('img_small')
let openModalCreateEnterprise = document.getElementById('openModalEnterprise');
let imageFondo = document.getElementById('ruta_fondo');
let imageSmall = document.getElementById('ruta_small_2');
let saveButtonEnterprise = document.getElementById('save-button');

// Change Image Background
let imageEnterpriseEdit = document.getElementById('image_enterprise_edit')
let changeImageButton = document.getElementById('change-image-button');
let imgEnterpriseEdit = document.getElementById('img_enterprise_edit')

// Change Image Content
let imageContentEnterpriseEdit = document.getElementById('image_enterprise_edit_content')
let imgContentEnterpriseEdit = document.getElementById('img_enterprise_edit_content')
let changeImageContentButton = document.getElementById('change-image-content-button');

// Update text
let editButtonTextEnterprise = document.getElementById('edit-button');

// Post Enterprise

openModalCreateEnterprise.onclick = () => {
    let form = document.forms['form-enterprise'];
    form.reset()
    imgFondo.textContent='Escoger una imagen'
    imgSmall.textContent='Escoger una imagen'
}

imageFondo.onchange = () => {
    let form = document.forms['form-enterprise']
    var imgFondo = document.getElementById('img_fondo')
    imgFondo.textContent=form['ruta_fondo'].value.replace(/C:\\fakepath\\/i, '')
}

imageSmall.onchange = () => {
    let form = document.forms['form-enterprise']
    var imgSmall = document.getElementById('img_small')
    imgSmall.textContent=form['ruta_small_2'].value.replace(/C:\\fakepath\\/i, '')
}

saveButtonEnterprise.onclick = () => {
    let form = document.forms['form-enterprise']
    showAlertWaiting()
    storeEnterprise(form).then(response => {
        responsePromise(response, "#table-enterprise", "#modalEnterprise")
    })
}

// Show Enterprise for update Text
$("#table-enterprise").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let enterprise = await getEnterprise(id)
    const data = enterprise.data
    Swal.close()
    let form = document.forms['form-enterprise-edit'];
    $("#modalEnterpriseEditText").modal('toggle')
    form['ruc'].value=data.ruc
    form['razon_social'].value=data.razon_social
    form['beneficio'].value=data.beneficio
    form['nombre_comercial'].value=data.nombre_comercial
    form['categoria_id'].value=data.categoria_id
    form['direccion'].value=data.direccion
    form['telefono'].value=data.telefono
    form['correo'].value=data.correo
    form['twitter'].value=data.twitter
    form['facebook'].value=data.facebook
    form['instagram'].value=data.instagram
    form['website'].value=data.website
    form['estado'].value=data.estado
})

// Show Image
$("#table-enterprise").DataTable().on('click', 'button.view', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let enterprise = await getEnterprise(id)
    const data = enterprise.data
    Swal.close()
    showImage(data)
})

function showImage(data) {
    var modal = $("#imageModal")
    modal.modal('toggle')
    $("#image_background").attr("src", data.ruta_fondo)
    $("#image_content").attr("src", data.ruta_small_2)
}

// Update Text
editButtonTextEnterprise.onclick = () => {
    let form = document.forms['form-enterprise-edit'];
    showAlertWaiting()
    updateEnterprise(form, id)
    .then(response => {
        responsePromise(response, "#table-enterprise", "#modalEnterpriseEditText")
    })
    .catch(err => console.log(err))
}

// Show Image Background for Edit
imageEnterpriseEdit.onchange = () => {
    let form = document.forms['form-enterprise-edit-image']
    var imgEnterprise = document.getElementById('img_enterprise_edit')
    imgEnterprise.textContent=form['image_enterprise_edit'].value.replace(/C:\\fakepath\\/i, '')
}

// Update Image Background

$("#table-enterprise").DataTable().on('click', 'button.change-image-background', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let enterprise = await getEnterprise(id)
    const data = enterprise.data
    Swal.close()
    $("#modalImageEdit").modal("toggle")
    let form = document.forms['form-enterprise-edit-image'];
    form['img-enterprise'].src=data.ruta_fondo;
    imgEnterpriseEdit.textContent='Escoger una imagen'
})

changeImageButton.onclick = () => {
    let form = document.forms['form-enterprise-edit-image']
    showAlertWaiting()
    changeImageBackground(form, id).then(response => {
        responsePromise(response, "#table-enterprise", "#modalImageEdit")
    })
}

// Show Image Content for Edit
imageContentEnterpriseEdit.onchange = () => {
    let form = document.forms['form-enterprise-edit-image-content']
    var imgEnterprise = document.getElementById('img_enterprise_edit_content')
    imgEnterprise.textContent=form['image_enterprise_edit_content'].value.replace(/C:\\fakepath\\/i, '')
}

// Update Image Content
$("#table-enterprise").DataTable().on('click', 'button.change-image-content', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let enterprise = await getEnterprise(id)
    const data = enterprise.data
    Swal.close()
    $("#modalImageEditContent").modal("toggle")
    let form = document.forms['form-enterprise-edit-image-content'];
    form['img-enterprise'].src=data.ruta_small_2;
    imgContentEnterpriseEdit.textContent='Escoger una imagen'
})

changeImageContentButton.onclick = () => {
    let form = document.forms['form-enterprise-edit-image-content']
    showAlertWaiting()
    changeImageContent(form, id).then(response => {
        responsePromise(response, "#table-enterprise", "#modalImageEditContent")
    })
}
