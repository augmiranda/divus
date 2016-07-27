<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2; 
use yii\web\JsExpression;
use app\models\Municipio;

$cityDesc = empty($model->muni_codigo) ? '' : $model->municipio->muni_nome . ' - ' . $model->municipio->estado->esta_nome;

?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'clien_nome')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'clien_tipo')->dropDownList([1 => 'Física', 2 => 'Jurídica']) ?>

    <?= $form->field($model, 'clien_cpf_cnpj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clien_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'muni_codigo')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Pesquise o município ...'],
        'initValueText' => $cityDesc,
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'ajax' => [
                'url' => \yii\helpers\Url::to(['municipio']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(city) { return city.text; }'),
            'templateSelection' => new JsExpression('function (city) { return city.text; }'),
        ],
    ]);
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
