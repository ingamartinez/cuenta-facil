<div class="modal fade" id="modal-registrar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Registrate!!
                </h4>
            </div>
            <div class="modal-body">
                <div class="widget-container fluid-height">
                    <div class="heading tabs">
                        <ul class="nav nav-tabs pull-right" data-tabs="tabs" id="tabs">
                            <li>
                                <a data-toggle="tab" href="#tab2"><i class="fa fa-user"></i><span>Proveedor</span></a>
                            </li>
                            <li class="active">
                                <a data-toggle="tab" href="#tab1"><i class="fa fa-paper-clip"></i><span>Tendero</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content padded" id="my-tab-content">
                        <div class="tab-pane active" id="tab1">
                            <h3>
                                Overview
                            </h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque imperdiet auctor purus, non imperdiet sapien dapibus non. Phasellus pretium rutrum elit in cursus. Donec ullamcorper nec massa vel mattis. Curabitur eros metus, dapibus quis est et, dapibus imperdiet dolor.
                            </p>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3>
                                Registrate como un proveedor
                            </h3>
                            {!! Form::open(['route'=>'proveedor.store','method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-registrar-proveedor']) !!}
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
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="contraseña">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 centered">
                                    <button class="btn btn-primary" type="submit">Registrarme</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button class="btn btn-default-outline" data-dismiss="modal" type="button">Cerrar</button>

            </div>
        </div>
    </div>
</div>
</div>

@push('script')

<script>

    var presentacion="";
    var unidad_medida="";
    var medida="";

    $('.select-presentacion').on('change', function() {
        presentacion = $(".select-presentacion>option:selected").html();
        producto();
    });

    $('.select-unidad_medida').on('change', function() {
        unidad_medida= $(".select-unidad_medida>option:selected").html();
        producto();
    });

    $('#text_medida').on('keyup', function() {
        medida= $(this).val();
        producto();
    });
    $('#nombre').on('keyup', function() {
        $('#label_producto').text($(this).val());
    });

    function producto() {
        $('#label_id').text(presentacion+' de '+medida+' '+unidad_medida);
    }


    $('#nombre').select2({
        theme: "bootstrap",
        language: "es",
        placeholder: 'Enter a tag',
        ajax: {
            dataType: 'json',
            url: '{{ url("api/productos") }}',
            delay: 400,
            data: function(params) {
                return {
                    term: params.term
                }
            },
            processResults: function (data, page) {
                return {
                    results: data
                };
            },
        }
    });

</script>

@endpush