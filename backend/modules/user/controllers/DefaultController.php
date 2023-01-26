<?php
namespace app\modules\user\controllers;

use backend\models\UserForm;
use common\models\User;
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['Менеджер'],
                    ],
                    [
                        'actions' => ['edit', 'delete'],
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
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', [
            'statusOptions' => User::getStatusOptions(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEdit($id)
    {
        $user = UserForm::findUser($id);
        $model = new UserForm($user->toArray(['id', 'email', 'status']));

        if ($model->load(Yii::$app->request->post()) && $model->save($user)) {
            return $this->redirect('index');
        }

        $roles = Yii::$app->authManager->getRolesByUser($user->id);
        if (count($roles)) {
            $model->role = array_keys($roles)[0];
        }

        return $this->render(
            'edit',
            [
                'model' => $model,
                'statusOptions' => User::getStatusOptions(),
                'roleOptions' => User::getRoleOptions(),
            ]
        );
    }

    public function actionDelete($id)
    {
        UserForm::findUser($id)->delete();
        return $this->redirect('index');
    }
}
