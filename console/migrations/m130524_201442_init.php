<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'patronymic' => $this->string(),
            'role' => $this->smallInteger()->defaultValue(1));
            'email' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'image' => $this->string(),
        ], $tableOptions);

        $password_hash = Yii::$app->getSecurity()->generatePasswordHash('123456');
        $auth_key = Yii::$app->security->generateRandomString();
        $time = time();
        $this->insert('{{%user}}', [
            'username' => 'Admin',
            'surname' => 'Admin',
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password_hash' => $password_hash,
            'auth_key' => $auth_key,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    public function down()
    {
        $this->delete('{{%user}}', ['id' => 1]);
        $this->dropTable('{{%user}}');
    }
}
