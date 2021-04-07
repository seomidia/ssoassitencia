<div class="page-content">
    <div class="analytics-container">
        <form method="get" action="{{Route('voyager.busca')}}" style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <ul class="payment-methods">
                            <li class="payment-method checked-nome">
                                <input name="filter" type="radio" id="checked-nome" value="nome" style="display: none" checked>
                                <label for="checked-nome">Nome</label>
                            </li>

                            <li class="payment-method checked-cpf">
                                <input name="filter" type="radio" id="checked-cpf" value="cpf" style="display: none">
                                <label for="checked-cpf">CPF</label>
                            </li>

                        </ul>

                    </div>
                </div>
                <div class="col-md-10">
                    <input style="height: 50px;font-size: 33px;font-weight: bold;" class="form-control mb-5" id="buscar" name="buscar" type="text" class="ui-autocomplete-input" autocomplete="off" placeholder="Buscar Nome do Paciente CPF" >
                </div>
                <div class="col-md-1">
                    <button style="margin-top: 0px;font-size: 22px;font-weight: bold;" type="submit" class="btn btn-success" style="margin-top: 0px;">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    @if(isset($paciente))
        <div class="page-content">
            <div class="analytics-container" style="padding: 0px 25px 25px;">
                <div class="col-md-12" style="border-radius:4px; padding:20px; background:#fff; margin:0; color:#999">
                    <p>{{count($paciente)}} resultados foram encontrados.</p>
                    <table class="table">
                        @if(count($paciente) > 0)
                            @foreach($paciente as $key => $item)
                                <tr>
                                    <td><img style="border-radius: 50%;" src="{{asset('storage/' . Auth::user()->avatar)}}" width="100"></td>
                                    <td style="font-size: 20px;font-weight: 600;vertical-align: middle;">{{$item->name}} </td>
                                    <td style="font-size: 20px;font-weight: 600;vertical-align: middle;">{{$item->cpf}}</td>
                                    <td class="anamnese" style="background: #22a7f0"><a href="{{$item->id}}" style="text-decoration: none;"><div id="anamnese-{{$item->id}}" style="font-size: 51px;color: #fff;text-align: center;" class="voyager-angle-right"></div></a> </td>
                                </tr>
                                <tr class="anamnese anamnese-{{$item->id}}" style="display: none">
                                    <td colspan="6" style="background: #f2f2f2;">
                                        <table class="table" style="border: 1px solid #dddddd">
                                            <tr style="background: #22a7f0;color: #ffffff;font-weight: 600">
                                                <td>Empresa</td>
                                                <td>CNPJ</td>
                                                <td>Status</td>
                                                <td>Condição</td>
                                                <td>Data</td>
                                                <td>Ação</td>
                                            </tr>

                                            @foreach(App\Http\Controllers\AnamineseController::get_anamnese($filtro,$item->id) as $key2 => $amnesis)

                                                <tr>
                                                    <td>{{$amnesis->nome}}</td>
                                                    <td>{{$amnesis->cnpj}}</td>
                                                    <td>
                                                        <div  class="
                                                        @if($amnesis->step == 'step_rh')
                                                            alert-danger
                                                        @endif
                                                        @if($amnesis->step == 'step_funci')
                                                            alert-success
                                                        @endif
                                                        @if($amnesis->step == 'step_med')
                                                            alert-primary
                                                        @endif
                                                        @if($amnesis->step == 'step_complementar')
                                                            alert-primary
                                                        @endif
                                                            " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;">
                                                            @if($amnesis->step == 'step_rh')
                                                                Não iniciado
                                                            @endif
                                                            @if($amnesis->step == 'step_funci')
                                                                Funcionario
                                                            @endif
                                                            @if($amnesis->step == 'step_med')
                                                                Medico
                                                            @endif
                                                            @if($amnesis->step == 'step_complementar')
                                                                Exames Complementares
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div  class="
                                        @if(!is_null($amnesis->apt))
                                                        @if(in_array($amnesis->apt,[0,'-1','-2','-3']))
                                                            alert-danger
                                                        @endif
                                                        @if(in_array($amnesis->apt,[1,2,3]))
                                                            alert-success
                                                        @endif
                                                        @else
                                                            alert-primary
                                                        @endif
                                                            " style="padding: 3px;font-weight: bold;font-size: 13px;margin-top: 6px;text-align: center">
                                                            @if(!is_null($amnesis->apt))
                                                                @if(in_array($amnesis->apt,[1,2,3]))
                                                                    Apto
                                                                @endif
                                                                @if(in_array($amnesis->apt,[0,'-1','-2','-3']))
                                                                    Não Apto
                                                                @endif
                                                            @else
                                                                Não avaliado
                                                            @endif
                                                        </div>

                                                    </td>
                                                    <td>{{date('d/m/Y', strtotime($amnesis->created_at))}}</td>
                                                    <td><a id="detalhe" href="{{$amnesis->id}}" style="text-decoration: none;"><div class="voyager-search"></div> </a> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @include('partials.medico.modal')
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center">Não existe resultados para esta busca.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="modal modal-primary fade" tabindex="-1" id="complementares_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-activity"></i> {{ __('Existe exames complementares?') }}?</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="#" name="complementares" method="POST">

                            <input type="submit" class="btn pull-right delete-confirm" value="{{ __('Sim') }}">
                        </form>
                        <button type="button" class="btn btn-default btn-danger pull-right" data-dismiss="modal">{{ __('Não') }}</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    @endif

    @section('javascript')
        <script>
            $(document).ready(function($){
                $('a#detalhe').click(function(event){
                    event.preventDefault();
                    var href = $(this).attr('href');
                    $('#ficha-' + href).modal('show')
                });

                $('td.anamnese a').on('click',function(event){
                    event.preventDefault();
                    var href = $(this).attr('href');

                    switch (this.lastChild.className) {
                        case('voyager-angle-right'):
                            $('#anamnese-' + href).removeClass('voyager-angle-right');
                            $('#anamnese-' + href).addClass('voyager-angle-down');
                            break
                        case('voyager-angle-down'):
                            $('#anamnese-' + href).removeClass('voyager-angle-down');
                            $('#anamnese-' + href).addClass('voyager-angle-right');
                            break
                    }

                    $('.anamnese-' + href).toggle();
                });
                $('form[name="form-medico"]').submit(function(event){
                    event.preventDefault();

                    var url = $(this).attr('action');

                    $.post(url,$(this).serializeArray(), function (response) {
                        if(response.success){
                            var anamnese_id = window.location.origin + '/admin/complementar/' + response.anamnese_id;

                            // fecha ficha
                            $('.modal').modal('hide');
                            // abre dialogo
                            $('form[name="complementares"]').attr('action',anamnese_id);
                            $('#complementares_modal').modal('show');

                        }
                    }).fail(function (jqXHR, textStatus) {
                        toastr.error(jqXHR.responseJSON.message);
                    })

                });

                $('form[name="complementares"]').submit(function(event){
                    event.preventDefault();

                    var url = $(this).attr('action');

                    $.post(url,$(this).serializeArray(), function (response) {
                        toastr.success(response.message);
                        $('.modal').modal('hide');
                        setTimeout(function () {
                            window.location.href = 'buscar?filter=<?php if (isset($_GET['filter'])) echo $_GET['filter'];?>&buscar=<?php if (isset($_GET['buscar'])) echo $_GET['buscar']?>'
                        }, 2000);
                    });
                });

            })
        </script>
@stop
