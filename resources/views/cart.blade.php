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
      <div class="row mb-5">
          <div class="site-blocks-table col-md-12">
                      <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="product-name">Exame</th>
                          <th class="product-price">Valor</th>
                          <th class="product-quantity">QTD</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($produtos) > 0)

                      @foreach($produtos as $produto)
                        <tr>
                          <td class="product-thumbnail">
                              {{$produto->name}}
                          </td>
                          <td>
                              @if($produto->sale == '')
                                  R$ {{$produto->price}}
                              @else
                                  <del>R$ {{$produto->price}}</del>
                                  @endif
                                  @if($produto->sale != '') &mdash; R$ {{$produto->sale}} @endif

                          </td>
                          <td>
                              <form action="/carrinho-update/{{$produto->id}}" name="update-qtd" type="post">
                                  @csrf

                                  <div class="input-group mb-3" style="max-width: 120px;margin: 0 auto;">

                                      <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary js-btn-minus updateqtd" type="submit">&minus;</button>
                                      </div>

                                      <input type="text" class="form-control text-center" name="cart_qtd" value="{{$produto->qtd}}" placeholder=""
                                        aria-label="Example text with button addon" aria-describedby="button-addon1">

                                      <div class="input-group-append">
                                        <button  class="btn btn-outline-primary js-btn-plus updateqtd" type="submit">&plus;</button>
                                      </div>
                                    </div>
                                  <button type="submit" style="display: none" class="update-card">envia</button>

                              </form>

                          </td>
                            <td>
                                @if($produto->sale == '')
                                    R$ {{$produto->price * $produto->qtd}}
                                @else
                                    R$ {{$produto->sale * $produto->qtd}}
                                    @endif

                            </td>
                          <td><a href="/carrinho-delete/{{$produto->id}}" class="btn btn-primary height-auto btn-sm">X</a></td>
                        </tr>
                      @endforeach

                      @else
                          <tr>
                              <td colspan="5">
                                  Carrinho vazio <a href="{{url('/')}}">volte para loja!</a>
                              </td>
                          </tr>
                      @endif
                      </tbody>
                    </table>
          </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <button id="cart-update" class="btn btn-primary btn-md btn-block">Atualizar carrinho</button>
            </div>
            <div class="col-md-6">
              <a href="{{url('/')}}" class="btn btn-outline-primary btn-md btn-block">Continuar comprando</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="coupon">Cupom</label>
              <p>Entre com o codigo.</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="text" class="form-control py-3" id="coupon" placeholder="Codigo do cupom">
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary btn-md px-4">Aplicar</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Total da compra</h3>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <span class="text-black">Subtotal</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">R$ {{$subtotal}}</strong>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6">
                  <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                  <strong class="text-black">R$ {{$total}}</strong>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary btn-lg btn-block" onclick="window.location='/checkout'">Finalizar compra</button>
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

@endsection
