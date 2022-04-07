<?php
/**
 * @Author: Albert
 * @Date:   2022-04-05 17:05:36
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:12:30
 */

require_once('../conf/conf.php');
require_once(_CLASS . 'guilds.class.php');

$_SESSION['current_landing'] = 'guilds';

$page = "guilds";
require_once(VIEW . 'layout.view.php');
