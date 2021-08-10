import { responsePromise, showAlertWaiting } from '../helpers.js';
import { storeEnterprise } from './endpoints.js'

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
        responsePromise(response, "", "#modalEnterprise")
    })
}
