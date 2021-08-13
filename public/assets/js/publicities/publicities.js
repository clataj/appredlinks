import { responsePromise, showAlertWaiting } from "../helpers.js";
import { changeImage, getPublicity, storePublicity } from "./endpoints.js";
// Post Publicity
let openModalPublicity = document.getElementById('openModalPublicity')
let saveButton = document.getElementById('save-button')
let imagen = document.getElementById('imagen')
let id = null

// Update Image

let imgPublicityEdit = document.getElementById('img_publicity_edit')
let imageEdit = document.getElementById('imageEdit');
let changeImageButton = document.getElementById('change-image-button')

// Post Publicity
openModalPublicity.onclick = () => {
    let form = document.forms['form-save-publicity']
    form.reset()
    var imgPublicity = document.getElementById('img_publicity')
    $('.searchEnterprise').val(null).trigger('change')
    imgPublicity.textContent='Escoger una imagen'
}

imagen.onchange = () => {
    let form = document.forms['form-save-publicity']
    var imgPublicity = document.getElementById('img_publicity')
    imgPublicity.textContent=form['imagen'].value.replace(/C:\\fakepath\\/i, '')
}

saveButton.onclick = () => {
    let form = document.forms['form-save-publicity']
    showAlertWaiting()
    storePublicity(form).then(response => {
        responsePromise(response, "#table-publicity", "#modalPublicity")
    })
}

// Show Image
$("#table-publicity").DataTable().on('click', 'button.view', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let publicity = await getPublicity(id)
    const data = publicity.data
    Swal.close()
    showImage(data)
})

function showImage(data) {
    console.log(data.imagen)
    Swal.fire({
        title: data.tipo=='P' ? 'Publicidad Destacada' : 'Publicidad Secundaria',
        text: data.nombre,
        imageUrl: data.imagen,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: data.nombre,
    })
}
// Update Image
$("#table-publicity").DataTable().on('click', 'button.change-image', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let publicity = await getPublicity(id)
    const data = publicity.data
    Swal.close()
    $("#modalImageEdit").modal("toggle")
    let form = document.forms['form-publicity-edit-image'];
    form['img-publicity'].src=data.imagen;
    imgPublicityEdit.textContent='Escoger una imagen'
})

imageEdit.onchange = () => {
    let form = document.forms['form-publicity-edit-image']
    imgPublicityEdit.textContent=form['imageEdit'].value.replace(/C:\\fakepath\\/i, '')
}

changeImageButton.onclick = () => {
    let form = document.forms['form-publicity-edit-image']
    showAlertWaiting()
    changeImage(form, id).then(response => {
        responsePromise(response, "#table-publicity", "#modalImageEdit")
    })
}

// Update Text
$("#table-publicity").DataTable().on('click', 'button.edit', async function() {
    id = $(this).attr('id');
    showAlertWaiting()
    let publicity = await getPublicity(id)
    const data = publicity.data
    Swal.close()
    let form = document.forms['form-edit-publicity'];
    $("#modalEditPublicity").modal('toggle')
    form['nombre'].value=data.nombre;
    form['tipo'].value=data.tipo;
    form['estado'].value=data.estado;
    form['fecha_inicio'].value=data.fecha_inicio;
    form['fecha_fin'].value=data.fecha_fin;
    form['descripcion'].value=data.descripcion;
    $('.searchEnterprise')
        .text(data.enterprise.nombre_comercial)
        .val(data.sub_categoria)
        .trigger('change')
})

