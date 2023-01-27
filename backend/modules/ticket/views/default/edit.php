<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Edit');
$this->params['breadcrumbs']['index'] = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ticket-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-ticket']); ?>

                <?= $form->field($model, 'name')->input('name', ['autofocus' => true]) ?>

                <?= $form->field($model, 'client_name') ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'product_name') ?>

                <?= $form->field($model, 'price') ?>

                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'status')->dropDownList($statusOptions, ['value' => $model->status]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
