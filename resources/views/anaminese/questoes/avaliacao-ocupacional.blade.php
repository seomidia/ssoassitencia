<div class="question" id="AVALIACAO-OCUPACIONAL">
    <div class="section-questions">
        <div class="section-title">
            <h3>AVALIAÇÃO OCUPACIONAL</h3>
        </div>
        <div class="tab1">

            <div class="pergunta">
                <p>Já sofreu algum acidente do trabalho? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][ja-sofreu-algum-acidente-do-trabalho][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'ja-sofreu-algum-acidente-do-trabalho'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][ja-sofreu-algum-acidente-do-trabalho][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Já teve alguma doença do trabalho?</p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][ja-teve-alguma-doenca-do-trabalho][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'ja-teve-alguma-doenca-do-trabalho'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][ja-teve-alguma-doenca-do-trabalho][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Apresentou algum afastamento acima de 15 dias? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][apresentou-algum-afastamento-acima-de-15-dias][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'apresentou-algum-afastamento-acima-de-15-dias'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][apresentou-algum-afastamento-acima-de-15-dias][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Já esteve afastado pelo INSS? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][ja-esteve-afastado-pelo-inss][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'ja-esteve-afastado-pelo-inss'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][ja-esteve-afastado-pelo-inss][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Exerce outras atividade em outras empresas além desta? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][exerce-outras-atividade-em-outras-empresas-alem-desta][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'exerce-outras-atividade-em-outras-empresas-alem-desta'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][exerce-outras-atividade-em-outras-empresas-alem-desta][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Já utilizou EPI? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][ja-utilizou-epi][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'ja-utilizou-epi'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][ja-utilizou-epi][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Sua condição de saúde atual exige ambiente de trabalho especial? </p>
                @component('components.forms.radio',[
                        'name' => 'question[avaliacao_ocupacional][sua-condicao-de-saude-atual-exige-ambiente-de-trabalho-especial][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'sua-condicao-de-saude-atual-exige-ambiente-de-trabalho-especial'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[avaliacao_ocupacional][sua-condicao-de-saude-atual-exige-ambiente-de-trabalho-especial][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>

        </div>
    </div>
</div>
