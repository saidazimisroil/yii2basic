<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="filter-form">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['purchase/report'],
    ]); ?>

    <?= $form->field($searchModel, 'product_id')->dropDownList($products, ['prompt' => 'Select Product']) ?>

    <?= $form->field($searchModel, 'date_filter')->dropDownList([
        'today' => 'Today',
        'this_week' => 'This Week',
    ], ['prompt' => 'Select Date Filter']) ?>

    <?= $form->field($searchModel, 'currency_id')->dropDownList($currencies, ['prompt' => 'Select Currency']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
