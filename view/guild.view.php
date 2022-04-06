<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 18:26:51
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:23:25
 */
?>
  <?php $page = 'guild';
  require(BLOCKS . 'layout.php'); ?>
    <div class="container-fluid">
    </div>
    <?php if(isset($is_leader) && $is_leader) { ?>
      <div class="main_panel"><button id="add_row">Añadir fila</button></div>
    <?php } ?>
    <?php require(BLOCKS . 'footer.php'); ?>
    <script src="<?php echo JS . 'guild.js'?>"></script>
    <script src="https://www.jsviews.com/download/jsrender.min.js"></script>
    <?php if(isset($is_leader) && $is_leader) { ?>
      <?php require_once(JSRENDER . 'edit_row.jsrender.php'); ?>
      <?php require_once(JSRENDER . 'edit_block.jsrender.php'); ?>
      <script src="<?php echo TOOLS . 'ckeditor/ckeditor.js'; ?>"></script>
      <script src="<?php echo JS . 'edit_guild.js'; ?>"></script>
    <?php }else{ ?>
      <?php require_once(JSRENDER . 'show_row.jsrender.php'); ?>
      <?php require_once(JSRENDER . 'show_block.jsrender.php'); ?>
      <script src="<?php echo JS . 'show_guild.js'; ?>"></script>
    <?php } ?>