<div class="question" id="ANTECEDENTES-FAMILIARES">
    <div class="section-questions">
        <div class="section-title">
            <h3>ANTECEDENTES FAMILIARES</h3>
        </div>
        <div class="tab1">
            <div class="pergunta">
                <p>Doenças do coração, infartos, pressão alta? </p>
                @component('components.forms.radio',[
                    'tipo'=>['checked','checked-off'],
                    'name' => 'antecedentes_familiares[doencas-do-coracao-infartos-pressao-alta]',
                    'valor'=>['sim','nao'],
                    'slug' => 'doencas-do-coracao-infartos-pressao-alta'
                    ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Derrame/AVC?</p>
                    @component('components.forms.radio',[
                        'tipo'=>['checked','checked-off'],
                        'name' => 'antecedentes_familiares[derrame-avc]',
                        'valor'=>['sim','nao'],
                        'slug'=>'derrame-avc'
                        ])
                    @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Câncer/Tumor?</p>
                @component('components.forms.radio',[
                    'name' => 'antecedentes_familiares[cancer-tumor]',
                    'valor'=>['sim','nao'],
                    'slug'=>'cancer-tumor'
                    ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Diabetes? </p>
                @component('components.forms.radio',[
                    'name' => 'antecedentes_familiares[diabetes]',
                    'valor'=>['sim','nao'],
                    'slug'=>'diabetes'
                    ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Colesterol alterado?</p>
                @component('components.forms.radio',[
                    'name' => 'antecedentes_familiares[colesterol-alterado]',
                    'valor'=>['sim','nao'],
                    'slug'=>'colesterol-alterado'
                    ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças psiquiátricas? </p>
                @component('components.forms.radio',[
                    'name' => 'antecedentes_familiares[doenças-psiquiatricas]',
                    'valor'=>['sim','nao'],
                    'slug'=>'doenças-psiquiatricas'
                    ])
                @endcomponent
            </div>
            <div class="line" style="clear: both">&nbsp;</div>
        </div>
    </div>
</div>
