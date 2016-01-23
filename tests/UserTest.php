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

namespace rhopress\tests;

use rhopress\models\User;
use rhopress\models\Email;
use rhopress\models\Profile;

/**
 * Description of UserTest
 *
 * @author vistart <i@vistart.name>
 */
class UserTest extends TestCase
{

    public function testNew()
    {
        $user = new User();
        $this->assertNotNull($user);
        $this->assertInstanceOf(User::className(), $user);
        $this->assertEmpty($user->id);
    }

    /**
     * @depends testNew
     */
    public function testRegisterSelf()
    {
        $user = new User();
        $result = $user->register();
        if ($result === true) {
            $this->fail(); // ID not assigned.
        } else {
            $this->assertTrue(true);
        }
        $user = new User(['id' => 'rhopress', 'password' => '123456']);
        $result = $user->register();
        if ($result === true) {
            $this->assertTrue($result);
        } else {
            var_dump($user->rules());
            var_dump($$user->errors);
            $this->fail();
        }

        $user = new User(['id' => 'rhopress', 'password' => '123456']);
        $result = $user->register();
        if ($result === true) {
            $this->fail(); // ID existed.
        } else {
            $this->assertTrue(true);
        }

        $user = User::find()->id('rhopress')->one();
        $this->assertNotNull($user);
        $this->assertInstanceOf(User::className(), $user);
        $this->assertTrue($user->deregister());
    }

    private function prepareUser($id = null, $password = null)
    {
        if (empty($id)) {
            $id = 'rhopress';
        }
        if (empty($password)) {
            $password = '123456';
        }
        return new User(['id' => $id, 'password' => $password]);
    }

    /**
     * @depends testRegisterSelf
     */
    public function testRegisterEmail()
    {
        $user = $this->prepareUser();
        $email = $user->create(Email::className(), ['email' => 'dev@rho.press']);
        $this->assertTrue($user->register([$email]));
        $user = User::find()->id('rhopress')->one();
        $this->assertInstanceOf(User::className(), $user);
        $email = $user->emails[0];
        $this->assertInstanceOf(Email::className(), $email);
        $this->assertEquals($user, $email->user);
        $this->assertTrue($user->deregister());
        $email = Email::find()->content('dev@rho.press')->one();
        $this->assertNull($email);
    }

    /**
     * @depends testRegisterEmail
     */
    public function testRegisterProfile()
    {
        $user = $this->prepareUser();
        $profile = $user->create(Profile::className(), ['nickname' => 'rhopress']);
        $result = $user->register([$profile]);
        if ($result === true) {
            $this->assertTrue($result);
        } else {
            var_dump($user->errors);
            var_dump($profile->errors);
            $this->fail();
        }
        $user = User::find()->id('rhopress')->one();
        $profile = $user->profile;
        $this->assertInstanceOf(Profile::className(), $profile);
        $this->assertEquals($user, $profile->user);
        $this->assertTrue($user->deregister());
    }

    /**
     * @depends testRegisterProfile
     */
    public function testRegisterProfileEmail()
    {
        $user = $this->prepareUser();
        $profile = $user->create(Profile::className(), ['nickname' => 'rhopress']);
        $email = $user->create(Email::className(), ['email' => 'dev@rho.press']);
        $this->assertTrue($user->register([$profile, $email]));
        $this->assertTrue($user->deregister());
    }
}