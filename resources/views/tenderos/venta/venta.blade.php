@include('tenderos.venta.includes.mostrarDetalleVenta')
{{--@include('tenderos.vitrina.includes.realizarVenta')--}}


@extends('layouts.dashboard')

@section('title')
    Cuenta Fácil | Ventas
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
                        <a href="{{route('proveedor-informal.index')}}">
                            <span aria-hidden="true" class="se7en-tables"></span>Proveedores Informales</a>
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
                        <a class="current" href="ventas">
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
                    <h3>
                        Ventas en curso
                    </h3>
                </div>

                <div class="widget-content padded clearfix">
                    <div class="table-responsive">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th style="width:50%">Producto</th>
                                <th style="width:10%" class="text-center">Precio</th>
                                <th style="width:8%" class="text-center">Cantidad</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (Cart::instance('venta')->content() as $producto)
                                <tr>

                                    <td data-th="Product">
                                        <div class="row">
                                            {{--<div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>--}}
                                            <div class="col-sm-10">
                                                <h4 class="nomargin">{{$producto->name}}</h4>

                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" class="text-center">${{$producto->price}}</td>

                                    <td data-th="Quantity" class="text-center">{{$producto->qty}}</td>

                                    <td data-th="Subtotal" class="text-center">${{$producto->total()}}</td>
                                    <td data-th="{{$producto->rowId}}" class="actions">
                                        <button class="btn btn-danger btn-sm eliminar-producto-carrito"><i class="fa fa-trash-o"></i></button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="visible-xs">
                                <td class="text-center"><strong>${{Cart::instance('venta')->total()}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="1" class="hidden-xs"></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>${{Cart::instance('venta')->total()}}</strong></td>
                                <td><a href="#" id="empty" class="btn btn-success btn-block">Finalizar <i class="fa fa-angle-right"></i></a></td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
                <div class="heading">
                    {{--<button class="btn btn-success" data-toggle="modal" href="#modal-realizar-compra">--}}
                        {{--<i class="fa fa-plus-square"></i>Realizar Compra--}}
                    {{--</button>--}}
                    <h3>
                        Mis Compras
                    </h3>

                </div>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example2">
                        <thead>

                        <th>
                            #Id Compra
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Fecha de Venta
                        </th>

                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($ventas as $venta)
                            <tr
                                    data-id="{{$venta->id}}">

                                <td>{{$venta->id}}</td>
                                <td>{{$venta->nombre}}</td>
                                <td>{{$venta->created_at}}</td>

                                <td class="actions">
                                    <div class="action-buttons">
                                        <a class="table-actions visualizar-venta" href="#">
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

    $('.eliminar-producto-carrito').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('td');
        var id = fila.data('th');
        $.ajax({
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'carrito-venta/' + id,
            success: function (data) {
                swal({
                    title: 'Se Elimino del Carrito',
                    type: 'success',
                    html:
                    '<b>Nombre: </b>' +
                    data.name+' <br>',
                    showCloseButton: true,
                    confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Ok'
                }).then(function() {
                    location.reload();
                })
            }
        });
    });

    $('#empty').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'ventas',
            success: function (data) {
                console.log(data);
                swal({
                    title: 'Se realizó la compra',
                    type: 'success',
                    html:
                    '<b>Nombre: </b>' +
                    data.name+' <br>',
                    showCloseButton: true,
                    confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Ok'
                }).then(function() {
                    location.reload();
                })
            }
        });
    });


</script>

@endpush