@push('css')
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endpush
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">Listado de Publicidades</h3>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button
                id="openModalPublicity"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalPublicity">
                <i class="fa fa-plus"></i> Agregar Publicidad
            </button>
        </div>
    </div>

    <!-- Create Modal -->
    @include('publicities.modals.modalCreate')

    <!-- Edit Modal Image-->
    @include('publicities.modals.modalEditImage')

    <!-- Edit Modal Text-->
    @include('publicities.modals.modalEditText')

    <div class="card">
        <div class="card-body">
            <table id="table-publicity"
                class="display nowrap table table-bordered table-hover"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Nombre de la Publicidad</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Nombre de la empresa</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Fecha Final</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/lte/plugins/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $("#table-publicity").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('publicities.data') }}`,
        type: 'GET',
        columnDefs: [
            {
                sortable: false,
                targets: "_all"
            }
        ],
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
                data: "nombre"
            },
            {
                data: "tipo",
                render: function(data, row, type) {
                    return data==='Publicidad Destacada' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-info">${data}</span>`;
                }
            },
            {
                data: "descripcion"
            },
            {
                data: "estado",
                render: function(data, row, type) {
                    return data==='Activo' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-danger">${data}</span>`;
                }
            },
            {
                data: "sub_categoria"
            },
            {
                data: "fecha_inicio"
            },
            {
                data: "fecha_fin"
            },
            {
                data: "actions",
            }
        ]
    })
</script>
<script src="{{ asset('assets/js/publicities/publicities.js') }}" type="module"></script>
@endpush