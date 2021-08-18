@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">Listado de Usuarios</h3>
    <div class="row mb-2">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button
                id="openModal"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalUser">
                <i class="fa fa-user-plus"></i> Agregar Usuario
            </button>

            <!-- Modal Create -->
            @include('users.modalCreate')

            <!-- Modal Edit -->
            @include('users.modalEdit')

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-user" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                    <thead>

                        <tr>
                            <th scope="col">Nombres</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
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
    $("#table-user").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('users.data') }}`,
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
        columns : [
            {
                data: 'name',
            },
            {
                data: 'email',
            },
            {
                data : 'options',
            }
        ]
    });
</script>
<script src="{{ asset('assets/js/users/users.js') }}" type="module"></script>
@endpush
