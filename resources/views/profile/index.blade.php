@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="row mb-4">

    <div class="col-md-12">

        <form id="form-profile" class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mi Perfil</h6>
            </div>

            <div class="py-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre *</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Correo electronico *</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="email"
                                    id="email"
                                    value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

</div>

<!-- Page Heading -->
<div class="row">
    <div class="col-md-12">
        <form id="form-credentials"
            class="card shadow">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cambiar contraseña</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="newpassword">Nueva contraseña *</label>
                            <input
                                id="newpassword"
                                name="newpassword"
                                type="password"
                                class="form-control"
                                placeholder="Nueva Contraseña" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="repassword">Repita contraseña *</label>
                            <input
                                id="repassword"
                                name="repassword"
                                type="password"
                                class="form-control"
                                placeholder="Repita contraseña"
                                autocomplete="newpassword"
                                />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">Contraseña actual *</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                placeholder="Contraseña actual" />
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
@push('scripts')
<script type="text/javascript">
    window.USERID = '{{ Auth::user()->id }}'
</script>
<script src="{{ asset('assets/js/profile/profile.js') }}" type="module"></script>
<script src="{{ asset('assets/js/profile/forms.js') }}" type="module"></script>
@endpush
