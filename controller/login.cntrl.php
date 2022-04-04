<?php
/**
 * @Author: Albert
 * @Date:   2022-03-29 13:45:26
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-03 02:11:31
 */
	
require_once('../conf/conf.php');
require_once('../class/user.class.php');

if(isset($_POST['name']) && isset($_POST['password'])){
	$user = new user();
	$user->name = $_POST['name'];
	$user->password = hash("sha256", PASSWORD . $_POST['password']);
	$user->login();
	if(is_null($user->id)){
		$_SESSION[SESSION_NAME] = false;	
	}else{
		$_SESSION[SESSION_NAME] = $user->id;	
	}
}else{
	unset($_SESSION[SESSION_NAME]);
}

header('Location: ' . ROOT);
?>