@include('tenderos.proveedor.includes.addProveedor')
@include('tenderos.proveedor.includes.editProveedor')
@include('tenderos.proveedor.includes.addProducto')
@include('tenderos.proveedor.includes.editProducto')


@extends('layouts.dashboard')

@section('title')
    Cuenta Fácil | Proveedores Informales
@endsection

@section('nagivation')
    <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown user "><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img width="34" height="34" src="{{URL::asset('images/user_icon.png')}}"/>{{Auth::guard('web_tendero')->user()->nombre}}<b class="caret"></b></a>
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
                        <a href="{{route('tendero.index')}}">
                            <span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
                    </li>
                    <li>
                        <a class="current" href="{{route('proveedor-informal.index')}}">
                            <span aria-hidden="true" class="se7en-feed"></span>Proveedores Informales</a>
                    </li>
                    <li>
                        <a href="{{route('vitrina.index')}}">
                            <span aria-hidden="true" class="se7en-tables"></span>Mi Vitrina</a>
                    </li>
                    <li>
                        <a href="clientes">
                            <span aria-hidden="true" class="se7en-forms"></span>Mis Clientes</a>
                    </li>
                    <li>
                        <a href="compras">
                            <span aria-hidden="true" class="se7en-flag"></span>Compras</a>
                    </li>
                    <li>
                        <a href="ventas">
                            <span aria-hidden="true" class="se7en-pages"></span>Ventas</a>
                    </li>
                    {{--<li>--}}
                    {{--<a href="vitrina">--}}
                    {{--<span aria-hidden="true" class="se7en-feed"></span>Vitrina</a>--}}
                    {{--</li>--}}

                </ul>
            </div>
        </div>
    </div>
@endsection

@section('container')
    <div class="page-title">
        <h1>
            Proveedores Informales
        </h1>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <h3>
                        Proveedores Informales
                    </h3>

                    <button class="btn btn-success" data-toggle="modal" href="#modal-registrar-proveedor-informal">
                        <i class="fa fa-plus-square"></i>Agregar Proveedor
                    </button>

                </div>
                <br> <br>

                <div class="widget-content padded clearfix table-responsive">
                    <table class="table table-bordered table-striped" id="example">
                        <thead>

                        <th>
                            Nit o Cedula
                        </th>
                        <th>
                            Nombre
                        </th>

                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($proveedoresInformales as $proveedor)
                            <tr
                                data-id="{{$proveedor->id}}">

                                <td>{{$proveedor->nit}}</td>
                                <td>{{$proveedor->nombre}}</td>

                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions editar-proveedor" href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="table-actions vender-producto" href="{{route('proveedor-informal.show',$proveedor->id)}}">
                                            <i class="fa fa-arrow-right"></i>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    <h3>
                        Productos
                    </h3>

                    <button class="btn btn-success" data-toggle="modal" href="#modal-agregar-producto">
                        <i class="fa fa-plus-square"></i>Agregar Producto
                    </button>

                </div>
                <br><br>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example2">
                        <thead>

                        <th>
                            Codigo
                        </th>
                        <th>
                            Producto
                        </th>
                        <th>
                            Presentación completa
                        </th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr data-id="{{$producto->id}}">
                                <td>{{$producto->id}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</td>

                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions editar-producto" href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="table-actions eliminar-producto" href="#">
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
            }],

        });
        $('#example2').dataTable({

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


</script>

@endpush