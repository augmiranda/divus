<?php

namespace app\controllers;

use Yii;
use app\models\Aluno;
use app\models\AlunoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Estado;
use yii\helpers\ArrayHelper;
use mPDF;
/**
 * AlunoController implements the CRUD actions for Aluno model.
 */
class AlunoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionPdf(){        
            $this->layout = 'main-pdf'; // Criar este layout
            $html =  $this->render('pdf'); // Criar esta view
            $mpdf = new \mPDF(); 
            $mpdf->WriteHTML($html);
            $mpdf->Output();
    }
    
    public function actionAlunosPdf(){        
            
            $this->layout = 'main-pdf';
            
            $alunos = Aluno::find()->all();
                   
            
            $html =  $this->render('alunos-pdf', ['alunos' => $alunos]); 
            $mpdf = new \mPDF(); 
            $mpdf->WriteHTML($html);
            $mpdf->Output();
    }

    /**
     * Lists all Aluno models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlunoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $estados = \app\models\Estado::find()->all();
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'estados' => $estados,
        ]);
    }

    /**
     * Displays a single Aluno model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aluno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aluno();
        
        $rows = Estado::find()->all();

        $estados = ArrayHelper::map($rows, 'esta_codigo', 'esta_nome');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->alun_codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'estados' => $estados
            ]);
        }
    }
    
    public function actionMunicipio($id){
        
        $rows = \app\models\Municipio::find()->where(['esta_codigo' => $id])->all();

        echo "<option>Selecione um municipio</option>";
        
        if(count($rows)>0){
            foreach($rows as $row){
                echo "<option value='$row->muni_codigo'>$row->muni_nome</option>";
            }
        }
        else{
            echo "<option>Nenhum municipio cadastrado</option>";
        }
        
    }

    /**
     * Updates an existing Aluno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->alun_codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aluno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aluno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aluno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aluno::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
