@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Listado de mis solicitudes</h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordenes" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Localizador</th>
                                <th>Monto</th>
                                <th>Banco</th>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Cuenta</th>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                {{--                                <th>Acciones</th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            listar_demandas();

            function listar_demandas()
            {
                fetch('list_demands').then(resp => resp.json())
                    .then(data => {
                        console.log(data);
                        generar_tabla(data)
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }

            function generar_tabla(dataSet)
            {
                $('#ordenes').DataTable({
                    destroy: true,
                    data: dataSet,
                    columns: [
                        { "data": "locator"},
                        { "data": "amount"},
                        { "data": "bank"},
                        { "data": "account_name"},
                        { "data": "account_dni"},
                        { "data": "account_number"},
                        { "data": "date"},
                        { "data": "status"}
                    ],
                    "ordering": true,
                    "bInfo": false,
                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": ">>",
                            "sPrevious": "<<"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    },
                    "iDisplayLength": 10,
                    "responsive": false,
                });
            }
        })
    </script>
@endsection
