<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 16:19:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 03:33:48
 */

require_once('../conf/conf.php');
require_once(_CLASS . 'user.class.php');
require_once(_CLASS . 'user_guilds.class.php');
require_once(_CLASS . 'guild_blocks.class.php');

$guild_blocks = new guild_blocks();
$guild_blocks->loadBlocks(4);

$_SESSION['current_landing'] = null;
$url = explode('/', $_SERVER['REQUEST_URI']);
$current_guild = $url[array_search('guild', $url) + 1];
$is_leader = false;

foreach($current_user_guilds->leader_guilds AS $guild){
   if(strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0){
      $is_leader = true;
   }
}
 
require_once(VIEW . 'guild.view.php');
?>