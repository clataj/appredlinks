@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <h3 class="h3 text-gray-800">Listado de Empresas</h3>

        <!-- Button trigger modal -->
        <button
            id="openModalEnterprise"
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#modalEnterprise">
            <i class="fa fa-plus"></i> Agregar Empresa
        </button>

    </div>

</div>

<div class="row mb-4">
    <div class="col">
        <span>* Seleccione un registro para visualizar más opciones</span>
    </div>
</div>

<!-- Create Modal -->

@include('empresa.enterprises.modals.modalCreate')

<!-- Edit Modal Text -->
@include('empresa.enterprises.modals.modalEditText')

<!-- Show Image -->
@include('modals.enterprises.modalImage')

<!-- Update Image -->
@include('modals.enterprises.modalEditImage')
<div class="row">
    <div class="col">

        <div class="card shadow mb-4 w-100">

            <div class="p-4">

                <table id="table-enterprise" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Nombre de la compañia</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">RUC</th>
                            <th scope="col">Razón Social</th>
                            <th scope="col">Beneficio</th>
                            {{-- <th scope="col">Beneficios</th> --}}
                            <th scope="col">Sucursal</th>
                            <th scope="col">Numero de Cupones</th>
                            <th scope="col">Cupones</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Sitio Web</th>
                            <th scope="col">Facebook</th>
                            <th scope="col">Twitter</th>
                            <th scope="col">Instagram</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>

    </div>

</div>

@endsection
@if (session('status'))
<script type="text/javascript">
    Swal.fire({
        title: 'Exito',
        text: `{{ session('status') }}`,
        icon: 'success'
    })
</script>
@endif
@push('scripts')
<script type="text/javascript">
    $("#table-enterprise").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('users.enterprises.data', $id) }}`,
        type: 'GET',
        columnDefs: [ {
            sortable: false,
            targets: "_all"
        } ],
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                `Mostrar <select class="form-control form-control-sm">` +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                "</select> registros",
            loadingRecords: "Cargando...",
            processing: "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Procesando ...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            },
        },
        columns: [
            {
                data: "nombre_comercial"
            },
            {
                data: 'categoria_id'
            },
            {
                data: "ruc"
            },
            {
                data: "razon_social"
            },
            {
                data: "beneficio"
            },
            // {
            //     data: "beneficios"
            // },
            {
                data: "createBranchOffice"
            },
            {
                data: "limite_cupon",
                render: function(data, type, row) {
                    return data > 0 ? data : 'Sin cupones';
                }
            },
            {
                data: "coupons"
            },
            {
                data: "estado",
                render: function(data, type, row) {
                    return data==='Activo' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-danger">${data}</span>`;
                }
            },
            {
                data: "direccion"
            },
            {
                data: "telefono"
            },
            {
                data: "correo"
            },
            {
                data: "website"
            },
            {
                data: "facebook"
            },
            {
                data: "twitter"
            },
            {
                data: "instagram"
            },
            {
                data: "actions"
            }
        ]
    })
</script>
<script src="{{ asset('assets/js/empresa/enterprises/enterprises.js') }}" type="module"></script>
<script src="{{ asset('assets/js/empresa/enterprises/forms.js') }}" type="module"></script>
@endpush
