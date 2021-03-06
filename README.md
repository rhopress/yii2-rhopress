Yii 2 Rho Press
===============
The Base Components of Rho Press

[![Join the chat at https://gitter.im/rhopress/yii2-rhopress](https://badges.gitter.im/rhopress/yii2-rhopress.svg)](https://gitter.im/rhopress/yii2-rhopress?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![License](https://poser.pugx.org/rhopress/yii2-rhopress/license)](https://packagist.org/packages/rhopress/yii2-rhopress)
[![Build Status](https://img.shields.io/travis/rhopress/yii2-rhopress.svg)](http://travis-ci.org/rhopress/yii2-rhopress)
[![Dependency Status](https://www.versioneye.com/user/projects/56a328509b5998003d000098/badge.svg)](https://www.versioneye.com/user/projects/56a328509b5998003d000098)
[![Code Climate](https://img.shields.io/codeclimate/github/rhopress/yii2-rhopress.svg)](https://codeclimate.com/github/rhopress/yii2-rhopress)

Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download).

Either run:
~~~
php composer.phar require rhopress/yii2-rhopress:dev-master
~~~

or add
~~~
"rhopress/yii2-rhopress": "dev-master"
~~~
to the require section of your `composer.json` file.

Usage
-----
Once this extension is installed, you can simply add `rhopress` module to the
`module` section of main config of your project, like following:
```php
$config = [
    ...
    'module' => [
        ...
        'rhopress' => [
            'class' => 'rhopress\Module'
        ],
        ...
    ],
    ...
]
```

If you want to use it in bootstrap process, please attach the module name into
`bootstrap` section, like following:
```php
$config = [
    ...
    'bootstrap' => [
        ...
        'rhopress'
        ...
    ],
    ...
]
```

[![yii2-rhopress](https://img.shields.io/badge/Powered_by-rhopress-green.svg?style=flat)](https://rho.press)
