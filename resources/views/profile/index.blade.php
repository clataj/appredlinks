@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-md-12">
        <form
            action="{{ route('profile.updateCredentials', Auth::user()->id) }}"
            class="card shadow" method="POST">
            @csrf

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cambiar contraseña</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="newpassword">Nueva contraseña *</label>
                            <input
                                name="newpassword"
                                type="password"
                                class="form-control
                                @error('newpassword')
                                    {{ 'is-invalid' }}
                                @enderror
                                "
                                placeholder="Nueva Contraseña" />
                            @error('newpassword')
                            <h6 class="m-0 font-weight-bold text-danger">
                                {{ $message }}
                            </h6>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="repassword">Repita contraseña *</label>
                            <input
                                name="repassword"
                                type="password"
                                class="form-control
                                @error('repassword')
                                    {{ 'is-invalid' }}
                                @enderror
                                "
                                placeholder="Repita contraseña"
                                autocomplete="newpassword"
                                />
                                @error('repassword')
                                <h6 class="m-0 font-weight-bold text-danger">
                                    {{ $message }}
                                </h6>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Contraseña actual *</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control
                                @error('password')
                                    {{ 'is-invalid' }}
                                @enderror"
                                placeholder="Contraseña actual" />
                            @error('password')
                            <h6 class="m-0 font-weight-bold text-danger">
                                {{ $message }}
                            </h6>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-danger">
                            <em>Nota:
                                <span class="text-dark">
                                    Para cambiar la contraseña es necesario
                                    verificar su contraseña actual
                                </span>
                            </em>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar datos</button>
            </div>
        </form>
    </div>

</div>
@endsection
