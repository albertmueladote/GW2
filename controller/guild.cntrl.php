<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 16:19:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-05 17:59:49
 */
require_once('../conf/conf.php');
$url = explode('/', $_SERVER['REQUEST_URI']);
$current_guild = $url[array_search('guild', $url) + 1];
$is_leader = false;
$_SESSION['current_landing'] = $gw2->cleanString($current_guild);
$_SESSION['current_guild'] = $gw2->cleanString($current_guild);
foreach($current_user_guilds->leader_guilds AS $guild){
   if(strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0){
      $is_leader = true;
   }
}
require_once(VIEW . 'guild.view.php');
?>