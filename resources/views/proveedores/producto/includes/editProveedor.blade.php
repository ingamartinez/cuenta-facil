<div class="modal fade" id="modal-editar-proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Editar datos de Proveedor
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['proveedor.destroy',':PROVEEDOR_ID'],'method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-editar-proveedor']) !!}
                    <input id="modal-editar-id-proveedor" name="id-proveedor" type="hidden" value="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="modal-editar-nombre-proveedor" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="NIT">NIT</label>
                                <input type="text" class="form-control" name="nit" id="modal-editar-nit-proveedor" placeholder="NIT">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-group formCategoria">
                                    {!! Form::label('categoria','Categorias') !!}
                                    <select class="form-control" name="categoria" id="modal-editar-categoria-proveedor">
                                        @foreach($categorias as $categoria)
                                            <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
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