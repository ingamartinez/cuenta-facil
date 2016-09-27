{{--@include('proveedor.includes.addProveedor')--}}
{{--@include('proveedor.includes.editProveedor')--}}

@extends('layouts.dashboard')

@section('title')
    Tienda | Proveedor
@endsection

@section('nagivation')
    <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown user "><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img width="34" height="34" src="images/user_icon.png"/>John Smith<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">
                                    <i class="fa fa-user"></i>My Account</a>
                            </li>
                            <li><a href="#">
                                    <i class="fa fa-gear"></i>Account Settings</a>
                            </li>
                            <li><a href="login1.html">
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
                        <a  href="/">
                            <span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
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
            Listado de Proveedores
        </h1>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <i class="fa fa-table"></i>Listado de Proveedores

                </div>
                <div class="heading">
                    <button class="btn btn-success" data-toggle="modal" href="#modal-agregar-proveedor">
                        <i class="fa fa-plus-square"></i>Agregar Proveedor
                    </button>

                </div>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example">
                        <thead>

                        <th>
                            Nombre Proveedor
                        </th>
                        <th>
                            NIT
                        </th>
                        <th>
                            Categoría
                        </th>
                        <th></th>
                        </thead>
                        <tbody>
                        {{--@foreach($proveedores as $proveedor)--}}
                        {{--<tr data-id="{{$proveedor->proveedor_id}}">--}}
                        {{--<td>{{$proveedor->proveedor_nombre}}</td>--}}
                        {{--<td>{{$proveedor->proveedor_nit}}</td>--}}
                        {{--<td>{{$proveedor->categoria_nombre}}</td>--}}
                        {{--<td class="actions">--}}
                        {{--<div class="action-buttons">--}}
                        {{--<a class="table-actions ver-proveedor" href="#"><i class="fa fa-eye"></i></a>--}}
                        {{--<a class="table-actions editar-proveedor" href="#"><i class="fa fa-pencil"></i></a>--}}
                        {{--<a class="table-actions eliminar-proveedor" href="#"><i class="fa fa-trash-o"></i></a>--}}
                        {{--</div>--}}
                        {{--</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}

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