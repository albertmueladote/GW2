<?php
/**
 * @Author: Albert
 * @Date:   2022-04-01 18:26:51
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 09:28:01
 */
?>
<!DOCTYPE html>
<html>
  <?php require(BLOCKS . 'head.php'); ?>
  <link rel="stylesheet" href="<?php echo CSS . 'guild.css'?>">
  <link rel="stylesheet" href="<?php echo CSS . 'topmenu.css'?>">
  <link href="https://www.jsviews.com/samples/samples.css" rel="stylesheet" />
  <?php if($is_leader){ ?>
    <link rel="stylesheet" href="<?php echo CSS . 'edit_guild.css'?>">
    <?php } ?>
  <?php require(BLOCKS . 'topmenu.php'); ?>
  <body>
    <div class="container-fluid">
    </div>
    <?php if($is_leader){ ?>
      <div class="main_panel"><button id="add_row">Añadir fila</button></div>
    <?php } ?>
    <?php require(BLOCKS . 'footer.php'); ?>
    <script src="<?php echo JS . 'guild.js'?>"></script>
    <?php if($is_leader){ ?>
      <script src="<?php echo TOOLS . 'ckeditor/ckeditor.js'; ?>"></script>
      <script src="https://www.jsviews.com/download/jsrender.min.js"></script>
      <script src="<?php echo JS . 'edit_guild.js'; ?>"></script>
    <?php } ?>
  </body>
</html>

<script id="row_template" type="text/x-jsrender">
<div>
   Hola row
</div>
</script>

<script id="block_template" type="text/x-jsrender">
<div>
   Hola block
</div>
</script>