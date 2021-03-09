@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Anaminese'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Anaminese')}}
    </h1>
    <a href="/admin/funcionario/anaminese" class="btn btn-warning btn-add-new">
        <i class="voyager-double-left"></i> <span>{{ __('Voltar') }}</span>
    </a>


    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="title">
                            <h4>SSO - ASSESSORIA EM SEGURANÇA E SAÚDE OCUPACIONAL</h4>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-md-12 dados-funcionario">
                                @foreach($dados as $key => $value)
                                    <span class="label">NOME: {{$value->funcionario}}</span>
                                    <span class="label">CPF: {{App\Http\Controllers\AnamineseController::formatar_cpf_cnpj($value->cpf)}}</span>
                                    <span class="label">Nasc: {{App\Http\Controllers\AnamineseController::data($value->nasc)}}</span>
                                @endforeach
                            </div>
                            <form>
                                <div class="col-md-10 border">
                                    @include('anaminese.questoes.antecedentes-familiares')
                                    @include('anaminese.questoes.habitos-de-vida')
                                    @include('anaminese.questoes.antecedentes-pessoais')
                                    @include('anaminese.questoes.mulheres-questionarios')
                                    @include('anaminese.questoes.homem-questionario')
                                    @include('anaminese.questoes.avaliacao-nutricional')
                                    @include('anaminese.questoes.avaliacao-ocupacional')
                                    @include('anaminese.questoes.sinais-vitais')
                                    @include('anaminese.questoes.biotipo')
                            </form>
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
        jQuery('.tab1').hide();
        $('.question').click(function(){
            var id = $(this).attr('id');
            jQuery('.tab1').hide();
            $('#' + id + '.question .tab1').toggle();
        })
        $('label').click(function(){
            var id = $(this).attr('for');
            var name = $(this).attr('name');
            var value = $('#'+ id).val();
            $('.reply').hide();
            if(value == 'sim' || value=='tenho'){
                $('#reply-' + id.replace('checked-','')).show();
            }
        })
    })
</script>
@stop


