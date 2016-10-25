<div class="modal fade" id="mostrar-detalle-compra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">&times;</button>
                <h4 class="modal-title">
                    Detalle de Compra
                </h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="example3">
                    <thead>

                    <th>
                        Cantidad
                    </th>
                    <th>
                        Precio
                    </th>
                    <th>
                        Producto
                    </th>
                    <th>
                        Proveedor
                    </th>


                    </thead>
                    <tbody>



                    </tbody>
                </table>
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

    $(document).ready(function () {
        var t = $('#example3').DataTable({
            "language": {
                url: "//cdn.datatables.net/plug-ins/1.10.10/i18n/Spanish.json"
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            filter: true,
            sort: true,
            info: true,
            autoWidth: true,
            order: [
                [0, "desc"]
            ],
            aoColumnDefs: [{
                bSortable: false,
                "aTargets": [-1]
            }]
        });

        $('.visualizar-compra').on('click', function (e) {
            t.clear().draw();
            e.preventDefault();
            var fila = $(this).parents('tr');
            var id = fila.data('id');

//        alert(id);


            $.ajax({
                type: 'GET',
                url: 'detalle-compra/' + id,
                success: function (data) {
                    for (var item in data){

                        t.row.add( [
                            data[item].cantidad_detalle_compra,
                            data[item].precio,
                            data[item].nombre_producto,
                            data[item].nombre_proveedor
                        ] ).draw( false );
                    }

                    $("#mostrar-detalle-compra").modal('toggle');
                }
            });
        });

    });



</script>

@endpush