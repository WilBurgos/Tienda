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
                            <label for="idProveedor">Proveedor</label>
                            <select class="form-control select2" id="idProveedor">
                                <option></option>
                                @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->compania }}</option>
                                @endforeach
                            </select>
                            <div id="error_idProveedor"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="nombreProducto">Producto</label>
                            <input type="text" class="form-control" id="nombreProducto" placeholder="Nobre de producto" required>
                            <div id="error_nombreProducto"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        
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
                            <select class="form-control select2" id="upd-idProveedor">
                                <option></option>
                                @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->compania }}</option>
                                @endforeach
                            </select>
                            <div id="error_upd-idProveedor"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-nombreProducto">Producto</label>
                            <input type="text" class="form-control" id="upd-nombreProducto" placeholder="Nobre de producto" required>
                            <div id="error_upd-nombreProducto"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" style="display:none;">
                            <label for="upd-estatus">Estatus</label>
                            <input type="text" class="form-control" id="upd-estatus" placeholder="Estatus de compañía" required>
                            <div id="error_upd-estatus"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN UPDATE PRODUCTO -->
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Close</button>
                <button type="button" class="btn btn-primary" type="submit" id="guardarProd">Save changes</button>
                <button type="button" class="btn btn-primary" type="submit" id="updateProd">Update changes</button>
            </div>
        </div>
    </div>
</div>