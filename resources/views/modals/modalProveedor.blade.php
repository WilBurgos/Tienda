<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalProveedor" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-titulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- SAVE PROVEEDOR -->
                <form id="formNewProv" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="compania">Compañía</label>
                            <input type="text" class="form-control" id="compania" placeholder="Nombre de compañía" required>
                            <div id="error_compania"></div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" placeholder="Dirección de compañía" required>
                            <div id="error_direccion"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" placeholder="Teléfono de compañía" required>
                            <div id="error_telefono"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="correo">Correo</label>
                            <input type="text" class="form-control" id="correo" placeholder="Correo de compañía" required>
                            <div id="error_correo"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN SAVE PROVEEDOR -->
                <!-- UPDATE PROVEEDOR -->
                <form id="formUpdateProv" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" style="display:none;">
                            <label for="upd-id">id</label>
                            <input type="text" class="form-control" id="upd-id" placeholder="id" required>
                            <div id="error_upd-id"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-compania">Compañía</label>
                            <input type="text" class="form-control" id="upd-compania" placeholder="Nombre de compañía" required>
                            <div id="error_upd-compania"></div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="upd-direccion">Dirección</label>
                            <input type="text" class="form-control" id="upd-direccion" placeholder="Dirección de compañía" required>
                            <div id="error_upd-direccion"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="upd-telefono">Teléfono</label>
                            <input type="text" class="form-control" id="upd-telefono" placeholder="Teléfono de compañía" required>
                            <div id="error_upd-telefono"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-correo">Correo</label>
                            <input type="text" class="form-control" id="upd-correo" placeholder="Correo de compañía" required>
                            <div id="error_upd-correo"></div>
                        </div>
                        <div class="col-md-4 mb-3" style="display:none;">
                            <label for="upd-estatus">Estatus</label>
                            <input type="text" class="form-control" id="upd-estatus" placeholder="Estatus de compañía" required>
                            <div id="error_upd-estatus"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN UPDATE PROVEEDOR -->
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="guardarProv">Save changes</button>
                <button type="button" class="btn btn-primary" type="submit" id="updateProv">Update changes</button>
            </div>
        </div>
    </div>
</div>