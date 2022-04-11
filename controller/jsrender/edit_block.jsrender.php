<?php
/**
 * @Author: Albert
 * @Date:   2022-04-04 19:13:51
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-11 18:01:41
 */
?>
<script id="edit_block_template" type="text/x-jsrender">
<div data-column="{{:column}}" class="column column_{{:column}}">
    <div class="column_panel">
        <div>
            <button data-row="{{:row}}" class="remove_column">
                Eliminar columna
            </button>
        </div>
        <div>
            <select class="column_content">
                <option value="text">Texto</option>
                <option value="image">Imagen</option>
            </select>
        </div>
    </div>
    <div class="textarea_content">
        <textarea name="textarea_{{:row}}_{{:column}}" rows="10" cols="50">{{:text}}</textarea>
    </div>
    <div class="image_content">
        <input name="file_{{:row}}_{{:column}}" type="file" accept="image/png, image/jpeg">
    </div>
</div>
</script>