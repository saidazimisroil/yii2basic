<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Thank You';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-thankyou">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Thank you for your purchase! Your order has been successfully placed.</p>

    <?= Html::a('Back to Products', ['product/index'], ['class' => 'btn btn-primary']) ?>

</div>
