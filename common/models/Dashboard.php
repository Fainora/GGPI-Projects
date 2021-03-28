<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dashboard".
 *
 * @property int $id
 * @property int $project_id
 * @property string|null $to_do
 * @property string|null $do
 * @property string|null $done
 * @property string|null $bugs
 * @property string|null $resources
 *
 * @property Projects $project
 */
class Dashboard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dashboard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id'], 'integer'],
            [['to_do', 'do', 'done', 'bugs', 'resources'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'to_do' => 'To Do',
            'do' => 'Do',
            'done' => 'Done',
            'bugs' => 'Bugs',
            'resources' => 'Resources',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
