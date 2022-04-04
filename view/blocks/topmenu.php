<?php
/**
 * @Author: Albert
 * @Date:   2022-03-26 00:10:40
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-03 02:19:41
 */
?>
<div class="topnav">
<?php if(isset($_SESSION[SESSION_NAME])){ ?>
      <?php if($_SESSION[SESSION_NAME]) { ?>
        <a class="<?php echo (strcmp($_SESSION['current_landing'], 'profile' === 0) ? 'active' : ''); ?> profile" href="<?php echo ROOT; ?>"><?php echo $current_user->name; ?></a>
          <?php foreach($current_user_guilds->leader_guilds AS $guild) {?>
            <a class="guild <?php echo (strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0 ? 'active' : ''); ?>" data-name="<?php echo $gw2->cleanString($guild->name); ?>" href="<?php echo ROOT . 'guild/' . $gw2->cleanString($guild->name); ?>">
              <img class="img-fluid" alt="red_tag" src="<?php echo MEDIA . 'red_tag.png' ?>" /><?php echo $guild->name; ?>
            </a>
          <?php } ?>
          <?php foreach($current_user_guilds->member_guilds AS $guild) {?>
            <a class="guild <?php echo (strcmp($gw2->cleanString($guild->name), $gw2->cleanString($current_guild)) === 0 ? 'active' : ''); ?>" data-name="<?php echo $gw2->cleanString($guild->name); ?>" href="<?php echo ROOT . 'guild/' . $gw2->cleanString($guild->name); ?>">
              <?php echo $guild->name; ?>
            </a>
          <?php } ?>
      <?php } ?>
  <?php } ?>
  <div class="login-container">
  	<?php if(isset($_SESSION[SESSION_NAME])){ ?>
  		<?php if($_SESSION[SESSION_NAME]) { ?>
  			<a class="active" href="<?php echo CONTROLLER . 'login.cntrl.php'; ?>">Desconectar</a>
  		<?php }else{ ?>
  			<a class="active" href="<?php echo CONTROLLER . 'login.cntrl.php'; ?>">Contraseña incorrecta</a>
  		<?php } ?>
  	<?php }else{ ?>
  		<form class="login-form" action="<?php echo CONTROLLER . 'login.cntrl.php'; ?>" method="POST">
      		<input type="text" name="name" placeholder="name"/>
      		<input type="password" name="password" placeholder="password"/>
      		<button>login</button>
    	</form>
  	<?php } ?>
  </div>
</div>

