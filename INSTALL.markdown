Install
=======

1.	Create a database for Publish It Yourself and a user with all rights on this database.
2.	Go into the ```piy`` directory.
3.	Run ``php symfony configure:database "mysql:host=localhost;dbname=piy" username password`` to configure the database access. Here it's for MySQL, you can use any database type supported by PDO.
3.	Run ``chmod -R 777 cache log plugins/sfXssSafePatchedPlugin/lib/vendor/htmlpurifier/HTMLPurifier/DefinitionCache/Serializer`` to allow HTMLPurifier to work.
4.	Run ``php symfony fix-perms`` to set corrects files permissions.
5.	Run `php symfony plugin:publish-assets`` to put data of the plugins in the corrects directories.
6.	Run ``php symfony propel:build-all`` to generate some needed code.

You are done!
