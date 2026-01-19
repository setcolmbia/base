<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="modalClienteLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg mw-100 w-30" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalClienteLabel">Buscar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input style="line-height: 30px;" type="text" name="clienteModal" id="clienteModal" />
                    <div class="input-group-append">
                        <button id="buscarClientes" class="btn btn-primary btn-sm buscar">
                            Buscar
                        </button>
                    </div>
                    <span>&nbsp;</span>
                    <a href="?controller=client&method=create" class="btn btn-primary btn-sm">Crear Cliente</a>
                </div>
                <div id="result"></div>
            </div>            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="modalProductoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductoLabel">Buscar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input style="line-height: 30px;" type="text" name="productoModal" id="productoModal" />
                    <div class="input-group-append">
                        <button id="buscarProductos" class="btn btn-primary btn-sm buscar">
                            Buscar
                        </button>
                    </div>
                </div>
                <div id="resultProd"></div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>