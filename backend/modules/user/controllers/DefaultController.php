<?php
namespace app\modules\user\controllers;

use backend\models\UserForm;
use common\models\User;
use Yii;
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
                        'roles' => ['usersList'],
                    ],
                    [
                        'actions' => ['edit', 'delete'],
                        'allow' => true,
                        'roles' => ['usersEdit'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        // fetch user list
        $users = User::find()->asArray()->all();

        // status list
        $statusOptions = User::getStatusOptions();

        return $this->render('index', [
            'users' => $users,
            'statusOptions' => $statusOptions,
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
