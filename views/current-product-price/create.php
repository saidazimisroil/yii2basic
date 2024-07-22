<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CurrentProductPrice $model */

$this->title = 'Create Current Product Price';
$this->params['breadcrumbs'][] = ['label' => 'Current Product Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="current-product-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
