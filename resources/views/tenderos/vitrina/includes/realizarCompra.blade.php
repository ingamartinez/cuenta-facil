<div class="modal fade" id="modal-realizar-compra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Realizar Compra
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['producto.destroy',':PRODUCTO_ID'],'method'=> 'POST','autocomplete'=>'off',
                'id'=>'form-modal-realizar-compra','class'=>'form']) !!}
                    <input id="modal-realizar-compra-id-producto_proveedor" name="id_producto_proveedor" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('producto','Producto') !!}
                            <select disabled class="form-control select-producto" name="producto" id="modal-editar-producto-producto_proveedor" >
                                <option>Seleccione... </option>
                                @foreach($productos_proveedores as $producto)
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
                                Datos Proveedor
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group" disabled>
                                {!! Form::label('cantidad','Cantidad') !!}
                                <input type="text" class="form-control text-cantidad" id="modal-editar-cantidad-producto_proveedor"
                                       placeholder="Cantidad" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_ofrecido">Precio Ofrecido</label>
                            <input type="text" class="form-control text-precio_ofrecido" id="modal-editar-precio_ofrecido-producto_proveedor"
                                   placeholder="Precio Ofrecido" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-disponibilidad" id="modal-editar-disponibilidad-producto_proveedor"
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
                                Datos de Compra
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('cantidad','Cantidad') !!}
                                <input type="text" class="form-control text-cantidad" id="modal-cantidad-producto_proveedor"
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

    $('.comprar-producto').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: 'vitrina/' + id,
            success: function (data) {
                console.log(data);

                for (producto_prov in data){

                    console.log(data[producto_prov].id);
                    $('select[id="modal-editar-producto-producto_proveedor"]').val(data[producto_prov].id);
                    $('#modal-editar-cantidad-producto_proveedor').val(data[producto_prov].cantidad_disponible);
                    $('#modal-editar-precio_ofrecido-producto_proveedor').val(data[producto_prov].precio_ofrecido);
                    $('select[id="modal-editar-disponibilidad-producto_proveedor"]').val(data[producto_prov].estado);

                    $("#modal-realizar-compra-id-producto_proveedor").val(data[producto_prov].id);
                }
                $("#modal-realizar-compra").modal('toggle');
            }
        });
    });

    $('#form-modal-realizar-compra').submit( function (e) {
        e.preventDefault();
        var id = $("#modal-realizar-compra-id-producto_proveedor").val();
        $.ajax({
            type: 'POST',
            url: 'carrito-compra',
            data: $(this).serialize(),
            success: function (data) {
                $("#modal-realizar-compra").modal('toggle');
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
                        '<b>'+$('#modal-cantidad-producto_proveedor').val()+'</b> <br>'+
                        'Cantidad del carrito mas la Ingresada: ' +
                        '<b>'+(cartItem.qty + parseInt($('#modal-cantidad-producto_proveedor').val())) +' </b> <br>',
                    showCloseButton: true,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Ok'
                });
            }
        });
    });

</script>

@endpush