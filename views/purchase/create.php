<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Purchase */
/* @var $form yii\widgets\ActiveForm */
/* @var $products array */
/* @var $currencies array */

$this->title = 'Purchase';
?>
<div class="purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="purchase-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'product_id')->dropDownList($products, ['prompt' => 'Select Product']) ?>

        <?= $form->field($model, 'currency_id')->dropDownList($currencies, ['prompt' => 'Select Currency']) ?>

        <div class="form-group">
            <?= Html::submitButton('Purchase', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
