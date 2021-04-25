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


@foreach($categoria as $key =>$cat)
    <div class="site-section" id="{{ Illuminate\Support\Str::slug($key,'-')}}">
    <div class="container">
      <div class="row">
        <div class="title-section text-center col-12">
          <h2 class="text-uppercase">{{$key}}</h2>
        </div>
      </div>
            <div class="row">
                <div class="col-md-12 block-3 products-wrap">
                    <div class="nonloop-block-3 owl-carousel">

                        @foreach($cat as $produto)

                            <div class="text-center item">
                                <a href="@if($produto->description != '') produto/{{$produto->slug}} @else {{ '#' . Illuminate\Support\Str::slug($key,'-')}} @endif">
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
                                    <button class="btn btn-outline-secondary cart" type="submit">Add Carrinho</button>
                                </form>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        <div class="row mt-5">
        <div class="col-12 text-center">
          <a href="/categoria/{{ Illuminate\Support\Str::slug($key,'-')}}" class="btn btn-primary-2 px-4 py-3">Ver todos</a>
        </div>
      </div>
    </div>
  </div>

@endforeach



  <div class="site-section bg-secondary" style="margin: 0px;padding: 0px;background-color:#fff!important">
      <iframe width="100%" height="400" id="gmap_canvas" src="{{setting('site.mapa')}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
  </div>


@endsection
