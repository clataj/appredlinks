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
        <form method="POST" action="{{ route('users.update', $userEdit->id) }}">
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
                            value="{{ $userEdit->name }}"
                            placeholder="Ingrese nombres"
                            class="form-control
                            @error('name')
                                {{ 'is-invalid' }}
                            @enderror"
                            >
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Correo electrónico *</label>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            value="{{ $userEdit->email }}"
                            placeholder="Ingrese correo electrónico"
                            class="form-control
                            @error('email')
                                {{ 'is-invalid' }}
                            @enderror"
                            >
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="role_id">Rol *</label>
                        <select
                            name="role_id"
                            id="role_id"
                            class="form-control
                                @error('role_id')
                                    {{ 'is-invalid' }}
                                @enderror"
                            >
                            <option value="0" selected disabled>-- Seleccione --</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    {{ $userEdit->role_id === $role->id ? 'selected' : '' }}>
                                    {{ $role->descripcion }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            @if ($userEdit->role_id == 2)
                <div id="searchShow">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="enterprises">Buscar empresa</label>
                                <select
                                    id="enterprises"
                                    name="enterprises[]"
                                    class="form-control
                                        @error('enterprises')
                                            {{ 'is-invalid' }}
                                        @enderror"
                                    multiple="multiple">
                                    @foreach($enterprises as $enterprise)
                                        <option value="{{ $enterprise->id }}" {{ in_array($enterprise->id, $ids) ? 'selected' : '' }}>{{$enterprise->nombre_comercial}}</option>
                                    @endforeach
                                </select>
                                @error('enterprises')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div id="searchShow" style="display: none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="enterprises">Buscar empresa</label>
                                <select
                                    id="enterprises"
                                    name="enterprises[]"
                                    class="form-control
                                        @error('enterprises')
                                            {{ 'is-invalid' }}
                                        @enderror"
                                    multiple="multiple">
                                    @foreach($enterprises as $enterprise)
                                        <option value="{{ $enterprise->id }}" {{ in_array($enterprise->id, $ids) ? 'selected' : '' }}>{{$enterprise->nombre_comercial}}</option>
                                    @endforeach
                                </select>
                                @error('enterprises')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/lte/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var values = $('#enterprises option[selected="true"]').map(function() {
            return $(this).val();
        }).get();
        $("#enterprises").select2({
            placeholder: "SELECCIONE..",
            theme: 'bootstrap4'
        });
    </script>
    <script src="{{ asset('assets/js/users/edit-user.js') }}"></script>
@endpush
