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
                                                <p>Tonturas, dores de cabeça, convulsões? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['tonturas-dores-de-cabeca-convulsoes']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['tonturas-dores-de-cabeca-convulsoes']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Perda de visão, miopia, hipermetropia, astigmatismos?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['perda-de-visao-miopia-hipermetropia-astigmatismos']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['perda-de-visao-miopia-hipermetropia-astigmatismos']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Perda de audição, otite, zumbido, rebaixamento auditivo? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['perda-de-audicao-otite-zumbido-rebaixamento-auditivo']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['perda-de-audicao-otite-zumbido-rebaixamento-auditivo']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Resfriados, bronquite, asma, sinusite, rinite?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['resfriados-bronquite-asma-sinusite-rinite']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['resfriados-bronquite-asma-sinusite-rinite']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Dores nos ombros e punhos? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['dores-nos-ombros-e-punhos']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['dores-nos-ombros-e-punhos']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças de coração, infartos, pressão alta? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-de-coracao-infartos-pressao-alta']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-de-coracao-infartos-pressao-alta']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Dores nas costas, coluna, hérnia de disco? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['dores-nas-costas-coluna-hernia-de-disco']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['dores-nas-costas-coluna-hernia-de-disco']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Sofreu alguma fratura óssea? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['sofreu-alguma-fratura-ossea']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['sofreu-alguma-fratura-ossea']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças do estomago, úlcera, gastrite? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-do-estomago-ulcera-gastrite']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-do-estomago-ulcera-gastrite']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças do fígado, hepatite, cirrose? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-do-figado-hepatite-cirrose']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-do-figado-hepatite-cirrose']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças dos rins, nefrite, infecção urinária? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-dos-rins-nefrite-infeccao-urinaria']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-dos-rins-nefrite-infeccao-urinaria']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças de pele, urticárias eczemas? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-de-pele-urticarias-eczemas']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-de-pele-urticarias-eczemas']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Reumatismos, dores nas juntas? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['reumatismos-dores-nas-juntas']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['reumatismos-dores-nas-juntas']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Diabetes? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['diabetes']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['diabetes']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças psiquiátricas? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-psiquiatricas']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-psiquiatricas']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Já esteve internado? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['ja-esteve-internado']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['ja-esteve-internado']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Submetido à cirurgia? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['submetido-a-cirurgia']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['submetido-a-cirurgia']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Doenças vasculares, varizes/hemorroidas? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-vasculares-varizeshemorroidas']" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="antecedente_pessoais['doencas-vasculares-varizeshemorroidas']" value="nao">
                                                    <label class="form-check-label" for="">Não Tenho</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>MULHERS - QUESTIONÁRIO</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Tem filhos? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['tem-filhos'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['tem-filhos'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-check-input"  name="mulher_questionario['tem-filhos'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Abortamentos?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['abortamentos'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['abortamentos'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-check-input"  name="mulher_questionario['quantos'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Faz exames ginecológicos?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['faz-exames-ginecologicos']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['faz-exames-ginecologicos']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Usa contraceptivo? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['usa-contraceptivo']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="mulher_questionario['usa-contraceptivo']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Data da última menstruação</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="date" class="form-control" name="mulher_questionario['data-da-ultima-menstruacao']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>HOMENS - QUESTIONÁRIO</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Tem filhos? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['tem-filhos'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['tem-filhos'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-check-input"  name="homem_questionario['tem-filhos'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>É vasectomizado?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['vasectomizado'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['vasectomizado'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Passa por consulta urologica?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['passa-por-consulta-urologica']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['passa-por-consulta-urologica']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Já fez exame de prostata? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['ja-fez-exame-de-prostata']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['ja-fez-exame-de-prostata']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Câncer de próstata (pai, irmãos)</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['cancer-de-prostata']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="homem_questionario['cancer-de-prostata']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>AVALIAÇÃO NUTRICIONAL</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Tem apetite regular? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['tem-apetite-regular'][]" value="sim">
                                                    <label class="form-check-label" for="">Tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional[tem-apetite-regular'][]" value="nao">
                                                    <label class="form-check-label" for="">Não tenho</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <p>Quantas vezes por dia se alimenta?</p>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-check-input" name="avaliacao_nutricional['tem-apetite-regular'][]"> a
                                                    <input type="number" class="form-check-input" name="avaliacao_nutricional['tem-apetite-regular'][]">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Alimentação é variada? (carnes legumes, verduras, frutas )?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['alimentacao-e-variada']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['alimentacao-e-variada']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Você se sente bem com seu peso e altura? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>AVALIAÇÃO OCUPACIONAL</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Já sofreu algum acidente do trabalho? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['tem-apetite-regular'][]" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional[tem-apetite-regular'][]" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Já teve alguma doença do trabalho?</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['alimentacao-e-variada']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['alimentacao-e-variada']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Apresentou algum afastamento acima de 15 dias? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Já esteve afastado pelo INSS? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Exerce outras atividade em outras empresas além desta? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Já utilizou EPI? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Sua condição de saúde atual exige ambiente de trabalho especial? </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="sim">
                                                    <label class="form-check-label" for="">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input" name="avaliacao_nutricional['voce-se-sente-bem-com-seu-peso-e-altura']" value="nao">
                                                    <label class="form-check-label" for="">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question">
                                        <div class="section-questions">
                                            <div class="section-title">
                                                <h3>SINAIS VITAIS</h3>
                                            </div>
                                            <div class="pergunta">
                                                <p>Altura (mt) </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-control" name="avaliacao_nutricional['tem-apetite-regular'][]" value="sim">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>Peso (Kg)</p>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-control" name="avaliacao_nutricional['tem-apetite-regular'][]" value="sim">
                                                </div>
                                            </div>
                                            <div class="line">&nbsp;</div>
                                            <div class="pergunta">
                                                <p>MC </p>
                                                <div class="form-check form-check-inline">
                                                    <input type="number" class="form-control" name="avaliacao_nutricional['tem-apetite-regular'][]" value="sim">
                                                </div>
                                            </div>
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


