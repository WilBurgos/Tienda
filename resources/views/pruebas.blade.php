@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        {{$errors->first('compania')}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Capturar Orden de Pago</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['id'=>'formNewOrden','novalidate','class'=>'needs-validation','route' => 'pruebas.store', 'method'=>'POST']) !!}
                <div class="row pb-3">
                    <div class="col-9">
                        {{ Form::label('compania', 'COMPAÑÍA:') }}
                        {{ Form::text('compania',null,array('required','class'=>'form-control mayuscula'. ( $errors->has('compania') ? ' is-invalid' : '' ),'title'=>'Área que tramita')) }}
                        @if ($errors->any())<div id="error_compania" class="invalid-feedback">{{ $errors->first('compania') }}</div>@endif
                        
                        @if ($errors->any())
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('compania') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-3">
                        {{ Form::label('direccion', 'DIRECCIÓN:') }}
                        {{ Form::text('direccion',null,array('required','class'=>'form-control mayuscula','title'=>'')) }}
                        <div id="error_direccion"></div>
                        @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-3">
                        {{ Form::label('telefono', 'TELÉFONO:') }}
                        {{ Form::text('telefono',null,array('required','class'=>'form-control mayuscula','title'=>'Número de trámite')) }}
                        <div id="error_telefono"></div>
                    </div>
                    <div class="col-3">
                        {{ Form::label('correo', 'CORREO:') }}
                        {{ Form::text('correo',null,array('required','class'=>'form-control','title'=>'Fecha de elaboración')) }}
                        <div id="error_correo"></div>
                    </div>
                    <div class="col-3">
                        {{ Form::label('estatus', 'O.C. :') }}
                        {{ Form::select('estatus',$estatus,null,array('required','class'=>'form-control','title'=>'Tipo de trámite')) }}
                        <div id="error_estatus"></div>
                    </div>
                </div>
                <hr class="my-4">
                <div id="footer-buttons col-md-12">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-lg','id'=>'guardarOrden']) !!} 
                </div>
            {!! Form::close() !!}
        </div>
    </div>  
</div>
@endsection

@section('scripts')
<script type="text/javascript">

/*(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();*/

</script>
@endsection