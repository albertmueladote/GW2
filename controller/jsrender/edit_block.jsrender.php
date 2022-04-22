<?php
/**
 * @Author: Albert
 * @Date:   2022-04-04 19:13:51
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-20 12:15:19
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
                <option value="text" {{if selected_text}} selected {{/if}}>Texto</option>
                <option value="image" {{if selected_image}} selected {{/if}}>Imagen</option>
            </select>
        </div>
    </div>
    <div class="content">
        <div class="textarea_content" {{if selected_text}} data-enabled="true" {{/if}}>
            <textarea class="textarea" name="textarea_{{:row}}_{{:column}}" rows="10" cols="50">{{:text}}</textarea>
        </div>
        <div class="image_content" {{if selected_image}} data-enabled="true" {{/if}}> 
            <div>
                <button class="image_left"><-</button><button class="image_right">-></button><button class="image_center"><-></button><button class="image_expand_h">expand h</button><button class="image_expand_v">expand v</button><input class="image image_{{:row}}_{{:column}}" name="image_{{:row}}_{{:column}}" type="file" accept="image/png, image/jpeg">
            </div>
            <div class="image_preview_content {{:extra}}">    
                <img class="image_preview image_preview_{{:row}}_{{:column}}" src="{{:src}}" alt="image preview" />
            </div>
        </div>
    </div>
</div>
</script>