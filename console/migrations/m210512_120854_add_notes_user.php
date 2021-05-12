<?php

use yii\db\Migration;

/**
 * Class m210512_120854_add_notes_user
 */
class m210512_120854_add_notes_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'note', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'note');
    }
}
