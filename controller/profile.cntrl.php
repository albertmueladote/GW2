<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 12:00:34
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-03 02:11:36
 */

require_once('../conf/conf.php');
require_once(_CLASS . 'user.class.php');
require_once(_CLASS . 'user_guilds.class.php');

$_SESSION['current_landing'] = 'profile';

require_once(VIEW . 'profile.view.php');

?>