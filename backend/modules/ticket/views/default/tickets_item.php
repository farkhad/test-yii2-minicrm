<?php

use yii\helpers\Url;

$formatter = Yii::$app->formatter;
$formatter->locale = Yii::$app->language;
?>
<tr>
    <th scope="row"><?= $index + 1?></th>
    <td>
    <?php if (Yii::$app->user->can('ticketsEdit')) :?>
        <a href="<?= Url::to(['default/edit', 'id' => $model->id])?>"><?= $model->client_name?></a>
    <?php else : ?>
        <?= $model->client_name?>
    <?php endif ?>
    </td>
    <td><?= $model->phone?></td>
    <td><?= $model->product_name?></td>
    <td><?= $statusOptions[$model->status]?></td>
    <td><?= $formatter->asDatetime($model->created_at)?></td>
</tr>
