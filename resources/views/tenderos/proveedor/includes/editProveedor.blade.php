<div class="modal fade" id="modal-editar-proveedor-informal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Registrar un nuevo Proveedor Informal
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'proveedor-informal.store','method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-editar-proveedor']) !!}
                <input id="modal-editar-id-proveedor" name="id_proveedor" type="hidden" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nit">NIT</label>
                            <input type="text" class="form-control" name="nit" placeholder="NIT" id="modal-editar-nit-proveedor">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre" id="modal-editar-nombre-proveedor">
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

    $('.editar-proveedor').on('click', function (e) {
        e.preventDefault();
        var fila = $(this).parents('tr');
        var id = fila.data('id');
        $.ajax({
            type: 'GET',
            url: '/proveedor-informal2/' + id,
            success: function (data) {
                console.log(data);
                $('#modal-editar-nombre-proveedor').val(data.nombre);
                $('#modal-editar-nit-proveedor').val(data.nit);

                $("#modal-editar-id-proveedor").val(data.id);

                $("#modal-editar-proveedor-informal").modal('toggle');
            }
        });
    });

    $('#form-editar-proveedor').submit( function (e) {
        e.preventDefault();
        var id = $("#modal-editar-id-proveedor").val();
        console.log(id);

        $.ajax({
            type: 'PUT',
            url: '/proveedor-informal/' + id,
            data: $(this).serialize(),
            success: function () {
                location.reload();
            }
        });
    });


</script>

@endpush







