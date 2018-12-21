@extends('layouts.app')

@section('content')

@if (Auth::user()->ocupation == "Administrador")
<div class="container">
    <div class="row justify-content-center">

	</div>
</div>
@elseif(Auth::user()->ocupation == "Cajero")

@endif

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		
	});
</script>
@endsection