<?php

use yii\db\Migration;

/**
 * Class m230125_120804_init_rbac
 */
class m230125_120804_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $usersList = $auth->createPermission('usersList');
        $usersList->description = 'View user list';
        $auth->add($usersList);

        $usersEdit = $auth->createPermission('usersEdit');
        $usersEdit->description = 'Edit users';
        $auth->add($usersEdit);

        $manager = $auth->createRole('Менеджер');
        $auth->add($manager);
        $auth->addChild($manager, $usersList);

        // add "admin" role and give this role the "usersEdit" permission
        // as well as the permissions of the "Менеджер" role
        $admin = $auth->createRole('Администратор');
        $auth->add($admin);
        $auth->addChild($admin, $usersEdit);
        $auth->addChild($admin, $manager);

        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230125_120804_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
