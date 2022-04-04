<?php
/**
 * @Author: Albert
 * @Date:   2022-04-02 00:49:18
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-03 02:12:31
 */

session_start();

if(isset($_POST['name']) && isset($_POST['value'])){
	$_SESSION[$_POST['name']] = $_POST['value'];
	$result = array('result' => true);
}else{
	$result = array('result' => false);
}

echo json_encode($result);

?>