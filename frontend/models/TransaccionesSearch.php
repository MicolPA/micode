<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Transacciones;

/**
 * TransaccionesSearch represents the model behind the search form of `frontend\models\Transacciones`.
 */
class TransaccionesSearch extends Transacciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_id', 'servicio_extra_id', 'cliente_id', 'total'], 'integer'],
            [['fecha_pago', 'date'], 'safe'],
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
        $query = Transacciones::find()->orderBy(['fecha_pago' => SORT_DESC]);

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
            'id' => $this->id,
            'tipo_id' => $this->tipo_id,
            'servicio_extra_id' => $this->servicio_extra_id,
            'cliente_id' => $this->cliente_id,
            'total' => $this->total,
            // 'fecha_pago' => $this->fecha_pago,
            'MONTH(fecha_pago)' => substr($this->fecha_pago, -2),
            'YEAR(fecha_pago)' => substr($this->fecha_pago, 0,4),
        ]);

        return $dataProvider;
    }
}
