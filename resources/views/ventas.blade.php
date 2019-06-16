@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    
@endsection

@section('location')
    Ventas
@endsection
    
@section('content')
<!-- <div class="container"> -->
    <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
        <div class="card-header" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('home') }}">ATRÁS</a>
                    </div>
                    <div class="col-6" style="text-align: center;">
                        VENTAS
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <form id="formCheckVentas">
            <div class="form-row text-center">
                <div class="col-md-6 mb-3">
                    <label for="fechaInicial">Fecha inicial:</label>
                    <input type="date" name="fechaInicial" id="fechaInicial" class="form-control" max="<?php echo date('Y-m-d');?>">
                    <div id="error_fechaInicial"></div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fechaFinal">Fecha final:</label>
                    <input type="date" name="fechaFinal" id="fechaFinal" class="form-control" max="<?php echo date('Y-m-d');?>">
                    <div id="error_fechaFinal"></div>
                </div>
            </div>
            <div class="form-row">
                <button type="button" class="btn btn-primary" type="submit" id="guardarFechas">Guardar</button>
            </div>
        </form>
    </div>
    <hr><hr>
    <table id="tableVentas" style="text-align: center;">
<!-- </div> -->
@endsection

@section('scripts')
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table-es-MX.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    var table               = $('#tableVentas');
    var RouteIndexOrden     = "{!! route('ventas.index') !!}";
    var RouteOrdenes        = "{!! route('ventas.get_ventas') !!}";
    var RouteStoreOrden     = "{!! route('ventas.get_ventasFechas') !!}";

    //var divNuevo            = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="NuevaOrden">Nueva Orden</button></div>';

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                //rowStyle: rowStyle,
                url: RouteOrdenes,
                columns: [{
                    field: 'diaVenta',
                    title: 'Día de la orden',
                    sortable: 'true',
                }, {
                    field: 'orden.folioOrden',
                    title: 'Folio de la orden',
                    sortable: 'true',
                }, {
                    //field: 'cliente.nombre',
                    formatter: (value, row, index, field) => {
                        if(row.orden.cliente){
                            return row.orden.cliente.nombre+' '+row.orden.cliente.primerAp+' '+row.orden.cliente.segundoAp;
                        } else {
                            return 'Pendiente...';
                        }			
                    },
                    title: 'Cliente',
                    sortable: 'true',
                }, {
                    field: 'orden.mesero.name',
                    title: 'Mesero',
                    sortable: 'true',
                }, {                    
                    // field: 'totalVenta',
                    formatter: (value, row, index, field) => {
                        if(row.totalVenta == 0){
                            return 'Comida gratis por su quinta visita. $'+row.totalVenta
                        } else {
                            return '$'+row.totalVenta;
                        }			
                    },
                    title: 'Total de la orden',
                    sortable: 'true',
                },/*{
                    title:  'Acciones',
                    formatter: formatTableActions,
                    events: operateEvents
                }*/]
            });

            //$('.fixed-table-toolbar').append(divNuevo);
        });

        $(document).on('click','#guardarFechas',function(e){
            e.preventDefault();
            //console.log( $('#fechaInicial').val() )
            if( $('#fechaInicial').val() == '' || $('#fechaFinal').val() == '' ){
                table.bootstrapTable('refresh');
            }else{
                var dataString = {
                    fechaInicial:   $('#fechaInicial').val(),
                    fechaFinal:     $('#fechaFinal').val()
                }
                //console.log(dataString)
                $.ajax({
                    type: 'POST',
                    url: RouteStoreOrden,
                    data: dataString,
                    dataType: 'json',
                    success: function(data){
                        //modal.modal('hide');
                        //console.log(data)
                        table.bootstrapTable('load', data)
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            }
            
        });

});
</script>
@endsection