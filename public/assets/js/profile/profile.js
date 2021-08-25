import { showAlertWaiting } from "../helpers.js"
import { updateProfile } from "./endpoints.js"

export function storeProfileInit() {
    let form = document.forms['form-profile']
    showAlertWaiting()
    updateProfile(form).then(response => {
        if (response.type === "validate") {
            let array = [];
            for (const errors in response.errors) {
                array.push(response.errors[errors]);
            }
            let list = "";
            array.map(error => {
                list += "* " + error + "<br>";
            });
            Swal.fire({
                title: "!Error!",
                html: list,
                icon: "error"
            });
        } else {
            const { data } = response
            form['name'].value = data.name,
            form['email'].value = data.email
            let profileName = document.getElementById('profile-text')
            let profileImage = document.getElementById('profile-image')
            profileName.innerText = data.name
            profileImage.src = `https://ui-avatars.com/api/?background=3A61D0&color=fff&name=${data.name}&size=32`
            Swal.fire({
                title: "!Éxito!",
                text: response.message,
                icon: "success"
            });
        }
    })
}
