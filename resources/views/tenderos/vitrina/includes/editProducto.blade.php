<div class="modal fade" id="modal-editar-producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Editar Producto
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['producto.destroy',':PRODUCTO_ID'],'method'=> 'POST','autocomplete'=>'off',
                'id'=>'form-modal-editar-producto_proveedor','class'=>'form']) !!}
                    <input id="modal-editar-id-producto" name="id_producto" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('producto','Producto') !!}
                            <select disabled class="form-control select-producto" name="producto" id="modal-editar-producto" >
                                <option>Seleccione... </option>
                                @foreach($inventario as $producto)
                                    <option value='{{$producto->id}}'>{{$producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="precio_compra">Compra Ponderada</label>
                                <input type="text" class="form-control" id="modal-editar-precio_compra"
                                       disabled>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="stock_minimo">Stock Minimo</label>
                                <input type="text" class="form-control" id="modal-editar-stock_minimo"
                                       name="stock_minimo" placeholder="Stock Minimo">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="stock_maximo">Stock Maximo</label>
                                <input type="text" class="form-control" id="modal-editar-stock_maximo"
                                       name="stock_maximo" placeholder="Stock Maximo">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_venta">Precio Venta</label>
                            <input type="text" class="form-control text-precio_ofrecido" id="modal-editar-precio_venta"
                                   name="precio_venta" placeholder="Precio Venta">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="ganancia_percent">Ganancia Porcentaje</label>
                            <input type="text" class="form-control text-precio_ofrecido" id="modal-editar-ganancia_percent"
                                   name="ganancia_percent" placeholder="Ganancia en Porcentaje">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-disponibilidad" id="modal-editar-disponibilidad"
                                    name="estado">
                                <option>Seleccione... </option>
                                <option value='disponible'>Disponible</option>
                                <option value='agotado'>Agotado</option>
                                <option value='descontinuado'>Descontinuado</option>
                            </select>
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

    $('.editar-producto').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: 'inventario/' + id,
            success: function (data) {
                console.log(data);
                $('select[id="modal-editar-producto"]').val(data.id);
                $('#modal-editar-stock_minimo').val(data.stock_min);
                $('#modal-editar-stock_maximo').val(data.stock_max);
                $('#modal-editar-precio_venta').val(data.precio_venta_actual);
                $('#modal-editar-precio_ofrecido-producto_proveedor').val(data.precio_ofrecido);
                $('#modal-editar-precio_compra').val(data.precio_compra_ponderado);
                $('select[id="modal-editar-disponibilidad"]').val(data.estado);

                $("#modal-editar-id-producto").val(data.id);

                $("#modal-editar-producto").modal('toggle');
            }
        });
    });

    $('#form-modal-editar-producto_proveedor').submit( function (e) {
        e.preventDefault();
        var id = $("#modal-editar-id-producto").val();

        $.ajax({
            type: 'PUT',
            url: 'inventario/' + id,
            data: $(this).serialize(),
            success: function () {
                swal({
                    title: 'Producto Editado',
                    type: 'success',
                    html:
                    '<b>Nombre: </b>' +
                    $('select[id="modal-editar-producto"] option:selected').html()+' <br>',
                    showCloseButton: true,
                    confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> Ok'
                }).then(function() {
                    location.reload();
                })
            }
        });
    });

    $('#modal-editar-precio_venta').keyup(function(){
        var precioCompra = parseFloat($('#modal-editar-precio_compra').val());
        var precioVenta =  parseFloat($('#modal-editar-precio_venta').val());

        console.log(precioCompra,precioVenta)

        var diferencia = precioVenta-precioCompra;
        var porcentaje = (diferencia/precioCompra)*100;
        porcentaje = porcentaje.toFixed(2);
        $('#modal-editar-ganancia_percent').val(porcentaje+"%");

    });

    $('#modal-editar-ganancia_percent').keyup(function(){
        var precioCompra = parseFloat($('#modal-editar-precio_compra').val());
        var ganancia=  parseFloat($('#modal-editar-ganancia_percent').val().replace('%',''));

        var precioAVender = Math.round(((ganancia*precioCompra)/100)+precioCompra);
        $('#modal-editar-precio_venta').val(precioAVender);
    });

</script>

@endpush