<?php
/**
 * @Author: Albert
 * @Date:   2022-04-05 17:05:36
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-09 05:24:40
 */
require_once('../conf/conf.php');
require_once(_CLASS . 'guilds.class.php');

$_SESSION['current_landing'] = 'guilds';

require_once(VIEW . 'guilds.view.php');
