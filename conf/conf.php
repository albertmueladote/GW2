<?php
/**
 * @Author: Albert
 * @Date:   2022-03-25 12:35:21
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 03:11:35
 */

session_start();

//define("ROOT", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/gw2/');
define("ROOT", (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/gw2/');
define("PATH", $_SERVER['DOCUMENT_ROOT'] . '/gw2/');
define("_CLASS", PATH . "class/");
define("VIEW", PATH . "view/");
define("CONTROLLER", "../controller/");
define("CSS", "../view/css/");
define("JS", "../view/js/");
define("BLOCKS", PATH . "view/blocks/");
define("MEDIA", "../view/media/");
define("TOOLS", "../tools/");

define("URL_API", "https://api.guildwars2.com/v2/");
define("URL_KEY_API", "?access_token=");
define("URL_GUILD_API", 'guild/');

define("HOST_DB", "localhost");
define("USER_DB", "root");
define("PASSWORD_DB", "");
define("DATABASE_DB", "gw2");

define("PASSWORD", "NF#%=cU5LyGcE*?$]+BE%]u}J@qPrG(4");
define("SESSION_NAME", "gw2asurlogin");
define("SESSION_USER", "user");
define("SESSION_USER_GUILDS", "user_guilds");

require_once(_CLASS . 'gw2.class.php');
require_once(_CLASS . 'user.class.php');
require_once(_CLASS . 'user_guilds.class.php');

$gw2 = new gw2();
$current_user = null;
$current_user_guilds = null;

if(isset($_SESSION[SESSION_NAME])){
	if($_SESSION[SESSION_NAME]) {
		$current_user = new user($_SESSION[SESSION_NAME]);
		$current_user_guilds = new user_guilds($current_user->id);
	}
}

?>