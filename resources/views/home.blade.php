@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">Listado de Usuarios</h3>
        </div><!-- /.col -->
    </div><!-- /.row -->
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

            <!-- Modal -->
            <div class="modal fade" id="modalUser" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nuevo Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-user">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombres</label>
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
                                            <label for="email">Correo electrónico</label>
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
                                            <label for="password">Contraseña</label>
                                            <input
                                                type="password"
                                                id="password"
                                                name="password"
                                                placeholder="Ingrese contraseña"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password-confirm">Confirmar contraseña</label>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="save-button" type="button" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalUserEdit" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="form-user-edit">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombres</label>
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
                                            <label for="email">Correo electrónico</label>
                                            <input
                                                type="text"
                                                id="email"
                                                name="email"
                                                placeholder="Ingrese correo electrónico"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="edit-button" type="button" class="btn btn-primary">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
@endsection
@push('scripts')
<script type="text/javascript">
    function getUsers() {
        $("#table-user").DataTable({
            proccessing: true,
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
                    '<option value="15">20</option>' +
                    '<option value="20">40</option>' +
                    "</select> registros",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
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
    }
    getUsers();
</script>
<script src="{{ asset('assets/js/users/create-user.js') }}"></script>
<script src="{{ asset('assets/js/users/edit-user.js') }}"></script>
<script src="{{ asset('assets/js/users/delete-user.js') }}"></script>
@endpush
