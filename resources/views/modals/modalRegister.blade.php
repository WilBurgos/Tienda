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
                <form method="POST" action="{{ route('register') }}" id="formNewUser">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ocupation" class="col-md-4 col-form-label text-md-right">Cargo a ocupar</label>
                        <div class="col-md-6">
                            <select id="ocupation" class="form-control" name="ocupation" required>
                                <option value="GERENTE">GERENTE</option>
                                <option value="MESERO">MESERO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary form-control">
                                {{ __('Register') }}
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
                        <label for="upd-name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                        <div class="col-md-6">
                            <input id="upd-name" type="text" class="form-control" required>
                            <div id="error_upd-name"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upd-email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
                        <div class="col-md-6">
                            <input id="upd-email" type="email" class="form-control" required>
                            <div id="error_upd-email"></div>
                        </div>
                    </div>
                    <!--<div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>-->
                    <div class="form-group row">
                        <label for="upd-ocupation" class="col-md-4 col-form-label text-md-right">Cargo a ocupar</label>
                        <div class="col-md-6">
                            <select id="upd-ocupation" class="form-control" name="ocupation" required>
                                <option value="GERENTE">GERENTE</option>
                                <option value="MESERO">MESERO</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-primary" type="submit" id="updateUser">Update changes</button>
            </div>
        </div>
    </div>
</div>