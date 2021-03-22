<div class="question" id="HOMENS-QUESTIONARIO">
    <div class="section-questions">
        <div class="section-title">
            <h3>HOMENS - QUESTIONÁRIO</h3>
        </div>
        <div class="tab1">
            <div class="pergunta">
                <p>Tem filhos? </p>
                @component('components.forms.radio',[
                        'name' => 'question[homem_questionario][tem-filhos][]',
                        'valor'=>['sim','nao'],
                        'slug'=>'tem-filhos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="reply" id="reply-tem-filhos">
                    <div class="form-check form-check-inline">
                        <input type="number" class="form-check-input" placeholder="Quantos?"  name="question[homem_questionario][tem-filhos][]">
                    </div>
                </div>
            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>É vasectomizado?</p>
                @component('components.forms.radio',[
                        'name' => 'question[homem_questionario][vasectomizado]',
                        'valor'=>['sim','nao'],
                        'slug'=>'vasectomizado'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Passa por consulta urologica?</p>
                @component('components.forms.radio',[
                        'name' => 'question[homem_questionario][passa-por-consulta-urologica]',
                        'valor'=>['sim','nao'],
                        'slug'=>'passa-por-consulta-urologica'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Já fez exame de prostata? </p>
                @component('components.forms.radio',[
                        'name' => 'question[homem_questionario][ja-fez-exame-de-prostata]',
                        'valor'=>['sim','nao'],
                        'slug'=>'ja-fez-exame-de-prostata'
                        ])
                @endcomponent
            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Câncer de próstata (pai, irmãos)</p>
                @component('components.forms.radio',[
                        'name' => 'question[homem_questionario][cancer-de-prostata]',
                        'valor'=>['sim','nao'],
                        'slug'=>'cancer-de-prostata'
                        ])
                @endcomponent
            </div>
            <div style="clear:both;">&nbsp;</div>
        </div>
    </div>
</div>
