<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pendaftaran}}`.
 */
class m250405_175511_add_status_column_to_pendaftaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pendaftaran}}', 'status', $this->string()->defaultValue('Menunggu'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pendaftaran}}', 'status');
    }
}
