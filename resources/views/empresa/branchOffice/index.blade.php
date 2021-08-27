@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <h3 class="h3 text-gray-800">Listado de Sucursales</h3>
    </div>
</div>
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <!-- Button trigger modal -->
        <button
            id="openModalBranchOffice"
            type="button"
            class="btn btn-primary mt-1"
            data-toggle="modal"
            data-target="#modalBranchOffice">
            <i class="fa fa-plus"></i> Agregar Sucursal
        </button>
        <a href="{{ route('users.enterprises.index', $id) }}" class="btn btn-danger mt-1">
            <i class="fa fa-arrow-left"></i> Regresar
        </a>
    </div>
</div>
<input type="hidden" name="empresa_id" id="empresa_id" value="{{ $id }}">
<!-- Create Modal -->
@include('modals.branchOffice.modalCreate')

<!-- Edit Modal -->
@include('modals.branchOffice.modalEdit')

<div class="row">
    <div class="col">

        <div class="card shadow mb-4 w-100">

            <div class="p-4">

                <table id="table-branch-office" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Código QR</th>
                            <th scope="col">Nombre de sucursal</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Horario de Lunes a Viernes</th>
                            <th scope="col">Horario de Sábado</th>
                            <th scope="col">Horario de Domingo</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Longitud del mapa</th>
                            <th scope="col">Latitud del mapa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#table-branch-office").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('users.branchOffices.data', $id) }}`,
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
                data: "qr"
            },
            {
                data: "nombre"
            },
            {
                data: "direccion"
            },
            {
                data: "dias_laborales"
            },
            {
                data: "dia_no_laboral_1",
                render: function(data, type, row) {
                    return data==='Sin atencion' ? `<span class="badge badge-danger">${data}</span>` : `${data}`;
                }
            },
            {
                data: "dia_no_laboral_2",
                render: function(data, type, row) {
                    return data==='Sin atencion' ? `<span class="badge badge-danger">${data}</span>` : `${data}`;
                }
            },
            {
                data: "telefono"
            },
            {
                data: "city"
            },
            {
                data: "status",
                render: function(data, type, row) {
                    return data==='Activo' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-danger">${data}</span>`;
                }
            },
            {
                data: "longitud_map"
            },
            {
                data: "latitud_map"
            },
            {
                data: "actions"
            }
        ]
    });
</script>
<script src="{{ asset('assets/js/branchOffice/branchOffice.js') }}" type="module"></script>
<script src="{{ asset('assets/js/branchOffice/forms.js') }}" type="module"></script>
@endpush
