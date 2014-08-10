<?php
//error_reporting(0);
//use RedBean_Facade as R;
session_start();
require 'redbean/rb.php';
require 'config/config.php';
include_once 'function.php';
include_once 'controller/controller.php';
include_once 'model/model.php';
//  FOR TESTING LOGGIN ROUTER
$_SESSION['ID'] = null;

R::setup($config['dsn'],$config['dbuser'],$config['dbpass']);

$page = $_GET['pg'];
$route = new router($page);
include_once 'view/header.php';
include_once $route->page;
$header = new header();

/**
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
 */
//$users = R::dispense( 'USERS' );
//$users->USERNAME = 'Admin';
//$users->PASSWORD = 'root';
//$users->EMAIL = 'email';
//$id = R::store( $users );
//echo $id . "<- thats the id";
?>	