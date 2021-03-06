Alliance Company Group
======================

Based on Basic Project Template of [Yii 2 Framework](http://www.yiiframework.com/).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

MODULES STRUCTURE
-------------------

      main/               contains main, error, login and logout actions
      user/               contains Identity interface, view, update profile, change password actions
      admin/              contains User, Companies and Positions administration CRUD actions
      alliance/			  contains Creditcalendar CRUD action
      skoda/              contains Service Sheduler, Statusmonitor actions for Skoda StrelaAvto

INSTALLATION
------------

Clone the repository for pull command availability:

~~~
git clone https://github.com/m-ishchenko/AllianceCG.git project
cd project
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer install
~~~

Setup virtual host on web server to project directory

Init an environment:

~~~
php init
~~~

Fill your DB connection information in config/common.php and execute migrations:

~~~
php yii migrate
~~~

Default user/password - admin/admin

Sign up or create first user manually

~~~
php yii user/users/create
~~~


After that need init RBAC for assign roles

~~~
php yii rbac/init
~~~


Also check and edit the other files in the `config/` directory to customize your application.
=======
