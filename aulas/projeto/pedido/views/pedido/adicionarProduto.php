<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Adicionar produto';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("

$('#pedidoproduto-pepr_quantidade').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
        
$( '#pedidoproduto-pepr_quantidade' ).keyup(function() {

  var total = $( '#pedidoproduto-pepr_valor' ).val() * $( '#pedidoproduto-pepr_quantidade' ).val(); 
  
  $( '#pedidoproduto-pepr_total' ).val(total);
  
});        
        
        
", View::POS_END, 'my-options');

?>
<div class="pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>


<div class="pedido-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

     <?php
            $template = '<h6>{{label}}</h6>';

            echo $form->field($model, 'pepr_nome')->widget(Typeahead::classname(), [
                'name' => 'cliente',
                'options' => [
                    'placeholder' => '', 
                    'class' => 'form-control',
                ],
                'scrollable' => true,
                'dataset' => [
                    [
                        'remote' => [
                            'url' => Url::to(['/pedido/produto']) . '&q=%QUERY',
                            'wildcard' => '%QUERY',
                        ],
                        'limit' => 5,
                        'displayKey' => 'label',
                        'templates' => [
                            'empty' => '<h5>&nbsp;&nbsp;&nbsp;&nbsp; Produto não encontrado.</h5>',
                            'suggestion' => new JsExpression("Handlebars.compile('{$template}')"),
                        ]
                    ]
                ],
                'pluginOptions' => [
                    'highlight' => true,
                    'minLength' => 3,
                ],
                'pluginEvents' => [
                    'typeahead:selected' => "function(e, datum) { 

                        $( '#" . Html::getInputId($model, 'prod_codigo') . "' ).val(datum.produto.prod_codigo); 
                            
                        $( '#" . Html::getInputId($model, 'pepr_valor') . "' ).val(datum.produto.prod_valor);
                            
                        $( '#" . Html::getInputId($model, 'pepr_quantidade') . "' ).val(1);
                            
                        $( '#" . Html::getInputId($model, 'pepr_total') . "' ).val(datum.produto.prod_valor);
             

                    }",
                ]
            ]);
            ?>

            <?= HTML::activeHiddenInput($model, 'prod_codigo') ?>  
    
    <?= $form->field($model, 'pepr_valor')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    
    <?= $form->field($model, 'pepr_quantidade')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pepr_total')->textInput(['maxlength' => true, 'readonly' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>

