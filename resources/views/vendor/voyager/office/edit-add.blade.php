@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());

    $metodo = ($edit) ? 'office-update' : 'office';

@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="http://dev.sso.com/admin/{{$metodo}}" method="POST" enctype="multipart/form-data">
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

                                @if($edit)
                                    <div class="form-group  col-md-12 ">
                                        <label class="control-label" for="name">Status</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="status" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option value="0" @if($dataTypeContent->status == 0) selected @endif>Off</option>
                                            <option value="1" @if($dataTypeContent->status == 1) selected @endif>On</option>
                                        </select>
                                    </div>
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    <div class="form-group  col-md-12 ">
                                        <label class="control-label" for="name">Nome</label>
                                        <input required="" type="text" class="form-control" name="name" placeholder="Nome" value="{{$dataTypeContent->name}}">
                                    </div>
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    <div class="form-group  col-md-12 ">
                                        <label class="control-label" for="name">Ambiente</label>
                                        <input required="" type="text" class="form-control" name="workplace" placeholder="Ambiente" value="{{$dataTypeContent->workplace}}">
                                    </div>
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    <div class="form-group  col-md-12 ">
                                        <label class="control-label" for="name">Riscos </label>
                                        <select class="form-control select2" name="risk[]" multiple>
                                            @php

                                                $risklist = \Illuminate\Support\Facades\DB::table('risk_factors')
                                                                                        ->select('id','name')
                                                                                        ->get();

                                                $risklistname = \Illuminate\Support\Facades\DB::table('office_risk_relationship as orr')
                                                                                        ->join('risk_factors as rf','orr.risk_factors_id','rf.id')
                                                                                        ->where('office_id',$dataTypeContent->id)
                                                                                        ->select('rf.id','rf.name')
                                                                                        ->get();
                                                    $i = 0;
                                                 foreach ($risklist as $key => $item){
                                                     $selected = (isset($risklistname[$i]->id) AND $risklistname[$i]->id == $item->id) ? 'selected' : '';
                                                     echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                                                     $i++;
                                                 }
                                            @endphp
                                        </select>
                                    </div>
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    <div class="form-group  col-md-12 ">
                                        <label class="control-label" for="name">Descrição</label>
                                        <textarea class="form-control" name="description" rows="5">{{$dataTypeContent->description}}</textarea>
                                    </div>
                                    <input type="hidden" name="office_id" value="{{$dataTypeContent->id}}">
                                @endif
                                @if(!$edit)
                                <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Status</label>
                                <select class="form-control select2 select2-hidden-accessible" name="status" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option value="0" data-select2-id="3">Off</option>
                                    <option value="1">On</option>
                                </select>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Nome</label>
                                <input required="" type="text" class="form-control" name="name" placeholder="Nome" value="">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Ambiente</label>
                                <input required="" type="text" class="form-control" name="workplace" placeholder="Ambiente" value="">
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Riscos</label>
                                <select class="form-control select2" name="risk[]" multiple>
                                    @php

                                       $risklist = \Illuminate\Support\Facades\DB::table('risk_factors')
                                                                               ->select('id','name')
                                                                               ->get();

                                        foreach ($risklist as $key => $item){
                                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                        }
                                    @endphp
                                </select>
                            </div>
                            <!-- GET THE DISPLAY OPTIONS -->
                            <div class="form-group  col-md-12 ">
                                <label class="control-label" for="name">Descrição</label>
                                <textarea class="form-control" name="description" rows="5"></textarea>
                            </div>

                            @endif

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">Save</button>
                        </div>
                    </form>
                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
