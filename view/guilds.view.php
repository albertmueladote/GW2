<?php
/**
 * @Author: Albert
 * @Date:   2022-04-05 17:08:08
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:44:05
 */
?>
  <?php 
  $page = 'guilds';
  require(BLOCKS . 'layout.php'); ?>
    <div class="container-fluid">
    </div>
    <?php require(BLOCKS . 'footer.php'); ?>
    <?php require_once(JSRENDER . 'guilds.jsrender.php'); ?>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://www.jsviews.com/download/jsrender.min.js"></script>
    <script src="<?php echo JS . 'guilds.js'?>"></script>
  </body>
</html>

