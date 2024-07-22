<?php

namespace app\controllers;

use Yii;
use app\models\CurrentProductPrice;
use app\models\CurrentProductPriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CurrencyRate;

class CurrentProductPriceController extends Controller
{
    // ... other methods ...

    public function actionCreate()
    {
        $model = new CurrentProductPrice();

        if ($model->load(Yii::$app->request->post())) {
            $currencyRate = CurrencyRate::find()
                ->where(['currency_id' => $model->currency_id, 'date' => date('Y-m-d')])
                ->one();

            if ($currencyRate) {
                $model->price = $model->price * $currencyRate->rate;
            } else {
                Yii::$app->session->setFlash('error', 'Currency rate not found for today.');
                return $this->redirect(['create']);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $currencyRate = CurrencyRate::find()
                ->where(['currency_id' => $model->currency_id, 'date' => date('Y-m-d')])
                ->one();

            if ($currencyRate) {
                $model->price = $model->price * $currencyRate->rate;
            } else {
                Yii::$app->session->setFlash('error', 'Currency rate not found for today.');
                return $this->redirect(['update', 'id' => $model->id]);
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    // ... other methods ...
}
