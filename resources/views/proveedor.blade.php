@extends('layouts.app')

@section('content')

@if (Auth::user()->ocupation == "ADMINISTRADOR")
<div class="container">
    <div class="row justify-content-center">
    	<table id="tableAlmacen">
        	<thead class="thead-dark">
                <tr>
                    <th data-field="" data-sortable="true"></th>
                    <th data-field="Compania" data-sortable="true"></th>
                    <th data-field="Estatus" data-sortable="true"></th>
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
        var table = $('tableAlmacen');
		var RouteProveedores = "{!! route('prov.get_provs') !!}"
        //console.log(RouteProveedores);
        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                pageList: [10, 25, 50, 100],
                //rowStyle: rowStyle,
                url: RouteProveedores,
                columns: [{
                    title: 'No.',           
                    field: 'rownum'
                }, {
                    field: 'Compania',
                    title: 'Nombre',
                }, {                    
                    field: 'Estatus',
                    title: 'Estado de origen',
                }/*, {                    
                    field: 'email',
                    title: 'Correo',
                }, {                    
                    title: 'Estatus',
                    formatter: (value, row, index, field) => {
                        switch (row.status) {
                            case 'SI':
                                return 'ACTIVO'
                                break;
                            case 'NO':
                                return 'INACTIVO'
                                break;
                            default:
                                break;
                        }
                    }
                },{
                    title: 'Acciones',
                    formatter: formatTableActions,
                    events: operateEvents
                }*/]              
            });
        });

	});
</script>
@endsection