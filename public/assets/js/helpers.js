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

export function chargeInfo() {
    let showButtonAdd = document.getElementById('showButtonAdd')
    showButtonAdd.insertAdjacentHTML('beforeend', templateButton())
}
