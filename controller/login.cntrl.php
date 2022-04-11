<?php
/**
 * @Author: Albert
 * @Date:   2022-03-29 13:45:26
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-10 17:38:20
 */

require_once('../conf/conf.php');
require_once('../class/user.class.php');
require_once('../class/session.class.php');

if(isset($_POST['name']) && isset($_POST['password'])){
	$user = new user();
	$user->name = $_POST['name'];
	$user->password = hash("sha256", PASSWORD . $_POST['password']);	
	$user->login();
	if(!is_null($user->id)){
		setcookie(COOKIE_NAME, session_id(), time() + COOKIE_EXPIRE_TIME, '/');
		$session = new session();
		$session->id = session_id();
		$session->data = $user->id;
		$session->save();
	}
}

header('Location: ' . ROOT);
?>