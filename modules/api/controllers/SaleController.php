<?php 

namespace app\modules\api\controllers;

use yii\rest\Controller;
use app\models\Purchase;
use Yii;

class SaleController extends Controller
{
    public function actionCreate()
    {
        $model = new Purchase();
        if ($model->load(Yii::$app->request->post(), '') && $model->save()) {
            return $model;
        }
        return ['error' => $model->errors];
    }
}
