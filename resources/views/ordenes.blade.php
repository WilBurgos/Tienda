@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">
@endsection

@section('title')
    
@endsection

@section('location')
    Ordenes
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
                        ORDENES
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="tableOrdenes" style="text-align: center;">
    </table>
    @include('modals.modalOrden')
    {{-- @include('modals.modalCuenta') --}}
<!-- </div> -->

@endsection

@section('scripts')
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table-es-MX.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function () {
        var table               = $('#tableOrdenes');
        var RouteIndexOrden     = "{!! route('ordenes.index') !!}";
        var RouteOrdenes        = "{!! route('ordenes.get_ordenes') !!}";
        var RouteStoreOrden     = "{!! route('ordenes.store') !!}";
        var RouteCerrarOrden    = "{!! route('ordenes.cerrarOrden') !!}";
        var modal               = $('#modalOrden');
        var modalCuenta         = $('#modalCuenta');
        var divNuevo            = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="NuevaOrden">Nueva Orden</button></div>';

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                rowStyle: rowStyle,
                url: RouteOrdenes,
                columns: [{
                    field: 'folioOrden',
                    title: 'Folio de orden.',
                    sortable: 'true',
                }, {
                    //field: 'cliente.nombre',
                    formatter: (value, row, index, field) => {
                        if(row.cliente){
                            return row.cliente.nombre+' '+row.cliente.primerAp+' '+row.cliente.segundoAp;
                        } else {
                            return 'Pendiente...';
                        }			
                    },
                    title: 'Cliente',
                    sortable: 'true',
                }, {
                    field: 'numMesa',
                    title: 'Número de mesa',
                    sortable: 'true',
                }, {                    
                    field: 'estatusOrden',
                    title: 'Estatus de la orden',
                    sortable: 'true',
                },{
                    title:  'Acciones',
                    formatter: formatTableActions,
                    events: operateEvents
                }]
            });

            $('.fixed-table-toolbar').append(divNuevo);
        });

        function rowStyle(row, index) {
            switch (row.estatusOrden) {
                case 'CONSUMIENDO':
                    return {classes: 'table-warning'};
                    break;
                case 'PENDIENTE':
                    return {classes: 'table-info'};
                    break;
                case 'CERRADA':
                    return {classes: 'table-danger'};
                    break;
                case 'PAGADA':
                    return {classes: 'table-success'};
                    break;
                default:
                    return {};
                    break;
            };
        }

        var formatTableActions = function(value, row, index){
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            table.on('mouseenter', function (e, data) {
                $('[data-toggle="tooltip"]').tooltip();
            });

            table.on('mouseleave', function (e, data) {
                $('[data-toggle="tooltip"]').tooltip('hide');
            });

            edit = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Agregar" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;';
            switch (row.estatusOrden) {
                case 'PENDIENTE':
                    cons = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Cliente Consumiendo" id="Consumir"><i class="fas fa-utensils"></i></button>&nbsp;';
                    return [edit,cons].join('');
                    break;
                case 'CONSUMIENDO':
                    cerrar = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Cerrar cuenta" id="cerrarCuenta"><i class="fas fa-times-circle"></i></button>&nbsp;';
                    return [edit,cerrar].join('');
                    break;
                case 'CERRADA':
                    ver = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Ver orden" id="edit"><i class="far fa-eye"></i></button>&nbsp;';
                    impCuenta = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Imprimir cuenta" id="impCuenta"><i class="fas fa-list-ol"></i></button>&nbsp;';
                    pagada = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Pagar cuenta" id="cuentaPagada"><i class="fas fa-money-bill-alt"></i></button>&nbsp;';
                    return [ver,impCuenta,pagada].join('');
                case 'PAGADA':
                    ver = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Ver orden" id="edit"><i class="far fa-eye"></i></button>&nbsp;';
                    return [ver].join('');
                default:
                    return [edit].join('');
                    break;
            }
        }

        window.operateEvents = {
            'click #edit': function (e, value, row, index) {
                //console.log(row)
                e.preventDefault();
                limpiarModal();
                if( row.estatusOrden == "CERRADA" || row.estatusOrden == "PAGADA" ){
                    tituloModal.append('Ver orden');
                    $('#updateOrden').hide();
                }else{
                    tituloModal.append('Actualizar orden');
                    $('#updateOrden').show();
                }
                $('#formUpdateOrden').show();
                $('#formNewOrden').hide();
                $('#formUpdateOrden').removeClass('was-validated');
                $('.form-control').removeClass('is-valid');
                $('.form-control').removeClass('is-invalid');
                $('#div-verCuenta').show();
                $('#div-totalComidas').hide();
                $('#div-totalBebidas').hide();
                $('#div-totalTodo').hide();
                $('#comidaGratis').hide();
                $('#guardarOrden').hide();
                $('#imprimirOrden').hide();
                $('#upd-nuevoConcepto').empty()
                $('#formUpdateOrden')[0].reset();
                // --------------------------------------------- //
                $('#idOrden').val(row.id);
                $('#upd-idCliente').val(row.cliente.id);
                $('#upd-numeroMesa').val(row.numMesa);
                $('#upd-nombre').val(row.cliente.nombre);
                $('#upd-primerAp').val(row.cliente.primerAp);
                $('#upd-segundoAp').val(row.cliente.segundoAp);
                $('#upd-idComida').val(row.orden_alimento[0].alimento.id);
                $('#upd-cantidadComida').val(row.orden_alimento[0].cantidad);
                $('#upd-idBebida').val(row.orden_alimento[1].alimento.id);
                $('#upd-cantidadBebida').val(row.orden_alimento[1].cantidad);
                    suma = 0
                    console.log('lenght: '+row.orden_alimento.length)
                    div = (row.orden_alimento.length)/2
                     console.log('div: '+div)
                    apend = div/2
                    // console.log(apend)
                    if( apend >= 1){
                        for (let index = 0; index < apend; index++) {
                            $('#upd-masProducto').click()
                        }
                    }
                    console.log(row.orden_alimento)
                    row.orden_alimento.forEach(function(element) {
                        if( suma >= 2 ){
                            if( element.alimento.tipoComida == "COMIDA" ){
                                $('#upd-idComida-'+div).val(element.alimento.id);
                                $('#upd-cantidadComida-'+div).val(element.cantidad);
                                $('#div-totalComidas-'+div).hide()
                            }else{
                                if( element.alimento.tipoComida == "BEBIDA" ){
                                    $('#upd-idBebida-'+div).val(element.alimento.id);
                                    $('#upd-cantidadBebida-'+div).val(element.cantidad);
                                    $('#div-totalBebidas-'+div).hide()
                                }
                            }
                            if( row.estatusOrden == 'CERRADA' || row.estatusOrden == 'PAGADA'){
                                $('#upd-idComida-'+div).attr('disabled',true)
                                $('#upd-cantidadComida-'+div).attr('disabled',true)
                                $('#upd-idBebida-'+div).attr('disabled',true)
                                $('#upd-cantidadBebida-'+div).attr('disabled',true)
                                $('#upd-borrarAli-'+div).hide()
                            }else{
                                $('#upd-idComida-'+div).attr('disabled',false)
                                $('#upd-cantidadComida-'+div).attr('disabled',false)
                                $('#upd-idBebida-'+div).attr('disabled',false)
                                $('#upd-cantidadBebida-'+div).attr('disabled',false)
                                $('#upd-borrarAli-'+div).show()
                            }
                        }
                        suma=suma+1
                    });
                if( row.estatusOrden == 'CERRADA' || row.estatusOrden == 'PAGADA'){
                    $('#upd-numeroMesa,#upd-nombre,#upd-primerAp,#upd-segundoAp,#upd-idComida,#upd-cantidadComida,#upd-idBebida,#upd-cantidadBebida').attr('disabled',true)
                    $('#upd-masProducto').hide();
                }else{
                    $('#upd-numeroMesa,#upd-nombre,#upd-primerAp,#upd-segundoAp,#upd-idComida,#upd-cantidadComida,#upd-idBebida,#upd-cantidadBebida').attr('disabled',false)
                    $('#upd-masProducto').show();
                }

                $('#upd-idCliente,#upd-newCliente').attr('disabled',true)
                modal.modal('show');
            },
            'click #Consumir': function(e, value, row, index) {
                e.preventDefault();
                console.log('CONSUMIENDO')
                var dataString = {
                    estatusOrden:       'CONSUMIENDO',
                };
                console.log(dataString)
                $.ajax({
                    type: 'PUT',
                    url: RouteIndexOrden+'/'+row.id,
                    data: dataString,
                    dataType: 'json',
                    success: function(data){
                        console.log(data)
                        // modal.modal('hide');
                        table.bootstrapTable('refresh');
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors); 
                    }
                });
            },
            'click #cerrarCuenta': function(e, value, row, index) {
                e.preventDefault();
                console.log('CERRADA')
                //console.log(row)
                var dataString = {
                    estatusOrden:       'CERRADA',
                    consumo:     row.orden_alimento,
                };
                //console.log(dataString)
                $.ajax({
                    type: 'PUT',
                    url: RouteIndexOrden+'/'+row.id,
                    data: dataString,
                    dataType: 'json',
                    success: function(data){
                        //console.log(data)
                        // modal.modal('hide');
                        table.bootstrapTable('refresh');
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors); 
                    }
                });
            },
            'click #impCuenta': function(e,value,row,index){
                e.preventDefault();
                //console.log(row)
                limpiarModal();
                tituloModal.append('Imprimir orden');
                $('#formUpdateOrden').show();
                $('#formNewOrden').hide();
                $('#formUpdateOrden').removeClass('was-validated');
                $('.form-control').removeClass('is-valid');
                $('.form-control').removeClass('is-invalid');
                $('#div-verCuenta').hide();
                $('#div-totalComidas').show();
                $('#div-totalBebidas').show();
                $('#div-totalTodo').show();
                $('#imprimirOrden').show();
                if(row.cliente.numVisitas == 5){
                    $('#comidaGratis').show();
                    $('#imprimirOrden').hide();
                    $('#formUpdateOrden').hide();
                }else{
                    $('#comidaGratis').hide();
                }
                $('#updateOrden').hide();
                $('#guardarOrden').hide();
                
                $('#upd-nuevoConcepto').empty();
                $('#formUpdateOrden')[0].reset();
                // --------------------------------------------- //
                $('#idOrden').val(row.id);
                $('#upd-idCliente').val(row.cliente.id);
                $('#upd-numeroMesa').val(row.numMesa);
                $('#upd-nombre').val(row.cliente.nombre);
                $('#upd-primerAp').val(row.cliente.primerAp);
                $('#upd-segundoAp').val(row.cliente.segundoAp);
                $('#upd-idComida').val(row.orden_alimento[0].alimento.id);
                $('#upd-cantidadComida').val(row.orden_alimento[0].cantidad);
                $('#upd-totalComidas').val( row.orden_alimento[0].alimento.precio*row.orden_alimento[0].cantidad )
                $('#upd-idBebida').val(row.orden_alimento[1].alimento.id);
                $('#upd-cantidadBebida').val(row.orden_alimento[1].cantidad);
                $('#upd-totalBebidas').val( row.orden_alimento[1].alimento.precio*row.orden_alimento[1].cantidad )
                totalTodoDosPrimeros = (row.orden_alimento[0].alimento.precio*row.orden_alimento[0].cantidad)+(row.orden_alimento[1].alimento.precio*row.orden_alimento[1].cantidad)
                    suma = 0
                    div = (row.orden_alimento.length)/2
                    apend = div/2
                    if( apend >= 1){
                        for (let index = 0; index < apend; index++) {
                            $('#upd-masProducto').click()
                        }
                    }
                    totalTodo = 0
                    row.orden_alimento.forEach(function(element) {
                        if( suma >= 2 ){
                            if( element.alimento.tipoComida == "COMIDA" ){
                                $('#upd-idComida-'+div).val(element.alimento.id);
                                $('#upd-cantidadComida-'+div).val(element.cantidad);
                                $('#upd-totalComidas-'+div).val( element.alimento.precio*element.cantidad )
                                totalTodo = totalTodo + element.alimento.precio*element.cantidad;
                            }else{
                                if( element.alimento.tipoComida == "BEBIDA" ){
                                    $('#upd-idBebida-'+div).val(element.alimento.id);
                                    $('#upd-cantidadBebida-'+div).val(element.cantidad);
                                    $('#upd-totalBebidas-'+div).val( element.alimento.precio*element.cantidad )
                                    totalTodo = totalTodo + element.alimento.precio*element.cantidad;
                                }
                            }
                            if( row.estatusOrden == 'CERRADA' || row.estatusOrden == 'PAGADA'){
                                $('#upd-idComida-'+div).attr('disabled',true)
                                $('#upd-cantidadComida-'+div).attr('disabled',true)
                                $('#upd-idBebida-'+div).attr('disabled',true)
                                $('#upd-cantidadBebida-'+div).attr('disabled',true)
                                $('#upd-borrarAli-'+div).hide()
                                $('#div-totalComidas-'+div).show()
                                $('#div-totalBebidas-'+div).show()
                            }else{
                                $('#upd-idComida-'+div).attr('disabled',false)
                                $('#upd-cantidadComida-'+div).attr('disabled',false)
                                $('#upd-idBebida-'+div).attr('disabled',false)
                                $('#upd-cantidadBebida-'+div).attr('disabled',false)
                                $('#upd-borrarAli-'+div).show()
                            }
                        }
                        suma=suma+1
                    });
                if( row.estatusOrden == 'CERRADA' || row.estatusOrden == 'PAGADA'){
                    $('#upd-numeroMesa,#upd-nombre,#upd-primerAp,#upd-segundoAp,#upd-idComida,#upd-cantidadComida,#upd-idBebida,#upd-cantidadBebida').attr('disabled',true)
                    $('#upd-masProducto').hide();
                }else{
                    $('#upd-numeroMesa,#upd-nombre,#upd-primerAp,#upd-segundoAp,#upd-idComida,#upd-cantidadComida,#upd-idBebida,#upd-cantidadBebida').attr('disabled',false)
                    $('#upd-masProducto').show();
                }
                $('#upd-idCliente,#upd-newCliente').attr('disabled',true)
                $('#upd-totalTodo').val( totalTodoDosPrimeros+totalTodo );
                modal.modal('show');

            },
            'click #cuentaPagada': function(e, value, row, index) {
                e.preventDefault();
                console.log('PAGADA')
                //console.log(row)
                if( row.cliente.numVisitas == 5 ){
                    total = 0
                }else{
                    total = row.totalOrden
                }
                var dataString = {
                    estatusOrden:       'PAGADA',
                    totalOrden:         total
                    //consumo:     row.orden_alimento,
                };
                //console.log(dataString)
                $.ajax({
                    type: 'PUT',
                    url: RouteIndexOrden+'/'+row.id,
                    data: dataString,
                    dataType: 'json',
                    success: function(data){
                        console.log(data)
                        // modal.modal('hide');
                        table.bootstrapTable('refresh');
                    },
                    error: function(data){
                        var errors = data.responseJSON;
                        console.log(errors); 
                    }
                });
            }
        };

        $(document).on('click','#NuevaOrden',function(e){
            e.preventDefault();
            limpiarModal();
            tituloModal.append('Nueva Orden');
            $('#formNewOrden').show();
            $('#formUpdateOrden').hide();
            $('#formNewOrden').removeClass('was-validated');
            $('.form-control').removeClass('is-valid');
            $('.form-control').removeClass('is-invalid');
            $('#guardarOrden').show();
            $('#updateOrden').hide();
            $('#comidaGratis').hide();
            $('#imprimirOrden').hide();
            $('#nuevoConcepto').empty()
            $('#formNewOrden')[0].reset();
            //$('.select2').select2();
            modal.modal('show');
        });

        footerModal.on('click', '#guardarOrden', function(event){
            var inputs = document.getElementsByName( 'idComida[]' ),
            arrayidComidas  = [].map.call(inputs, function( input ) {
                return input.value;
            });
            var inputs2 = document.getElementsByName( 'cantidadComida[]' ),
            arrayCantComidas  = [].map.call(inputs2, function( input2 ) {
                return input2.value;
            });
            var dataString = {
                idCliente:      $('#idCliente').val(),
                numeroMesa:     $('#numeroMesa').val(),
                nombre:         $('#nombre').val(),
                primerAp:       $('#primerAp').val(),
                segundoAp:      $('#segundoAp').val(),
                idComida:       arrayidComidas,
                cantidadComida: arrayCantComidas,
            };
            $.ajax({
                type: 'POST',
                url: RouteStoreOrden,
                data: dataString,
                dataType: 'json',
                success: function(data){
                    modal.modal('hide');
                    table.bootstrapTable('refresh');
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    // var form = $("#formNewOrden")
                    // if (form[0].checkValidity() === false) {
                    //     event.preventDefault()
                    //     event.stopPropagation()
                    // }
                    // $.each(errors.errors, function(key, value){
                    //     $('#error_'+key).empty();
                    //     $('#error_'+key).addClass("invalid-feedback");
                    //     $('#error_'+key).append(value);
                    // });
                    // form.addClass('was-validated'); 
                }
            });
        });

        footerModal.on('click', '#updateOrden', function(event){
            var inputs = document.getElementsByName( 'upd-idComida[]' ),
            arrayidComidas  = [].map.call(inputs, function( input ) {
                return input.value;
            });
            var inputs2 = document.getElementsByName( 'upd-cantidadComida[]' ),
            arrayCantComidas  = [].map.call(inputs2, function( input2 ) {
                return input2.value;
            });
            var dataString = {
                id:             $('#idOrden').val(),
                idCliente:      $('#upd-idCliente').val(),
                numeroMesa:     $('#upd-numeroMesa').val(),
                nombre:         $('#upd-nombre').val(),
                primerAp:       $('#upd-primerAp').val(),
                segundoAp:      $('#upd-segundoAp').val(),
                idComida:       arrayidComidas,
                cantidadComida: arrayCantComidas,
                actualizacion: 'datos'
            };
            $.ajax({
                type: 'PUT',
                url: RouteIndexOrden+'/'+dataString['id'],
                data: dataString,
                dataType: 'json',
                success: function(data){
                    modal.modal('hide');
                    table.bootstrapTable('refresh');
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    // var form = $("#formUpdateOrden");
                    // if (form[0].checkValidity() === false) {
                    //     event.preventDefault()
                    //     event.stopPropagation()
                    // }
                    // $.each(errors.errors, function(key, value){
                    //     $('#error_upd-'+key).empty();
                    //     $('#error_upd-'+key).addClass("invalid-feedback");
                    //     $('#error_upd-'+key).append(value);
                    // });
                    // form.addClass('was-validated'); 
                }
            });
        });

        $("#masProducto").click(function(){
            var divs=document.getElementsByTagName('div');
            var num=0;
            for (x=0;x<divs.length;x++){
                if (divs[x].getAttribute('name')=="plusConcepto"){ 
                    num+=1; 
                }
            };
            num=num+1;
            var concepto = '';
            concepto = concepto + '<div id="nuevo'+num+'">'
                concepto = concepto + '<div class="form-row">'
                    concepto = concepto + '<div class="col-md-8 mb-3">'
                        concepto = concepto + '<label for="idComida-'+num+'">Comida</label>'
                        concepto = concepto + '<select name="idComida[]" id="idComida-'+num+'" class="form-control arrayIdComida">'
                            concepto = concepto + '<option></option>'
                            concepto = concepto + '@foreach($comidas as $comida)'
                                concepto = concepto + '<option value="{{ $comida->id }}">{{ $comida->nombre }}</option>'
                            concepto = concepto + '@endforeach'
                        concepto = concepto + '</select>'
                        concepto = concepto + '<div id="error_idComida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-4 mb-3">'
                        concepto = concepto + '<label for="cantidadComida-'+num+'">Cantidad:</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadComida" name="cantidadComida[]" id="cantidadComida-'+num+'" placeholder="Cantidad de producto" required>'
                        concepto = concepto + '<div id="error_cantidadComida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                concepto = concepto + '</div>'
                concepto = concepto + '<div class="form-row" name="plusConcepto">'
                    concepto = concepto + '<div class="col-md-8 mb-3">'
                        concepto = concepto + '<label for="idBebida-'+num+'">Bebida</label>'
                        concepto = concepto + '<select name="idComida[]" id="idBebida-'+num+'" class="form-control arrayIdBebida">'
                            concepto = concepto + '<option></option>'
                            concepto = concepto + '@foreach($bebidas as $bebida)'
                                concepto = concepto + '<option value="{{ $bebida->id }}">{{ $bebida->nombre }}</option>'
                            concepto = concepto + '@endforeach'
                        concepto = concepto + '</select>'
                        concepto = concepto + '<div id="error_idBebida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-4 mb-3">'
                        concepto = concepto + '<label for="cantidadBebida-'+num+'">Cantidad:</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadBebida" name="cantidadComida[]" id="cantidadBebida'+num+'" placeholder="Cantidad de producto" required>'
                        concepto = concepto + '<div id="error_cantidadBebida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                concepto = concepto + '</div>'
                concepto = concepto + '<button type="button" id="borrarAli-'+num+'" class="btn btn-danger" onclick="borrar(\'#nuevo'+num+'\')"><i class="fas fa-eraser"></i></button><hr class="my-1">';
            concepto = concepto + '</div>'
            $("#nuevoConcepto").append(concepto);
        });

        $("#upd-masProducto").click(function(){
            var divs=document.getElementsByTagName('div');
            var num=0;
            for (x=0;x<divs.length;x++){
                if (divs[x].getAttribute('name')=="upd-plusConcepto"){ 
                    num+=1; 
                }
            };
            num=num+1;
            var concepto = '';
            concepto = concepto + '<div id="upd-nuevo'+num+'">'
                concepto = concepto + '<div class="form-row">'
                    concepto = concepto + '<div class="col-md-8 mb-3">'
                        concepto = concepto + '<label for="upd-idComida-'+num+'">Comida</label>'
                        concepto = concepto + '<select name="upd-idComida[]" id="upd-idComida-'+num+'" class="form-control arrayIdComidaUpd">'
                            concepto = concepto + '<option></option>'
                            concepto = concepto + '@foreach($comidas as $comida)'
                                concepto = concepto + '<option value="{{ $comida->id }}">{{ $comida->nombre }}</option>'
                            concepto = concepto + '@endforeach'
                        concepto = concepto + '</select>'
                        concepto = concepto + '<div id="error_upd-idComida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-2 mb-3">'
                        concepto = concepto + '<label for="upd-cantidadComida-'+num+'">Cantidad:</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadComidaUpd" name="upd-cantidadComida[]" id="upd-cantidadComida-'+num+'" placeholder="Cantidad de producto" required>'
                        concepto = concepto + '<div id="error_upd-cantidadComida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-2 mb-3" id="div-totalComidas-'+num+'" style="display:none;">'
                        concepto = concepto + '<label for="upd-totalComidas-'+num+'">total</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadComidaUpd" name="upd-totalComidas[]" id="upd-totalComidas-'+num+'" placeholder="Total" disabled>'
                        concepto = concepto + '<div id="error_upd-totalComidas-'+num+'"></div>'
                    concepto = concepto + '</div>'
                concepto = concepto + '</div>'
                concepto = concepto + '<div class="form-row" name="upd-plusConcepto">'
                    concepto = concepto + '<div class="col-md-8 mb-3">'
                        concepto = concepto + '<label for="upd-idBebida-'+num+'">Bebida</label>'
                        concepto = concepto + '<select name="upd-idComida[]" id="upd-idBebida-'+num+'" class="form-control arrayIdBebidaUpd">'
                            concepto = concepto + '<option></option>'
                            concepto = concepto + '@foreach($bebidas as $bebida)'
                                concepto = concepto + '<option value="{{ $bebida->id }}">{{ $bebida->nombre }}</option>'
                            concepto = concepto + '@endforeach'
                        concepto = concepto + '</select>'
                        concepto = concepto + '<div id="error_upd-idBebida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-2 mb-3">'
                        concepto = concepto + '<label for="upd-cantidadBebida-'+num+'">Cantidad:</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadBebidaUpd" name="upd-cantidadComida[]" id="upd-cantidadBebida-'+num+'" placeholder="Cantidad de producto" required>'
                        concepto = concepto + '<div id="error_upd-cantidadBebida-'+num+'"></div>'
                    concepto = concepto + '</div>'
                    concepto = concepto + '<div class="col-md-2 mb-3" id="div-totalBebidas-'+num+'" style="display:none;">'
                        concepto = concepto + '<label for="upd-totalBebidas-'+num+'">total</label>'
                        concepto = concepto + '<input type="number" class="form-control arrayCantidadComidaUpd" name="upd-totalBebidas[]" id="upd-totalBebidas-'+num+'" placeholder="Total" disabled>'
                        concepto = concepto + '<div id="error_upd-totalBebidas-'+num+'"></div>'
                    concepto = concepto + '</div>'
                concepto = concepto + '</div>'
                concepto = concepto + ' <button type="button" id="upd-borrarAli-'+num+'" class="btn btn-danger" onclick="borrar(\'#upd-nuevo'+num+'\')"><i class="fas fa-eraser"></i></button><hr class="my-1">';
            concepto = concepto + '</div>'
            $("#upd-nuevoConcepto").append(concepto);
        });
    });

    function divCliente() {
        var checkBox = document.getElementById("newCliente");
        if (checkBox.checked == true){
            $('#div-nuevoCliente').show('slow')
            $('#idCliente').attr('disabled',true)
        } else {
            $('#div-nuevoCliente').hide('slow')
            $('#idCliente').attr('disabled',false)
        }
    }
    function divClienteUpd(){
        var checkBox = document.getElementById("upd-newCliente");
        if (checkBox.checked == true){
            $('#div-UPDnuevoCliente').show('slow')
            $('#upd-idCliente').attr('disabled',true)
        } else {
            $('#div-UPDnuevoCliente').hide('slow')
            $('#upd-idCliente').attr('disabled',false)
        }
    }

    function borrar (id){
        console.log('asasd')
        // swal({
        //         title: "¿Desea borrar la sección?",
        //         text: "Los datos no se podrán recuperar",
        //         type: "info",
        //         showCancelButton: true,
        //         confirmButtonText: "Si",
        //         confirmButtonColor: "#424242",
        //         cancelButtonText: "No",
        //         closeOnConfirm: true
        //     }, function (isContinuar) {
        //         if (isContinuar) {
                    $(id).remove();
        //         } else {
        //     }
        // });
    }
</script>
@endsection