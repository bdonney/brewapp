<?php
include_once 'header.php';
include_once 'function.php';
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
?>	