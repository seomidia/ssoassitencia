@extends('voyager::master')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role_id == 6)
        @include('partials.medico.busca')
    @endif

@stop

