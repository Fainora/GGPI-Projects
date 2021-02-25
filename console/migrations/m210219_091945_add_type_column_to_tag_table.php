<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%tag}}`.
 */
class m210219_091945_add_type_column_to_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tag}}', 'type', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%tag}}', 'type');
    }
}
