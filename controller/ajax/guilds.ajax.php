<?php
/**
 * @Author: Albert
 * @Date:   2022-04-06 03:11:24
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:37:32
 */

require_once('../../conf/conf.php');
require_once(_CLASS . 'guilds.class.php');

$guilds = new guilds();
$guilds->loadAll();

$array = array();

$x = 0;
foreach($guilds->guilds AS $guild){
    $result['result'][$x]['name'] = $guild->name;
    $result['result'][$x]['preferences'] = array_rand(array('PvE' => 1, 'McM' => 2, 'PvP' => 3, 'Rol' => 4, 'Carreras' => 5));
    $result['result'][$x]['activity'] = array_rand(array('L,M,X,J,V' => 1, 'L,X,V' => 2, 'S' => 3, 'M,J,S' => 4, 'L,M,X,J,V,S,D' => 5));
    $x++;
}

echo json_encode($result);
