<?php
/**
 * @Author: Albert
 * @Date:   2022-04-10 04:18:09
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-10 17:38:34
 */

require_once('../conf/conf.php');
require_once('../class/session.class.php');

if(isset($_COOKIE[COOKIE_NAME])){
    $session = new session($_COOKIE[COOKIE_NAME]);
    $session->remove();
    unset($_COOKIE[COOKIE_NAME]);
    setcookie(COOKIE_NAME, null, time() - COOKIE_EXPIRE_TIME, '/');
    $current_user = null;
    $current_user_guilds = null;
    session_destroy();
}

header('Location: ' . ROOT);
?>