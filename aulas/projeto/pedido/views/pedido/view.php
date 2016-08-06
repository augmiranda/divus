<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\widgets\Alert;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = $model->pedi_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$js = <<< 'SCRIPT'
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>

<?= Alert::widget() ?>


<div class="pedido-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>
    
    <p>
        <?= Html::submitButton('Alterar', ['class' => 'btn btn-primary btn-xs']) ?>
    </p>

    <?php
            $template = '<h6>{{label}}</h6>';

            echo $form->field($model, 'clien_nome')->widget(Typeahead::classname(), [
                'name' => 'cliente',
                'options' => [
                    'placeholder' => '', 
                    'class' => 'form-control',
                ],
                'scrollable' => true,
                'dataset' => [
                    [
                        'remote' => [
                            'url' => Url::to(['/pedido/cliente']) . '&q=%QUERY',
                            'wildcard' => '%QUERY',
                        ],
                        'limit' => 5,
                        'displayKey' => 'label',
                        'templates' => [
                            'empty' => '<h5>&nbsp;&nbsp;&nbsp;&nbsp; Cliente não encontrado.</h5>',
                            'suggestion' => new JsExpression("Handlebars.compile('{$template}')"),
                        ]
                    ]
                ],
                'pluginOptions' => [
                    'highlight' => true,
                    'minLength' => 1,
                ],
                'pluginEvents' => [
                    'typeahead:selected' => "function(e, datum) { 

                        $( '#" . Html::getInputId($model, 'clien_codigo') . "' ).val(datum.value); 
             

                    }",
                ]
            ]);
            ?>
    
    <?= HTML::activeHiddenInput($model, 'clien_codigo') ?> 
    
    <?php

        $rows = \app\models\FormaPagamento::find()->all();
        
        $data = ArrayHelper::map($rows, 'fopa_codigo', 'fopa_nome');
        
        echo $form->field($model, 'fopa_codigo')->dropDownList(
            $data,
            ['prompt'=>'Selecione uma forma de pagamento']
        );    
    ?>


    <?php ActiveForm::end(); ?>
    
    <h1>Produtos</h1>
     <p>
        <?= Html::a('Adicionar produto', ['adicionar-produto', 'id'=>$model->pedi_codigo], ['class' => 'btn btn-success btn-xs']) ?>
    </p>
    
     <table class="table table-hover"> 
         <thead> 
             <tr> 
                 <th>Código</th>
                 <th>Nome</th> 
                 <th>Quantidade</th> 
                 <th>Valor unitário</th> 
                 <th>Total</th> 
                 <th></th> 
             </tr> 
         </thead> 
         <tbody> 
             
                <?php
                    $totalGeral = 0;
                    
                    foreach($model->produtos as $produto):
                        $total = $produto->pepr_quantidade * $produto->pepr_valor;
                        $totalGeral += $total; 
                ?>
             
                <tr> 
                    <th scope=row><?= $produto->prod_codigo ?></th> 
                    <td><?= $produto->pepr_nome ?></td> 
                    <td><?= $produto->pepr_quantidade ?></td> 
                    <td><?= Yii::$app->formatter->asDecimal($produto->pepr_valor) ?></td> 
                    <td><?= Yii::$app->formatter->asDecimal($total) ?></td> 
                    <td>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['produto-update', 'id' => $produto->pepr_codigo], 
                                ['class' => 'btn btn-info btn-xs', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Alterar']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', ['produto-delete', 'id' => $produto->pepr_codigo], 
                                ['class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Deletar']) ?>
                    </td> 
                </tr> 
             
                <?php
                    endforeach;
                ?>
                
                <tr> 
                    <td colspan="4" style="text-align:right;font-weight:bold;"> Total:</td> 
                    <td><?= Yii::$app->formatter->asDecimal($totalGeral) ?></td> 
                    <td></td> 
                </tr> 

         
        </tbody>
     </table>

</div>
