<?php
namespace backend\models;

use common\models\User;
use Exception;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

/**
 * User form
 */
class UserForm extends Model
{
    public $id;
    public $email;
    public $status;
    public $password;
    public $role;

    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    public function rules()
    {
        return [
            // email, status attributes are required
            [['email', 'status'], 'required'],

            ['role', 'in', 'range' => User::getRoleOptions()],

            // the email attribute should be a valid email address
            ['email', 'email'],
            ['email', 'trim'],
            ['email', 'string', 'max' => 255],
            ['email', 'emailUniqueness'],

            ['status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE, User::STATUS_DELETED]],

            ['password', 'compare', 'compareValue' => '', 'operator' => '!='],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function emailUniqueness($attribute, $params)
    {
        $user = User::findOne(['email' => $this->email]);
        if ($user && $user->id != $this->id) {
            $this->addError($attribute, Yii::t('app', 'This email address has already been taken.'));
        }
    }

    public function save($user)
    {
        if (!$this->validate()) {
            return null;
        }

        $user->email = $this->email;
        $user->status = $this->status;
        if ($this->password != '') {
            $user->setPassword($this->password);
        }
        if ($this->role != '') {
            try {
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($this->role);
                $auth->assign($role, $user->id);
            } catch (Exception) {
                // Exception is thrown when role is already assigned to user
            }
        }

        return $user->save();
    }

    public static function findUser($id)
    {
        $user = User::findOne(['id' => $id]);
        if ($user === null) {
            throw new NotFoundHttpException;
        }
        return $user;
    }
}
