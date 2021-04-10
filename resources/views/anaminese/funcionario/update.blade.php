@extends('voyager::master')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('Anamnese'))

@section('page_header')
    <h1 class="page-title">
        <i class="icon voyager-documentation"></i>
        {{ __('Anamnese')}}
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
                                    <span class="label" style="font-size: 13px;"><strong style="font-size: 12px;font-weight: bold;"> NOME:</strong> {{$value->funcionario}}</span>
                                    <span class="label" style="font-size: 13px;"><strong style="font-size: 12px;font-weight: bold;"> CPF:</strong> {{App\Http\Controllers\AnamineseController::formatar_cpf_cnpj($value->cpf)}}</span>
                                    <span class="label" style="font-size: 13px;"><strong style="font-size: 12px;font-weight: bold;"> NASC:</strong> {{App\Http\Controllers\AnamineseController::data($value->nasc)}}</span>
                                    <span class="label" style="font-size: 13px;"><strong style="font-size: 12px;font-weight: bold;"> EMPRESA:</strong> {{$value->nome}}</span>
                                    <span class="label" style="font-size: 13px;"><strong style="font-size: 12px;font-weight: bold;"> CLINICA:</strong> {{$value->clinica}} - {{$value->endereco}} {{$value->numero}}, {{$value->bairro}}, {{$value->cidade}}-{{$value->estado}}</span>


                                @endforeach
                            </div>
                            <form name="questionario" action="">
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
                                    <input type="hidden" name="user_id_employee" value="{{$user_id}}">
                                    <input type="hidden" name="anamnesis_id" value="{{$anamnese_id}}">
                                    <button type="submit" class="btn btn-primary">Enviar para o medico</button>
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

        $('form[name="questionario"]').submit(function(event){
            event.preventDefault();
            // var anamnese_id = $('input[name="anamnese_id"]').val();

            $.post('/admin/anaminese/questionario', $(this).serializeArray(), function (response) {
                toastr.success('Anamnese encaminhada para o Medico!');
                setTimeout(function (){
                    window.location.href = '/admin/funcionario/anaminese';
                },2000);
            }).fail(function (jqXHR, textStatus) {
                toastr.error(jqXHR.responseJSON.message);
            })
        })



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


