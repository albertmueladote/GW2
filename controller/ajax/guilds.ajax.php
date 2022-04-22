<?php
/**
 * @Author: Albert
 * @Date:   2022-04-06 03:11:24
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-19 20:37:54
 */

require_once('../../conf/conf.php');
require_once(_CLASS . 'guilds.class.php');

$guilds = new guilds();
$guilds->loadAll();

$array = array();

foreach($guilds->guilds AS $guild){
    $result['result'][$guild->id]['url'] = ROOT . 'guild/' . $gw2->cleanString($guild->name);
    $result['result'][$guild->id]['name'] = $guild->name;
    $result['result'][$guild->id]['preferences'] = array_rand(array('PvE' => 1, 'McM' => 2, 'PvP' => 3, 'Rol' => 4, 'Carreras' => 5));
    $result['result'][$guild->id]['activity'] = array_rand(array('L,M,X,J,V' => 1, 'L,X,V' => 2, 'S' => 3, 'M,J,S' => 4, 'L,M,X,J,V,S,D' => 5));
}

echo json_encode($result);
