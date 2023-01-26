<?php

use yii\widgets\ListView;

$this->title = Yii::t('app', 'Users');

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'users_item',
    'viewParams' => [
        'statusOptions' => $statusOptions,
    ],
    'layout' => '<div class="summary">{summary}</div><table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">' . Yii::t('app', '#') . '</th>
        <th scope="col">' . Yii::t('app', 'Email') . '</th>
        <th scope="col">' . Yii::t('app', 'Status') . '</th>
        <th scope="col">' . Yii::t('app', 'Role') . '</th>
      </tr>
    </thead>
    <tbody>{items}</tbody></table>{pager}',
]);
