<?php
/**
 * @Author: Albert
 * @Date:   2022-04-05 17:08:08
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-20 09:18:43
 */
?>

<!DOCTYPE html>
<html>
  <?php require(BLOCKS . 'head.php'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <link href="https://www.jsviews.com/samples/samples.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo CSS . 'guilds.css'?>">
  <body>
    <?php require(BLOCKS . 'topmenu.php'); ?>  
    <div class="container-fluid">
    </div>
    <?php require(BLOCKS . 'footer.php'); ?>
    <?php require_once(JSRENDER . 'guilds.jsrender.php'); ?>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://www.jsviews.com/download/jsrender.min.js"></script>
    <script src="<?php echo JS . 'guilds.js'?>"></script>
  </body>
</html>

