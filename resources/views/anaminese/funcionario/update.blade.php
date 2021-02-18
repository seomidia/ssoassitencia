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
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="title">
                            <h4>SSO - ASSESSORIA EM SEGURANÇA E SAÚDE OCUPACIONAL</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="label">ANAMINESE OCUPACIONAL - PCI NOME: Kaio Henrique dos Santos</span>
                                <span class="label">CPF: 949.934.402-00</span>
                                <span class="label">Nasc: 23/11/1987</span>
                            </div>
                            <form>
                            <div class="col-md-5 border">
                                <div class="col-md-12 question">
                                    <div class="section-title">ANTECEDENTES FAMILIARES</div>
                                    <ul class="nav">
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="section-title">HÁBITOS DE VIDA</div>
                                    <ul class="nav">
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="section-title">ANTECEDENTES PESSOAIS</div>
                                    <ul class="nav">
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="section-title feminino">MULHERS - QUESTIONÁRIO</div>
                                            <ul class="nav">
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="section-title masculino">HOMEMS - QUESTIONÁRIO</div>
                                            <ul class="nav">
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                                <li>1 -
                                                    <span>Doenças do coração, infartos, pressão alta ?</span>
                                                    <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="section-title">AVALIAÇÃO NUTRICIONAL</div>
                                    <ul class="nav">
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="section-title">AVALIAÇÃO MÉDICA - SOMENTE O MÉDICO</div>
                                    <ul class="nav">
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                        <li>1 -
                                            <span>Doenças do coração, infartos, pressão alta ?</span>
                                            <span>
                                                <input name="teste" value="nao" type="radio"> Não
                                                <input name="teste" value="sin" type="radio"> Sim
                                            </span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="col-md-4 border">
                                <div class="section-title">SINAIS VITAIS</div>
                                <div class="section-title">AVALIAÇÃO OCUPACIONA</div>
                            </div>
                            <div class="col-md-3">
                                <img src="{{asset('/images/header/logo_final_bx.jpg')}}" width="200">
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
@stop


