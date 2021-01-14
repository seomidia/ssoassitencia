@extends('voyager::master')

@section('page_title', 'Pedidos de Exames')

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-categories"></i> {{ __('Pedidos de Exames') }}
    </h1>
@stop

@section('content')

    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Comprador</th>
                                <th>Exame</th>
                                <th>Status</th>
                                <th>QTD</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>SEO Midia</td>
                                <td>Prostata</td>
                                <td>Pendente</td>
                                <td>10</td>
                                <td>
                                    <a href="#" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="3" id="delete-3">
                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Deletar</span>
                                    </a>
                                    <a href="#" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                        <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                    </a>
                                    <a href="#" title="View" class="btn btn-sm btn-warning pull-right view">
                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                    </a>

                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@stop

@section('javascript')
 <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                    $('#dataTable').DataTable();
            } );
        </script>
@stop

