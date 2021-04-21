<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by'], 'integer'],
            [['username', 'created_at'], 'safe'],
            [['total_price'], 'number'],
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
     * @param integer $id
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find()->orderBy('created_at DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['between', 'created_at', $this->explodeDateTime($this->created_at)[0], $this->explodeDateTime($this->created_at)[1]]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }

    public function explodeDateTime($dateTime) {
        if ($dateTime) {
            return explode(' - ', $dateTime);
        } else {
            return [
                '2021-04-10',
                date('Y-m-d', strtotime('+1 day'))
            ];
        }
    }
}
