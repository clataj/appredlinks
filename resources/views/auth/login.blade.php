@extends('auth.app')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>Inicio de sesion</h1>
                <p class="text-muted">Ingrese a su cuenta</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Correo electrónico"
                        name="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->has('email') }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-key"></i>
                        </span>
                    </div>
                    <input
                        class="form-control"
                        type="password"
                        placeholder="Contraseña"
                        name="password"
                    >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit">Iniciar sesión</button>
                        </div>
                    </form>
                    <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="btn btn-link px-0" type="button">¿Olvidó su contraseña?</a>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
