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
                        ADMINISTRACIÓN
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table id="tableUser" style="text-align: center;">
    </table>
    @include('modals.modalRegister')
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
        var table               = $('#tableUser');
        var routeIndexAdmin     = "{!! route('administracion.index') !!}";
        var routeUsuarios       = "{!! route('admin.get_users') !!}";
        var routeStoreUser      = "{!! route('administracion.store') !!}";
        var modal               = $('#modalRegister');
        var divNuevo            = '<div style="position:relative; margin-top:10px; margin-bottom:10px; float:left!important;"><button class="btn btn-secondary" type="button" id="nuevoUsuario">Nuevo Usuario</button></div>';

        $(document).ready(function(){
            table.bootstrapTable({
                pagination: true,
                search: true,
                showRefresh: true,
                pageList: [10, 25, 50, 100],
                rowStyle: rowStyle,
                url: routeUsuarios,
                columns: [{
                    field: 'id',
                    title: 'No.',       
                }, {
                    field: 'name',
                    title: 'Nombre',
                    sortable: 'true',
                }, {
                    field: 'email',
                    title: 'Correo',
                    sortable: 'true',
                }, {                    
                    field: 'ocupation',
                    title: 'Ocupación',
                    sortable: 'true',
                },{
                    title:  'Acciones',
                    formatter: formatTableActions,
                    //events: operateEvents
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
            edit = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Editar Usuario" id="edit"><i class="fa fa-edit" aria-hidden="true"></i></button>&nbsp;';
            if(row.estatus=='ACTIVO'){
                baja = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de baja" id="bajaUsuario"><i class="fa fa-arrow-down"></i></button>&nbsp;';
                return [edit,baja].join('');
            }else{
                alta = '<button class="btn btn-dark btn-sm edit" data-toggle="tooltip" data-placement="top" title="Dar de alta" id="altaUsuario"><i class="fa fa-arrow-up"></i></button>&nbsp;&nbsp;';
                return [edit,alta].join('');
            }
        }

        window.operateEvents = {

        }

        $(document).on('click','#nuevoUsuario',function(e){
            e.preventDefault();
            limpiarModal();
            tituloModal.append('Nuevo Usuario');
            $('#formNewProd').show();
            $('#formUpdateProd').hide();
            $('#formNewProd').removeClass('was-validated');
            $('.form-control').removeClass('is-valid');
            $('.form-control').removeClass('is-invalid');
            $('#guardarProd').show();
            $('#updateProd').hide();
            $('#formNewUser')[0].reset();
            //$('.select2').select2();
            modal.modal('show');
        });
    });
</script>
@endsection