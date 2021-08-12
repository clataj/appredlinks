@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark">Listado de Categorias</h3>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2">
        <div class="col-md-6">
            <!-- Button trigger modal -->
            <button
                id="openModalCategory"
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalCategory">
                <i class="fa fa-plus"></i> Agregar Categoria
            </button>
        </div>
    </div>

    <!-- Create Modal -->

    @include('categories.modalCreate')

    <!-- Edit Modal Text -->
    @include('categories.modalEditText')

    <!-- Edit Modal Image-->
    @include('categories.modalEditImage')

    <div class="card">
        <div class="card-body">
            <table id="table-category" class="display nowrap table table-bordered table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">Categoria</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#table-category").DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,
        ajax: `{{ route('categories.data') }}`,
        type: 'GET',
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
        columns : [
            {
                data : "name"
            },
            {
                data : "status",
                render: function(data, type, row) {
                    return data==='Activo' ? `<span class="badge badge-success">${data}</span>` : `<span class="badge badge-danger">${data}</span>`;
                }
            },
            {
                data : "actions"
            }
        ]
    });
</script>
<script src="{{ asset('assets/js/categories/categories.js') }}" type="module"></script>
@endpush
