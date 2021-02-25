<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_tag}}`.
 */
class m210218_073558_create_user_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_tag}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-user_tag-tag_id',
            'user_tag',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-user_tag-tag_id',
            'user_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

        // creates index for column `project_id`
        $this->createIndex(
            'idx-user_tag-project_id',
            'user_tag',
            'user_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-user_tag-project_id',
            'user_tag',
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
        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-user_tag-tag_id',
            'user_tag'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-user_tag-tag_id',
            'user_tag'
        );

        // drops foreign key for table `project`
        $this->dropForeignKey(
            'fk-user_tag-project_id',
            'user_tag'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-user_tag-project_id',
            'user_tag'
        );
        
        $this->dropTable('{{%user_tag}}');
    }
}
