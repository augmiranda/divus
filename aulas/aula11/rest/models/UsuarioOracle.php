<?php

namespace app\models;

use Yii;

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
class UsuarioOracle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('oracle');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usua_nome', 'usua_email', 'usua_senha', 'usua_auth_key'], 'required'],
            [['usua_habilitado'], 'boolean'],
            [['usua_data_criacao', 'usua_data_alteracao'], 'safe'],
            [['usua_nome'], 'string', 'max' => 120],
            [['usua_email', 'usua_senha'], 'string', 'max' => 60],
            [['usua_auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usua_codigo' => 'Usua Codigo',
            'usua_nome' => 'Usua Nome',
            'usua_email' => 'Usua Email',
            'usua_senha' => 'Usua Senha',
            'usua_habilitado' => 'Usua Habilitado',
            'usua_data_criacao' => 'Usua Data Criacao',
            'usua_data_alteracao' => 'Usua Data Alteracao',
            'usua_auth_key' => 'Usua Auth Key',
        ];
    }
}
