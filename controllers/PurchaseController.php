<?php

namespace app\controllers;

use Yii;
use app\models\Currency;
use app\models\Product;
use app\models\Purchase;
use app\models\PurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseController implements the CRUD actions for Purchase model.
 */
class PurchaseController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Purchase models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Purchase model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Purchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Purchase();
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['thankyou']);
        }
    
        $products = Product::find()->select(['name', 'id'])->indexBy('id')->column();
        $currencies = Currency::find()->select(['name', 'id'])->indexBy('id')->column();
    
        return $this->render('create', [
            'model' => $model,
            'products' => $products,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Updates an existing Purchase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Purchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Purchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Purchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Purchase::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionThankyou()
    {
        return $this->render('thankyou');
    }

    public function actionReport()
    {
        $searchModel = new PurchaseSearch();
        $query = Purchase::find();

        // Set filters from request if needed
        $searchModel->load(Yii::$app->request->get());

        // Apply the search filters
        $query->andFilterWhere(['product_id' => $searchModel->product_id])
            ->andFilterWhere(['date_filter' => $searchModel->date_filter])
            ->andFilterWhere(['currency_id' => $searchModel->currency_id]);

        $purchases = $query->all();
        $products = Product::find()->select(['name', 'id'])->indexBy('id')->column();
        $currencies = Currency::find()->select(['name', 'id'])->indexBy('id')->column();

        return $this->render('report', [
            'searchModel' => $searchModel,
            'purchases' => $purchases,
            'products' => $products,
            'currencies' => $currencies,
        ]);
    }
}
