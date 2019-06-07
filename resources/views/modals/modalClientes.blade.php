<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalRegister" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-titulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- SAVE USER -->
                <form method="POST" action="{{ route('clientes.store') }}" id="formNewUser">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="off" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Primer apellido</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('primerAp') ? ' is-invalid' : '' }}" name="primerAp" value="{{ old('primerAp') }}" autocomplete="off" required>
                            @if ($errors->has('primerAp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('primerAp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Segundo Apellido</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('segundoAp') ? ' is-invalid' : '' }}" name="segundoAp" value="{{ old('segundoAp') }}" autocomplete="off" required>
                            @if ($errors->has('segundoAp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('segundoAp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary form-control">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
                <!-- FIN SAVE USER -->
                <!-- UPDTE USER -->
                <form id="formUpdateUser">
                    <div class="form-group row" style="display:none;">
                        <label for="upd-id">id</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="upd-id" placeholder="id" required>
                            <div id="error_upd-id"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upd-name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="upd-name" type="text" class="form-control{{ $errors->has('upd-name') ? ' is-invalid' : '' }}" name="upd-name" value="{{ old('upd-name') }}" autocomplete="off" required>
                            @if ($errors->has('upd-name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('upd-name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upd-primerAp" class="col-md-4 col-form-label text-md-right">Primer apellido</label>
                        <div class="col-md-6">
                            <input id="upd-primerAp" type="text" class="form-control{{ $errors->has('upd-primerAp') ? ' is-invalid' : '' }}" name="upd-primerAp" value="{{ old('upd-primerAp') }}" autocomplete="off" required>
                            @if ($errors->has('upd-primerAp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('upd-primerAp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upd-segundoAp" class="col-md-4 col-form-label text-md-right">Segundo Apellido</label>
                        <div class="col-md-6">
                            <input id="upd-segundoAp" type="text" class="form-control{{ $errors->has('upd-segundoAp') ? ' is-invalid' : '' }}" name="upd-segundoAp" value="{{ old('upd-segundoAp') }}" autocomplete="off" required>
                            @if ($errors->has('upd-segundoAp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('upd-segundoAp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-primary" type="submit" id="updateUser">Guardar</button>
            </div>
        </div>
    </div>
</div>