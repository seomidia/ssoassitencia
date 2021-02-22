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
        <i class="voyager-plus"></i> <span>{{ __('Voltar') }}</span>
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
                        <div class="row">
                            <div class="col-md-12 dados-funcionario">
                                <span class="label">NOME: Kaio Henrique dos Santos</span>
                                <span class="label">CPF: 949.934.402-00</span>
                                <span class="label">Nasc: 23/11/1987</span>
                            </div>
                            <form>
                                <div class="col-md-12 border">
                                    <div class="col-md-6 col-sm-12 question">
                                        <div class="section-title"><a href="123" class="tab"> ANTECEDENTES FAMILIARES </a> <i id="check-123" class="voyager-check-circle"></i><i id="warning-123" class="voyager-warning"></i></div>
                                        <div id="tab-123" class="tab-toggle">
                                            <p>The Radio button is exactly the same as the dropdown. You can specify a default if one has not been set and in the </p>
                                            <ul class="radio">
                                                <li>
                                                    <input type="radio" id="question-123-sim"
                                                           name="question-1"
                                                           value="sim">
                                                    <label for="question-123-sim">Sim</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input type="radio" id="question-123-nao"
                                                           name="question-1"
                                                           value="nao">
                                                    <label for="question-123-nao">nao</label>
                                                    <div class="check"></div>
                                                </li>
                                            </ul>
                                            <div style="clear: both"></div>
                                        </div>
                                        <div class="section-title"><a href="124" class="tab"> ANTECEDENTES FAMILIARES 2 </a><i id="check-124" class="voyager-check-circle"></i><i id="warning-124" class="voyager-warning"></i></div>
                                        <div id="tab-124" class="tab-toggle">
                                            <p>The Radio button is exactly the same as the dropdown. You can specify a default if one has not been set and in the </p>
                                            <ul class="radio">
                                                <li>
                                                    <input type="radio" id="question-124-sim"
                                                           name="question-2"
                                                           value="sim">
                                                    <label for="question-124-sim">Sim</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input type="radio" id="question-124-nao"
                                                           name="question-2"
                                                           value="nao">
                                                    <label for="question-124-nao">nao</label>
                                                    <div class="check"></div>
                                                </li>
                                            </ul>
                                            <div style="clear: both"></div>
                                        </div>
                                        <div class="section-title"><a href="125" class="tab"> ANTECEDENTES FAMILIARES 3 </a><i id="check-125" class="voyager-check-circle"></i><i id="warning-125" class="voyager-warning"></i></div>
                                        <div id="tab-125" class="tab-toggle">
                                            <p>The Radio button is exactly the same as the dropdown. You can specify a default if one has not been set and in the </p>
                                            <ul class="radio">
                                                <li>
                                                    <input type="radio" id="question-125-sim"
                                                           name="question-3"
                                                           value="sim">
                                                    <label for="question-125-sim">Sim</label>
                                                    <div class="check"></div>
                                                </li>
                                                <li>
                                                    <input type="radio" id="question-125-nao"
                                                           name="question-3"
                                                           value="nao">
                                                    <label for="question-125-nao">nao</label>
                                                    <div class="check"></div>
                                                </li>
                                            </ul>
                                            <div style="clear: both"></div>
                                        </div>
                                    </div>
                                </div>
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
        $('a.tab').click(function(event){
            event.preventDefault();
            var href = $(this).attr('href');

            $('#check-' + href).hide();
            $('#warning-' + href).show();

            $('.tab-toggle').hide();
            $('#tab-' + href).toggle();
        });

        $('input[type="radio"]').on('change',function(){
            var name = $(this).attr('name');
            var valor = $('input[name='+ name +']:checked').val()
            var id = $(this).attr('id');
            var num  = id.split('-')[1];
            if(valor != ''){
                $('#warning-' + num).hide();
                $('#check-' + num).show();
            }
        })


    })
</script>
@stop


