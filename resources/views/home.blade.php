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
                <button id="save-button" type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>

</div>

@endsection
@push('scripts')
@if (session('status'))
<script type="text/javascript">
    Swal.fire({
        title: 'Exito',
        text: `{{ session('status') }}`,
        icon: 'success'
    })
</script>
@endif
<script type="text/javascript">
    window.USERID = '{{ Auth::user()->id }}'
</script>
<script src="{{ asset('assets/js/profile/profile.js') }}" type="module"></script>
<script src="{{ asset('assets/js/profile/forms.js') }}" type="module"></script>
@endpush
