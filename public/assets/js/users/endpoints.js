let check = Object;
let arrayBody = [];

export async function getUser(id, enterpriseId = null) {
    let data = await fetch(`/users/${id}/show/${enterpriseId}`);
    return data.json();
}

export async function sendEnterprises(form) {


	const data = await fetch('/users', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},

		body: JSON.stringify(arrayBody)
	});

	const response = await data.json()

	if (data.status == 400) {
		$(tomarAsistencia).on("click", function() {
			var myModal = $("#myModal")
			myModal.modal('show')
			myModal.find('.modal-title').text('Notificación')
			myModal.find('.modal-body').text(response.message)
		})
	} else {
		$(tomarAsistencia).on("click", function() {
			var myModal = $("#myModal")
			myModal.modal('show')
			myModal.find('.modal-title').text('Notificación')
			myModal.find('.modal-body').text('Se ha tomado asistencia')
		})
		const resp = await obtenerProfesoresPorPeriodoVigente()
		await drawTeacher(resp)
		stompClient.send('/app/send', {}, JSON.stringify(arrayBody));
	}

	disconnect();
};

// export async function storeUser(form) {
//     arrayBody = [];
// 	[...check].map((c) => {
// 		if (c.checked == true) {
// 			let body = {
//                 "name" : form['name'].value,
//                 "email" : form['email'].value,
//                 "password" : form['password'].value,
// 				"enterprise": {
// 					"id": parseInt(c.previousElementSibling.value)
// 				}
// 			}

// 			arrayBody.push(body);
// 		}
// 	});

//     let role_id = form['role_id'].value
//     let empresa_id = form['empresa_id'].value
//     let name = form['name'].value;
//     let email = form['email'].value;
//     let password = form['password'].value;
//     let repassword = form['password-confirm'].value

//     let object = {
//         role_id : role_id,
//         empresa_id : empresa_id,
//         name : name,
//         email : email,
//         password : password,
//         password_confirmation : repassword
//     }

//     const response = await fetch(`/users`, {
//         method: 'POST',
//         headers: {
//             'Content-Type' : 'application/json',
//             'X-CSRF-TOKEN' : window.CSRF_TOKEN
//         },
//         body: JSON.stringify(object),
//     })
//     return response.json();
// }

export async function updateUser(form, id) {
    let role_id = form['role_id_edit'].value
    let name = form['name'].value;
    let email = form['email'].value;
    let empresa_id = form['empresa_id'].value

    let object = {
        role_id : role_id,
        name : name,
        email : email,
        empresa_id : empresa_id
    }
    const response = await fetch(`/users/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
        body: JSON.stringify(object),
    })

    return response.json()
}

export function deleteUser(id) {
    fetch(`/users/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN' : window.CSRF_TOKEN
        },
    })
    .then(res => res.json())
    .then(response => {

        $("#table-user").DataTable().ajax.reload(null,false);
        Swal.fire(
            'Eliminado!',
            `Usuario ${response.name} eliminado correctamente`,
            'success'
        )
    })
    .catch(error => console.log(error))
}

