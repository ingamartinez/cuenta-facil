@include('tenderos.vitrina.includes.realizarCompra')
@include('tenderos.vitrina.includes.realizarVenta')
@include('tenderos.vitrina.includes.editProducto')


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
                            <img width="34" height="34" src="images/user_icon.png"/>{{Auth::guard('web_tendero')->user()->nombre}}<b class="caret"></b></a>
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
                        <a class="current" href="{{route('vitrina.index')}}">
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
            Listado de Productos
        </h1>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    {{--<button class="btn btn-success" data-toggle="modal" href="#modal-realizar-compra">--}}
                        {{--<i class="fa fa-plus-square"></i>Realizar Compra--}}
                    {{--</button>--}}
                    <h3>
                        Inventario
                    </h3>
                </div>

                <div class="widget-content padded clearfix table-responsive">
                    <table class="table table-bordered table-striped" id="example">
                        <thead>

                        <th>
                            Cantidad
                        </th>
                        <th>
                            Codigo
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Presentación completa
                        </th>
                        <th>
                            Stock Minimo
                        </th>
                        <th>
                            Stock Maximo
                        </th>
                        <th>
                            Precio Compra Ponderado
                        </th>
                        <th>
                            Precio Venta Actual
                        </th>
                        <th>
                            Ganancia en Porcentaje
                        </th>
                        <th>
                            Estado
                        </th>

                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($inventario as $producto)
                            <tr
                                data-id="{{$producto->id}}">

                                <td>{{$producto->cantidad}}</td>
                                <td>{{$producto->codigo}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</td>
                                <td>{{$producto->stock_min}}</td>
                                <td>{{$producto->stock_max}}</td>
                                <td>${{$producto->precio_compra_ponderado}}</td>
                                <td>${{$producto->precio_venta_actual}}</td>

                                @if(isset($producto->ganancia_percent))
                                    <td>{{$producto->ganancia_percent}}%</td>
                                @else
                                    <td>
                                        <b class="alert-danger">Defina el precio de Venta</b>
                                    </td>
                                @endif


                                @if ($producto->estado === 'disponible')
                                    <td>
                                        <span class="label label-success">Disponible</span>
                                    </td>
                                @elseif ($producto->estado === 'agotado')
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
                                        <a class="table-actions editar-producto" href="#">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="table-actions vender-producto" href="#">
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
            <div class="widget-container fluid-height clearfix table-responsive">
                <div class="heading">
                    {{--<button class="btn btn-success" data-toggle="modal" href="#modal-realizar-compra">--}}
                        {{--<i class="fa fa-plus-square"></i>Realizar Compra--}}
                    {{--</button>--}}
                    <h3>
                        Productos de Proveedores
                    </h3>

                </div>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example2">
                        <thead>

                        <th>
                            Cantidad
                        </th>
                        <th>
                            Codigo
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Presentación completa
                        </th>
                        <th>
                            IVA
                        </th>
                        <th>
                            Precio Ofrecido
                        </th>
                        <th>
                            Nombre Proveedor
                        </th>
                        <th>
                            Nit
                        </th>

                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($productos_proveedores as $producto)
                            <tr
                                    data-id="{{$producto->id}}">

                                <td>{{$producto->cantidad_disponible}}</td>
                                <td>{{$producto->codigo}}</td>
                                <td>{{$producto->nombre}}</td>
                                <td>{{$producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</td>
                                <td>{{$producto->iva}}</td>
                                <td>${{$producto->precio_ofrecido}}</td>
                                <td>{{$producto->nombre_proveedor}}</td>
                                <td>{{$producto->nit}}</td>




                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions comprar-producto" href="#">
                                            <i class="fa fa-arrow-left"></i>
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