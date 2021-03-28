<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dashboard}}`.
 */
class m210323_074527_create_dashboard_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dashboard}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull(),
            'to_do' => $this->string(),
            'do' => $this->string(),
            'done' => $this->string(),
            'bugs' => $this->string(),
            'resources' => $this->string()
        ]);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-dashboard-project_id',
            'dashboard',
            'project_id'
        );

        // add foreign key for table `project`
        $this->addForeignKey(
            'fk-dashboard-project_id',
            'dashboard',
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
         // drops foreign key for table `project`
         $this->dropForeignKey(
            'fk-dashboard-project_id',
            'dashboard'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-dashboard-project_id',
            'dashboard'
        );

        $this->dropTable('{{%dashboard}}');
    }
}
