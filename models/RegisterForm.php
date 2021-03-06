<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license http://vistart.name/license/
 */

namespace rhopress\models;

use Yii;

/**
 * Description of RegisterForm
 *
 * @since 1.0
 * @author vistart <i@vistart.name>
 */
class RegisterForm extends \yii\base\Model
{

    public $username;
    public $email;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            ['username', 'string', 'min' => 4, 'max' => 32],
            ['email', 'email'],
            ['password', 'string', 'min' => 6, 'max' => 32],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app', ('The confirm password should be consistent with password.'))],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new User(['username' => $this->username, 'password' => $this->password]);
        $profile = $user->create(Profile::className(), ['nickname' => $this->username, 'display_name' => $this->username]);
        $email = $user->create(Email::className(), ['email' => $this->email]);
        return $user->register([$profile, $email]);
    }
}
