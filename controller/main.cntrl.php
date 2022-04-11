<?php
/**
 * @Author: Albert
 * @Date:   2022-04-10 18:57:18
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-10 19:01:17
 */

require_once('../conf/conf.php');

if(is_null($current_user->id)){
    $_SESSION['current_landing'] = 'singup';
    require_once(VIEW . 'main.view.php');
}else{
    header('Location: perfil/');
 }