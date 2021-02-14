<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projects_tag".
 *
 * @property int $id
 * @property int $projects_id
 * @property int $tag_id
 *
 * @property Tag $tag
 * @property Projects $projects
 */
class ProjectsTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projects_id', 'tag_id'], 'required'],
            [['projects_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['projects_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projects_id' => 'Projects ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasOne(Projects::className(), ['id' => 'projects_id']);
    }
}
