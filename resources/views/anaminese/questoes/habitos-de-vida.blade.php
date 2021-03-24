<div class="question" id="HABITOS-DE-VIDA">
    <div class="section-questions">
        <div class="section-title">
            <h3>HÁBITOS DE VIDA</h3>
        </div>
        <div class="tab1">
            <div class="pergunta">
                <p>Prática atividade física? </p>
                @component('components.forms.radio',[
                    'name' => 'question[habitos_vida][pratica-atividade-fisica][]',
                    'valor'=>['sim','nao'],
                    'slug'=>'pratica-atividade-fisica'
                    ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-pratica-atividade-fisica">
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control" placeholder="Se Sim Qual?" name="question[habitos_vida][pratica-atividade-fisica][]">
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control" placeholder="Em qual frequencia?" name="question[habitos_vida][pratica-atividade-fisica][]">
                    </div>
                </div>
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Faz uso de bebida alcoólica?</p>
                @component('components.forms.radio',[
                    'name' => 'question[habitos_vida][faz-uso-de-bebida-alcoolica][]',
                    'valor'=>['sim','nao'],
                    'slug'=>'faz-uso-de-bebida-alcoolica'
                    ])
                @endcomponent
                <div style="clear: both"></div>

                <div class="reply" id="reply-faz-uso-de-bebida-alcoolica">
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-control" placeholder="Quantas vezes por semana?" name="question[habitos_vida][faz-uso-de-bebida-alcoolica][]">
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="line">&nbsp;</div>
            <div class="pergunta">
                <p>Fumante? </p>
                @component('components.forms.radio',[
                    'name' => 'question[habitos_vida][fumante][]',
                    'valor'=>['sim','nao'],
                    'slug'=>'fumante'
                    ])
                @endcomponent
                <div style="clear: both"></div>

                <div class="reply" id="reply-fumante">
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-check-input" placeholder="Quantas vezes por semana?" name="question[habitos_vida][fumante][]">
                    </div>
                </div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Usa ou usou drogas?</p>
                @component('components.forms.radio',[
                        'name' => 'question[habitos_vida][usa-o-usou-drogas][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'usa-o-usou-drogas'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-usa-o-usou-drogas">
                    <div class="form-check form-check-inline">
                        <input type="text" class="form-check-input" placeholder="Qual e em que frequência?" name="question[habitos_vida][usa-o-usou-drogas][]">
                    </div>
                </div>
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Tem vida sexualmente ativa? </p>
                @component('components.forms.radio',[
                        'name' => 'question[habitos_vida][tem-vida-sexualmente-ativa]',
                        'valor'=>['sim','nao'],
                        'slug'=>'tem-vida-sexualmente-ativa'
                        ])
                @endcomponent
            </div>
            <div style="clear: both">&nbsp;</div>
        </div>
    </div>
</div>
