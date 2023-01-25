<?php
namespace app\modules\user\controllers;

use backend\models\UserForm;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
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
        $user = $this->findUser($id);
        $model = new UserForm($user->toArray(['id', 'email', 'status']));
        if ($model->load(Yii::$app->request->post()) && $model->save($user)) {
            return $this->redirect('index');
        }

        return $this->render('edit', ['model' => $model, 'statusOptions' => User::getStatusOptions()]);
    }

    public function actionDelete($id)
    {
        $this->findUser($id)->delete();
        return $this->redirect('index');
    }

    public function findUser($id)
    {
        $user = User::findOne(['id' => $id]);
        if ($user === null) {
            throw new NotFoundHttpException;
        }
        return $user;
    }
}
