<?php

use yii\db\Migration;

/**
 * Class m210415_115041_add_title_tag
 */
class m210415_115041_add_title_tag extends Migration
{
    public function safeUp()
    {
        //type: 0 - Project; 1 - User
        $this->batchInsert('{{%tag}}',
            [
                'title',
                'type'
            ],
            [
                ['Html', '0'],
                ['CSS', '0'],
                ['PHP', '0'],
                ['JavaScript', '0'],
                ['Java', '0'],
                ['Java', '0'],
                ['C/C++', '0'],
                ['C#', '0'],
                ['Yii2', '0'],
                ['Laravel', '0'],
                ['Unity', '0'],

                ['Программист', '1'],
                ['Аналитик', '1'],
                ['Тестировщик', '1'],
                ['Юрист', '1'],
                ['Художник', '1'],
                ['Дизайнер', '1'],
                ['Звуковик', '1'],
                ['Менеджер', '1'],
            ]
        );
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('tag', ['in', 'title', ['Html', 'Css', 'PHP', 'JavaScript', 'Java', 
            'C/C++', 'C#', 'Yii2', 'Laravel', 'Unity','Программист', 'Аналитик', 'Тестировщик', 'Юрист', 'Художник', 
            'Дизайнер', 'Звуковик', 'Менеджер']])->execute();
    }
}
