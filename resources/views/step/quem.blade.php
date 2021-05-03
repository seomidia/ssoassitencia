<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(Auth::check())
            <p class="alert alert-success" style="padding: 0.75rem 1.25rem!important"><small>Autenticado com sucesso.</small></p>
                @else
                <p class="alert alert-success" id="login-sucesso" style="padding: 0.75rem 1.25rem!important; display: none"><small>Autenticado com sucesso.</small></p>

                <form name="login-assiante" id="login-assinante" method="post" action="">
                    @csrf
                        <div class="form-group">
                            <label>Usuario</label>
                            <input class="form-control" type="text" name="email">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <p class="alert alert-danger" style="display: none" id="message"></p>
                        <button type="submit" class="btn btn-secondary">Logar</button>
                    </form>
                @endif
        </div>
    </div>
</div>


