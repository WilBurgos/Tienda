<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalProducto" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-titulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- SAVE PRODUCTO -->
                <form id="formNewProd" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="idProveedor">Tipo de producto:</label>
                            <select class="form-control" id="idProveedor">
                                <option></option>
                                <option value="COMIDA">COMIDA</option>
                                <option value="BEBIDA">BEBIDA</option>
                            </select>
                            <div id="error_idProveedor"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nombreProducto">Nombre de Producto:</label>
                            <input type="text" class="form-control" id="nombreProducto" placeholder="Nobre de producto" required>
                            <div id="error_nombreProducto"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="estatus">Precio:</label>
                            <input type="text" class="form-control" id="estatus" placeholder="Precio de prodcuto" required>
                            <div id="error_estatus"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN SAVE PRODUCTO -->
                <!-- UPDATE PRODUCTO -->
                <form id="formUpdateProd" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" style="display:none;">
                            <label for="upd-id">id</label>
                            <input type="text" class="form-control" id="upd-id" placeholder="id" required>
                            <div id="error_upd-id"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-idProveedor">Proveedor</label>
                            <select class="form-control" id="upd-idProveedor">
                                <option></option>
                                <option value="COMIDA">COMIDA</option>
                                <option value="BEBIDA">BEBIDA</option>
                            </select>
                            <div id="error_upd-idProveedor"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-nombreProducto">Producto</label>
                            <input type="text" class="form-control" id="upd-nombreProducto" placeholder="Nobre de producto" required>
                            <div id="error_upd-nombreProducto"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-estatus">Precio:</label>
                            <input type="text" class="form-control" id="upd-estatus" placeholder="Precio de prodcuto" required>
                            <div id="error_upd-estatus"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN UPDATE PRODUCTO -->
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Cerrar</button>
                <button type="button" class="btn btn-primary" type="submit" id="guardarProd">Guardar</button>
                <button type="button" class="btn btn-primary" type="submit" id="updateProd">Guardar</button>
            </div>
        </div>
    </div>
</div>