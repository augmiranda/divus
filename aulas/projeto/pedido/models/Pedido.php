<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "pedido".
 *
 * @property integer $pedi_codigo
 * @property string $pedi_data_criacao
 * @property string $pedi_data_alteracao
 * @property integer $clien_codigo
 * @property integer $usua_codigo
 * @property integer $fopa_codigo
 *
 * @property Cliente $clienCodigo
 * @property FormaPagamento $fopaCodigo
 * @property Usuario $usuaCodigo
 * @property PedidoProduto[] $pedidoProdutos
 */
class Pedido extends \yii\db\ActiveRecord
{
    public $clien_nome;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'pedi_data_criacao',
                'updatedAtAttribute' => 'pedi_data_alteracao',
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
            [['clien_codigo', 'usua_codigo', 'fopa_codigo', 'clien_nome'], 'required'],
            [['pedi_data_criacao', 'pedi_data_alteracao'], 'safe'],
            [['clien_codigo', 'usua_codigo', 'fopa_codigo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pedi_codigo' => 'Código',
            'pedi_data_criacao' => 'Data de criação',
            'pedi_data_alteracao' => 'Data de alteração',
            'clien_codigo' => 'Cliente',
            'clien_nome' => 'Nome do cliente',
            'usua_codigo' => 'Usuário',
            'fopa_codigo' => 'Forma de pagamento',
        ];
    }
    
    public function afterFind(){
        
        $this->clien_nome = $this->cliente->clien_nome;
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['clien_codigo' => 'clien_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormaPagamento()
    {
        return $this->hasOne(FormaPagamento::className(), ['fopa_codigo' => 'fopa_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['usua_codigo' => 'usua_codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(PedidoProduto::className(), ['pedi_codigo' => 'pedi_codigo']);
    }
}
