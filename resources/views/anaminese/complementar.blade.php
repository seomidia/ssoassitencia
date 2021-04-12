@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

@stop

@section('page_title', __('Encaminhamentos'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Complementares')}}
    </h1>
@stop

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
                                    <th><input type="checkbox" name="deletecheck"></th>
                                    <th>#Codigo</th>
                                    <th>Empresa</th>
                                    <th>Funcionario</th>
                                    <th>Cargo</th>
                                    <th>Status</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($anamnese as $key => $item)
                                <tr>
                                    <td style="vertical-align: middle"><input type="checkbox" name="deletecheck" value="id[]"></td>
                                    <td style="vertical-align: middle">#{{$item->id}}</td>
                                    <td style="vertical-align: middle">{{$item->empresa}}</td>
                                    <td style="vertical-align: middle">{{$item->funcionario}}</td>
                                    <td style="vertical-align: middle">{{$item->cargo}}</td>
                                    <td style="vertical-align: middle">
                                        <div  class="
                                            @if($item->step == 'step_rh')
                                                alert-danger
                                            @endif
                                            @if($item->step == 'step_funci')
                                                alert-success
                                            @endif
                                            @if($item->step == 'step_med')
                                                alert-primary
                                            @endif
                                            @if($item->step == 'step_complementar')
                                                alert-primary
                                            @endif
                                            aviso">
                                            @if($item->step == 'step_rh')
                                                Não iniciado
                                            @endif
                                            @if($item->step == 'step_funci')
                                                Funcionario
                                            @endif
                                            @if($item->step == 'step_med')
                                                Medico
                                            @endif
                                            @if($item->step == 'step_complementar')
                                                Complementar
                                            @endif
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle">
                                         <a href="{{$item->id}}&{{$item->user_id_employee}}"  class="btn btn-sm btn-primary pull-center obs" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                    </td>
                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal modal-primary fade" tabindex="-1" id="obg_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-info-circled"></i> {{ __('Observações gerais') }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" name="obs" method="POST">

                        <textarea id="default" class="form-control" rows="10" name="obs_geral" style="margin-bottom: 5px"></textarea>
                            <br>
                        <input type="hidden" name="user_id"  value="">
                        <input type="submit" class="btn pull-right delete-confirm" value="{{ __('Salvar') }}">
                    </form>
                    <button type="button" class="btn btn-default btn-danger pull-right" data-dismiss="modal">{{ __('Cancelar') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('.obs').click(function(event){
                event.preventDefault();
                var id = $(this).attr('href').split('&');
                var url  = window.location.origin + '/admin/complementares/' + id[0] + '/status';
                $('input[name="user_id"]').val(id[1]);
                $('form[name="obs"]').attr('action',url);
                $('#obg_modal').modal('show');
            });

            $('form[name="obs"]').submit(function (event){
                event.preventDefault();
                var data = $(this).serializeArray();

                var url = $('form[name="obs"]').attr('action');

                $.post(url, data, function (response) {
                    toastr.success(response.message);
                    setTimeout(function (){
                        $('.modal').modal('hide');
                    },2000);
                    setTimeout(function (){
                        window.location.href = '/admin';
                    },3000);
                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })


            });
        });
    </script>
@stop
