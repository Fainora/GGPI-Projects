<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property int $number
 */
class Projects extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'number'], 'required'],
            [['description'], 'string'],
            [['number'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['file'], 'image'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'file' => 'Image',
            'number' => 'Number',
        ];
    }
}
