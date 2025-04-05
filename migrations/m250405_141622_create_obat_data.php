<?php

use yii\db\Migration;

class m250405_141622_create_obat_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%obat}}', [
            'id' => $this->primaryKey(),
            'kode' => $this->string(20)->notNull()->unique(),
            'nama' => $this->string(100)->notNull(),
            'harga' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%obat}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250405_141622_create_obat_data cannot be reverted.\n";

        return false;
    }
    */
}
