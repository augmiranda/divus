<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression; 

/**
 * This is the model class for table "usuario".
 *
 * @property integer $usua_codigo
 * @property string $usua_nome
 * @property string $usua_email
 * @property string $usua_senha
 * @property boolean $usua_habilitado
 * @property string $usua_data_criacao
 * @property string $usua_data_alteracao
 * @property string $usua_auth_key
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $usua_senha_temp;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'usua_data_criacao',
                'updatedAtAttribute' => 'usua_data_alteracao',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usua_nome', 'usua_email', 'usua_senha'], 'required'],
            [['usua_habilitado'], 'boolean'],
            [['usua_data_criacao', 'usua_data_alteracao', 'usua_senha_temp', 'usua_auth_key'], 'safe'],
            [['usua_nome'], 'string', 'max' => 120],
            [['usua_email', 'usua_senha'], 'string', 'max' => 60],
            [['usua_auth_key'], 'string', 'max' => 32],
            [['usua_email'], 'unique'],
            [['usua_email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usua_codigo' => 'Código',
            'usua_nome' => 'Nome',
            'usua_email' => 'E-mail',
            'usua_senha' => 'Senha',
            'usua_habilitado' => 'Habilitado',
            'usua_data_criacao' => 'Data de Criação',
            'usua_data_alteracao' => 'Data de Alteração',
            'usua_auth_key' => 'Auth Key',
        ];
    }
    
    public function afterFind(){
        
        $this->usua_senha_temp = $this->usua_senha;
        
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if ($insert) {
                
                $this->usua_auth_key = Yii::$app->getSecurity()->generateRandomString();
                
            }
        
            if($this->usua_senha_temp != $this->usua_senha){

                $this->usua_senha = Yii::$app->getSecurity()->generatePasswordHash($this->usua_senha);
              
            }    
            
            return true;

        } else {

            return false;

        }	   
    }
}
