<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 3/7/20
 * Time: 12:29 PM
 */


use Illuminate\Database\Capsule\Manager;

require_once "vendor/autoload.php";


$config = array(
    'driver' 	=> 'mysql',
    'host' 		=> '192.168.1.111',
    'database' 	=> 'chat',
    'username' 	=> 'remote',
    'password' 	=> 'qwerty',
    'charset' 	=> 'utf8',
    'collation'	=> 'utf8_general_ci'
);

$capsule = new Manager();
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$opr = new \Indilabz\Chat();

echo json_encode($opr->blockUser(1, 'one'));




