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
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $i => $user) : ?>
    <tr>
      <th scope="row"><?= $i + 1?></th>
      <td><a href="<?= Url::to(['default/edit', 'id' => $user['id']])?>"><?= $user['email']?></a></td>
      <td><?= $statusOptions[$user['status']]?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
