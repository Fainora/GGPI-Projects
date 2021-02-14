<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects_tag}}`.
 */
class m210206_112839_create_projects_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects_tag}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-projects_tag-tag_id',
            'projects_tag',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-projects_tag-tag_id',
            'projects_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

        // creates index for column `project_id`
        $this->createIndex(
            'idx-projects_tag-project_id',
            'projects_tag',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-projects_tag-project_id',
            'projects_tag',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-projects_tag-tag_id',
            'projects_tag'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-projects_tag-tag_id',
            'projects_tag'
        );

        // drops foreign key for table `project`
        $this->dropForeignKey(
            'fk-projects_tag-project_id',
            'projects_tag'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-projects_tag-project_id',
            'projects_tag'
        );

        $this->dropTable('{{%projects_tag}}');
    }
}
