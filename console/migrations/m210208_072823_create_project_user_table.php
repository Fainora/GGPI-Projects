<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects_user}}`.
 */
class m210208_072823_create_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects_user}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            //status: 0 - default(отклонил); 1 - в ожидании; 2 - заявка принята;
            'status' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-projects_user-user_id',
            'projects_user',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-projects_user-user_id',
            'projects_user',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `project_id`
        $this->createIndex(
            'idx-projects_user-project_id',
            'projects_user',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-projects_user-project_id',
            'projects_user',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-projects_user-user_id',
            'projects_user'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-projects_user-user_id',
            'projects_user'
        );

        // drops foreign key for table `project`
        $this->dropForeignKey(
            'fk-projects_user-project_id',
            'projects_user'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-projects_user-project_id',
            'projects_user'
        );

        $this->dropTable('{{%projects_user}}');
    }
}
