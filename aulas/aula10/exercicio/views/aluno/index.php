<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlunoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alunos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aluno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'alun_codigo',
            'alun_nome',
            'alun_matricula',
            'alun_data_nascimento:date',
            'alun_habilitado:boolean',
            // 'alun_observacao:ntext',
            'muni_codigo:currency',
            [
                'attribute' => 'muni_codigo',
		'header' => 'Municipio',
                'value' => function ($data) {
                    return $data->municipio->muni_nome . 
                            " - " . $data->municipio->estado->esta_nome;
                },
            ],
            // 'alun_data_criacao',
            // 'alun_data_alteracao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


<?php

//foreach($estados as $estado){
//    echo $estado->esta_nome . "<br>";
//    
//    foreach($estado->municipios as $municipio){
//        echo " - " . $municipio->muni_nome . "<br>";
//    }
//}

?>