<?php
/**
 * @Author: Albert
 * @Date:   2022-03-26 00:16:02
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-03 02:15:23
 */
?>
<footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?php echo JS . 'main.js'?>"></script>
    <script src="<?php echo JS . 'topmenu.js'?>"></script>
    <script>
        $(window).on('load', function () {
            $('.outer-loader').delay(1000).fadeOut('slow');
        });
    </script>
</footer>