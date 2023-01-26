<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'ticket-form']); ?>

                <?= $form->field($model, 'client_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'product_name')->dropDownList(['яблоки' => 'яблоки', 'апельсины' => 'апельсины', 'мандарины' => 'мандарины']) ?>

                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
