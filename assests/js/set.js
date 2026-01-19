/* 
 * Varios SETCOLOMBIA SAS
 * Luis Alejandro Beltran
 */
$(document).ready(function () {
    //DataTables
    $('#basic-datatables').DataTable({ //Simple
    });
    
    $('#tabla-loader').DataTable({ //Con loader CSS
        responsive: false,
        order: [[ 0, "asc" ]],
        initComplete: function( settings, json ) {
            $('div.loader2').remove();
            $('div.table-responsive').show();
        },
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Sin datos para mostrar",
            search: "Buscar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros en total.",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(_TOTAL_ filtrados de _MAX_ registros)",
            paginate: {
                first:      "Primero",
                last:       "Último",
                next:       "Siguiente",
                previous:   "Anterior"
            }
        }
    });
    
    $('#tabla-loader-100').DataTable({ //Con loader CSS
        responsive: false,
        pageLength: 100,
        order: [[ 0, "asc" ]],
        initComplete: function( settings, json ) {
            $('div.loader2').remove();
            $('div.table-responsive').show();
        },
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Sin datos para mostrar",
            search: "Buscar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros en total.",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(_TOTAL_ filtrados de _MAX_ registros)",
            paginate: {
                first:      "Primero",
                last:       "Último",
                next:       "Siguiente",
                previous:   "Anterior"
            }
        }
    });
    
    $('#tabla-loader-desc').DataTable({ //Con loader CSS
        order: [[ 0, "desc" ]],
        initComplete: function( settings, json ) {
            $('div.loader2').remove();
            $('div.table-responsive').show();
        },
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Sin datos para mostrar",
            search: "Buscar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros en total.",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(_TOTAL_ filtrados de _MAX_ registros)",
            paginate: {
                first:      "Primero",
                last:       "Último",
                next:       "Siguiente",
                previous:   "Anterior"
            }
        }
    });
    
    /*//Este permite colocar los text search en algunas columnas
    $('#facturas tfoot th').each(function () {
        var title = $(this).text();
        var index = $(this).index();
        if(index=='0'){
            
        }else{
            $(this).html( '<input style="width: 60px;" type="text" placeholder="Buscar '+title+'" />' );
        }
    } );*/
    
    var table = $("#facturas").DataTable({ //Con checkbox para selección de facturas.
        columnDefs: [
            {
               targets: 0,
               checkboxes: {
                  selectRow: true
               }
            }
         ],
         select: {
            style: 'multi'
         },
        responsive: false,
        order: [[ 3, "desc" ]],
        initComplete: function( settings, json ) {
            $('div.loader2').remove();
            $('div.table-responsive').show();
            var api = this.api();
            $('.filterhead', api.table().header()).each( function (i) {
                if(i==8||i==9||i==10){ //Select para busqueda Medio Pago e Impreso
                    var column = api.column(i);
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' );
                    } );
                }else if(i==1){ //Select para busqueda Origen
                    var column = api.column(i);
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(this).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( this.value )
                                .draw();
                        } );

                    select.append( '<option value="LINIO">LINIO</option>' );
                    select.append( '<option value="DAFITI">DAFITI</option>' );
                    select.append( '<option value="TIENDA">TIENDA</option>' );
                    select.append( '<option value="PAGINA">PAGINA</option>' );
                }
            } );
            /*// Este permite colocar los text search en algunas columnas
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );*/
        },
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "Sin datos",
            search: "Buscar",
            info: "Mostrando _START_ a _END_ de _TOTAL_ ",
            infoEmpty: "No hay registros",
            infoFiltered: "(filtrados: _TOTAL_ de _MAX_)",
            paginate: {
                first:      "Primero",
                last:       "Último",
                next:       "Siguiente",
                previous:   "Anterior"
            },
            select: {
                rows: {
                    _: '%d registros seleccionados',
                    0: '',
                    1: '%d registro seleccionado'
                }
            }
        }
    });
    
    // Submit del form de los check de datatables
    $('#frm-table-actions').on('submit', function(e){
       var form = this;

       var rows_selected = table.column(0).checkboxes.selected();

       // Iterate over all selected checkboxes
       $.each(rows_selected, function(index, rowId){
          // Create a hidden element 
          $(form).append(
              $('<input>')
                 .attr('type', 'hidden')
                 .attr('name', 'id[]')
                 .val(rowId)
          );
       });
    });   

    $('.datepicker').datetimepicker({ //Selector de fecha genérico.
            format: 'YYYY-MM-DD',
    });
    
    $('#country').change(function(){ // Listas Dependientes Pais
            
        var pais = $('#country').val();
        if(pais==''){
            $("#city").html("<option value=''>Seleccione...</option>");
        }
        $.post("?controller=contact&method=searchState",
            {
                pais: pais,
            },
            function (response, status) {
                $("#state").html(response);

            });
    });
    
    $('#state').change(function(){ // Listas Dependientes Departamento
        var pais = $('#country').val();
        var departamento = $('#state').val();
        $.post("?controller=contact&method=searchCity",
            {
                pais: pais,
                departamento: departamento,
            },
            function (response, status) {
                $("#city").html(response);

            });
    });
    
    // Modales para búsqueda de clientes.
    $('#cerrarClientes').click(function(){
        var dataBack = $('#clienteModal').val().trim();
        $('#cliente').val(dataBack);
    }),
    $('#buscarClientes').click(function(){
        var cliente = $('#clienteModal').val();
        $.post("?controller=client&method=search", //Required URL of the page on server
            {// Data Sending With Request To Server
                cliente: cliente,
            },
            function (response, status) { // Required Callback Function
                $("#result").html(response);//"response" receives - whatever written in echo of above PHP script.

            });
    });

    //Agregar item con busqueda de productos
    $(document).on('click', '.cerrarProductos',function(){
        var $row = $(this).closest("tr"),
            $tds = $row.find("td:nth-child(1)");
        var sku = $tds.text();
        $.post("?controller=product&method=searchForItem", //Required URL of the page on server
            {// Data Sending With Request To Server
                sku: sku,
            },
            function (response, status) { // Required Callback Function
                $(".after-add-more").before(response);
            });

        //var html = '';
        //html += '<div class="form-row control-group"> <div class="col-md-3 mb-3">     <label for="productCode">SKU</label>     <div class="input-group">         <input type="text" class="readonly form-control" id="productCode'+index+'" name="productCode[]" placeholder="SKU Producto" data-toggle="modal" data-target="#modalProducto" required>         <!-- Button trigger modal -->         <div class="input-group-append">             <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalProducto">                 Buscar             </button>         </div>     </div>     <div class="valid-feedback">Correcto!</div>     <div class="invalid-feedback">Seleccione un SKU</div> </div> <div class="col-md-3 mb-3">     <label for="dueDate">Fecha Vencimiento</label>     <input type="text" class="readonly datepicker form-control" id="dueDate" name="dueDate" placeholder="Fecha Vencimiento" autocomplete="off" required>     <div class="valid-feedback">Correcto!</div>     <div class="invalid-feedback">Seleccione una Fecha</div> </div> <div class="col-md-3 mb-3">     <label for="pedido">Pedido</label>     <div class="input-group">         <input type="text" class="form-control" id="pedido" name="pedido" placeholder="Pedido" required>     </div>     <div class="valid-feedback">Correcto!</div>     <div class="invalid-feedback">Digite el numero del pedido</div> </div> <div class="col-md-2 mb-3">     <label for="paymentMethod">Forma de Pago</label>     <select type="select" id="paymentMethod" name="paymentMethod" class="custom-select" required>         <option value="">Seleccione...</option>         <?php foreach($payments as $payment):  ?>         <option value="<?= $payment->id ?>"><?= $payment->paymentName ?></option>         <?php endforeach; ?>     </select>     <div class="valid-feedback">Correcto!</div>     <div class="invalid-feedback">Seleccione un opción</div> </div> <div class="col-md-1 mb-3">     <label for="remove"></label>     <div class="input-group">         <div>             <button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-trash"></i></button>         </div>     </div>      </div> </div>';
        //$(".after-add-more").before(html);
        subtotal();
    });

    $('#buscarProductos').click(function(){
        var producto = $('#productoModal').val();
        $.post("?controller=product&method=search", //Required URL of the page on server
            {// Data Sending With Request To Server
                producto: producto,
            },
            function (response, status) { // Required Callback Function
                $("#resultProd").html(response);//"response" receives - whatever written in echo of above PHP script.

            });
    });
    
    $(".readonly").on('keydown paste', function(e){ // Readonly Hack
        e.preventDefault();
    });
    
    //Agregar filas dinámicas en formulario
    var index = 0;
    $(".add-more").click(function(){
        var html = $(".copy").html();
        var clase = "";
        index = index + 1;
        $(".after-add-more").before(html);
        //Recorro todos los input fieldName y le coloco required a todos excepto el original oculto
        $('.fieldName').each(function(){
            clase = $(this).parent().parent().parent().attr('class');
            console.log(clase);
            if(clase==='copy'){
                $(this).prop('required', false);
            }else{
                $(this).prop('required', true);
            }
        });
        //Recorro todos los input fieldType y le coloco required a todos excepto el original oculto
        $('.fieldType').each(function(){
            clase = $(this).parent().parent().parent().attr('class');
            console.log(clase);
            if(clase==='copy'){
                $(this).prop('required', false);
            }else{
                $(this).prop('required', true);
            }
        });
    });
    
    //Elimina filas dinámicas del formulario
    $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
    });
    
    //Evita submit con Enter
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
