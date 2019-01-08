@extends('layouts.app')

@section('content')

@if (Auth::user()->ocupation == "ADMINISTRADOR")
<div class="container">
    <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
        <div class="card-header" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('home') }}">BACK</a>
                    </div>
                    <div class="col-6" style="text-align: center;">
                        PROVEEDORES
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="tableAlmacen" style="text-align: center;">
    </table>
</div>
@elseif(Auth::user()->ocupation == "CAJERO")

@endif

@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
        var table = $('#tableAlmacen');
		var RouteProveedores = "{!! route('prov.get_provs') !!}"

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                rowStyle: rowStyle,
                url: RouteProveedores,
                //icons: {refresh: 'fa-sync-alt',},
                columns: [{
                    field: 'id',
                    title: 'No.',       
                }, {
                    field: 'Compania',
                    title: 'Nombre',
                    sortable: 'true',
                }, {                    
                    field: 'Estatus',
                    title: 'Estado de origen',
                },{
                    title:  'Acciones',
                    formatter: formatTableActions,
                    events: operateEvents
                }]
            });
        });

        function rowStyle(row, index) {
            switch (row.Estatus) {
                case 'ACTIVO':
                    return {classes: 'table-success'};
                    break;
                case 'INACTIVO':
                    return {classes: 'table-danger'};
                    break;
                case null:
                    return {};
                    break;
                default:
                    return {};
                    break;
            };
        }

        var formatTableActions = function(value, row, index){
            edit = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Editar" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;';
            if(row.Estatus=='ACTIVO'){
                baja = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de baja" id="baja"><i class="fa fa-arrow-down"></i></button>&nbsp;';
                return [edit,baja].join('');
            }else{
                alta = '<button class="btn btn-secondary btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de alta" id="alta"><i class="fa fa-arrow-up"></i></button>&nbsp;&nbsp;';
                return [edit,alta].join('');
            }
        }

        window.operateEvents = {
            'click #edit': function (e, value, row, index) {
                console.log(row);
            }
        };

	});
</script>
@endsection