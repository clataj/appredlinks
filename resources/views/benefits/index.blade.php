@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-12">
            <!-- Button trigger modal -->
            <button
                id="openModalBenefits"
                type="button"
                class="btn btn-primary float-left"
                data-toggle="modal"
                data-target="#modalBenefits">
                <i class="fa fa-plus"></i> Agregar Beneficio
            </button>
            <a href="{{ route('enterprises.index') }}">
                <button
                    type="button"
                    class="btn btn-primary float-right">
                    <i class="fa fa-arrow-left"></i> Regresar
                </button>
            </a>
        </div>
    </div>
    <!-- Create Modal -->
    @include('benefits.modals.modalCreate')

    <!-- Edit Modal -->
    @include('benefits.modals.modalEdit')

    <div class="card">
        <div class="card-body">
            <table id="table-benefits"
                class="display nowrap table table-bordered table-hover"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#table-benefits").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('benefits.data', $id) }}`,
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
                data: "descripcion"
            },
            {
                data: "actions"
            }
        ]
    });
</script>
<script src="{{ asset('assets/js/benefits/benefits.js') }}" type="module"></script>
@endpush
