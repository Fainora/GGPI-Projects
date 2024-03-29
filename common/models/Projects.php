<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use Yii\image\drivers\Image;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property int $max_number
 */
class Projects extends \yii\db\ActiveRecord
{
    public $tags_array;
    public $members;
    public $file;
    const IMAGES_SIZE = [
        ['160','160'],
    ];

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
            [['title', 'max_number', 'description'], 'required'],
            [['description'], 'string'],
            ['user_id', 'integer'],
            ['max_number', 'integer', 'min' => 1, 'max' => 15],
            [['title', 'image'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['tags_array','members'], 'safe'],
            [['file'], 'image', 'extensions' => 'png, jpg, jpeg'],
            ['user_id', 'default', 'value' => Yii::$app->user->identity->id ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название проекта',
            'description' => 'Описание',
            'image' => 'Картинка',
            'file' => 'Картинка',
            'smallImage' => 'Картинка',
            'max_number' => 'Количество участников',
            'user_id' => 'Создатель',
            'creater.username' => 'Создатель',
            'tags_array' => 'Теги',
            'tagsAsString' => 'Теги',
            'members' => 'Участники',
            'created_at:datetime' => 'Дата создания'
        ];
    }

    public function behaviors()
    {
        return [
                [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false
                ],  
                TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'file')){
            $dir = Yii::getAlias('@images').'/projects/';
            if (!is_dir($dir . $this->image)) {
                if (file_exists($dir . $this->image)) {
                    unlink($dir . $this->image);
                }
                if (file_exists($dir . '160x160/' . $this->image)) {
                    unlink($dir . '160x160/' . $this->image);
                }
            };
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . 
                '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff', 0);
            $imag->resize('160','160',Image::INVERSE);
            $imag->crop('160','160');
            if(!file_exists($dir.'160x160/')){
             FileHelper::createDirectory($dir.'160x160/');
            }
            $imag->save($dir.'160x160/'.$this->image, 90);
        }
        return parent::beforeSave($insert);

        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->user->id;
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $arr = ArrayHelper::map($this->tags, 'id', 'id');
        if (isset($this->tags_array[0])) {
            foreach ($this->tags_array as $tag) {
                if(!in_array($tag, $arr)) {
                    $model = new ProjectsTag();
                    $model->project_id = $this->id;
                    $model->tag_id = $tag;
                    $model->save();
                }
                if(isset($arr[$tag])) {
                    unset($arr[$tag]);
                }
            }
        }
        ProjectsTag::deleteAll(['tag_id'=>$arr,'project_id' => $this->id]);
    }

    public function beforeDelete()
    {
        if(parent::beforeDelete()) {
            $dir = Yii::getAlias('@images').'/projects/';
            if (!is_dir($dir . $this->image)) { 
              if (file_exists($dir . $this->image)) {
                unlink($dir . $this->image);
              }
            }
 
            foreach (self::IMAGES_SIZE as $size) {
                $size_dir = $size[0].'x';
                if($size[1] !== null) {
                    $size_dir .= $size[1];
                }
                if (!is_dir($dir . $size_dir . '/' . $this->image)) { 
                    if (file_exists($dir . $size_dir . '/' . $this->image)) {
                           unlink($dir . $size_dir . '/' . $this->image);
                    }
               }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getSmallImage() 
    {
        if($this->image) {
            $path = str_replace('admin', '', Url::home(true)).'uploads/projects/160x160/'.$this->image;
        } else {
            $path = str_replace('admin', '', Url::home(true)).'uploads/projects/160x160/no_image.png';
        }
        return $path;
    }

    public function getCreater() 
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    
    public function getProjectsTag() 
    {
        return $this->hasMany(ProjectsTag::className(), ['project_id'=>'id']);
    }

    public function getTags() 
    {
        return $this->hasMany(Tag::className(), ['id'=>'tag_id'])->via('projectsTag');
    }

    public function getTagsAsString() 
    {
        $arr = ArrayHelper::map($this->tags, 'id', 'title');
        return implode(', ', $arr);
    }

    public function afterFind() 
    {
        $this->tags_array = $this->tags;
    }

    public function isMember($userId)
    {
        return ProjectsUser::find()->where(['status' => 2])
            ->andWhere([
                'project_id' => $this->id,
                'user_id' => $userId,
            ])->one();
    }

    public function isWaitingMember($userId)
    {
        return ProjectsUser::find()->where(['status' => 1])
        ->andWhere([
            'project_id' => $this->id,
            'user_id' => $userId,
        ])->one();
    }
}
