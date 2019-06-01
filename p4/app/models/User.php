<?php

require 'Core/Model.php';

class User extends Model
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $name;
    public $authKey;
    public $accessToken;
    
    public function __construct() 
    {
        $this->table="productos";
    }



    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
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
    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function save()
    {
        $query="INSERT INTO users (username,name,password,email)
                VALUES('".$this->username."',
                       '".$this->name."',
                       '".$this->password."',
                       '".$this->email."');";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }
}


?>