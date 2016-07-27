<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $clien_codigo
 * @property string $clien_nome
 * @property integer $clien_tipo
 * @property string $clien_cpf_cnpj
 * @property string $clien_email
 * @property integer $muni_codigo
 *
 * @property Municipio $muniCodigo
 * @property Pedido[] $pedidos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clien_nome', 'clien_tipo', 'clien_cpf_cnpj', 'clien_email', 'muni_codigo'], 'required'],
            [['clien_tipo', 'muni_codigo'], 'integer'],
            [['clien_nome'], 'string', 'max' => 120],
            [['clien_cpf_cnpj'], 'string', 'max' => 14],
            [['clien_email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clien_codigo' => 'Código',
            'clien_nome' => 'Nome',
            'clien_tipo' => 'Tipo',
            'clien_cpf_cnpj' => 'CPF / CNPJ',
            'clien_email' => 'E-mail',
            'muni_codigo' => 'Municipio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['muni_codigo' => 'muni_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['clien_codigo' => 'clien_codigo']);
    }
}
