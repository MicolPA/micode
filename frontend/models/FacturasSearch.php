<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Facturas;

/**
 * FacturasSearch represents the model behind the search form of `frontend\models\Facturas`.
 */
class FacturasSearch extends Facturas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cliente_id', 'total', 'user_id'], 'integer'],
            [['cliente_nombre', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        
        if (isset(Yii::$app->request->get()['type'])) {
            $this->cotizacion = Yii::$app->request->get()['type'];
        }else{
            $this->cotizacion = 0;
        }

        $query = Facturas::find()->where(['cotizacion' => $this->cotizacion, 'active' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 16],
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cotizacion' => $this->cotizacion,
            'factura_code' => $this->factura_code,
            'cliente_id' => $this->cliente_id,
            'total' => $this->total,
            'status_id' => $this->status_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'cliente_nombre', $this->cliente_nombre]);

        return $dataProvider;
    }
}
