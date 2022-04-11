<?php
/**
 * @Author: Albert
 * @Date:   2022-03-26 00:10:40
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-11 03:08:43
 */
?>
<link rel="stylesheet" href="<?php echo CSS . 'topmenu.css'?>">
<div class="topnav">
  <?php if(!is_null($current_user->id)){ ?>
    <a class="<?php echo (strcmp($_SESSION['current_landing'], 'profile') === 0 ? 'active' : ''); ?> profile" href="<?php echo ROOT . 'perfil/'; ?>"><?php echo $current_user->name; ?></a>
  <?php }else{ ?>
    <a class="<?php echo (strcmp($_SESSION['current_landing'], 'singup') === 0 ? 'active' : ''); ?> profile" href="<?php echo ROOT . 'registrarse/'; ?>">Registrarse</a>
  <?php } ?>  
  <a class="<?php echo (strcmp($_SESSION['current_landing'], 'guilds') === 0 ? 'active' : ''); ?> guilds" href="<?php echo ROOT . 'clanes/'; ?>">Clanes</a>
  <?php if(!is_null($current_user->id)){ ?>  
    <?php foreach($current_user_guilds->leader_guilds AS $guild) {?>
      <a class="guild <?php echo (isset($current_guild) ? (strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0 ? 'active' : '') : ''); ?>" data-name="<?php echo $gw2->cleanString($guild->name); ?>" href="<?php echo ROOT . 'guild/' . $gw2->cleanString($guild->name); ?>">
        <img class="img-fluid" alt="red_tag" src="<?php echo MEDIA . 'red_tag.png' ?>" /><?php echo $guild->name; ?>
      </a>
    <?php } ?>
    <?php foreach($current_user_guilds->member_guilds AS $guild) {?>
      <a class="guild <?php echo (isset($current_guild) ? (strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0 ? 'active' : '') : ''); ?>" data-name="<?php echo $gw2->cleanString($guild->name); ?>" href="<?php echo ROOT . 'guild/' . $gw2->cleanString($guild->name); ?>">
        <?php echo $guild->name; ?>
      </a>
    <?php } ?>
  <?php } ?>
  <div class="login-container">
    <?php if(!is_null($current_user->id)){ ?>
      <a class="" href="<?php echo ROOT . 'logout/'; ?>">Cerrar Sesión</a>
      <!-- <a class="active" href="">Contraseña incorrecta</a> -->
    <?php }else{ ?>
      <form class="login-form" action="<?php echo ROOT . 'login/'; ?>" method="POST">
        <input type="text" name="name" placeholder="name"/>
        <input type="password" name="password" placeholder="password"/>
        <button>login</button>
      </form>
    <?php } ?>
  </div>
</div>

