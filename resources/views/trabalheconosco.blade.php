@extends('layouts.app')

@section('content')

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="/">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Trabalhe conosco</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 mb-5 text-black">Trabalhe conosco</h2>
                </div>
                <div class="col-md-12">

                    <form action="/trabalhe-conosco" method="post" enctype="multipart/form-data">
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
                                <div class="col-md-6">
                                    <label for="c_email" class="text-black">E-mail <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="c_email" name="email" placeholder="">
                                </div>
                                <div class="col-md-6">
                                    <label for="c_email" class="text-black">Telefone <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="c_tel" name="tel" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_subject" class="text-black">Curriculo (*PDF) </label>
                                    <input type="FILE" class="form-control" id="c_subject" name="arquivo">
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
    </div>
@endsection
