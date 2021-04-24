@extends('layouts.app')

@section('content')

    @foreach($datapage as $key => $value)
        <div class="site-blocks-cover inner-page" style="background-image: url({{url('/storage')}}/{{$value->image}});">
            <div class="container">
              <div class="row">
                <div class="col-lg-7 mx-auto align-self-center">
                  <div class=" text-center">
                      @if($value->status_title == 1)
                            <h1>{{$value->title}}</h1>
                            <p>{{$value->excerpt}}</p>
                          @endif
                  </div>
                </div>
              </div>
            </div>
      </div>
      <div class="site-section bg-light custom-border-bottom"  style="text-align:justify" data-aos="fade">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-12">
                @if($value->linkvideo != '')
                      <div style="float: left;margin: 15px" class="block-16">
                        <figure>
                          <img src="{{$value->imgvideo}}" alt="Image placeholder" class="img-fluid rounded">
                          <a href="{{$value->linkvideo}}" class="play-button popup-youtube"><span
                              class="icon-play"></span></a>

                        </figure>
                      </div>
                @endif
                {!! $value->body!!}

            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection
