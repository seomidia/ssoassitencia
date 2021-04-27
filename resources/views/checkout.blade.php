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
                  <label for="quem" class="text-black">Você é? <span class="text-danger">*</span></label><br>
                    <input type="radio" name="cliente" value="cliente"> Avulso
                    <input type="radio" name="cliente" value="rh"> Rh
                    <input type="radio" name="cliente" value="empresa"> Empresa
                </div>
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Primeiro nome <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="nome" value="{{ $nome ?? '' }}">
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
                          <td>
                              R$ {{$produto->price}}
                              <input type="hidden" name="prod[]" value="{{$produto->id}}">
                          </td>
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
                      <article class="card">
                          <div class="card-body">
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
