@extends('layouts.app')

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Obrigado pela compra</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="icon-check_circle display-3 text-success"></span>
                    <h2 class="display-3 text-black">Obrigado pela compra!</h2>
                    <p class="lead mb-5">Sua compra foi finalizada com sucesso.</p>
                            <p class="alert alert-warning">
                                Seu exame ou consulta estará disponivel após a confirmação de seu pagamento.
                            </p>
{{--                            <p>--}}
{{--                                Todos os exame ou consultas serão criados em abertos para que seja possivel o encaminhamento para terceiros se for o caso.--}}
{{--                            </p>--}}

                    <p>
                        <a href="/" class="btn btn-md height-auto px-4 py-3 btn-primary">Voltar aos site</a>
                        <a href="/admin/pedidos" class="btn btn-md height-auto px-4 py-3 btn-primary">Aréa do cliente</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
