export function responsePromise(response, table, modal) {

    if(response.type === 'validate') {
        let array = []
        for (const errors in response.errors) {
            array.push(response.errors[errors])
        }
        let list = '';
        array.map(error => {
            list += "* " + error + '<br>'
        })
        Swal.fire({
            title: "!Error!",
            html: list,
            icon : "error"
        })
    } else {
        $(table).DataTable().ajax.reload(null,false);
        $(modal).modal('toggle')
        Swal.fire({
            title: "!Éxito!",
            text: response.message,
            icon: "success"
        });
    }
}

export function showAlertWaiting() {
    Swal.fire({
        title: '¡Espere, Por favor!',
        html: 'Cargando informacion...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
}

export async function showAlertDelete() {
    let result = await Swal.fire({
        title: 'Estas seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    })
    return result
}
