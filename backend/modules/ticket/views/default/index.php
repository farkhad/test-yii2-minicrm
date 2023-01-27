<?php

use yii\widgets\ListView;

$this->title = Yii::t('app', 'Tickets');

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'tickets_item',
    'viewParams' => [
        'statusOptions' => $statusOptions,
    ],
    'layout' => '<div class="summary">{summary}</div><table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">' . Yii::t('app', '#') . '</th>
        <th scope="col">' . Yii::t('app', 'Ticket Name') . '</th>
        <th scope="col">' . Yii::t('app', 'Client Name') . '</th>
        <th scope="col">' . Yii::t('app', 'Phone') . '</th>
        <th scope="col">' . Yii::t('app', 'Product') . '</th>
        <th scope="col">' . Yii::t('app', 'Status') . '</th>
        <th scope="col">' . Yii::t('app', 'Created At') . '</th>
      </tr>
    </thead>
    <tbody>{items}</tbody></table>{pager}',
]);
