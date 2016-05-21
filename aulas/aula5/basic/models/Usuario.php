<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $codigo
 * @property string $nome
 * @property string $email
 * @property string $senha
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'senha'], 'required'],
            [['nome'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 40],
            [['senha'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'nome' => 'Nome',
            'email' => 'Email',
            'senha' => 'Senha',
        ];
    }
}
