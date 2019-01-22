@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">

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
                        PROVEEDORES
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="tableProveedor" style="text-align: center;">
    </table>
    @include('modals.modalProveedor')
</div>
@elseif(Auth::user()->ocupation == "CAJERO")

@endif

@endsection

@section('scripts')
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table-es-MX.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function () {
        var table               = $('#tableProveedor');
        var RouteIndexProv      = "{!! route('proveedor.index') !!}";
        var RouteProveedores    = "{!! route('prov.get_provs') !!}";
        var RouteStoreProv      = "{!! route('proveedor.store') !!}";
        var modal               = $('#modalProveedor');
        var divNuevo            = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="nuevoProveedor">Nuevo Proveedor</button></div>';

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                rowStyle: rowStyle,
                url: RouteProveedores,
                columns: [{
                    field: 'id',
                    title: 'No.',       
                }, {
                    field: 'compania',
                    title: 'Compañía',
                    sortable: 'true',
                }, {
                    field: 'direccion',
                    title: 'Dirección',
                    sortable: 'true',
                }, {
                    field: 'telefono',
                    title: 'Teléfono',
                    sortable: 'true',
                }, {
                    field: 'correo',
                    title: 'Correo',
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
            edit = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Editar Proveedor" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;';
            if(row.estatus=='ACTIVO'){
                baja = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de baja" id="bajaProveedor"><i class="fa fa-arrow-down"></i></button>&nbsp;';
                return [edit,baja].join('');
            }else{
                alta = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de alta" id="altaProveedor"><i class="fa fa-arrow-up"></i></button>&nbsp;&nbsp;';
                return [edit,alta].join('');
            }
        }

        window.operateEvents = {
            'click #edit': function (e, value, row, index) {
                e.preventDefault();
                limpiarModal();
                tituloModal.append('Actualizar Proveedor');
                $('#formUpdateProv').show();
                $('#formNewProv').hide();
                $('#formUpdateProv').removeClass('was-validated');
                $('.form-control').removeClass('is-valid');
                $('.form-control').removeClass('is-invalid');
                $('#updateProv').show();
                $('#guardarProv').hide();
                $('#formUpdateProv')[0].reset();
                // --------------------------------------------- //
                $('#upd-id').val(row.id);
                $('#upd-compania').val(row.compania);
                $('#upd-direccion').val(row.direccion);
                $('#upd-telefono').val(row.telefono);
                $('#upd-correo').val(row.correo);
                $('#upd-estatus').val(row.estatus);
                modal.modal('show');
            },
            'click #bajaProveedor': function(e, value, row, index) {
                e.preventDefault();
                var dataString = {
                    id:             row.id,
                    compania:       row.compania,
                    direccion:      row.direccion,
                    telefono:       row.telefono,
                    correo:         row.correo,
                    estatus:       'INACTIVO',
                };
                $.ajax({
                    type: 'PUT',
                    url: RouteIndexProv+'/'+dataString['id'],
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
            'click #altaProveedor': function(e, value, row, index) {
                e.preventDefault();
                var dataString = {
                    id:             row.id,
                    compania:       row.compania,
                    direccion:      row.direccion,
                    telefono:       row.telefono,
                    correo:         row.correo,
                    estatus:       'ACTIVO',
                };
                $.ajax({
                    type: 'PUT',
                    url: RouteIndexProv+'/'+dataString['id'],
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

        $(document).on('click','#nuevoProveedor',function(e){
            e.preventDefault();
            limpiarModal();
            tituloModal.append('Nuevo Proveedor');
            $('#formNewProv').show();
            $('#formUpdateProv').hide();
            $('#formNewProv').removeClass('was-validated');
            $('.form-control').removeClass('is-valid');
            $('.form-control').removeClass('is-invalid');
            $('#guardarProv').show();
            $('#updateProv').hide();
            $('#formNewProv')[0].reset();
            modal.modal('show');
        });

        footerModal.on('click', '#guardarProv', function(event){
            var dataString = {
                compania:       $('#compania').val(),
                direccion:      $('#direccion').val(),
                telefono:       $('#telefono').val(),
                correo:         $('#correo').val()
            };
            $.ajax({
                type: 'POST',
                url: RouteStoreProv,
                data: dataString,
                dataType: 'json',
                success: function(data){
                    modal.modal('hide');
                    table.bootstrapTable('refresh');
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    var form = $("#formNewProv")
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

        footerModal.on('click', '#updateProv', function(event){
            var dataString = {
                id:             $('#upd-id').val(),
                compania:       $('#upd-compania').val(),
                direccion:      $('#upd-direccion').val(),
                telefono:       $('#upd-telefono').val(),
                correo:         $('#upd-correo').val(),
                estatus:        $('#upd-estatus').val()
            };
            $.ajax({
                type: 'PUT',
                url: RouteIndexProv+'/'+dataString['id'],
                data: dataString,
                dataType: 'json',
                success: function(data){
                    modal.modal('hide');
                    table.bootstrapTable('refresh');
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    var form = $("#formNewProv")
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