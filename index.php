<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 11:55:41
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-11 12:43:48
 */

require_once ('conf/conf.php');

if(!is_null($current_user->id)){
    header('Location: perfil/');
}else{
    header('Location: registrarse/');
}