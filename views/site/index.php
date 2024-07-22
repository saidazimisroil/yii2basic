<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $products app\models\Product[] */
/* @var $currencies app\models\Currency[] */

$this->title = 'Product List';
?>
<div class="site-index">
    <h1>Products</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price (RUB)</th>
                <th>Price (USD)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= Html::encode($product->name) ?></td>
                <td><?= Html::encode($product->description) ?></td>
                <td><?= Html::encode($product->getPriceInCurrency('RUB')) ?></td>
                <td><?= Html::encode($product->getPriceInCurrency('USD')) ?></td>
                <td><?= Html::a('Buy', ['purchase/create', 'product_id' => $product->id], ['class' => 'btn btn-primary']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
