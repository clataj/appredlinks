@push('css')
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Datos del usuario</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="enterprises">Buscar empresa</label>
                            <select id="enterprises" name="enterprises[]"  class="form-control"  multiple="multiple">
                                @foreach($enterprises as $enterprise)
                                    <option value="{{ $enterprise->id }}">{{$enterprise->nombre_comercial}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                    <button id="save-button" type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/users/create-user.js') }}"></script>
@endpush
