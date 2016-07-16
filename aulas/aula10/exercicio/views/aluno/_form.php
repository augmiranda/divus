<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\helpers\Url;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => false]); ?>

    <?= $form->field($model, 'alun_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alun_matricula')->textInput(['maxlength' => true]) ?>
    
    <?=  $form->field($model, 'alun_data_nascimento')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Selecione a data de nascimento ...'],
        'language' => 'pt-BR',
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd/mm/yyyy'
        ]
    ]);?>
    
    <?= $form->field($model, 'esta_codigo')->dropDownList(
	$estados, 
        [
            'prompt'=>'Selecione um estado',
            'onchange'=>'
                $.get( "'.Url::toRoute('/aluno/municipio').'", { id: $(this).val() } )
                    .done(function( data ) {
                        $( "#'.Html::getInputId($model, 'muni_codigo').'" ).html( data );
                    }
                );
            ' 
        ]
    );?>
    
    <?= $form->field($model, 'muni_codigo')->dropDownList(
        ['prompt'=>'Selecione um estado']
    );?>
    
    <?= $form->field($model, 'alun_habilitado')->checkbox() ?>

    <?= $form->field($model, 'alun_observacao')->textarea(['rows' => 6]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
