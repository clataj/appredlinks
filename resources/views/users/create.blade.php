@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Datos del usuario</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            {{-- <input type="hidden" id="empresa_id" name="enterprises[]"> --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nombres *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Ingrese nombres"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Correo electrónico *</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            placeholder="Ingrese correo electrónico"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Contraseña *</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingrese contraseña"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password-confirm">Confirmar contraseña *</label>
                    <input
                        id="password-confirm"
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        required
                        placeholder="Repita la contraseña"
                        autocomplete="new-password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="role_id">Rol *</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="0" selected disabled>-- Seleccione --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="searchShow" style="display: none">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table id="table-enterprise" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">Nombre Compañia</th>
                                        <th scope="col">Categoría</th>
                                        <th scope="col">RUC</th>
                                        <th scope="col">Razón Social</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="save-button" type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
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
                data: "estado",
                render: function(data, type, row) {
                    return data==='Activo' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-danger">${data}</span>`;
                }
            },
            {
                data: "id",
                render: function(data, type, row) {
                    return `<div class="text-center">
                                <input type="checkbox" name="enterprises[]" id="checkbox-${data}" class="check btn btn-sm" value="${data}">
                            </div>`
                }
            }
        ]
    })
    </script>
    <script src="{{ asset('assets/js/users/users.js') }}" type="module"></script>
@endpush
