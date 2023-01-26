<?php

use yii\helpers\Url;
?>
<tr>
    <th scope="row"><?= $index + 1?></th>
    <td>
    <?php if (Yii::$app->user->can('usersEdit')) :?>
        <a href="<?= Url::to(['default/edit', 'id' => $model->id])?>"><?= $model->email?></a>
    <?php else : ?>
        <?= $model->email?>
    <?php endif ?>
    </td>
    <td><?= $statusOptions[$model->status]?></td>
    <td><?php
    $roles = Yii::$app->authManager->getRolesByUser($model->id);
    if (count($roles)) {
        echo array_keys($roles)[0];
    }
    ?></td>
</tr>
