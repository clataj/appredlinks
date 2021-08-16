import { responsePromise, showAlertDelete, showAlertWaiting } from "../helpers.js";
import { changeImage, deletePublicity, getPublicity, storePublicity, updatePublicity } from "./endpoints.js";
// Post Publicity
let openModalPublicity = document.getElementById('openModalPublicity')
let saveButton = document.getElementById('save-button')
let imagen = document.getElementById('imagen')
let id = null

// Update Image

let imgPublicityEdit = document.getElementById('img_publicity_edit')
let imageEdit = document.getElementById('imageEdit');
let changeImageButton = document.getElementById('change-image-button')

// Update Text
let editButton = document.getElementById('edit-button')

// Post Publicity
openModalPublicity.onclick = () => {
    let form = document.forms['form-save-publicity']
    var imgPublicity = document.getElementById('img_publicity')
    imgPublicity.textContent='Escoger una imagen'
    $('.searchEnterprise').empty()
    $('.searchEnterprise').select2({
        theme: 'bootstrap4',
        placeholder: 'Busque una empresa',
        language:{
            noResults: function(){
                return "No hay resultados";
            },
            searching: function(){
                return "Buscando..";
            },
        },
        ajax: {
            url: '/publicities/enterprises',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre_comercial,
                            id:item.id
                        }
                    })
                };
            },
            cache: true
        },
    });
    form.reset()
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
    $('.searchEnterpriseEdit').select2({
        theme: 'bootstrap4',
        placeholder: 'Busque una empresa',
        language:{
            noResults: function(){
                return "No hay resultados";
            },
            searching: function(){
                return "Buscando..";
            },
        },
        ajax: {
            url: '/publicities/enterprises',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre_comercial,
                            id:item.id
                        }
                    })
                };
            },
            cache: true
        },
    });
    var enterprise = new Option(data.enterprise.nombre_comercial, data.sub_categoria, true, true)
    $(".searchEnterpriseEdit").append(enterprise).trigger('change')
})

editButton.onclick = () => {
    let form = document.forms['form-edit-publicity']
    showAlertWaiting()
    updatePublicity(form, id).then(response => {
        responsePromise(response, "#table-publicity", "#modalEditPublicity");
    })
}

// Delete Enterprise
$("#table-publicity").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete().then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deletePublicity(id)
        }
    })
})
