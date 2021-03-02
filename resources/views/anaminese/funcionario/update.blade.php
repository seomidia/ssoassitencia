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
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>ANTECEDENTES FAMILIARES</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Doenças do coração, infartos, pressão alta? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['doencas-do-coração-infartos-pressao-alta']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['doencas-do-coração-infartos-pressao-alta']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Derrame/AVC?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares[derrame-avc]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares[derrame-avc]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Câncer/Tumor?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares[cancer-tumor]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares[cancer-tumor]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Diabetes? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['diabetes']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['diabetes']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Colesterol alterado?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['colesterol-alterado']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['colesterol-alterado']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças psiquiátricas? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['doenças-psiquiatricas']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedentes_familiares['doenças-psiquiatricas']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>HÁBITOS DE VIDA</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Prática atividade física? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['pratica-atividade-fisica'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['pratica-atividade-fisica'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Se Sim Qual?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Em qual frequencia?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>

                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Faz uso de bebida alcoólica?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida[faz-uso-de-bebida-alcoolica][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida[faz-uso-de-bebida-alcoolica][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Quantas vezes por semana?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Fumante? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['fumante'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['fumante'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Quantas vezes por semana?" name="habitos_vida['fumante'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Usa ou usou drogas?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['usa-o-usou-drogas']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['usa-o-usou-drogas']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Qual e em que frequência?" name="habitos_vida['usa-o-usou-drogas'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Tem vida sexualmente ativa? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['tem-vida-sexualmente-ativa']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['tem-vida-sexualmente-ativa']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>ANTECEDENTES PESSOAIS</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Prática atividade física? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['pratica-atividade-fisica'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['pratica-atividade-fisica'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Se Sim Qual?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Em qual frequencia?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>

                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Faz uso de bebida alcoólica?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida[faz-uso-de-bebida-alcoolica][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida[faz-uso-de-bebida-alcoolica][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Quantas vezes por semana?" name="habitos_vida['pratica-atividade-fisica'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Fumante? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['fumante'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['fumante'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Quantas vezes por semana?" name="habitos_vida['fumante'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Usa ou usou drogas?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['usa-o-usou-drogas']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['usa-o-usou-drogas']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="text" class="form-check-input" placeholder="Qual e em que frequência?" name="habitos_vida['usa-o-usou-drogas'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Tem vida sexualmente ativa? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['tem-vida-sexualmente-ativa']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="habitos_vida['tem-vida-sexualmente-ativa']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
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


