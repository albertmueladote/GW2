<?php
/**
 * @Author: Albert
 * @Date:   2022-04-21 13:03:54
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 16:00:27
 */

require_once('../../conf/conf.php');
require_once(_CLASS . 'guild.class.php');
require_once(_CLASS . 'guild_block.class.php');

    
 if(isset($_POST['type']) && isset($_POST['value']) && isset($_POST['extra']) && isset($_POST['row']) && isset($_POST['column'])){
    $guild = new guild();
    $guild->name = $gw2->cleanStringSpaces($_SESSION['current_guild']);
    $guild->loadByName();

    $guild_block = new guild_block();
    $guild_block->guild = $guild->id;
    $guild_block->type = $_POST['type'];
    $guild_block->value = $_POST['value'];
    $guild_block->extra = $_POST['extra'];
    $guild_block->row = $_POST['row'];
    $guild_block->column = $_POST['column'];

    if($guild_block->loadByGuildRowColumn()){
        $guild_block->type = $_POST['type'];
        $guild_block->value = $_POST['value'];
        $guild_block->extra = $_POST['extra'];
        $guild_block->update();
    }else{
        $guild_block->type = $_POST['type'];
        $guild_block->value = $_POST['value'];
        $guild_block->extra = $_POST['extra'];
        $guild_block->row = $_POST['row'];
        $guild_block->column = $_POST['column'];
        $guild_block->save();
    }
    $result = array('result' => true);
 }else if(isset($_POST['row']) && isset($_POST['column']) && isset($_POST['remove'])){
    $guild = new guild();
    $guild->name = $gw2->cleanStringSpaces($_SESSION['current_guild']);
    $guild->loadByName();

    $guild_block = new guild_block();
    $guild_block->guild = $guild->id;
    $guild_block->row = $_POST['row'];
    $guild_block->column = $_POST['column'];

    if($guild_block->loadByGuildRowColumn()){
        $guild_block->remove();
    }
    $result = array('result' => true);
}else{
	$result = array('result' => false);
}

echo json_encode($result);