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
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome empresa:</label>
                            <input type="text" class="form-control" name="nome_fantasia">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">CNPJ:</label>
                            <input type="text" class="form-control" name="cnpj">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">CEP:</label>
                            <input type="text" class="form-control" name="cep">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Endereço:</label>
                            <input type="text" class="form-control" name="endereco">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Numero:</label>
                            <input type="text" class="form-control" name="numero">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Complemento:</label>
                            <input type="text" class="form-control" name="complemento">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Bairro:</label>
                            <input type="text" class="form-control" name="bairro">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" name="cidade">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Estado:</label>
                            <input type="text" class="form-control" name="estado">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Telefone:</label>
                            <input type="text" class="form-control" name="telefone">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
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
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <h2 class="h3 mb-3 text-black">Detalhes de cobrança</h2>
          <div class="p-3 p-lg-5 border">
            <div class="form-group">
              <label for="quem" class="text-black">Você é? <span class="text-danger">*</span></label>
              <select id="quem" name="cliente" class="form-control">
                  <option value="rh">RH</option>
                  <option value="funcionario">Funcionario</option>
              </select>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_fname" class="text-black">Primeiro nome <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_fname" name="mone">
              </div>
              <div class="col-md-6">
                <label for="c_lname" class="text-black">Ultimo nome <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_lname" name="sobrenome">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_companyname" class="text-black">Nome da empresa </label>
                <input type="text" class="form-control" id="c_companyname"  class="ui-autocomplete-input" autocomplete="off" name="empresa">
              </div>
            </div>

              <div class="form-group row">
                  <div class="col-md-12">
                      <label for="cep" class="text-black">CEP <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="cep" name="cep">
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

                <div class="col-md-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <div class="row" >
                                  <h3 class="panel-body"><img style="width:100%" src="images/checkout/pagseguro.svg" alt=""/></h3>
                              </div>
                          </div>

                          <div class="panel-body">
                              <form role="form" action="./pay.php" method="POST">

                                  <input type="hidden" name="brand">
                                  <input type="hidden" name="token">
                                  <input type="hidden" name="senderHash">

                              <div class="row">
                                  <div class="col">
                                    <label for="cardNumber">Nº Cartão</label>
                                    <input type="text" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus value="4111 1111 1111 1111"/>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <label for="cardExpiry">Validade</label>
                                    <input type="tel" class="form-control" name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required value="12/2030"/>
                                  </div>
                                  <div class="col">
                                    <label for="cardCVC">CVV</label>
                                    <input type="tel" class="form-control" name="cardCVC" placeholder="CVV" autocomplete="cc-csc" required value="123"/>
                                  </div>
                                </div>
                                <div class="row">
                                      <div class="col mt-5">
                                          <button class="subscribe btn btn-success btn-lg btn-block" type="submit">Pagar</button>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>

                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script>

      $("button:submit").click(function(){
          var senderHash = PagSeguroDirectPayment.getSenderHash();
          $("input[name='senderHash']").val(senderHash);
      });

      jQuery(function($) {
        PagSeguroDirectPayment.setSessionId('');

        PagSeguroDirectPayment.getPaymentMethods({
          success: function(json){
              console.log(json);
          },
          error: function(json){
              console.log(json);
            var erro = "";
            for(i in json.errors){
              erro = erro + json.errors[i];
            }
            alert(erro);
          },
          complete: function(json){
          }
        });

        PagSeguroDirectPayment.getBrand({
          cardBin: $("input[name='cardNumber']").val().replace(/ /g,''),
          success: function(json){
            var brand = json.brand.name;

            $("input[name='brand']").val(brand);

            console.log(brand);

            var param = {
              cardNumber: $("input[name='cardNumber']").val().replace(/ /g,''),
              brand: brand,
              cvv: $("input[name='cardCVC']").val(),
              expirationMonth: $("input[name='cardExpiry']").val().split('/')[0],
              expirationYear: $("input[name='cardExpiry']").val().split('/')[1],
              success: function(json){
                var token = json.card.token;
                $("input[name='token']").val(token);
                console.log("Token: " + token);
              },
              error: function(json){
                  console.log(json);
              },
              complete:function(json){
              }
            }

            PagSeguroDirectPayment.createCardToken(param);
          },
          error: function(json){
            console.log(json);
          },
          complete: function(json){
          }
        });

      });

  </script>
@endsection

<style>
    .block{
        display: block;
    }
    .hidden{
        display: none;
    }
</style>
