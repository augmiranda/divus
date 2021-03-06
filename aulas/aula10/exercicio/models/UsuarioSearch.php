<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usua_codigo'], 'integer'],
            [['usua_nome', 'usua_email', 'usua_senha', 'usua_data_criacao', 'usua_data_alteracao', 'usua_auth_key'], 'safe'],
            [['usua_habilitado'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Usuario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'usua_codigo' => $this->usua_codigo,
            'usua_habilitado' => $this->usua_habilitado,
            'usua_data_criacao' => $this->usua_data_criacao,
            'usua_data_alteracao' => $this->usua_data_alteracao,
        ]);

        $query->andFilterWhere(['like', 'usua_nome', $this->usua_nome])
            ->andFilterWhere(['like', 'usua_email', $this->usua_email])
            ->andFilterWhere(['like', 'usua_senha', $this->usua_senha])
            ->andFilterWhere(['like', 'usua_auth_key', $this->usua_auth_key]);

        return $dataProvider;
    }
}
