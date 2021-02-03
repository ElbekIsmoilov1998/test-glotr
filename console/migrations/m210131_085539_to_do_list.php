<?php

use yii\db\Migration;

/**
 * Class m210131_085539_to_do_list
 */
class m210131_085539_to_do_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210131_085539_to_do_list cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->createTable('to_do_list', array(
            'id' => 'pk',
            'user_id_created' => 'int NOT NULL',
            'user_id_completed' => 'int NOT NULL',
            'title' => 'string NOT NULL',
            'content' => 'text',
            'date' => 'varchar',
            'show' => 'enum(`yes`, `no`) NOT NULL DEFAULT `yes`',

        ));
    }
 
    public function down()
    {
        $this->dropTable('to_do_list');
    }
}
