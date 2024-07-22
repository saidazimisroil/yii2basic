<?php 

namespace app\modules\api\controllers;

use yii\rest\Controller;
use Yii;
use yii\db\Query;

class ReportController extends Controller
{
    public function actionIndex()
    {
        $query = (new Query())
            ->select(['product.name', 'purchase.*'])
            ->from('purchase')
            ->join('INNER JOIN', 'product', 'purchase.product_id = product.id')
            ->orderBy(['purchase.id' => SORT_DESC]);

        if ($productId = Yii::$app->request->get('product_id')) {
            $query->andWhere(['product_id' => $productId]);
        }

        if ($dateFilter = Yii::$app->request->get('date_filter')) {
            if ($dateFilter === 'today') {
                $query->andWhere(['DATE(purchase.created_at)' => date('Y-m-d')]);
            } elseif ($dateFilter === 'this_week') {
                $query->andWhere(['between', 'purchase.created_at', date('Y-m-d', strtotime('last Monday')), date('Y-m-d')]);
            }
        }

        if ($currencyId = Yii::$app->request->get('currency_id')) {
            $query->andWhere(['currency_id' => $currencyId]);
        }

        return $query->all();
    }
}
