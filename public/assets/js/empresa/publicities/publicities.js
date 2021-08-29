import { responsePromise, showAlertDelete, showAlertWaiting, showImage } from "../../helpers.js";
import { changeImage, deletePublicity, getPublicity } from "../../administrador/publicities/endpoints.js";
import { storePublicity, updatePublicity } from "./endpoints.js";


// Post Publicity
let openModalPublicity = document.getElementById("openModalPublicity");
let imagen = document.getElementById("imagen");
let id = null;

// Update Image
let imgPublicityEdit = document.getElementById("img_publicity_edit");
let imageEdit = document.getElementById("imageEdit");

// Post Publicity
openModalPublicity.onclick = () => {
    let form = document.forms["form-save-publicity"];
    var imgPublicity = document.getElementById("img_publicity");
    imgPublicity.textContent = "Escoger una imagen";
    if($(".subCategoria")) {
        $(".subCategoria").select2({
            theme: "bootstrap4",
            placeholder: "Busque una empresa",
            language: {
                noResults: function() {
                    return "No hay resultados";
                },
                searching: function() {
                    return "Buscando..";
                }
            },
        });
    }
    form.reset();
};

imagen.onchange = () => {
    let form = document.forms["form-save-publicity"];
    var imgPublicity = document.getElementById("img_publicity");
    imgPublicity.textContent = form["imagen"].value.replace(
        /C:\\fakepath\\/i,
        ""
    );
};

export function storePublicityInit() {
    let form = document.forms["form-save-publicity"];
    showAlertWaiting();
    storePublicity(form).then(response => {
        responsePromise(response, "#table-publicity", "#modalPublicity");
    });
}

// Show Image
$("#table-publicity")
    .DataTable()
    .on("click", "button.view", async function() {
        id = $(this).attr("id");
        showAlertWaiting();
        let publicity = await getPublicity(id);
        const data = publicity.data;
        Swal.close();
        showImage(data);
    });

// Update Image
$("#table-publicity")
    .DataTable()
    .on("click", "button.change-image", async function() {
        id = $(this).attr("id");
        showAlertWaiting();
        let publicity = await getPublicity(id);
        const data = publicity.data;
        Swal.close();
        $("#modalImageEdit").modal("toggle");
        let form = document.forms["form-publicity-edit-image"];
        form["img-publicity"].src = data.imagen;
        imgPublicityEdit.textContent = "Escoger una imagen";
    });

imageEdit.onchange = () => {
    let form = document.forms["form-publicity-edit-image"];
    imgPublicityEdit.textContent = form["imageEdit"].value.replace(
        /C:\\fakepath\\/i,
        ""
    );
};

export function changeImageInit() {
    let form = document.forms["form-publicity-edit-image"];
    showAlertWaiting();
    changeImage(form, id).then(response => {
        responsePromise(response, "#table-publicity", "#modalImageEdit");
    });
}


// Update Text
$("#table-publicity")
    .DataTable()
    .on("click", "button.edit", async function() {
        id = $(this).attr("id");
        showAlertWaiting();
        let publicity = await getPublicity(id);
        const data = publicity.data;
        Swal.close();
        let form = document.forms["form-edit-publicity"];
        $("#modalEditPublicity").modal("toggle");
        form["nombre"].value = data.nombre;
        form["tipo"].value = data.tipo;
        form["descripcion"].value = data.descripcion;
        if($(".subCategoriaEdit")) {
            $(".subCategoriaEdit").select2({
                theme: "bootstrap4",
                placeholder: "Busque una empresa",
                language: {
                    noResults: function() {
                        return "No hay resultados";
                    },
                    searching: function() {
                        return "Buscando..";
                    }
                },
            });
        }
        $(".subCategoriaEdit")
            .val(data.sub_categoria)
            .trigger("change");
    });

export function updatePublicityInit() {
    let form = document.forms["form-edit-publicity"];
    showAlertWaiting();
    updatePublicity(form, id).then(response => {
        responsePromise(response, "#table-publicity", "#modalEditPublicity");
    });
}

// Delete Enterprise
$("#table-publicity")
    .DataTable()
    .on("click", "button.delete", function() {
        id = $(this).attr("id");
        showAlertDelete().then(result => {
            if (result.isConfirmed) {
                showAlertWaiting();
                deletePublicity(id);
            }
        });
    });



