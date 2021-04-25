@extends('layouts.app')

@section('content')

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="/">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Contato</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 mb-5 text-black">Contato</h2>
                </div>
                <div class="col-md-12">

                    <form action="/contato" method="post">
                            @csrf
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">Nome <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_fname" name="nome">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_lname" class="text-black">Sobrenome <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="c_lname" name="sobrenome">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email" class="text-black">E-mail <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="c_email" name="email" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_subject" class="text-black">Assunto </label>
                                    <input type="text" class="form-control" id="c_subject" name="assunto">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_message" class="text-black">Mensagem </label>
                                    <textarea name="mensagem" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Enviar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <div class="site-section">
        <iframe width="100%" height="400" id="gmap_canvas" src="{{setting('site.mapa')}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>
@endsection
