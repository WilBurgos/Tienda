<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalOrden" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
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
                <form id="formNewOrden" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="idCliente">Cliente</label>
                            <select name="idCliente" id="idCliente" class="form-control">
                                <option></option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre.' '.$cliente->primerAp.' '.$cliente->segundoAp }}</option>
                                @endforeach
                            </select>
                            <div id="error_idCliente"></div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="idCliente"></label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newCliente" onclick="divCliente()">
                                <label class="custom-control-label" for="newCliente">Nuevo cliente</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="numeroMesa">Número de mesa</label>
                            <input type="number" class="form-control" id="numeroMesa" placeholder="Número de mesa" required>
                            <div id="error_numeroMesa"></div>
                        </div>
                    </div>
                    <div class="form-row" id="div-nuevoCliente" style="display:none;">
                        <div class="col-md-4 mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre de cliente">
                            <div id="error_nombre"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="primerAp">Primer apellido:</label>
                            <input type="text" class="form-control" id="primerAp" placeholder="Primer apellido de cliente">
                            <div id="error_primerAp"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="segundoAp">Segundo apellido:</label>
                            <input type="text" class="form-control" id="segundoAp" placeholder="Segundo apellido de cliente">
                            <div id="error_segundoAp"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="idComida">Comida</label>
                            <select name="idComida[]" id="idComida" class="form-control arrayIdComida">
                                <option></option>
                                @foreach($comidas as $comida)
                                    <option value="{{ $comida->id }}">{{ $comida->nombre }}</option>
                                @endforeach
                            </select>
                            <div id="error_idComida"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cantidadComida">Cantidad:</label>
                            <input type="number" class="form-control arrayCantidadComida" name="cantidadComida[]" id="cantidadComida" placeholder="Cantidad de producto" required>
                            <div id="error_cantidadComida"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="idBebida">Bebida</label>
                            <select name="idComida[]" id="idBebida" class="form-control arrayIdBebida">
                            <option></option>
                                @foreach($bebidas as $bebida)
                                    <option value="{{ $bebida->id }}">{{ $bebida->nombre }}</option>
                                @endforeach
                            </select>
                            <div id="error_idBebida"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cantidadBebida">Cantidad:</label>
                            <input type="number" class="form-control arrayCantidadBebida" name="cantidadComida[]" id="cantidadBebida" placeholder="Cantidad de producto" required>
                            <div id="error_cantidadBebida"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN SAVE PRODUCTO -->
                <!-- UPDATE PRODUCTO -->
                <form id="formUpdateOrden" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3" style="display:none;">
                            <label for="idOrden">id</label>
                            <input type="text" class="form-control" id="idOrden" placeholder="idOrden" required>
                            <div id="error_idOrden"></div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="upd-idCliente">Cliente</label>
                            <select name="upd-idCliente" id="upd-idCliente" class="form-control">
                                <option></option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre.' '.$cliente->primerAp.' '.$cliente->segundoAp }}</option>
                                @endforeach
                            </select>
                            <div id="error_idCliente"></div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="upd-idCliente"></label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="upd-newCliente" onclick="divClienteUpd()">
                                <label class="custom-control-label" for="upd-newCliente">Nuevo cliente</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="upd-numeroMesa">Número de mesa</label>
                            <input type="number" class="form-control" id="upd-numeroMesa" placeholder="Número de mesa" required>
                            <div id="error_numeroMesa"></div>
                        </div>
                    </div>
                    <div class="form-row" id="div-UPDnuevoCliente" style="display:none;">
                        <div class="col-md-4 mb-3">
                            <label for="upd-nombre">Nombre:</label>
                            <input type="text" class="form-control" id="upd-nombre" placeholder="Nombre de cliente">
                            <div id="error_nombre"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-primerAp">Primer apellido:</label>
                            <input type="text" class="form-control" id="upd-primerAp" placeholder="Primer apellido de cliente">
                            <div id="error_primerAp"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-segundoAp">Segundo apellido:</label>
                            <input type="text" class="form-control" id="upd-segundoAp" placeholder="Segundo apellido de cliente">
                            <div id="error_segundoAp"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="upd-idComida">Comida</label>
                            <select name="upd-idComida" id="upd-idComida" class="form-control arrayIdComidaUpd">
                                <option></option>
                                @foreach($comidas as $comida)
                                    <option value="{{ $comida->id }}">{{ $comida->nombre }}</option>
                                @endforeach
                            </select>
                            <div id="error_idComida"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-cantidadComida">Cantidad:</label>
                            <input type="number" class="form-control arrayCantidadComidaUpd" name="upd-cantidadComida" id="upd-cantidadComida" placeholder="Cantidad de producto" required>
                            <div id="error_cantidadComida"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="upd-idBebida">Bebida</label>
                            <select name="upd-idBebida" id="upd-idBebida" class="form-control arrayIdBebidaUpd">
                            <option></option>
                                @foreach($bebidas as $bebida)
                                    <option value="{{ $bebida->id }}">{{ $bebida->nombre }}</option>
                                @endforeach
                            </select>
                            <div id="error_idBebida"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="upd-cantidadBebida">Cantidad:</label>
                            <input type="number" class="form-control arrayCantidadBebidaUpd" name="upd-cantidadBebida" id="upd-cantidadBebida" placeholder="Cantidad de producto" required>
                            <div id="error_cantidadBebida"></div>
                        </div>
                    </div>
                </form>
                <!-- FIN UPDATE PRODUCTO -->
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Cerrar</button>
                <button type="button" class="btn btn-primary" type="submit" id="guardarOrden">Guardar</button>
                <button type="button" class="btn btn-primary" type="submit" id="updateOrden">Guardar</button>
            </div>
        </div>
    </div>
</div>