# jsnlib-joomla_database_eloquent
輔助 Eloquent 在 Joomla! Model 中的使用

## 安裝
````
composer require jsnlib/joomla_database_eloquent
````

## 使用方式

使用別名為 Helper
````php
use Jsnlib\Joomla\Database\Eloquent\Helper;
````

請務必從外部連線以後才指定給 Helper。這樣可以連線不同的資料庫
````php
$builder = DB::connection('mysql');
Helper::connectionEloquent($builder);
// OR
$builder = DB::connection('mysql_custom');
Helper::connectionEloquent($builder);
````

````php
Helper::proccess(true, function () use ($param)
{
    // ...
});
````

## 範例
這裡示範一個連接的方式
````php
require_once 'vendor/autoload.php';
use Jsnlib\Joomla\Database\Eloquent\Helper;
use Illuminate\Database\Capsule\Manager as DB;

$db = new DB;
 
$db->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$db->addConnection([
    //...
], "mysql_custom");
 
$db->setAsGlobal();
$db->bootEloquent();

// 連線一
$builder = DB::connection();
Helper::connectionEloquent($builder);
Helper::proccess(true, function ($builder) use ($param)
{
    //....
});

// 連線二
$builder = DB::connection('mysql_custom');
Helper::connectionEloquent($builder);
Helper::proccess(true, function ($builder) use ($param)
{
    //....
});
````