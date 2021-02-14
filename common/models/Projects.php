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
            [['title', 'max_number'], 'required'],
            [['description'], 'string'],
            [['max_number', 'user_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['tags_array','members'], 'safe'],
            [['file'], 'image'],
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
                if (file_exists($dir . '80x80/' . $this->image)) {
                    unlink($dir . '80x80/' . $this->image);
                }
            };
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff', 0);
            $imag->resize('80','80',Image::INVERSE);
            $imag->crop('80','80');
            if(!file_exists($dir.'80x80/')){
             FileHelper::createDirectory($dir.'80x80/');
            }
            $imag->save($dir.'80x80/'.$this->image, 90);
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

    public function getSmallImage() 
    {
        if($this->image) {
            $path = str_replace('admin.','',Url::home(true)).'uploads/projects/80x80/'.$this->image;
        } else {
            $path = str_replace('admin.','',Url::home(true)).'uploads/projects/80x80/no_image.png';
        }
        return $path;
    }

    public function getCreater() 
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    
    public function getProjectsTag() 
    {
        return $this->hasMany(ProjectsTag::className(),['project_id'=>'id']);
    }

    public function getTags() 
    {
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])->via('projectsTag');
    }

    public function getTagsAsString() 
    {
        $arr = ArrayHelper::map($this->tags, 'id', 'title');
        return implode(', ',$arr);
    }

    public function afterFind() 
    {
        $this->tags_array = $this->tags;
    }

    public function isMember($userId)
    {
        return ProjectsUser::find()->andWhere([
            'project_id' => $this->id,
            'user_id' => $userId
        ])->one();
    }

    public function getMembers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable('projects_user', ['project_id' => 'id']);
    }
}
