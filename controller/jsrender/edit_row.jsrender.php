<?php
/**
 * @Author: Your name
 * @Date:   2022-04-04 19:13:44
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-11 12:01:19
 */
?>
<script id="edit_row_template" type="text/x-jsrender">
<div data-row="{{:row}}" class="row row_{{:row}}">
    <div class="row_panel">
        <div>
            <button data-row="{{:row}}" class="add_column">
                Añadir columna
            </button>
        </div>
        <div>
            <button data-row="{{:row}}" class="remove_row">
                Eliminar fila
            </button>
        </div>
    </div>
</div>
</script>