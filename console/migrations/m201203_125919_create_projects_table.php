<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m201203_125919_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'image' => $this->string(),
            'max_number' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-projects-user_id',
            'projects',
            'user_id'
        );

        $this->addForeignKey(
            'fk-projects-user_id', 
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
        $this->dropForeignKey('fk-projects-user_id', 'projects');
        $this->dropIndex('idx-projects-user_id', 'projects');
        $this->dropTable('{{%projects}}');
    }
}
