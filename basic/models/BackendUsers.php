<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;



class BackendUsers extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface{



    public static function tableName()
    {
        return 'BackendUsers';
    }


    public function rules()
    {
        return [
            [['id', 'username', 'password', 'authkey'], 'required'],
            [['id', 'password', 'authkey'], 'integer'],
            [['username'], 'string', 'max' => 20],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authkey' => 'Authkey',
        ];
    }


    public static function findByUsername($username){

        return self::findOne(['username'=>$username]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new self::$users[$id] : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return $this->authkey;
    }


    public function validateAuthKey($authkey)
    {
        return $this->authkey === $authkey;
    }


    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
