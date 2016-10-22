<div class="modal fade" id="modal-editar-producto_proveedor">
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
                    <input id="modal-editar-id-producto_proveedor" name="id_producto_proveedor" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('producto','Producto') !!}
                            <select disabled class="form-control select-producto" name="producto" id="modal-editar-producto-producto_proveedor" >
                                <option>Seleccione... </option>
                                @foreach($productos2 as $producto)
                                    <option value='{{$producto->id}}'>{{$producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                {!! Form::label('cantidad','Cantidad') !!}
                                <input type="text" class="form-control text-cantidad" id="modal-editar-cantidad-producto_proveedor"
                                       name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_ofrecido">Precio Ofrecido</label>
                            <input type="text" class="form-control text-precio_ofrecido" id="modal-editar-precio_ofrecido-producto_proveedor"
                                   name="precio_ofrecido" placeholder="Precio Ofrecido">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-disponibilidad" id="modal-editar-disponibilidad-producto_proveedor"
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

    $('.editar-producto_proveedor').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: 'disponibilidad/' + id,
            success: function (data) {
                console.log(data);
                $('select[id="modal-editar-producto-producto_proveedor"]').val(data.id);
                $('#modal-editar-cantidad-producto_proveedor').val(data.cantidad);
                $('#modal-editar-precio_ofrecido-producto_proveedor').val(data.precio_ofrecido);
                $('select[id="modal-editar-disponibilidad-producto_proveedor"]').val(data.estado);

                $("#modal-editar-id-producto_proveedor").val(data.id);

                $("#modal-editar-producto_proveedor").modal('toggle');
            }
        });
    });

    $('#form-modal-editar-producto_proveedor').submit( function (e) {
        e.preventDefault();
        var id = $("#modal-editar-id-producto_proveedor").val();

        $.ajax({
            type: 'PUT',
            url: 'disponibilidad/' + id,
            data: $(this).serialize(),
            success: function () {
                location.reload();
            }
        });
    });

</script>

@endpush