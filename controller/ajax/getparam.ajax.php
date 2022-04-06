<?php
/**
 * @Author: Albert
 * @Date:   2022-04-02 02:34:09
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 19:56:59
 */

if(isset($_POST['name']) && isset($_POST['from'])){
	if(strcmp($_POST['from'], 'conf') == 0){
		if(defined(strtoupper($_POST['name']))){
			$constants = POST_defined_constants(true);
			$result = array('result' => $constants['user'][strtoupper($_POST['name'])]);
		}else{
			$result = array('result' => false);
		}
	}elseif(strcmp($_POST['from'], 'session') == 0){
		if(isset($_SESSION[$_POST['name']])){
			$result = array('result' => $_SESSION[$_POST['name']]);
		}else{
			$result = array('result' => false);
		}
	}
}else{
	$result = array('result' => false);
}

echo json_encode($result);

?>