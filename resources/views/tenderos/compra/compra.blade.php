@include('tenderos.compra.includes.mostrarDetalleCompra')
{{--@include('tenderos.vitrina.includes.realizarVenta')--}}


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
                        <a href="{{route('proveedor-informal.index')}}">
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
                        <a class="current" href="compras">
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
                        Compras en curso
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
                            @foreach (Cart::instance('compra')->content() as $producto)
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
                                <td class="text-center"><strong>${{Cart::instance('compra')->total()}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="1" class="hidden-xs"></td>
                                <td colspan="2" class="hidden-xs"></td>
                                <td class="hidden-xs text-center"><strong>${{Cart::instance('compra')->total()}}</strong></td>
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

                    <div class="col-md-3">
                        <input type="text" class="form-control nombre" name="daterange" value="">
                    </div>
                </div>

                <div class="widget-content padded clearfix">
                    <table class="table table-bordered table-striped" id="example2">
                        <thead>

                        <th>
                            #Id Compra
                        </th>
                        <th>
                            Proveedor
                        </th>
                        <th>
                            Total de la Compra
                        </th>
                        <th>
                            Fecha de Compra
                        </th>

                        <th></th>
                        </thead>
                        <tbody>
                        {{--@foreach($compras as $compra)--}}
                            {{--<tr--}}
                                    {{--data-id="{{$compra->id}}">--}}

                                {{--<td>{{$compra->id}}</td>--}}
                                {{--<td>{{$compra->nombre}}</td>--}}
                                {{--<td>${{$compra->total_compra}}</td>--}}
                                {{--<td>{{$compra->created_at}}</td>--}}

                                {{--<td class="actions">--}}
                                    {{--<div class="action-buttons">--}}
                                        {{--<a class="table-actions visualizar-compra" href="#">--}}
                                            {{--<i class="fa fa-arrow-left"></i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}

                        </tbody>
                    </table>
                </div>

                <div class="col-lg-6">
                    <label>Total Compras:</label><br>

                    <label style="font-weight: 700;font-size: 1.5em" id="total-precio_compra" for="total-precio_compra">
                        {{--@if(isset($compras->total_compras))--}}
                            {{--${{$compras->total_compras}}--}}
                        {{--@else--}}
                            {{--$0--}}
                        {{--@endif--}}

                    </label>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

<script>
    var table;
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
        table=$('#example2').DataTable({
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

        reloadTable(moment().startOf('year').format('YYYY-MM-DD'),moment().format('YYYY-MM-DD'))

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
            url: 'carrito-compra/' + id,
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
            url: 'compras',
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

    $('input[name="daterange"]').daterangepicker({
            locale: {
                "format": "YYYY/MM/DD",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                "fromLabel": "Desde",
                "toLabel": "Hasta",
                "customRangeLabel": "Custom",
                "weekLabel": "S",
                "daysOfWeek": [
                    "Do",
                    "Lu",
                    "Mar",
                    "Mier",
                    "Ju",
                    "Vi",
                    "Sa"
                ],
                "monthNames": [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ]
            },
            startDate: moment().startOf('year').format('YYYY-MM-DD')
        },

        function(start, end, label) {
            reloadTable(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
        }
    );


    function reloadTable(start, end) {
        table.clear().draw();
        var total=0;

        $.ajax({
            type: 'GET',
            url: '{{url('consultar-compra')}}',
            data:{'start': start, 'end': end},
            success: function (data) {
                console.log(data);
                for (var item in data){
                    table.row.add( [
                        data[item].id,
                        data[item].nombre,
                        data[item].total_compra,
                        data[item].created_at,
                        '<div class="action-buttons">'+
                        '<a class="table-actions visualizar-compra" href="#">'+
                        '<i class="fa fa-arrow-left"></i>'+
                        '</a>'+
                        '</div>'
                    ] ).draw().nodes()
                            .to$()
                            .find('td')
                            .each(function() {
                                $(this).closest("tr").attr('data-id', data[item].id);
                            });
                    total+=parseFloat(data[item].total_compra);
                }
                $('#total-precio_compra').text('$'+total);

            }
        });
    }


</script>

@endpush