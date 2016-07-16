<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Aluno;

class ExercicioController extends Controller
{
   public function actionCreate(){
       
       for ($i=0; $i < 2000; $i++){
           
           $aluno = new Aluno();
           $aluno->alun_nome = "Chico $i";
           $aluno->alun_matricula = "123456" . $i;
           $aluno->alun_data_nascimento = "01/01/2001";
           $aluno->muni_codigo = 1;
           $aluno->esta_codigo = 1;
           $aluno->save();
           
//           print_r($aluno->errors);
//           die();
           
       }
   }
   
   public function actionList(){
       
       $alunos = Aluno::find()->all();
       
       return $this->render('list', ['alunos' => $alunos]);
       
   }
   
   public function actionDelete($id){
       
       if(Aluno::findOne($id)->delete()){
           Yii::$app->session->setFlash('success', "Aluno de codigo $id deletado com sucesso!");
       }else{
           Yii::$app->session->setFlash('danger', "Nao foi possivel deletar o aluno de codigo $id!");       
       }
       
       
       return $this->redirect(['list']);
   }
}
