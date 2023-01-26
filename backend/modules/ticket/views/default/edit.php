<?php

use common\models\Ticket;
use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = Yii::t('app', 'Edit');
$this->params['breadcrumbs']['index'] = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['id' => 'form-user']);
echo $form->field($model, 'id')->hiddenInput()->label(false);

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'client_name',
        'product_name',
        'comment:html',
        'created_at:datetime',
    ],
]);

echo $form->field($model, 'status')->dropDownList(Ticket::getStatusOptions(), ['value' => $model->status]);
?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success mt-3']) ?>
</div>
<?php ActiveForm::end(); ?>
