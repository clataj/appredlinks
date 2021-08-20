@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <h3 class="h3 text-gray-800">Listado de Cupones</h3>

        @if ($enterprise->limite_cupon > 0)
            <!-- Button trigger modal -->
            <button
                id="openModalCoupon"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalCoupon">
                <i class="fa fa-plus"></i> Agregar Cupon
            </button>
            @else
            <h3>Se han agotado los cupones</h3>
        @endif

    </div>

</div>

<!-- Create Modal -->
@include('coupons.modals.modalCreate')

<!-- Edit Modal Text-->
@include('coupons.modals.modalEdit')

@if ($enterprise->limite_cupon > 0)
<div class="row">
    <div class="col">
        <span>Usted tiene {{ $enterprise->limite_cupon }} cupones por registrar</span>
    </div>
</div>
@endif

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
                            <th scope="col">Cantidad de cupones por Usuario</th>
                            <th scope="col">Limite de numero de cupones</th>
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
<script type="text/javascript">
    $("#table-coupons").DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        pageLength : 5,
        responsive : true,
        ajax: `{{ route('coupons.dataEnterprise', $id) }}`,
        type: 'GET',
        columnDefs : [
            {
                targets : "_all",
                sortable : false
            }
        ],
        language: {
            emptyTable: "No hay información",
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
                data : "cant_x_usua"
            },
            {
                data: "num_cupon"
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
@endpush
