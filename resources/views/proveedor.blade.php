@extends('layouts.app')

@section('content')

@if (Auth::user()->ocupation == "ADMINISTRADOR")
<div class="container">
    <div class="row justify-content-center">
    	<table id="tableAlmacen">
        	<thead class="thead-dark">
                <tr>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="" data-sortable="true"></th>
                </tr>
            </thead>
        </table>
	</div>
</div>
@elseif(Auth::user()->ocupation == "CAJERO")

@endif

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>
@endsection