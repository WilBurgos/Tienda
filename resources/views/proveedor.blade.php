@extends('layouts.app')

@section('css')
<link href="{{ asset('plugins/BootstrapTable/css/bootstrap-table.min.css') }}" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />


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
    <table id="tableAlmacen" style="text-align: center;">
    </table>
    @include('modals.modalProveedor')
</div>
@elseif(Auth::user()->ocupation == "CAJERO")

@endif

@endsection

@section('scripts')
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('plugins/BootstrapTable/js/bootstrap-table-es-MX.js') }}"></script>
<script src="{{ asset('plugins/jQueryFormValidator/js/jquery.form-validator.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function () {
        var table               = $('#tableAlmacen');
        var RouteProveedores    = "{!! route('prov.get_provs') !!}";
        var RouteStoreProv      = "{!! route('proveedor.store') !!}";
        var modal               = $('#modalProveedor');
        var tituloModal         = $('#modal-titulo');
	    var bodyModal           = $('#modal-body');
	    var footerModal         = $('#modal-footer');

        var divNuevo = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="nuevoProveedor">Nuevo Proveedor</button></div>';

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
                    field: 'compania',
                    title: 'Nombre',
                    sortable: 'true',
                }, {                    
                    field: 'estatus',
                    title: 'Estado de origen',
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
            if(row.estatus=='ACTIVO'){
                baja = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de baja" id="baja"><i class="fa fa-arrow-down"></i></button>&nbsp;';
                return [edit,baja].join('');
            }else{
                alta = '<button class="btn btn-secondary btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de alta" id="alta"><i class="fa fa-arrow-up"></i></button>&nbsp;&nbsp;';
                return [edit,alta].join('');
            }
        }

        window.operateEvents = {
            'click #edit': function (e, value, row, index) {
                //modal.modal('show');
            }
        };

        $(document).on('click','#nuevoProveedor',function(e){
            modal.modal('show');
        });

        footerModal.on('click', '#guardarProv', function(event){
            /*'use strict';
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            //form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            //}, false);
            });*/
            var dataString = {
                compania:       $('#compania').val(),
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
                        $('#'+key).append('<div class="invalid-feedback" id="error_compania">'+value+'</div>');
                    });
                    form.addClass('was-validated');

                }
            })
        });
    });

    /*(function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();*/

</script>
@endsection