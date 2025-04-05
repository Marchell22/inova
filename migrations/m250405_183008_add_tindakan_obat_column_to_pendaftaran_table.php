<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pendaftaran}}`.
 */
class m250405_183008_add_tindakan_obat_column_to_pendaftaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pendaftaran}}', 'tindakan_id', $this->integer()->null());
        $this->addColumn('{{%pendaftaran}}', 'obat_id', $this->integer()->null());

        // Tambahkan foreign key (jika relasi dibutuhkan)
        $this->addForeignKey(
            'fk-pendaftaran-tindakan_id',
            '{{%pendaftaran}}',
            'tindakan_id',
            '{{%tindakan}}',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-pendaftaran-obat_id',
            '{{%pendaftaran}}',
            'obat_id',
            '{{%obat}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-pendaftaran-tindakan_id', '{{%pendaftaran}}');
        $this->dropForeignKey('fk-pendaftaran-obat_id', '{{%pendaftaran}}');
        $this->dropColumn('{{%pendaftaran}}', 'tindakan_id');
        $this->dropColumn('{{%pendaftaran}}', 'obat_id');
    }
}
