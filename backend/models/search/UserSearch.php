<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'admin'], 'integer'],
            [['username', 'auth_key', 'password', 'created_at'], 'safe'],
            [['balance'], 'number'],
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
     * @param array $admin
     *
     * @return ActiveDataProvider
     */
    public function search($params, $admin = null)
    {
        if ($admin) {
            $query = User::find()->andWhere([
                'admin' => User::IS_ADMIN,
                'status' => User::STATUS_ACTIVE
            ]);
        } else {
            $query = User::find()->andWhere(['admin' => User::NOT_ADMIN]);
        }

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
            'balance' => $this->balance,
            'status' => $this->status,
            'last_login_at' => $this->last_login_at,
            'updated_at' => $this->updated_at,
            'admin' => $this->admin,
        ]);

        $query->andFilterWhere(['between', 'created_at', $this->explodeDateTime($this->created_at)[0], $this->explodeDateTime($this->created_at)[1]]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password', $this->password]);

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
