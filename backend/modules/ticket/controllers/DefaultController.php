<?php
namespace app\modules\ticket\controllers;

use backend\models\TicketForm;
use common\models\Ticket;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'edit'],
                        'allow' => true,
                        'roles' => ['Менеджер'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['Администратор'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ticket::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'statusOptions' => Ticket::getStatusOptions(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEdit($id)
    {
        $model = Ticket::findOne(['id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render(
            'edit',
            [
                'model' => $model,
                'statusOptions' => Ticket::getStatusOptions(),
            ]
        );
    }

    public function actionDelete($id)
    {
        Ticket::findOne(['id' => $id])->delete();
        return $this->redirect('index');
    }
}
