<div class="question" id="MULHERS-QUESTIONARIO">
    <div class="section-questions">
        <div class="section-title">
            <h3>MULHERS - QUESTIONÁRIO</h3>
        </div>
        <div class="tab1">
            <div class="pergunta">
                <p>Tem filhos? </p>
                @component('components.forms.radio',[
                        'name' => 'mulher_questionario[tem-filhos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'tem-filhos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-tem-filhos">
                    <div class="form-check form-check-inline">
                        <input type="number" class="form-check-input" placeholder="Quantos?"  name="mulher_questionario['tem-filhos'][]">
                    </div>
                </div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Abortamentos?</p>
                @component('components.forms.radio',[
                        'name' => 'mulher_questionario[abortamentos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'abortamentos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-abortamentos">

                <div class="form-check form-check-inline">
                    <input type="number" class="form-check-input" placeholder="Quantos?"  name="mulher_questionario['abortamentos'][]">
                </div>

                </div>
            </div>
            <div class="line">&nbsp;</div>
            <div class="pergunta">
                <p>Faz exames ginecológicos?</p>
                @component('components.forms.radio',[
                        'name' => 'mulher_questionario[faz-exames-ginecologicos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'faz-exames-ginecologicos'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Usa contraceptivo? </p>
                @component('components.forms.radio',[
                        'name' => 'mulher_questionario[usa-contraceptivo][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'usa-contraceptivo'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Data da última menstruação</p>
                <div class="form-check form-check-inline">
                    <input type="date" class="form-control" name="mulher_questionario['data-da-ultima-menstruacao']" value="sim">
                </div>
            </div>
        </div>
    </div>
</div>
