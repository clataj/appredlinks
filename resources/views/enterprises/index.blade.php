@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">Listado de Empresas</h3>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button
                id="openModalEnterprise"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalEnterprise">
                <i class="fa fa-plus"></i> Agregar Empresa
            </button>
        </div>
    </div>

    <!-- Create Modal -->

    @include('enterprises.modalCreate')
</div>
@endsection
