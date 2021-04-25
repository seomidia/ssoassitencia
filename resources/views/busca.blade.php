@extends('layouts.app')

@section('content')
    <div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Buscar</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">{{$buscar}}</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
        @if(count($produtos) > 0)
            @foreach($produtos as $key => $produtos)
                    @foreach($produtos as $produto)
                    <div class="col-sm-6 col-lg-4 text-center item mb-4">
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
                            <button class="btn btn-outline-secondary" type="submit">Add Carrinho</button>
                        </form>
                    </div>
                    @endforeach
            @endforeach
            @else
               <h3>Nenhum produto foi encontrado para "{{$buscar}}".</h3>
            @endif
        </div>

    </div>
</div>
@endsection
