<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 */
class m230126_080245_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'client_name' => $this->string()->notNull(),
            'product_name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'comment' => $this->text(),
            'price' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ticket}}');
    }
}
