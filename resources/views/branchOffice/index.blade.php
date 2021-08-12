@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button
                id="openModalBranchOffice"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalBranchOffice">
                <i class="fa fa-plus"></i> Agregar Sucursal
            </button>
            <a href="{{ route('enterprises.index') }}">
                <button
                    type="button"
                    class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Regresar
                </button>
            </a>
        </div>
    </div>
    <!-- Create Modal -->
    @include('branchOffice.modals.modalCreate')

    <!-- Edit Modal -->
    @include('branchOffice.modals.modalEdit')

    <div class="card">
        <div class="card-body">
            <table id="table-branch-office"
                class="display nowrap table table-bordered table-hover"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Código QR</th>
                        <th scope="col">Nombre de sucursal</th>
                        <th scope="col">Dirección</th>
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
@endsection
@push('scripts')
<script type="text/javascript">
    $("#table-branch-office").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('branchOffices.data', $id) }}`,
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
                "Mostrar <select>" +
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
@endpush
