<?php
/**
 * @Author: Albert
 * @Date:   2022-04-05 16:48:10
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 17:51:38
 */
?>

<script id="show_text_block_template" type="text/x-jsrender">
<div data-column="{{:column}}" class="column column_{{:column}}">
    {{:text}}
</div>
</script>

<script id="show_image_block_template" type="text/x-jsrender">
<div data-column="{{:column}}" class="column column_{{:column}} {{:extra}}">
    <img src="{{:src}}" alt="{{:src}}" />
</div>
</script>