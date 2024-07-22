<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Purchase;

/**
 * PurchaseSearch represents the model behind the search form of `app\models\Purchase`.
 */
class PurchaseSearch extends Purchase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'currency_id'], 'integer'],
            [['name', 'phone'], 'safe'],
            [['payment'], 'number'],
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
        $query = Purchase::find();

        // Load the search parameters
        $this->load($params);

        // Apply the filters
        $query->andFilterWhere(['product_id' => $this->product_id])
              ->andFilterWhere(['date_filter' => $this->date_filter])
              ->andFilterWhere(['currency_id' => $this->currency_id]);

        return $query;
    }
}
