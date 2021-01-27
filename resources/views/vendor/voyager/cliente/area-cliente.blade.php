@extends('voyager::master')

@section('page_title',   'Pedidos do Cliente')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="icon voyager-person"></i> Área do Cliente
        </h1>
    </div>
@endsection

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Status</th>
                                    <th>Pagamento</th>
                                    <th>Tipo de produto</th>
                                    <th>Produto</th>
                                    <th>QTD</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pendente</td>
                                    <td>Boleto</td>
                                    <td>Consulta</td>
                                    <td>Exame de fezes</td>
                                    <td>10</td>
                                    <td>
                                        <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="2" id="delete-2">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Deletar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2" title="View" class="btn btn-sm btn-warning pull-right view">
                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Pendente</td>
                                    <td>Boleto</td>
                                    <td>Consulta</td>
                                    <td>Exame de fezes</td>
                                    <td>10</td>
                                    <td>
                                        <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="2" id="delete-2">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Deletar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2" title="View" class="btn btn-sm btn-warning pull-right view">
                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Pendente</td>
                                    <td>Boleto</td>
                                    <td>Consulta</td>
                                    <td>Exame de fezes</td>
                                    <td>10</td>
                                    <td>
                                        <a href="javascript:;" title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="2" id="delete-2">
                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Deletar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2/edit" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                        </a>
                                        <a href="http://dev.sso.com/admin/products/2" title="View" class="btn btn-sm btn-warning pull-right view">
                                            <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                        </a>
                                    </td>
0                                </tr>
                                </tbody>
                            </table>
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button previous disabled" aria-controls="dataTable" tabindex="0" id="dataTable_previous">
                                            <a href="#">Anterior</a>
                                        </li>
                                        <li class="paginate_button active" aria-controls="dataTable" tabindex="0">
                                            <a href="#">1</a></li>
                                        <li class="paginate_button " aria-controls="dataTable" tabindex="0">
                                            <a href="#">2</a>
                                        </li>
                                        <li class="paginate_button next" aria-controls="dataTable" tabindex="0" id="dataTable_next">
                                            <a href="#">Proximo</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- DataTables -->
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>

@stop
