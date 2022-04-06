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
  <body>
    <div class="outer-loader">
        <div class="inner-loader-img"> 
            <p>Por favor espere ...</p> 
        </div>
    </div>
<?php
   require(BLOCKS . 'topmenu.php');
?>


