<?php

/*
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link http://vistart.name/
 * @copyright Copyright (c) 2016 vistart
 * @license http://vistart.name/license/
 */

namespace rhopress\tests;

use rhopress\models\RegisterForm;
use rhopress\models\User;

/**
 * Description of RegisterFormTest
 *
 * @author vistart <i@vistart.name>
 */
class RegisterFormTest extends TestCase
{

    public function testNew()
    {
        $registerForm = new RegisterForm();
        $username = 'rhopress' . \Yii::$app->security->generateRandomString(4);
        $registerForm->attributes = ['username' => $username , 'email' => 'dev-register@rho.press', 'password' => '123456', 'confirm_password' => '123456'];
        $this->assertTrue($registerForm->register());
        $user = User::find()->id($username)->one();
        $this->assertTrue($user->deregister());
    }
}
