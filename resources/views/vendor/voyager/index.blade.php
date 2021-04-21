@extends('voyager::master')
@php
    $role = \DB::table('user_roles')->where('user_id',Auth::user()->id)->get();
    $permissao = (count($role) > 0) ? $role[0]->role_id : '';
@endphp

@section('content')
    @if($permissao == 6)
        @include('partials.medico.busca')
    @endif

@stop

