<?php
require 'vendor/autoload.php';
require 'config/config.php';
include_once 'header.php';
include_once 'function.php';
session_start();

use RedBean_Facade as R;
R::setup($config['dsn'],$config['dbuser'],$config['dbpass']);

$Page = $_GET['pg'];
if($Page === "login"){
include 'view/login.php';
}
elseif($Page === "home"){
include 'view/myrecipes.php';
}
elseif($Page === "recipe"){
include 'view/recipe.php';
}
else{
include 'view/home.php';
}
$users = R::dispense( 'USERS' );
$users->USERNAME = 'Admin';
$users->PASSWORD = 'root';
$users->EMAIL = 'email';
$id = R::store( $users );
?>	