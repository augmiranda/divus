<?php

namespace app\controllers;

use Yii;
use app\models\Pedido;
use app\models\PedidoProduto;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => [Yii::$app->controller->action->id],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [Yii::$app->controller->action->id],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    /**
     * Lists all Pedido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', 'Pedido alterado com sucesso!');
            
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
    public function actionAdicionarProduto($id)
    {
        
        $pedido =  $this->findModel($id);
        $model = new \app\models\PedidoProduto();
        $model->pedi_codigo = $id;
        
        if ($model->load(Yii::$app->request->post())) {
            
            $pedidoProduto = PedidoProduto::findOne(['pedi_codigo' => $id, 'prod_codigo' =>$model->prod_codigo]);
            
            if($pedidoProduto){
                
                $pedidoProduto->pepr_quantidade += $model->pepr_quantidade;   
                
                $pedidoProduto->save();
                
                Yii::$app->session->setFlash('success', 'Produto alterado com sucesso!');
                
            }else{
                
                $model->save();
                
                Yii::$app->session->setFlash('success', 'Produto adicionado com sucesso!');
            }
                
            return $this->redirect(['view', 'id' => $model->pedi_codigo]);
        }
        
        return $this->render('adicionarProduto', [
            'model' => $model,
        ]);
    }
    
    public function actionProdutoUpdate($id)
    {
        
        $model =  PedidoProduto::findOne($id);
     
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash('success', 'Produto alterado com sucesso!');
                
            return $this->redirect(['view', 'id' => $model->pedi_codigo]);
        }
        
        return $this->render('adicionarProduto', [
            'model' => $model,
 
        ]);
    }
    
    public function actionCliente($q = null) {
        
        $query = new Query;
        
        $id = (int) $q;

        $rows = $query->select('clien_codigo,clien_nome')
            ->from('cliente')
            ->where("clien_nome ilike '%$q%' or clien_codigo = $id")
            ->orderBy('clien_nome')
            ->all();

        $out = [];
        
        foreach ($rows as $row) {
            $out[] = [
                'label' => $row['clien_codigo'] . ' - ' . $row['clien_nome'],
                'value' => $row['clien_codigo'],
            ];
        }
     
        echo Json::encode($out);
    }
    
    public function actionProduto($q = null) {
        
        $query = new Query;

        $rows = $query->select('prod_codigo,prod_nome,prod_valor')
            ->from('produto')
            ->where("prod_nome ilike '%$q%'")
            ->orderBy('prod_nome')
            ->all();

        $out = [];
        
        foreach ($rows as $row) {
            $out[] = [
                'label' => $row['prod_codigo'] . ' - ' . $row['prod_nome'],
                'value' => $row['prod_codigo'],
                'produto' => $row
            ];
        }
     
        echo Json::encode($out);
    }
    
    public function actionProdutoDelete($id)
    {
        $model = PedidoProduto::findOne($id);
        
        $model->delete();
        
        Yii::$app->session->setFlash('success', 'Produto deletado com sucesso!');

        return $this->redirect(['view', 'id' => $model->pedi_codigo]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pedido();
        $model->usua_codigo = Yii::$app->user->identity->id;
        $model->clien_codigo = 1;
        $model->fopa_codigo = 1;
        $model->save();
        
        return $this->redirect(['view', 'id' => $model->pedi_codigo]);
    }

    /**
     * Deletes an existing Pedido model.
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
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pedido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
