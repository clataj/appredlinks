@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Datos del usuario</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nombres *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ $user->name }}"
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
                            value="{{ $user->email }}"
                            placeholder="Ingrese correo electrónico"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="role_id">Rol *</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="0" selected disabled>-- Seleccione --</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                    {{ $role->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            @if ($user->role_id == 2)
                <div id="searchShow">
                    <div class="col">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <table id="table-enterprise" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">Nombre Compañia</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">RUC</th>
                                            <th scope="col">Razón Social</th>
                                            <th scope="col">Estado</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="edit-button" type="submit" class="btn btn-primary">Guardar</button>
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
            targets: 0,
            checkboxes: {
                'selectRow': true
            }
        } ],
        select: {
            'style': 'multi'
        },
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
                data: "id",
            },
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
        ]
    })
    </script>
    <script src="{{ asset('assets/js/users/create-user.js') }}"></script>
@endpush
