<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 12:00:34
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-10 19:03:59
 */

require_once('../conf/conf.php');

if(!is_null($current_user->id)){
    $_SESSION['current_landing'] = 'profile';
    require_once(VIEW . 'profile.view.php');
}else{
    header('Location:' . ROOT);
 }

?>