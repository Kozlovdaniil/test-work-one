<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignUpForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $phone;
    public $name;
    public $role;

    private $_user;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['password', 'string', 'min' => 6],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['phone', 'string', 'max' => 12 ],
            ['role', 'safe']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->role = $this->role;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            return Yii::$app->user->login($user, 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
