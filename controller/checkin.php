<?php 
include '../function.php';
//include '../controller/controller.php';
session_start();
$verifylower = strtolower($_POST['verify']);
$logout = $_GET['logout'];
// check to make sure all fields were entered, if not send them back with a message to fill in the fields
		if($_GET['signup']==1){
			if($_POST['createpwd'] == Null OR $_POST['newemail'] == Null OR $_POST['newun'] == Null){
			header('Location: http://www.kbindrim.com/beer/index.php?pg=login&signup=1&msg=1');
			exit();
			}
			// if they filled in all the fields, I want to check that this is a unique username and email address.
			//$UCheck = UserCheck ($_POST['newun'],$_POST['newemail']);
			elseif(UserCheck ($_POST['newun'],$_POST['newemail']) == false){
			header('Location: http://www.kbindrim.com/beer/index.php?pg=login&signup=1&msg=2');
			exit();
			}
			else{
				if($verifylower === "infinite beer" AND $_POST['createpwd'] === $_POST['conpwd'] AND $_POST['newemail'] === $_POST['conemail']){
					$Password = create_hash($_POST['createpwd']);
					if(Create_User($_POST['newun'], $Password, $_POST['newemail'])){
					header('Location: http://www.kbindrim.com/beer/index.php?pg=login');
					exit();
					}
				}
				else{
					header('Location: http://www.kbindirm.com/beer/index.php?pg=login&signup=1&msg=3');
					exit();
			}
			}
			}
		elseif($logout == null){//else we're simply logging in Need to pull the hashed password from the database for the user entered and check the password
		if(Login_Check($_POST['username'], $_POST['pwd'])){
		$ID = USER_ID($_POST['username']);
		$now = date('Y-m-d H:i:s');
		$_SESSION['TIMESTAMP'] = $now;
		$_SESSION['USERNAME'] = $_POST['username'];
		$_SESSION['ID'] = $ID;
		header('Location: http://www.kbindrim.com/beer/index.php');
		exit();
		}
		else {
				header('Location: http://www.kbindrim.com/beer/index.php?pg=login&msg=4');
				exit();
				}
		}
			if($logout == 1){
			session_destroy();
			header('Location: http://www.kbindrim.com/beer/index.php');
			exit();
			}
?>