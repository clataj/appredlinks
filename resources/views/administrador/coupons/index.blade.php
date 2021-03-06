@push('css')
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('assets/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <h3 class="h3 text-gray-800">Listado de Cupones</h3>

        <!-- Button trigger modal -->
        <button
            id="openModalCoupon"
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#modalCoupon">
            <i class="fa fa-plus"></i> Agregar Cupon
        </button>

    </div>

</div>

<!-- Create Modal -->
@include('administrador.coupons.modals.modalCreate')

<!-- Edit Modal Text-->
@include('administrador.coupons.modals.modalEdit')


<div class="row">
    <div class="col">

        <div class="card shadow mb-4 w-100">

            <div class="p-4">

                <table id="table-coupons" class="table table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Nombre de la empresa</th>
                            <th scope="col">Limite de numero de cupones</th>
                            <th scope="col">Cantidad de cupones por Usuario</th>
                            <th scope="col">Fecha Inicio</th>
                            <th scope="col">Fecha Final</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>

    </div>

</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/lte/plugins/select2/js/select2.min.js') }}"></script>
<script type="text/javascript">
    $("#table-coupons").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength : 5,
        responsive : true,
        ajax: `{{ route('coupons.data') }}`,
        type: 'GET',
        columnDefs : [
            {
                targets : "_all",
                sortable : false
            }
        ],
        language: {
            emptyTable: "No hay informaci??n",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(Filtrado de _MAX_ total registros)",
            lengthMenu:
                `Mostrar <select class="form-control form-control-sm">` +
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
                data : "texto"
            },
            {
                data : "descripcion"
            },
            {
                data: "estado"
            },
            {
                data: "empresa_id"
            },
            {
                data: "num_cupon"
            },
            {
                data : "cant_x_usua"
            },
            {
                data : "fecha_inicio"
            },
            {
                data : "fecha_fin"
            },
            {
                data : "actions"
            }

        ]
    })
</script>
<script src="{{ asset('assets/js/administrador/coupons/coupons.js') }}" type="module"></script>
<script src="{{ asset('assets/js/administrador/coupons/forms.js') }}" type="module"></script>
@endpush
