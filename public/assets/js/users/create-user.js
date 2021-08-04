let saveButtonUser = document.getElementById('save-button');
let openModal = document.getElementById('openModal');


openModal.onclick = () => {
    let form = document.forms['form-user'];
    cleanData(form);
}

saveButtonUser.onclick = () => {
    let form = document.forms['form-user'];
    storeUser(form)
    .then(response => {
        $("#table-user").DataTable().ajax.reload(null,false);
        $("#modalUser").modal('toggle')
        Swal.fire({
            title: "!Éxito!",
            text: response.message,
            icon: "success"
        });
    })
    .catch(error => console.log(error))
}

function cleanData(form) {
    form['name'].value="";
    form['email'].value="";
    form['password'].value="";
    form['password-confirm'].value=""
}

async function storeUser(form) {
    let name = form['name'].value;
    let email = form['email'].value;
    let password = form['password'].value;
    let repassword = form['password-confirm'].value
    let token = form['token'].value;

    let object = {
        name : name,
        email : email,
        password : password,
        password_confirmation : repassword
    }

    const response = await fetch(`/users/create`, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : token
        },
        body: JSON.stringify(object),
    })
    return response.json();
}
