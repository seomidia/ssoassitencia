<div class="question" id="MULHERS-QUESTIONARIO">
    <div class="section-questions">
        <div class="section-title">
            <h3>MULHERS - QUESTIONÁRIO</h3>
        </div>
        <div class="tab1">
            <div class="pergunta">
                <p>Tem filhos? </p>
                @component('components.forms.radio',[
                        'name' => 'question[mulher_questionario][tem-filhos-mulher][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'tem-filhos-mulher'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-tem-filhos-mulher">
                    <div class="form-check form-check-inline">
                        <input type="number" class="form-check-input" placeholder="Quantos?"  name="question[mulher_questionario][tem-filhos-mulher][]">
                    </div>
                </div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Abortamentos?</p>
                @component('components.forms.radio',[
                        'name' => 'question[mulher_questionario][abortamentos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'abortamentos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-abortamentos">

                <div class="form-check form-check-inline">
                    <input type="number" class="form-check-input" placeholder="Quantos?"  name="question[mulher_questionario][abortamentos][]">
                </div>

                </div>
            </div>
            <div class="line">&nbsp;</div>
            <div class="pergunta">
                <p>Faz exames ginecológicos?</p>
                @component('components.forms.radio',[
                        'name' => 'question[mulher_questionario][faz-exames-ginecologicos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'faz-exames-ginecologicos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[mulher_questionario][faz-exames-ginecologicos][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Usa contraceptivo? </p>
                @component('components.forms.radio',[
                        'name' => 'question[mulher_questionario][usa-contraceptivo][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'usa-contraceptivo'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[mulher_questionario][usa-contraceptivo][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Data da última menstruação</p>
                <div class="form-check form-check-inline">
                    <input type="date" class="form-control" name="question[mulher_questionario][data-da-ultima-menstruacao][]" value="sim">
                </div>
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[mulher_questionario][data-da-ultima-menstruacao][]">
                </div>
                <div style="clear: both"></div>

            </div>
        </div>
    </div>
</div>
