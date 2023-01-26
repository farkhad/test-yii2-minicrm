<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'Users');
?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><?= Yii::t('app', '#')?></th>
      <th scope="col"><?= Yii::t('app', 'Email')?></th>
      <th scope="col"><?= Yii::t('app', 'Status')?></th>
      <th scope="col"><?= Yii::t('app', 'Role')?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $i => $user) : ?>
    <tr>
      <th scope="row"><?= $i + 1?></th>
      <td>
        <?php if (Yii::$app->user->can('usersEdit')) :?>
            <a href="<?= Url::to(['default/edit', 'id' => $user['id']])?>"><?= $user['email']?></a>
        <?php else : ?>
            <?= $user['email']?>
        <?php endif ?>
      </td>
      <td><?= $statusOptions[$user['status']]?></td>
      <td><?php
      $roles = Yii::$app->authManager->getRolesByUser($user['id']);
      if (count($roles)) {
        echo array_keys($roles)[0];
      }
      ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
