<?php 

namespace app\commands;

use yii\console\Controller;
use app\models\CurrencyRate;
use Yii;

class AddCurrencyRateController extends Controller
{
    public function actionIndex($currency_id, $rate)
    {
        $model = new CurrencyRate();
        $model->currency_id = $currency_id;
        $model->rate = $rate;
        $model->date = date('Y-m-d');
        if ($model->save()) {
            echo "Currency rate added successfully.\n";
        } else {
            echo "Error adding currency rate.\n";
        }
    }
}
