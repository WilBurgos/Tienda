@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- <div class="container"> -->
    <div class="card" style="border: 1px solid rgba(0, 0, 0, 0);">
        <div class="card-header" >
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a href="{{ route('home') }}">BACK</a>
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
                    pagada = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Pagar cuenta" id="cuentaPagada"><i class="fas fa-money-bill-alt"></i></button>&nbsp;';
                    return [edit,pagada].join('');
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
                console.log(row);
                e.preventDefault();
                limpiarModal();
                tituloModal.append('Actualizar orden');
                $('#formUpdateOrden').show();
                $('#formNewOrden').hide();
                $('#formUpdateOrden').removeClass('was-validated');
                $('.form-control').removeClass('is-valid');
                $('.form-control').removeClass('is-invalid');
                $('#updateOrden').show();
                $('#guardarOrden').hide();
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
            'click #cuentaPagada': function(e, value, row, index) {
                e.preventDefault();
                console.log('PAGADA')
                //console.log(row)
                var dataString = {
                    estatusOrden:       'PAGADA',
                    totalOrden:         row.totalOrden
                    //consumo:     row.orden_alimento,
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

        footerModal.on('click', '#updateProd', function(event){
            var dataString = {
                id:             $('#upd-id').val(),
                idProveedor:    $('#upd-idProveedor').val(),
                nombreProducto: $('#upd-nombreProducto').val(),
                estatus:        $('#upd-estatus').val()
            };
            $.ajax({
                type: 'PUT',
                url: RouteIndexProd+'/'+dataString['id'],
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
</script>
@endsection