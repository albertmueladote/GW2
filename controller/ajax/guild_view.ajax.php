<?php
/**
 * @Author: Albert
 * @Date:   2022-04-04 19:54:59
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-20 10:39:52
 */

require_once('../../conf/conf.php');
require_once(_CLASS . 'guild_blocks.class.php');

if(!is_null($current_user_guilds->user)){
    $guild_blocks = new guild_blocks();
    $guild_blocks->loadBlocksByGuildName($gw2->cleanStringSpaces($_SESSION['current_guild']));
    $blocks = array();
    foreach($guild_blocks->blocks AS $block){
        $blocks[$block->row][$block->column]['type'] = $block->type;
        if(strcmp($block->type, 'text') == 0){
            $blocks[$block->row][$block->column]['text'] = $block->value;
        }else if(strcmp($block->type, 'image') == 0){
            $blocks[$block->row][$block->column]['src'] = MEDIA . 'guilds/' . $gw2->cleanString($_SESSION['current_guild']) . '/' . $block->value;
        }
        $blocks[$block->row][$block->column]['extra'] = $block->extra;
    }
    $result = array('result' => $blocks);
}else{
    $result = array('result' => false);
}

echo json_encode($result);

