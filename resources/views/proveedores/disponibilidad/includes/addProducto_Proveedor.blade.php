<div class="modal fade" id="modal-agregar-producto_proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Agregar producto
                </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'disponibilidad.store','method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-agregar-producto']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group formPresentacion">
                            {!! Form::label('producto','Producto') !!}
                            <select class="form-control select-presentacion" name="producto" id="producto">
                                <option>Seleccione... </option>
                                @foreach($productos as $producto)
                                <option value='{{$producto->id}}'>{{$producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group formPresentacion">
                                {!! Form::label('cantidad','Cantidad') !!}
                                <input type="text" class="form-control text_medida" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_ofrecido">Precio Ofrecido</label>
                            <input type="text" class="form-control text_medida" name="precio_ofrecido" placeholder="Precio Ofrecido">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-presentacion" name="presentacion" id="modal-editar-presentacion-producto">
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
                        <label for="producto" id="label_producto_completo"></label>
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

//    var presentacion="";
//    var unidad_medida="";
//    var medida="";
//
//    $('.select-presentacion').on('change', function() {
//        presentacion = $(".select-presentacion>option:selected").html();
//        producto();
//    });
//
//    $('.select-unidad_medida').on('change', function() {
//        unidad_medida= $(".select-unidad_medida>option:selected").html();
//        producto();
//    });
//
//    $('.text_medida').on('keyup', function() {
//        medida= $(this).val();
//        producto();
//    });
//    $('.nombre').on('keyup', function() {
//        $('#label_producto').text($(this).val());
//    });
//
//    function producto() {
//        $('#label_producto_completo').text(presentacion+' de '+medida+' '+unidad_medida);
//    }


    {{--$('#nombre').select2({--}}
        {{--theme: "bootstrap",--}}
        {{--language: "es",--}}
        {{--placeholder: 'Enter a tag',--}}
        {{--ajax: {--}}
            {{--dataType: 'json',--}}
            {{--url: '{{ url("api/productos") }}',--}}
            {{--delay: 400,--}}
            {{--data: function(params) {--}}
                {{--return {--}}
                    {{--term: params.term--}}
                {{--}--}}
            {{--},--}}
            {{--processResults: function (data, page) {--}}
                {{--return {--}}
                    {{--results: data--}}
                {{--};--}}
            {{--},--}}
        {{--}--}}
    {{--});--}}

</script>

@endpush