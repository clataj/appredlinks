let imageCategory = document.getElementById('image_category');
let saveButtonCategory = document.getElementById('save-button');
let openModalCategory = document.getElementById('openModalCategory');
let status = document.getElementById('status');
let statusSave = ''

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
    Swal.fire({
        title: "¡Espere, Por favor!",
        html : 'Procesando informacion...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        },
    })
    storeCategory(form).then(response => {
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
            $("#modalCategory").modal('toggle')
            Swal.fire({
                title: "!Éxito!",
                text: response.message,
                icon: "success"
            });
        }
    })
}


openModalCategory.onclick = () => {
    let form = document.forms['form-category'];
    var imgCategory = document.getElementById('img_category')
    form['name'].value="";
    form['status'].value=0;
    imgCategory.textContent=form['image_category'].value=''
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

async function storeCategory(form) {

    let name = form['name'].value;
    let image_category = form['image_category'].files[0]
    var formData = new FormData()
    formData.append("name", name);
    formData.append("image_category", image_category)
    formData.append("status", statusSave)

    let response = await fetch('/categories', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN' : form['token'].value
        },
        body: formData
    })
    return response.json()

}



