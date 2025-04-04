<?php

use yii\db\Migration;

class m250404_181635_add_fullname_and_status_to_user_table extends Migration
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
        echo "m250404_181635_add_fullname_and_status_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250404_181635_add_fullname_and_status_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
