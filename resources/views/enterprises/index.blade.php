@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">Listado de Empresas</h3>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2">
        <div class="col-md-6">
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

    <!-- Create Modal -->

    @include('enterprises.modalCreate')

    <!-- Edit Modal Text -->
    @include('enterprises.modalEditText')

    <div class="card">
        <div class="card-body">
            <table id="table-enterprise" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>

                    <tr>
                        <th scope="col">Nombre de la compañia</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">RUC</th>
                        <th scope="col">Razón Social</th>
                        <th scope="col">Beneficio</th>
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
@endsection
@push('scripts')
<script type="text/javascript">
    $("#table-enterprise").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('enterprises.data') }}`,
        type: 'GET',
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                "Mostrar <select>" +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="15">20</option>' +
                '<option value="20">40</option>' +
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
<script src="{{ asset('assets/js/enterprises/enterprises.js') }}" type="module"></script>

@endpush
