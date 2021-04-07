@extends('voyager::master')

@section('page_title', __('Criar Novo Assistente'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-plus"></i>
        {{ __('Add Assistente')}}

    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form name="assistente" class="form-edit-add" action="#" method="POST">
                        <!-- CSRF TOKEN -->
                                @csrf
                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Nome</label>
                                <input required="" type="text" class="form-control" name="name" placeholder="Nome" value="{{$name ?? ''}}">
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="emial">E-mail</label>
                                <input required="" type="email" class="form-control" name="email" placeholder="E-mail" value="{{$email ?? ''}}">
                            </div>

                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="emial">Senha</label>
                                <input  type="text" class="form-control" name="password" placeholder="Senha" value="{{$senha ?? ''}}">
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @if(!isset($id))
                            <input type="hidden" name="parent" value="{{\Auth::user()->id}}">
                            @endif
                            <button type="submit" class="btn btn-primary save">Criar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('form[name="assistente"]').submit(function(event){
                event.preventDefault();
                $.post('{{(isset($id) ? url('/') . '/admin/assistente/'.$id.'/edit' : url('/') . '/admin/assistente')}}', $(this).serializeArray(), function (response) {
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
