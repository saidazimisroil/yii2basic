<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 *
 * @property CurrencyRate[] $currencyRates
 * @property CurrentProductPrice[] $currentProductPrices
 * @property Purchase[] $purchases
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[CurrencyRates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyRates()
    {
        return $this->hasMany(CurrencyRate::class, ['currency_id' => 'id']);
    }

    /**
     * Gets query for [[CurrentProductPrices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentProductPrices()
    {
        return $this->hasMany(CurrentProductPrice::class, ['currency_id' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['currency_id' => 'id']);
    }
}
