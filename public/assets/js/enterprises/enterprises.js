import { responsePromise, showAlertWaiting } from '../helpers.js';
import { getEnterprise, storeEnterprise } from './endpoints.js'

let id = null

// Post Enterprise
let imgFondo = document.getElementById('img_fondo')
let imgSmall = document.getElementById('img_small')
let openModalCreateEnterprise = document.getElementById('openModalEnterprise');
let imageFondo = document.getElementById('ruta_fondo');
let imageSmall = document.getElementById('ruta_small_2');
let saveButtonEnterprise = document.getElementById('save-button');

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
