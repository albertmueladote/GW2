<?php
/**
 * @Author: Albert
 * @Date:   2022-04-04 19:54:59
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 20:12:07
 */

require_once('../../conf/conf.php');
require_once(_CLASS . 'guild_blocks.class.php');

if(isset($_SESSION['current_guild'])){
    $guild_blocks = new guild_blocks();
    $guild_blocks->loadBlocksByGuildName($gw2->cleanStringSpaces($_SESSION['current_guild']));
    $blocks = array();
    foreach($guild_blocks->blocks AS $block){
        $blocks[$block->row][$block->column]['type'] = $block->type;
        $blocks[$block->row][$block->column]['value'] = $block->value;
    }
    $result = array('result' => $blocks);
}else{
    $result = array('result' => false);
}

echo json_encode($result);
