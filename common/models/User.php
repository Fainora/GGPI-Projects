<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\Url;
use yii\web\UploadedFile;
use Yii\image\drivers\Image;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const ROLE_USER = 1;
    const ROLE_ADMIN = 10;
    public $file;
    public $tags_array;
    const IMAGES_SIZE = [
        ['160','160'],
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 50],

            ['surname', 'trim'],
            ['surname', 'string', 'min' => 2, 'max' => 50],

            ['name', 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 50],

            ['patronymic', 'trim'],
            ['patronymic', 'string', 'min' => 2, 'max' => 50],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот адрес электронной почты уже занят.'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['image', 'string', 'max' => 255],
            ['note', 'string', 'max' => 100],
            [['file'], 'image', 'extensions' => 'png, jpg, jpeg'],
            [['tags_array','members'], 'safe'], 
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'email' => 'Email',
            'image' => 'Картинка',
            'file' => 'Картинка',
            'smallImage' => 'Картинка',
            'tags_array' => 'Теги',
            'tagsAsString' => 'Теги',
            'fullName' => 'Полное имя',
            'note' => 'Заметки'
        ];
    }

    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'file')){
            $dir = Yii::getAlias('@images').'/user/';
            if (!is_dir($dir . $this->image)) {
                if (file_exists($dir . $this->image)) {
                    unlink($dir . $this->image);
                }
                if (file_exists($dir . '160x160/' . $this->image)) {
                    unlink($dir . '160x160/' . $this->image);
                }
            };
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
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
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $arr = ArrayHelper::map($this->tags, 'id', 'id');
        if (isset($this->tags_array[0])) {
            foreach ($this->tags_array as $tag) {
                if(!in_array($tag, $arr)) {
                    $model = new UserTag();
                    $model->user_id = $this->id;
                    $model->tag_id = $tag;
                    $model->save();
                }
                if(isset($arr[$tag])) {
                    unset($arr[$tag]);
                }
            }
        }
        UserTag::deleteAll(['tag_id'=>$arr,'user_id' => $this->id]);
    }

    public function beforeDelete()
    {
        if(parent::beforeDelete()) {
            $dir = Yii::getAlias('@images').'/user/';
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
            $path = str_replace('admin.','',Url::home(true)).'uploads/user/160x160/'.$this->image;
        } else {
            $path = str_replace('admin.','',Url::home(true)).'uploads/user/160x160/avatar.png';
        }
        return $path;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getUserTag() 
    {
        return $this->hasMany(UserTag::className(),['user_id'=>'id']);
    }

    public function getTags() 
    {
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])->via('userTag');
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

    public function getFullName() 
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public static function roles()
    {
        return [
            self::ROLE_USER => Yii::t('app', 'User'),
            self::ROLE_ADMIN => Yii::t('app', 'Admin'),
        ];
    }

    public function getRoleName(int $id)
    {
        $list = self::roles();
        return $list[$id] ?? null;
    }

    public function isAdmin()
    {
        return ($this->role == self::ROLE_ADMIN);
    }

    public function isUser()
    {
        return ($this->role == self::ROLE_USER);
    }
}
