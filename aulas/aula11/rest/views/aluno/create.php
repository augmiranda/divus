<?php

use yii\helpers\Html;
use Yii;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = 'Create Aluno';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'estados' => $estados
    ]) ?>

</div>


<?php
//
//$password = "123456";
//echo Yii::$app->getSecurity()->generatePasswordHash($password) . "<br>";
//echo Yii::$app->getSecurity()->generatePasswordHash($password) . "<br>";
//echo Yii::$app->getSecurity()->generatePasswordHash($password) . "<br>";
//
//$hash = Yii::$app->getSecurity()->generatePasswordHash($password);
//
//if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
//    echo "senha e valida";
//}

?>
