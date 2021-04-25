@extends('layouts.app')

@section('content')
@foreach($produtos as $key => $produtos)
    <div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{$key}}</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">


        <div class="row">
            @foreach($produtos as $produto)
            <div class="col-sm-6 col-lg-4 text-center item mb-4">
                <a href="@if($produto->description != '') produto/{{$produto->slug}} @else {{'#'.str_replace(' ','-',$key)}} @endif">
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
@endforeach
{{--        <div class="row mt-5">--}}
{{--            <div class="col-md-12 text-center">--}}
{{--                <div class="site-block-27">--}}
{{--                    <ul>--}}
{{--                        <li><a href="#">&lt;</a></li>--}}
{{--                        <li class="active"><span>1</span></li>--}}
{{--                        <li><a href="#">2</a></li>--}}
{{--                        <li><a href="#">3</a></li>--}}
{{--                        <li><a href="#">4</a></li>--}}
{{--                        <li><a href="#">5</a></li>--}}
{{--                        <li><a href="#">&gt;</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
