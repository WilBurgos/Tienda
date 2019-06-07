@extends('layouts.app')

@section('content')
@if (Auth::user()->ocupation == "GERENTE")
<!-- <div class="container"> -->
    <div class="row justify-content-center">
        <!--
        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('almacen.index') }}">
	                <div class="card-header">
	                	ALMACÉN
	                </div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Almacen.jpg') }}" width="100%" style="height: 218px;">
	                </div>
            	</a>
            </div>
        </div>
        -->

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('clientes.index') }}">
	                <div class="card-header">
	                	CLIENTES
	                </div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/clientes.jpg') }}" width="100%" style="height: 218px;">
	                </div>
            	</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('ordenes.index') }}">
                	<div class="card-header">
                		ORDENES
            		</div>
                	<div class="card-body">
                    	<img src="{{ asset('imagenes/tomar-orden.jpg') }}" width="100%" style="height: 218px;">
                	</div>
            	</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('ventas.index') }}">
                	<div class="card-header">
                		VENTAS
            		</div>
                	<div class="card-body">
                    	<img src="{{ asset('imagenes/Ventas.jpg') }}" width="100%" style="height: 218px;">
                	</div>
            	</a>
            </div>
        </div>
        <!--
        <div class="col-md-4">
            <div class="card">
            	<a href="">
	                <div class="card-header">
	                	COMPRAS
	            	</div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Compras.jpg') }}" width="100%" style="height: 218px;">
	                </div>
	            </a>
            </div>
        </div>
        -->
    </div>

    <hr>

    <div class="row justify-content-center">
        <!--
        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('proveedor.index') }}">
	                <div class="card-header">
	                	PROVEEDORES
	                </div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Proveedor.jpg') }}" width="100%" style="height: 218px;">
	                </div>
                </a>
            </div>
        </div>
        -->

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('producto.index') }}">
	                <div class="card-header">
	                	PRODUCTOS
	            	</div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Productos.jpg') }}" width="100%" style="height: 218px;">
	                </div>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('administracion.index') }}">
	                <div class="card-header">
	                	ADMINISTRACIÓN
	            	</div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Administracion.jpg') }}" width="100%" style="height: 218px;">
	                </div>
                </a>
            </div>
        </div>

    </div>
<!-- </div> -->
@elseif(Auth::user()->ocupation == "MESERO")
<!-- <div class="container"> -->
    <div class="row justify-content-center">
    	
        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('ordenes.index') }}">
                	<div class="card-header">
                		ORDENES
            		</div>
                	<div class="card-body">
                    	<img src="{{ asset('imagenes/tomar-orden.jpg') }}" width="100%" style="height: 218px;">
                	</div>
            	</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <a href="{{ route('ventas.index') }}">
                    <div class="card-header">
                        VENTAS
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('imagenes/Ventas.jpg') }}" width="100%" style="height: 218px;">
                    </div>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
            	<a href="{{ route('producto.index') }}">
	                <div class="card-header">
	                	PRODUCTOS
	            	</div>
	                <div class="card-body">
	                    <img src="{{ asset('imagenes/Productos.jpg') }}" width="100%" style="height: 218px;">
	                </div>
                </a>
            </div>
        </div>
        <!--
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                	OPCIÓN 3
            	</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    -->
    </div>

    <hr>

    <div class="row justify-content-center">
        <!--
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                	OPCIÓN 4
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                	OPCIÓN 5
            	</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                	OPCÍÓN 6
            	</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        -->
    </div>
<!-- </div> -->
@endif

@endsection