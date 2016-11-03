<div class="modal fade" id="modal-registrar-proveedor-informal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Registrar un nuevo Proveedor Informal
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'proveedor-informal.store','method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-realizar-compra']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nit">NIT</label>
                            <input type="text" class="form-control" name="nit" placeholder="NIT">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                        </div>
                    </div>
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="email">Email</label>--}}
                            {{--<input type="text" class="form-control" name="email" placeholder="Email">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="contraseña">Contraseña</label>--}}
                            {{--<input type="password" class="form-control" name="password" placeholder="Contraseña">--}}
                        {{--</div>--}}
                    {{--</div>--}}
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


</script>

@endpush







