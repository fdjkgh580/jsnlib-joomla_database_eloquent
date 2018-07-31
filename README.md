# jsnlib-joomla_database_eloquent
輔助 Eloquent 在 Joomla! Model 中的使用

## 安裝
````
composer require jsnlib/joomla_database_eloquent
````

## 使用方式

使用別名為 Helper
````php
use Jsnlib\Joomla\Database\Eloquent\Helper as Helper;
````

請務必從外部連接資料庫以後，才指定給 Helper
````php
Helper::setEloquentName('Illuminate\Database\Capsule\Manager');

Helper::proccess(true, function () use ($param)
{

});
````

## 範例
這裡示範一個連接的方式
````php
require_once 'vendor/autoload.php';
use Jsnlib\Joomla\Database\Eloquent\Helper as Helper;
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
 
$db->setAsGlobal();
$db->bootEloquent();

Helper::setEloquentName('Illuminate\Database\Capsule\Manager');

Helper::proccess(true, function () use ($param)
{
    //....
});
````