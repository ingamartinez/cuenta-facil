<div class="modal fade" id="modal-editar-producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Editar producto
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['producto.store',':PRODUCTO_ID'],'method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-editar-producto']) !!}
                    <input id="modal-editar-id-producto" name="id-producto" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="codigo">Codigo</label>
                            <input type="text" class="form-control" name="codigo" placeholder="Codigo">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            {{--<select style="width: 100%" class="form-control" name="nombre" id="nombre" placeholder="Nombre">--}}
                            {{--</select>--}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="iva">IVA</label>
                            <input type="text" class="form-control" name="iva" placeholder="IVA" value="0">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group formPresentacion">
                                {!! Form::label('presentacion','Presentacion') !!}
                                <select class="form-control select-presentacion" name="presentacion" id="presentacion">
                                    <option>Seleccione... </option>
                                    @foreach($presentaciones as $presentacion)
                                        <option value='{{$presentacion->id}}'>{{$presentacion->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="medida">Medida</label>
                            <input type="text" class="form-control" id="text_medida" name="medida" placeholder="Medida">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group formUnidad_medida">
                                {!! Form::label('unidad_medida','Unidad de Medida') !!}
                                <select class="form-control select-unidad_medida" id="" name="unidad_medida"
                                        id="unidad_medida">
                                    <option>Seleccione... </option>
                                    @foreach($unidades_medidas as $unidad_medida)
                                        <option value='{{$unidad_medida->id}}'>{{$unidad_medida->nombre}}</option>
                                    @endforeach
                                </select>
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