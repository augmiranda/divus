<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $codigo
 * @property string $nome
 * @property string $matricula
 * @property string $email
 * @property boolean $habilitado
 * @property string $cpf
 */
class Aluno extends \yii\db\ActiveRecord
{
    public $email_confirmacao;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'matricula', 'email', 'cpf','email_confirmacao'], 'required'],
            [['habilitado'], 'boolean'],
            [['nome', 'email'], 'string', 'max' => 60],
            [['matricula'], 'string', 'max' => 10],
            [['cpf'], 'string', 'max' => 11],
            [['email'], 'unique', 'message' => 'Ei doidao, esse email ja tem!'],
            ['email', 'compare', 'compareAttribute' => 'email_confirmacao'],
        ];
    }
    
    public function afterFind() {
        
        $this->nome = "Sr. " . strtoupper($this->nome);
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Código',
            'nome' => 'Nome',
            'matricula' => 'Matricula',
            'email' => 'E-mail',
            'habilitado' => 'Habilitado',
            'cpf' => 'CPF',
            'email_confirmacao' => 'Confirmação de e-mail'
        ];
    }
}
