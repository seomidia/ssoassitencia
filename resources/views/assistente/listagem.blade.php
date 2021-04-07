@extends('voyager::master')
@section('css')
@stop

@section('page_title', __('Assistente'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-people"></i>
        {{ __('Assistente')}}
    </h1>
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <a class="btn btn-success btn-add-new" href="/admin/criar-assistente">
                        <i class="voyager-plus"></i> <span>Criar</span>
                    </a>
            </div>
        </div>
    </div>
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
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td style="vertical-align: middle"><input type="checkbox" name="deletecheck"></td>
                                        <td style="vertical-align: middle">{{$user->id}}</td>
                                        <td style="vertical-align: middle">{{$user->name}}</td>
                                        <td style="vertical-align: middle">{{$user->email}}</td>
                                        <td style="vertical-align: middle">
                                            <a href="/admin/assistente/{{$user->id}}/edit"  class="btn btn-sm btn-primary pull-center" style="padding: 2px 7px;"><i class="voyager-edit"></i></a>
                                            <a href="/admin/assistente/{{$user->id}}/delete" class="btn btn-sm btn-danger pull-center delete" style="padding: 2px 7px;"><i class="voyager-trash"></i></a>
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

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('Deletar Assitente') }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="#" name="assistente" method="POST">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="{{ __('Deletar') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('Cancelar') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('.delete').click(function(event){
                event.preventDefault();
                var href = $(this).attr('href');
                $('form[name="assistente"]').attr('action',href);
                $('#delete_modal').modal('show');
            });


            $('form[name="assistente"]').submit(function(event){
                event.preventDefault();
                var action =  $('form[name="assistente"]').attr('action');

                $.post(action, function (response) {
                    toastr.success(response.message);
                    setTimeout(function (){
                        window.location.href = '/admin/assistente';
                    },2000);

                }).fail(function (jqXHR, textStatus) {
                    toastr.error(jqXHR.responseJSON.message);
                })
            })

        });
    </script>
@stop
