<?php

use yii\db\Migration;

/**
 * Class m230126_111233_init_rbac_for_tickets
 */
class m230126_111233_init_rbac_for_tickets extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $ticketsList = $auth->createPermission('ticketsList');
        $ticketsList->description = 'View ticket list';
        $auth->add($ticketsList);

        $ticketsEdit = $auth->createPermission('ticketsEdit');
        $ticketsEdit->description = 'Edit tickets';
        $auth->add($ticketsEdit);

        $ticketsDelete = $auth->createPermission('ticketsDelete');
        $ticketsDelete->description = 'Delete tickets';
        $auth->add($ticketsDelete);

        $manager = $auth->getRole('Менеджер');
        $auth->addChild($manager, $ticketsList);
        $auth->addChild($manager, $ticketsEdit);

        $admin = $auth->getRole('Администратор');
        $auth->addChild($admin, $ticketsDelete);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $ticketsList = $auth->getPermission('ticketsList');
        $auth->remove($ticketsList);

        $ticketsEdit = $auth->getPermission('ticketsEdit');
        $auth->remove($ticketsEdit);

        $ticketsDelete = $auth->getPermission('ticketsDelete');
        $auth->remove($ticketsDelete);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230126_111233_init_rbac_for_tickets cannot be reverted.\n";

        return false;
    }
    */
}
