<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%projects}}`.
 */
class m201205_085004_add_user_id_column_to_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('projects', 'user_id', $this->integer()->notNull());

        $this->createIndex(
            'idx-projects-user_id',
            'projects',
            'user_id'
        );
        $this->addForeignKey(
            'fk-post-user_id', 
            'projects', 
            'user_id', 
            'user', 
            'id', 
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('projects', 'user_id');
        $this->dropForeignKey('fk-projects-user_id', 'projects');
        $this->dropIndex('idx-projects-user_id', 'projects');
    }
}
