<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pendaftaran}}`.
 */
class m250405_193038_add_harga_column_to_pendaftaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pendaftaran', 'harga', $this->decimal(10, 2)->null()->defaultValue(0)->comment('Harga tindakan'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    
    {
        $this->dropColumn('pendaftaran', 'harga');
    }
}
