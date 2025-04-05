<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tindakan}}`.
 */
class m250405_144828_create_tindakan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tindakan}}', [
            'id' => $this->primaryKey(),
            'kode' => $this->string(20)->notNull()->unique(),
            'nama' => $this->string(100)->notNull(),
            'harga' => $this->decimal(15, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tindakan}}');
    }
}
