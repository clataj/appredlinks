import { deleteUser } from "./endpoints.js"
import { showAlertDelete, showAlertWaiting } from "../helpers.js";

let id = null;

// Delete User
$("#table-user").DataTable().on('click', 'button.delete', function() {
    id = $(this).attr('id');
    showAlertDelete()
    .then((result) => {
        if (result.isConfirmed) {
            showAlertWaiting()
            deleteUser(id)
        }
    })

})
