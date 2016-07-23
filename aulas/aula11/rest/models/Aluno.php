<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression; 
use Datetime;


/**
 * This is the model class for table "aluno".
 *
 * @property integer $alun_codigo
 * @property string $alun_nome
 * @property string $alun_matricula
 * @property string $alun_data_nascimento
 * @property boolean $alun_habilitado
 * @property string $alun_observacao
 * @property integer $muni_codigo
 * @property string $alun_data_criacao
 * @property string $alun_data_alteracao
 *
 * @property Municipio $muniCodigo
 */
class Aluno extends \yii\db\ActiveRecord
{
    public $esta_codigo;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'alun_data_criacao',
                'updatedAtAttribute' => 'alun_data_alteracao',
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
            [['alun_nome', 'alun_matricula', 'alun_data_nascimento', 'muni_codigo', 'esta_codigo'], 'required'],
            [['alun_data_nascimento', 'alun_data_criacao', 'alun_data_alteracao'], 'safe'],
            [['alun_habilitado'], 'boolean'],
            [['alun_observacao'], 'string'],
            [['muni_codigo'], 'integer'],
            [['alun_nome'], 'string', 'max' => 120],
            [['alun_matricula'], 'string', 'max' => 10],
            [['alun_matricula'], 'unique'],
            [['alun_data_nascimento'], 'validarData'],
            [['muni_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['muni_codigo' => 'muni_codigo']],
        ];
    }
    
    public function validarData($attribute, $params)
    {
        $date = DateTime::createFromFormat('d/m/Y', $this->$attribute);
        
        $interval = $date->diff( new DateTime( ) );
        
        $idade = $interval->format( '%Y' );
        
        if ( $idade > 18 ) {
            
            $this->addError($attribute, 'É necessário ter ate 18 anos de idade.');
            
        }
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alun_codigo' => 'Alun Codigo',
            'alun_nome' => 'Alun Nome',
            'alun_matricula' => 'Alun Matricula',
            'alun_data_nascimento' => 'Alun Data Nascimento',
            'alun_habilitado' => 'Alun Habilitado',
            'alun_observacao' => 'Alun Observacao',
            'muni_codigo' => 'Muni Codigo',
            'alun_data_criacao' => 'Alun Data Criacao',
            'alun_data_alteracao' => 'Alun Data Alteracao',
            'esta_codigo' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(Municipio::className(), ['muni_codigo' => 'muni_codigo']);
    }
}
