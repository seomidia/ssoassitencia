@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Anamineses'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-documentation"></i>
        {{ __('Anaminese')}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('form[name="create_anaminesis"]').submit(function(event){
                event.preventDefault();
                $.post('{{ route('voyager.create.anaminese') }}', $(this).serializeArray(), function (response) {
                        toastr.success('teste');
                        $file.parent().fadeOut(300, function() {
                            $(this).remove();
                            window.location = '/admin/anamnesis/create';
                        })
                });
            })
        });
    </script>
@stop
