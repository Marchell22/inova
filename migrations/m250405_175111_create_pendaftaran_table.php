<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pendaftaran}}`.
 */
class m250405_175111_create_pendaftaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pendaftaran}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(100)->notNull(),
            'keluhan' => $this->text()->notNull(),
            'dokter_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(), // user yang input
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        // Foreign key ke tabel pegawai (sebagai dokter)
        $this->addForeignKey(
            'fk-pendaftaran-dokter_id',
            '{{%pendaftaran}}',
            'dokter_id',
            '{{%pegawai}}',
            'id',
            'CASCADE'
        );

        // Foreign key ke user login
        $this->addForeignKey(
            'fk-pendaftaran-user_id',
            '{{%pendaftaran}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-pendaftaran-dokter_id', '{{%pendaftaran}}');
        $this->dropForeignKey('fk-pendaftaran-user_id', '{{%pendaftaran}}');
        $this->dropTable('{{%pendaftaran}}');
    }
}
