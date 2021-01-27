@extends('layouts.app')

@section('content')


<div class="site-blocks-cover" style="background-image: url('images/home/slide-1.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
          <div class="site-block-cover-content text-center">
            {{-- <h2 class="sub-title">Segurança e saúde Ocupacional</h2>
            <h1>SSO</h1> --}}
           <p>
              <a href="#" class="btn btn-primary-2 px-5 py-3">Agende seu exame</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="title-section text-center col-12">
          <h2 class="text-uppercase">Consultas</h2>
        </div>
      </div>

      <div class="row">
          @foreach($produtos as $produto)
              @if($produto->category_id == 3)
                <div class="col-sm-6 py-5 col-lg-4 text-center item mb-4">
                    @if($produto->sale)
                          <span class="tag">Promoção</span>
                    @endif
                  <a href="produto/{{$produto->slug}}">
                  <h3 class="text-dark">{{$produto->name}}</h3>
                  <p class="price">
                      @if($produto->sale == '')
                          R$ {{$produto->price}}
                      @else
                          <del>R$ {{$produto->price}}</del>
                          @endif
                      @if($produto->sale != '') &mdash; R$ {{$produto->sale}} @endif
                  </p>
                  </a>
                        <form action="/carrinho/add" name="{{$produto->slug}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$produto->id}}">
                          <button class="btn btn-outline-secondary" type="submit">Add Carrinho</button>
                        </form>
                </div>
              @endif
          @endforeach

      </div>
      <div class="row mt-5">
        <div class="col-12 text-center">
          <a href="#" class="btn btn-primary-2 px-4 py-3">Ver todas consultas</a>
        </div>
      </div>
    </div>
  </div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="title-section text-center col-12">
                <h2 class="text-uppercase">Exames</h2>
            </div>
        </div>

        <div class="row">
            @foreach($produtos as $produto)
                @if($produto->category_id == 4)
                    <div class="col-sm-6 py-5 col-lg-4 text-center item mb-4">
                        @if($produto->sale)
                            <span class="tag">Promoção</span>
                        @endif
                        <a href="produto/{{$produto->slug}}">
                            <h3 class="text-dark">{{$produto->name}}</h3>
                            <p class="price">
                                @if($produto->sale == '')
                                    R$ {{$produto->price}}
                                @else
                                    <del>R$ {{$produto->price}}</del>
                                    @endif
                                    @if($produto->sale != '') &mdash; R$ {{$produto->sale}} @endif
                            </p>
                        </a>
                        <form action="/carrinho/add" name="{{$produto->slug}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$produto->id}}">
                            <button class="btn btn-outline-secondary" type="submit">Add Carrinho</button>
                        </form>
                    </div>
                @endif
            @endforeach

        </div>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <a href="#" class="btn btn-primary-2 px-4 py-3">Ver todos exames</a>
            </div>
        </div>
    </div>
</div>



  <div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="title-section text-center col-12">
          <h2 class="text-uppercase">Serviços destaque</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 block-3 products-wrap">
          <div class="nonloop-block-3 owl-carousel">

              @foreach($produtos as $produto)

                  <div class=" py-5  text-center item mb-4">
                      <a href="produto/{{$produto->slug}}">
                            <h3 class="text-dark">{{$produto->name}}</h3>
                          <p class="price">
                              @if($produto->sale == '')
                                  R$ {{$produto->price}}
                              @else
                                  <del>R$ {{$produto->price}}</del>
                                  @endif
                                  @if($produto->sale != '') &mdash; R$ {{$produto->sale}} @endif
                          </p>
                            </a>
                      <form action="/carrinho/add" name="{{$produto->slug}}" method="post">
                          @csrf
                          <input type="hidden" name="product_id" value="{{$produto->id}}">
                          <button class="btn btn-outline-secondary" type="submit">Add Carrinho</button>
                      </form>
                </div>

              @endforeach

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
