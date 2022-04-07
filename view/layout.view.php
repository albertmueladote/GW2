<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 18:26:51
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:23:25
 */
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" href="/view/media/loading.gif"/>
  <?php require(BLOCKS . 'head.php'); ?>
  <link rel="stylesheet" href="<?php echo CSS . 'common.css'?>">
  <?php
  switch($page) {
    case 'guild':
?>
    <link rel="stylesheet" href="<?php echo CSS . 'guild.css'?>">
    <link rel="stylesheet" href="<?php echo CSS . 'topmenu.css'?>">
    <?php if(isset($is_leader) && $is_leader) { ?>
      <link href="https://www.jsviews.com/samples/samples.css" rel="stylesheet" />
      <link rel="stylesheet" href="<?php echo CSS . 'edit_guild.css'?>">
    <?php }else{ ?>
      <link rel="stylesheet" href="<?php echo CSS . 'show_guild.css'?>">
    <?php } ?>
<?php
      
      break;
      case 'guilds':
        ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <link href="https://www.jsviews.com/samples/samples.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo CSS . 'guilds.css'?>">
  <link rel="stylesheet" href="<?php echo CSS . 'topmenu.css'?>">
  
<?php
      break;
      case 'profile':
?>
        <link rel="stylesheet" href="<?php echo CSS . 'profile.css'?>">
        <link rel="stylesheet" href="<?php echo CSS . 'topmenu.css'?>">
<?php
      break;
  }
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="outer-loader">
        <div class="inner-loader-img"> 
            <p>Por favor espere ...</p> 
        </div>
    </div>
<?php
   require(BLOCKS . 'topmenu.php');
?>
<div class="bg">
  <h1></h1>
</div>
<?php
   require(VIEW . $page.'.view.php');
?>
<?php require(BLOCKS . 'footer.php'); ?>
</body>
</html>



