<div class="question" id="AVALIACAO-NUTRICIONAL">
    <div class="section-questions">
        <div class="section-title">
            <h3>AVALIAÇÃO NUTRICIONAL</h3>
        </div>
        <div class="tab1">

            <div class="pergunta">
                <p>Tem apetite regular? </p>
                @component('components.forms.radio',[
                        'name' => 'avaliacao_nutricional[tem-apetite-regular][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'tem-apetite-regular'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-tem-apetite-regular">
                    <div class="form-check form-check-inline">
                        <p>Quantas vezes por dia se alimenta?</p>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="number" class="form-check-input" min="1" name="avaliacao_nutricional['tem-apetite-regular'][]"> a
                        <input type="number" class="form-check-input" max="10" name="avaliacao_nutricional['tem-apetite-regular'][]">
                    </div>
                </div>

            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Alimentação é variada? (carnes legumes, verduras, frutas )?</p>
                @component('components.forms.radio',[
                        'name' => 'avaliacao_nutricional[alimentacao-e-variada]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'alimentacao-e-variada'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Você se sente bem com seu peso e altura? </p>
                @component('components.forms.radio',[
                        'name' => 'avaliacao_nutricional[voce-se-sente-bem-com-seu-peso-e-altura]',
                        'valor'=>['sim','nao'],
                        'slug'=>'voce-se-sente-bem-com-seu-peso-e-altura'
                        ])
                @endcomponent
            </div>
            <div style="clear: both">&nbsp;</div>
        </div>
    </div>
</div>
