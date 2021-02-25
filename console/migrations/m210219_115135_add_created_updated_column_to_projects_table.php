<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%projects}}`.
 */
class m210219_115135_add_created_updated_column_to_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%projects}}', 'created_at', $this->integer());
        $this->addColumn('{{%projects}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%projects}}', 'created_at');
        $this->dropColumn('{{%projects}}', 'updated_at');
    }
}
