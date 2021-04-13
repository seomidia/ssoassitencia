<div class="question" id="ANTECEDENTES-PESSOAIS">
    <div class="section-questions">
        <div class="section-title">
            <h3>ANTECEDENTES PESSOAIS</h3>
        </div>
        <div class="tab1">

            <div class="pergunta">
                <p>Tonturas, dores de cabeça, convulsões? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][tonturas-dores-de-cabeca-convulsoes][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'tonturas-dores-de-cabeca-convulsoes'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][tonturas-dores-de-cabeca-convulsoes][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Perda de visão, miopia, hipermetropia, astigmatismos?</p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][perda-de-visao-miopia-hipermetropia-astigmatismos][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'perda-de-visao-miopia-hipermetropia-astigmatismos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][perda-de-visao-miopia-hipermetropia-astigmatismos][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Perda de audição, otite, zumbido, rebaixamento auditivo? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][perda-de-audicao-otite-zumbido-rebaixamento-auditivo][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'perda-de-audicao-otite-zumbido-rebaixamento-auditivo'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][perda-de-audicao-otite-zumbido-rebaixamento-auditivo][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Resfriados, bronquite, asma, sinusite, rinite?</p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][resfriados-bronquite-asma-sinusite-rinite][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'resfriados-bronquite-asma-sinusite-rinite'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][resfriados-bronquite-asma-sinusite-rinite][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Dores nos ombros e punhos? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][dores-nos-ombros-e-punhos][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'dores-nos-ombros-e-punhos'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][dores-nos-ombros-e-punhos][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças de coração, infartos, pressão alta? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-de-coracao-infartos-pressao-alta][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-de-coracao-infartos-pressao-alta'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-de-coracao-infartos-pressao-alta][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Dores nas costas, coluna, hérnia de disco? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][dores-nas-costas-coluna-hernia-de-disco][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'dores-nas-costas-coluna-hernia-de-disco'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][dores-nas-costas-coluna-hernia-de-disco][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Sofreu alguma fratura óssea? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][sofreu-alguma-fratura-ossea][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'sofreu-alguma-fratura-ossea'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][sofreu-alguma-fratura-ossea][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças do estomago, úlcera, gastrite? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-do-estomago-ulcera-gastrite][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-do-estomago-ulcera-gastrite'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-do-estomago-ulcera-gastrite][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças do fígado, hepatite, cirrose? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-do-figado-hepatite-cirrose][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-do-figado-hepatite-cirrose'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-do-figado-hepatite-cirrose][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças dos rins, nefrite, infecção urinária? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-dos-rins-nefrite-infeccao-urinaria][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-dos-rins-nefrite-infeccao-urinaria'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-dos-rins-nefrite-infeccao-urinaria][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças de pele, urticárias eczemas? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-de-pele-urticarias-eczemas][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-de-pele-urticarias-eczemas'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-de-pele-urticarias-eczemas][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Reumatismos, dores nas juntas? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][reumatismos-dores-nas-juntas][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'reumatismos-dores-nas-juntas'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][reumatismos-dores-nas-juntas][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Diabetes? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][diabetes-antecedente_pessoais][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'diabetes-antecedente_pessoais'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][diabetes-antecedente_pessoais][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças psiquiátricas? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-psiquiatricas][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-psiquiatricas'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-psiquiatricas][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Já esteve internado? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][ja-esteve-internado][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'ja-esteve-internado'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][ja-esteve-internado][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Submetido à cirurgia? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][submetido-a-cirurgia][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'submetido-a-cirurgia'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][submetido-a-cirurgia][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div class="line" style="clear:both;">&nbsp;</div>
            <div class="pergunta">
                <p>Doenças vasculares, varizes/hemorroidas? </p>
                @component('components.forms.radio',[
                        'name' => 'question[antecedente_pessoais][doencas-vasculares-varizeshemorroidas][]',
                        'valor'=>['tenho','nao tenho'],
                        'slug'=>'doencas-vasculares-varizeshemorroidas'
                        ])
                @endcomponent
                <div style="clear: both"></div>
                <div class="form-check form-check-inline">
                    <input type="text" class="form-control" placeholder="Descreva se for necessario" name="question[antecedente_pessoais][doencas-vasculares-varizeshemorroidas][]">
                </div>
                <div style="clear: both"></div>

            </div>
            <div style="clear:both;">&nbsp;</div>
        </div>
    </div>
</div>
