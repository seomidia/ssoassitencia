@extends('layouts.app')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nova empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="company_store" action="/company-store" type="post">
                    @csrf

                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome empresa:</label>
                            <input type="text" class="form-control" name="nome_fantasia" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">CNPJ:</label>
                            <input id="cnpj" type="text" class="form-control" name="cnpj" maxlength="18" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">CEP:</label>
                            <input type="text" class="form-control cep_company"  name="cep" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Endereço:</label>
                            <input type="text" class="form-control" id="company_endereco" name="endereco" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Numero:</label>
                            <input type="text" class="form-control" name="numero" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Complemento:</label>
                            <input type="text" class="form-control"  name="complemento" >
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Bairro:</label>
                            <input type="text" class="form-control" id="company_bairro" name="bairro" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" id="company_cidade" name="cidade" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Estado:</label>
                            <input type="text" class="form-control" id="company_estado" name="uf" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" data-mask="(00) 0000-0000" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>

            </div>
        </div>
    </div>

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0">
        <a href="#">Home</a> <span class="mx-2 mb-0">/</span>
        <a href="#">Carrinho</a> <span class="mx-2 mb-0">/</span>
          <strong class="text-black">Checkout</strong>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12">
          <div class="bg-light rounded p-3">
            <p class="mb-0">Você já é paciente? <a href="/admin/login" class="d-inline-block">Clique aqui</a> para logar</p>
          </div>
            @if(Session::has('warning'))
                <div class="mt-5 alert alert-warning">
                    {{ Session::get('warning') }}
                </div>
            @endif
            @if(Session::has('danger'))
                <div class="mt-5 alert alert-danger">
                    {{ Session::get('danger') }}
                </div>
            @endif

        </div>
      </div>
        <form name="finalizar" action="/finalizar" method="POST">
            @csrf
            <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
              <h2 class="h3 mb-3 text-black">Detalhes de cobrança</h2>
              <div class="p-3 p-lg-5 border">
                <div class="form-group">
                  <label for="quem" class="text-black">Você é? <span class="text-danger">*</span></label>
                  <select id="quem" name="cliente" class="form-control">
                      <option value="cliente">Outros</option>
                      <option value="rh">RH</option>

                  </select>
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Primeiro nome <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="nome">
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Ultimo nome <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="sobrenome">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_companyname" class="text-black">Nome da empresa </label>
                      <input type="text" class="form-control" id="c_companyname"  class="ui-autocomplete-input" autocomplete="off">
                      <input type="hidden" class="form-control" class="ui-autocomplete-input" autocomplete="off" name="empresa_id">
                  </div>
                </div>

                  <div class="form-group row">
                      <div class="col-md-12">
                          <label for="cep" class="text-black">CEP <span class="text-danger">*</span></label>
                          <input type="text" class="form-control cep"  name="cep">
                      </div>
                      <div class="col-md-9">
                          <label for="endereco" class="text-black">Endereço <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">
                      </div>
                      <div class="col-md-3">
                          <label for="numero" class="text-black">Numero <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero">
                      </div>
                  </div>


                  <div class="form-group">
                  <input type="text" class="form-control" name="complemento" placeholder="Complemento">
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="cidade" class="text-black">Cidade <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cidade" name="cidade">
                    </div>
                    <div class="col-md-6">
                    <label for="uf" class="text-black">Estado <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="uf" name="uf">
                  </div>
                </div>

                <div class="form-group row mb-5">
                  <div class="col-md-6">
                    <label for="email" class="text-black">E-mail <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email">
                  </div>
                  <div class="col-md-6">
                    <label for="telefone" class="text-black">Telefone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                  </div>
                </div>

                    @if(!Auth::check())
                        <div class="form-group">
                          <label for="c_create_account" class="text-black">
                              <input type="checkbox" value="1" id="c_create_account"> Dados de sua conta</label>
                          <div id="create_an_account" class="hidden">
                            <div class="py-2">
                              <p class="mb-3">Crie uma conta inserindo as informações abaixo. Se você é um cliente antigo, faça o login no topo da página.</p>
                              <div class="form-group">
                                <label for="password" class="text-black">Senha de sua conta</label>
                                <input type="password" class="form-control" id="password" name="password"
                                  placeholder="">
                              </div>
                            </div>
                          </div>
                        </div>
                  @endif
                <div class="form-group">
                  <label for="obs" class="text-black">OBS do pedido</label>
                  <textarea name="obs" id="obs" cols="30" rows="5" class="form-control"
                    placeholder="Se existir uma observação sobre a compra deixe aqui."></textarea>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="row mb-5">
                <div class="col-md-12">
                  <h2 class="h3 mb-3 text-black">Sua compra</h2>
                  <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                      <thead>
                        <th>Produto</th>
                        <th>Total</th>
                      </thead>
                      <tbody>
                      @foreach($produtos as $produto)
                        <tr>
                          <td>{{$produto->name}} <strong class="mx-2">x</strong> {{$produto->qtd}}</td>
                          <td>R$ {{$produto->price}}</td>
                        </tr>
                      @endforeach
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Sub-total</strong></td>
                          <td class="text-black">R$ {{$subtotal}}</td>
                        </tr>
                        <tr>
                          <td class="text-black font-weight-bold"><strong>Total</strong></td>
                          <td class="text-black font-weight-bold"><strong>R$ {{$total}}</strong></td>
                        </tr>
                      </tbody>
                    </table>

                    <!-- <div class="border mb-3">
                      <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button"
                          aria-expanded="false" aria-controls="collapsebank">Tranferência bancária</a></h3>
                      <div class="collapse" id="collapsebank">
                        <div class="py-2 px-4">
                          <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the
                            payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                        </div>
                      </div>
                    </div> -->

                      <article class="card">
                          <div class="card-body">
                              <div class="loadpag" style="display:none;font-size: 20px;position: absolute;min-width: 92%;min-height: 93%;background: #ffff;z-index: 9;opacity: 0.9;text-align: center;">
                                  <img style="position: sticky;top: 50%;" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif">
                                  <p style="position: sticky;top: 40%;color: #1ad5d5">Aguarde...</p>
                              </div>


                              <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
{{--                                  <li class="nav-item">--}}
{{--                                      <a class="nav-link active" data-toggle="pill" href="#nav-tab-card">--}}
{{--                                          <i class="fa fa-credit-card"></i> Credit Card</a>--}}
{{--                                  </li>--}}
                                  <li class="nav-item">
                                      <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                                          <i class="fa fa-file-invoice-dollar"></i>  Boleto</a>
                                  </li>
                              </ul>

                              <div class="tab-content">

{{--                                  <div class="tab-pane fade show active" id="nav-tab-card">--}}
{{--                                          <div class="form-group">--}}
{{--                                              <label for="username">Nome completo (impresso no cartão)</label>--}}
{{--                                              <input type="text" class="form-control" name="username" placeholder="" required="">--}}
{{--                                          </div> <!-- form-group.// -->--}}

{{--                                          <div class="form-group">--}}
{{--                                              <label for="cardNumber">Numero do cartão</label>--}}
{{--                                              <div class="input-group">--}}
{{--                                                  <input type="text" class="form-control" name="cardNumber" placeholder="">--}}
{{--                                                  <div class="input-group-append">--}}
{{--                                                        <span class="input-group-text text-muted">--}}
{{--                                                            <i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  --}}
{{--                                                            <i class="fab fa-cc-mastercard"></i>--}}
{{--                                                        </span>--}}
{{--                                                  </div>--}}
{{--                                              </div>--}}
{{--                                          </div> <!-- form-group.// -->--}}

{{--                                          <div class="row">--}}
{{--                                              <div class="col-sm-8">--}}
{{--                                                  <div class="form-group">--}}
{{--                                                      <label><span class="hidden-xs">Vencimento</span> </label>--}}
{{--                                                      <div class="input-group">--}}
{{--                                                          <input type="number" class="form-control" placeholder="Mês" name="cart_mes">--}}
{{--                                                          <input type="number" class="form-control" placeholder="Ano" name="cart_ano">--}}
{{--                                                      </div>--}}
{{--                                                  </div>--}}
{{--                                              </div>--}}
{{--                                              <div class="col-sm-4">--}}
{{--                                                  <div class="form-group">--}}
{{--                                                      <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>--}}
{{--                                                      <input type="number" name="cart_cvv" class="form-control">--}}
{{--                                                  </div> <!-- form-group.// -->--}}
{{--                                              </div>--}}
{{--                                          </div> <!-- row.// -->--}}
{{--                                  </div> <!-- tab-pane.// -->--}}
                                  <div class="tab-pane fade py-3 active" id="nav-tab-bank">
                                      <center>
                                          <img src="{{asset('images/boleto.png')}}" alt="boleto" title="Boleto">
                                          <a style="display: none" href="#" id="boleto" target="_blank"><i class="fa fa-print"></i> Clique aqui para ver seu boleto</a>
                                      </center>
                                  </div> <!-- tab-pane.// -->
                              </div> <!-- tab-content .// -->
                              <input type="hidden" name="type_payment" value="boleto">
                              <button class="subscribe btn btn-primary btn-block" type="submit"> Pagar agora  </button>

                          </div> <!-- card-body.// -->
                      </article>


                  </div>
                </div>
              </div>

            </div>
          </div>
        </form>
    </div>
  </div>


  <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
    <div class="container">
      <div class="row align-items-stretch">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_1.jpg');">
            <div class="banner-1-inner align-self-center">
              <h2>Pharma Products</h2>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
              </p>
            </div>
          </a>
        </div>
        <div class="col-lg-6 mb-5 mb-lg-0">
          <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('images/bg_2.jpg');">
            <div class="banner-1-inner ml-auto  align-self-center">
              <h2>Rated by Experts</h2>
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem odio voluptatem.
              </p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

@endsection

<style>
    .block{
        display: block;
    }
    .hidden{
        display: none;
    }
</style>
