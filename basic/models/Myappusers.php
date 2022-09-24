<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "myappusers".
 *
 * @property int $id
 * @property string $username
 * @property string $authtoken
 * @property int $password
 */
class Myappusers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'myappusers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'username', 'authtoken', 'password'], 'required'],
            [['id', 'password'], 'integer'],
            [['username', 'authtoken'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'authtoken' => Yii::t('app', 'Authtoken'),
            'password' => Yii::t('app', 'Password'),
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
