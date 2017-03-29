<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends ARModel implements IdentityInterface
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user';
    }


    public function rules()
    {
        return [
            [['name', 'email'], 'trim'],
            [['name', 'password', 'email', 'phone'], 'required', 'message'=>'Это обязательное поле'],
            [['name', 'email', 'phone'], 'string', 'max' => 50],
            [['name'], 'unique', 'message' => 'Такой пользователь уже существует'],
            ['email', 'validateEmail'],
            ['name', 'validateName'],
            ['phone', 'validatePhone'],
            [['id', 'role_id'], 'integer'],
            ['role_id', 'validateRole'],
            ['role_id', 'default', 'value'=>2]
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['name' => $username]);
    }


    public function getUsername() {
        return $this->name;
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
//        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
//        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return  $this->password === $this->getHashPass($password);
    }


    public function beforeSave($insert) {
        if(!$insert) {
            return parent::beforeSave($insert);
        }

        if(parent::beforeSave($insert)) {
            $this->hashPass();
            return true;
        }

        return false;
    }


    public function validateEmail() {
        if (!preg_match('/^[a-z-_.0-9]+@[a-z0-9-_.]+\.[a-z]{2,6}$/', $this->email)) {
            $this->addError('email', 'Введите корректный email');
        }
    }


    public function validateName() {
        if (!preg_match('/^[a-z0-9]+$/i', $this->name)) {
            $this->addError('name', 'Логин может состаться только из латинских символов и цифр');
        }
    }


    public function validateRole() {
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role_id == 1
            && Yii::$app->user->identity->id == $this->id && $this->role_id != 1) {
            $this->addError('role_id', 'Вы не можете назначить себе роль ниже админской');
        }
    }


    public function validatePhone() {
        if (!preg_match("/(8|7|\+7){0,1}[- \\\\(]{0,}([9][0-9]{2})[- \\\\)]{0,}(([0-9]{2}[-
                        ]{0,}[0-9]{2}[- ]{0,}[0-9]{3})|([0-9]{3}[- ]{0,}[0-9]{2}[- ]{0,}[0-9]{2})|([0-9]{3}[-
                        ]{0,}[0-9]{1}[- ]{0,}[0-9]{3})|([0-9]{2}[- ]{0,}[0-9]{3}[- ]{0,}[0-9]{2}))/", $this->phone)) {
            $this->addError('phone', 'Введите корректный номер мобильного телефона, например: +7 999 1234567');
        }
    }


    public function getRole() {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    public function getHashPass($password) {
        return md5(md5($password).md5($password));
    }


    public function hashPass() {
        if($this->password)
            $this->password = $this->getHashPass($this->password);
        return true;
    }

}
