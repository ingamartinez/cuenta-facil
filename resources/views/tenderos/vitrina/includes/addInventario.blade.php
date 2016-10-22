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
                {!! Form::open(['route'=>'vitrina.store','method'=> 'POST','autocomplete'=>'off' ,'id'=>'form-realizar-compra']) !!}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {!! Form::label('producto','Producto') !!}
                            <select class="form-control select-producto" name="producto" id="producto">
                                <option selected disabled hidden>Seleccione... </option>
                                @foreach($productos_proveedores as $producto)
                                <option value='{{$producto->pp_id}}'>{{$producto->nombre.' - '. $producto->presentacion.' de '.$producto->medida.' '.$producto->unidad_medida}}</option>
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
                                <input type="text" class="form-control text-cantidad" name="cantidad" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="precio_ofrecido">Precio Venta</label>
                            <input type="text" class="form-control text-precio_ofrecido" name="precio_venta" placeholder="Precio Venta">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control select-disponibilidad" name="estado">
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
    var producto_nombre="";
    var cantidad="";
    var precio_ofrecido="";
    var disponibilidad="";



    $('.select-producto').on('change', function() {
        producto_nombre = $(".select-producto>option:selected").html();
        producto();
        console.log(productos_proveedores);
    });

    $('.text-cantidad').on('keyup', function() {
        cantidad= $(this).val();
        producto_proveedor();
    });
    $('.text-precio_ofrecido').on('keyup', function() {
        precio_ofrecido= $(this).val();
        producto_proveedor();
    });

    $('.select-disponibilidad').on('change', function() {
        disponibilidad= $(".select-disponibilidad>option:selected").html();
        producto_proveedor();
    });


    function producto() {
        $('#label_producto').text(producto_nombre);

    }
    function producto_proveedor() {
        $('#label_producto_completo').text('Cantidad: '+cantidad+' | Precio Ofrecido: '+precio_ofrecido+' | Unidad de Medida: '+disponibilidad);
    }


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