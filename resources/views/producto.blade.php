@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">
<!--<link href="{{ asset('plugins/Select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/Select2/css/select2-bootstrap.min.css') }}" rel="stylesheet">-->

@endsection

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
                        PRODUCTOS
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="tableProducto" style="text-align: center;">
    </table>
    @include('modals.modalProducto')
</div>
@elseif(Auth::user()->ocupation == "CAJERO")

@endif

@endsection

@section('scripts')
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table-es-MX.js') }}"></script>
<!--<script src="{{ asset('plugins/Select2/js/select2.min.js') }}"></script>-->

<script type="text/javascript">
	$(document).ready(function () {
        var table               = $('#tableProducto');
        var RouteIndexProd      = "{!! route('producto.index') !!}";
        var RouteProductos      = "{!! route('prod.get_prods') !!}";
        var RouteStoreProd      = "{!! route('producto.store') !!}";
        var modal               = $('#modalProducto');
        var divNuevo            = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="nuevoProducto">Nuevo Producto</button></div>';

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                rowStyle: rowStyle,
                url: RouteProductos,
                columns: [{
                    field: 'id',
                    title: 'No.',       
                }, {
                    field: 'proveedor.compania',
                    title: 'Compañía',
                    sortable: 'true',
                }, {
                    field: 'nombreProducto',
                    title: 'Producto',
                    sortable: 'true',
                }, {                    
                    field: 'estatus',
                    title: 'Estatus',
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
            switch (row.estatus) {
                case 'ACTIVO':
                    return {classes: 'table-success'};
                    break;
                case 'INACTIVO':
                    return {classes: 'table-danger'};
                    break;
                default:
                    return {};
                    break;
            };
        }

        var formatTableActions = function(value, row, index){
            edit = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Editar Producto" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;';
            if(row.estatus=='ACTIVO'){
                baja = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de baja" id="bajaProducto"><i class="fa fa-arrow-down"></i></button>&nbsp;';
                return [edit,baja].join('');
            }else{
                alta = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de alta" id="altaProducto"><i class="fa fa-arrow-up"></i></button>&nbsp;&nbsp;';
                return [edit,alta].join('');
            }
        }

        window.operateEvents = {
            'click #edit': function (e, value, row, index) {
                e.preventDefault();
                limpiarModal();
                tituloModal.append('Actualizar Producto');
                $('#formUpdateProd').show();
                $('#formNewProd').hide();
                $('#formUpdateProd').removeClass('was-validated');
                $('.form-control').removeClass('is-valid');
                $('.form-control').removeClass('is-invalid');
                $('#updateProd').show();
                $('#guardarProd').hide();
                $('#formNewProd')[0].reset();
                // --------------------------------------------- //
                $('#upd-id').val(row.id);
                $('#upd-idProveedor').val(row.idProveedor);
                $('#upd-nombreProducto').val(row.nombreProducto);
                $('#upd-estatus').val(row.estatus);
                modal.modal('show');
            },
            'click #bajaProducto': function(e, value, row, index) {
                e.preventDefault();
                var dataString = {
                    id:                 row.id,
                    idProveedor:        row.idProveedor,
                    nombreProducto:     row.nombreProducto,
                    estatus:            'INACTIVO',
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
                    }
                });
            },
            'click #altaProducto': function(e, value, row, index) {
                e.preventDefault();
                var dataString = {
                    id:                 row.id,
                    idProveedor:        row.idProveedor,
                    nombreProducto:     row.nombreProducto,
                    estatus:            'ACTIVO',
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
                    }
                });
            }
        };

        $(document).on('click','#nuevoProducto',function(e){
            e.preventDefault();
            limpiarModal();
            tituloModal.append('Nuevo Producto');
            $('#formNewProd').show();
            $('#formUpdateProd').hide();
            $('#formNewProd').removeClass('was-validated');
            $('.form-control').removeClass('is-valid');
            $('.form-control').removeClass('is-invalid');
            $('#guardarProd').show();
            $('#updateProd').hide();
            $('#formNewProd')[0].reset();
            //$('.select2').select2();
            modal.modal('show');
        });

        footerModal.on('click', '#guardarProd', function(event){
            var dataString = {
                idProveedor:        $('#idProveedor').val(),
                nombreProducto:     $('#nombreProducto').val(),
            };
            $.ajax({
                type: 'POST',
                url: RouteStoreProd,
                data: dataString,
                dataType: 'json',
                success: function(data){
                    modal.modal('hide');
                    table.bootstrapTable('refresh');
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    var form = $("#formNewProd")
                    if (form[0].checkValidity() === false) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    $.each(errors.errors, function(key, value){
                        $('#error_'+key).empty();
                        $('#error_'+key).addClass("invalid-feedback");
                        $('#error_'+key).append(value);
                    });
                    form.addClass('was-validated'); 
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
                    var form = $("#formNewProd")
                    if (form[0].checkValidity() === false) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    $.each(errors.errors, function(key, value){
                        $('#error_upd-'+key).empty();
                        $('#error_upd-'+key).addClass("invalid-feedback");
                        $('#error_upd-'+key).append(value);
                    });
                    form.addClass('was-validated'); 
                }
            });
        });
    });

</script>
@endsection