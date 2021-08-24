import templateButton from "./coupons/templateButton.js"

export function responsePromise(response, table, modal) {
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
        $(table)
            .DataTable()
            .ajax.reload(null, false);
        $(modal).modal("toggle");
        Swal.fire({
            title: "!Éxito!",
            text: response.message,
            icon: "success"
        });
    }
}

export function showAlertWaiting() {
    Swal.fire({
        title: "¡Espere, Por favor!",
        html: "Cargando informacion...",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
}

export async function showAlertDelete() {
    let result = await Swal.fire({
        title: "Estas seguro?",
        text: "No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
    });
    return result;
}

export async function showAlertDisabled() {
    let result = await Swal.fire({
        title: "Estas seguro?",
        text: "Se desactivara el cupon!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, desactivar!"
    });
    return result;
}

export async function showAlertEnabled() {
    let result = await Swal.fire({
        title: "Estas seguro?",
        text: "Se activara el cupon!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, activar!"
    });
    return result;
}

export function highlight(element, errorClass) {
    $(element).removeClass(errorClass);
    $(element).addClass("is-invalid");
}

export function unhighlight(element) {
    $(element).removeClass("is-invalid");
}

export function jqValidationDefaultOptions() {
    return {
        errorElement: 'div',
        lang: 'es',
        errorClass: "invalid-feedback",
        highlight,
        unhighlight
    }
}

export function chargeInfo(html) {
    html.insertAdjacentHTML('beforeend', templateButton())
}

export function loadDataEnterprise(data, limiteCupones, infoCupon) {
    if(data.limite_cupon > 0) {
        if(data.limite_cupon == 1) {
            limiteCupones.innerText = `Usted tiene ${data.limite_cupon} un cupon`
        } else {
            limiteCupones.innerText = `Usted tiene ${data.limite_cupon} cupones `
        }
        let showButtonAdd = document.getElementById('showButtonAdd')
        showButtonAdd.innerHTML = ''
        chargeInfo(showButtonAdd)
        let numCupon = document.getElementById('num_cupon2')
        if(numCupon !== null) {
            numCupon.innerText = data.limite_cupon
        }
    } else {
        let showButtonAdd = document.getElementById('showButtonAdd')
        if(showButtonAdd !== null) {
            showButtonAdd.parentNode.removeChild(showButtonAdd)
        }
        limiteCupones.innerText = ''
        infoCupon.style.display = ''
        infoCupon.innerText = 'Se han agotado los cupones'
    }
}
