@include('proveedores.disponibilidad.includes.addProducto_Proveedor')
{{--@include('proveedor.includes.editProveedor')--}}

@extends('layouts.dashboard')

@section('title')
    Cuenta Fácil | Disponibilidad
@endsection

@section('nagivation')
    <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown user "><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img width="34" height="34" src="images/user_icon.png"/>{{Auth::guard('web_proveedor')->user()->nombre}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">
                                    <i class="fa fa-user"></i>My Account</a>
                            </li>
                            <li><a href="#">
                                    <i class="fa fa-gear"></i>Account Settings</a>
                            </li>
                            <li><a href="{{url('logout')}}">
                                    <i class="fa fa-sign-out"></i>Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <a class="logo" href="index.html">se7en</a>
        </div>
        <div class="container-fluid main-nav clearfix">
            <div class="nav-collapse">
                <ul class="nav">
                    <li>
                        <a href="/">
                            <span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                    </li>
                    <li>
                        <a href="producto">
                            <span aria-hidden="true" class="se7en-flag"></span>Producto</a>
                    </li>
                    <li>
                        <a class="current" href="disponibilidad">
                            <span aria-hidden="true" class="se7en-flag"></span>Disponibilidad</a>
                    </li>
                    <li>
                        <a href="#">
                            <span aria-hidden="true" class="se7en-feed"></span>Vitrina</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="page-title">
        <h1>
            Listado de Productos
        </h1>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <button class="btn btn-success" data-toggle="modal" href="#modal-agregar-producto_proveedor">
                        <i class="fa fa-plus-square"></i>Agregar Producto
                    </button>

                </div>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example">
                        <thead>

                        <th>
                            Cantidad
                        </th>
                        <th>
                            Producto
                        </th>
                        <th>
                            Codigo
                        </th>
                        <th>
                            Precio Ofrecido
                        </th>
                        <th>
                            Presentación completa
                        </th>
                        <th>
                            Estado
                        </th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($productos_proveedores as $productos)
                            <tr data-id_global="{{$productos->id_producto_global}}"
                                data-id_local="{{$productos->id_producto_local}}">

                                <td>{{$productos->cantidad}}</td>
                                <td>{{$productos->nombre}}</td>
                                <td>{{$productos->codigo}}</td>
                                <td>${{$productos->precio}}</td>
                                <td>{{$productos->presentacion.' de '.$productos->medida.' '.$productos->unidad_medida}}</td>


                                @if ($productos->estado === 'disponible')
                                    <td>
                                        <span class="label label-success">Disponible</span>
                                    </td>
                                @elseif ($productos->estado === 'agotado')
                                    <td>
                                        <span class="label label-danger">Agotado</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="label label-warning">Descontinuado</span>
                                    </td>
                                @endif

                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions ver-proveedor" href="#">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="table-actions editar-proveedor" href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="table-actions eliminar-proveedor" href="#">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

<script>
    $(document).ready(function () {
        $('#example').dataTable({
            "language": {
                url: "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            filter: true,
            sort: true,
            info: true,
            autoWidth: true,
            order: [
                [0, "desc"]
            ],
            aoColumnDefs: [{
                bSortable: false,
                "aTargets": [-1]
            }]
        });
    });

    $('.editar-proveedor').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: 'proveedor/' + id,
            success: function (data) {
                console.log(data);
                $('#modal-editar-nombre-proveedor').val(data.nombre);
                $('#modal-editar-nit-proveedor').val(data.nit);
                $('select[id="modal-editar-categoria-proveedor"]').val(data.categoria_id);

                $("#modal-editar-id-proveedor").val(data.id);

                $("#modal-editar-proveedor").modal('toggle');
            }
        });
    });

    $('#form-editar-proveedor').on('submit', function (e) {
        e.preventDefault();
        var id = $("#modal-editar-id-proveedor").val();

        $.ajax({
            type: 'PUT',
            url: 'proveedor/' + id,
            data: $('#form-editar-proveedor').serialize(),
            success: function () {
                location.reload();
            }
        });
    });

    $('.eliminar-proveedor').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'DELETE',
            url: 'proveedor/' + id,
            data: {_token: CSRF_TOKEN},
            success: function (data) {
                alert('Se elimino correctamente la el proveedor');
                location.reload();
            }
        });
    });

</script>

@endpush