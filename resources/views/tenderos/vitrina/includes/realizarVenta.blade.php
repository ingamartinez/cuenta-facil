<div class="modal fade" id="modal-realizar-venta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Realizar Venta
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['producto.destroy',':PRODUCTO_ID'],'method'=> 'POST','autocomplete'=>'off',
                'id'=>'form-modal-realizar-venta','class'=>'form']) !!}
                <input id="modal-realizar-venta-id-inventario" name="id_inventario" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('producto','Producto') !!}
                            <select disabled class="form-control select-producto" name="producto" id="modal-editar-producto-inventario" >
                                <option>Seleccione... </option>
                                @foreach($inventario as $producto)
                                    <option value='{{$producto->id}}'>{{$producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label style="font-weight: 700;font-size: 20px; margin-bottom: 0px;padding-bottom: 0px" for="">
                                Datos Inventario
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group" disabled>
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control text-cantidad" id="modal-editar-cantidad-inventario"
                                       placeholder="Cantidad" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_venta_actual">Precio Venta Actual</label>
                            <input type="text" class="form-control text-precio_ofrecido" id="modal-editar-precio_venta_actual-inventario"
                                   placeholder="Precio Ofrecido" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-disponibilidad" id="modal-editar-disponibilidad-inventario"
                                    disabled>
                                <option>Seleccione... </option>
                                <option value='disponible'>Disponible</option>
                                <option value='agotado'>Agotado</option>
                                <option value='descontinuado'>Descontinuado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label style="font-weight: 700;font-size: 20px; margin-bottom: 0px;padding-bottom: 0px" for="">
                                Datos de Venta
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('cantidad','Cantidad') !!}
                                <input type="text" class="form-control text-cantidad" id="modal-cantidad-inventario"
                                       name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 centered">
                        <label style="font-weight: 700;" for="producto" id="label_producto"></label>
                    </div>
                    <div class="col-sm-12 centered">
                        <label for="producto" id="label_id"></label>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>

@push('script')

<script>

    $('.vender-producto').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: 'inventario2/' + id,
            success: function (data) {
                console.log(data);

                for (producto_prov in data){

                    console.log(data[producto_prov].id);
                    $('select[id="modal-editar-producto-inventario"]').val(data[producto_prov].id);
                    $('#modal-editar-cantidad-inventario').val(data[producto_prov].cantidad);
                    $('#modal-editar-precio_venta_actual-inventario').val(data[producto_prov].precio_venta_actual);
                    $('select[id="modal-editar-disponibilidad-inventario"]').val(data[producto_prov].estado);

                    $("#modal-realizar-venta-id-inventario").val(data[producto_prov].id);
                }
                $("#modal-realizar-venta").modal('toggle');
            }
        });
    });

    $('#form-modal-realizar-venta').submit( function (e) {
        e.preventDefault();
        var id = $("#modal-realizar-venta-id-inventario").val();
        $.ajax({
            type: 'POST',
            url: 'carrito-venta',
            data: $(this).serialize(),
            success: function (data) {
                $("#modal-realizar-venta").modal('toggle');
                swal({
                    title: 'Se añadió al Carrito',
                    type: 'success',
                    html:
                    '<b>Nombre: </b>' +
                    data.name+' <br>'+
                    '<b>Cantidad en el Carrito: </b>' +
                    data.qty +' <br>',
                    showCloseButton: true,
                    confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Ok'
                });
            },
            error: function (data) {
                var cartItem=data.responseJSON;
                swal({
                    title: 'Error al agregar cantidad al carrito',
                    type: 'error',
                    html:
                    '<b>La cantidad se Excede</b> <br> <br>'+
                    'Cantidad del Carrito: '+
                    '<b>'+cartItem.qty+' </b><br>'+
                    'Cantidad que se quiere ingresar: '+
                    '<b>'+$('#modal-cantidad-inventario').val()+'</b> <br>'+
                    'Cantidad del carrito mas la Ingresada: ' +
                    '<b>'+(cartItem.qty + parseInt($('#modal-cantidad-inventario').val())) +' </b> <br>',
                    showCloseButton: true,
                    confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Ok'
                });
            }
        });
    });

</script>

@endpush