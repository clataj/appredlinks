@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <h3 class="h3 text-gray-800">Listado de Cupones</h3>

        <h3 id="infoCupon" style="display: none"></h3>
        <input type="hidden" id="empresaId" value="{{ $id }}">
    </div>

</div>
<div class="row mb-4">
    <div class="col d-flex flex-column flex-md-row justify-content-between">
        <div id="showButtonAdd"></div>
        <a
            href="{{ route('users.enterprises.index', $id) }}"
            class="btn btn-danger float-right mt-1">
            <i class="fa fa-arrow-left"></i> Regresar
        </a>
    </div>
</div>

<!-- Create Modal -->
@include('empresa.coupons.modals.modalCreate')

<!-- Edit Modal Text-->
@include('empresa.coupons.modals.modalEdit')

<div id="showText"></div>
<div class="row">
    <div class="col">
        <span id="limite_cupones">
    </div>
</div>

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
        ajax: `{{ route('coupons.dataEnterprise', $id) }}`,
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
<script src="{{ asset('assets/js/empresa/coupons/coupons.js') }}" type="module"></script>
<script src="{{ asset('assets/js/empresa/coupons/forms.js') }}" type="module"></script>
@endpush
