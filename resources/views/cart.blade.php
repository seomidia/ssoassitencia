@extends('layouts.app')

@section('content')

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="spinner-grow" role="status">
        <span class="sr-only">Loading...</span>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-md-center">
                <div class="container-form col-md-10">
                    <form name="exames-complementares" action="" method="post">

                        <h1 class="title-form">@if($tipo) Consulta médica @else Exame complementar @endif</h1>

                        <h2>INSTRUÇÕES PARA COMPRA E AGENDAMENTO</h2>
                        <p>
                            Preencher um formulário por pessoa. Caso deseje agendar para mais pessoas iniciar novamente o forumlário.
                        </p>
                        <h2>Opção 1) Agendamento para outra pessoa</h2>
                        <p>
                            Neste caso você deve ter as informações da empresa e do funcionário como NOME, CPF, email, celular, etc e preencher as abas abaixo: EXAMES e PREÇOS, INFORMAÇÕES DA EMPRESA
                        </p>
                        <p>
                            O funcionário/paciente irá receber um email com o link do questionário que deve preencher antes de comparecer na clínica. Trabalhamos de Segunda a Sexta feira das 8hs as 18hs.              </p>
                        <p>
                            Após o exame médico o paciente e a pessoa que realizou o agendamento irão receber um email com o Atestado médico anexo.
                        </p>
                        <h2>Opção 2) Agendamento para mim</h2>
                        <p>
                            Neste caso você deve ter as informações da empresa e preencher as abas abaixo: EXAMES e PREÇOS, INFORMAÇÕES DA EMPRESA, INFORMAÇÕES DO PACIENTE
                        </p>
                        <p>
                            Após isto basta comparecer em nossa clínica de Segunda a Sexta feira das 8hs as 18hs para consulta médica. O resultado chegará no email que informou no cadastro.
                        </p>


{{--                        <div class="form-group col-md-12" >--}}
{{--                            <label for="quem" class="text-black">Para quem é o atendimento?  <span class="text-danger">*</span></label><br>--}}
{{--                            <p> <input type="radio" checked name="agendar" value="outra_pessoa"> Vou agendar para outra pessoa</p>--}}
{{--                            <p> <input type="radio"  name="agendar" value="rh"> Vou agendar para mim</p>--}}
{{--                        </div>--}}

                        <div class="exames-complementar col-md-12">
                            <div class="row">
                                @foreach($produtos as $key => $produto)
                                    <div class="col-md-12" style="clear: both">&nbsp;</div>

                                    <h5>{{$key}}</h5>
                                    <div class="col-md-12" style="clear: both">&nbsp;</div>
                                    @foreach($produto as $item)
                                        <div class="form-checkbox-item col-md-6">
                                            <input type="checkbox" @if($prod_id == $item->id) checked  @endif class="form-checkbox" id="{{$item->slug}}" name="prod[]" value="{{$item->id}}">
                                            <label for="{{$item->slug}}"> {{$item->name}} - <b>R$ {{number_format($item->price,2,",",".")}}</b> </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="pagamento">
                            <div class="col-md-12" style="clear: both">&nbsp;</div>

                            <h5>Detalhes da compra</h5>
                            <div class="col-md-12" style="clear: both">&nbsp;</div>

                            <table class="table table-responsive" id="cart">
                                <tr>
                                    <th>Exame</th>
                                    <th>QTD</th>
                                    <th>Valor</th>
                                </tr>
                                <tr><td colspan="3" style="text-align: center"> Não existe exames selecionados </td></tr>
                                <tr>
                                    <td colspan="2" style="text-align: right;padding: 5px 5px">TOTAL | </td>
                                    <td style="padding: 5px 0px">R$ 00,00</td>
                                </tr>
                            </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
