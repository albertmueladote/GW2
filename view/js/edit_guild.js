/**
 * @Author: Albert
 * @Date:   2022-04-02 23:13:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 17:30:21
 */

$('#add_row').click(function(){
    createColumn(createRow());
});

load();

var last_row = 0;
var last_column = 0;

function load()
{
    $.ajax({
	    url : '../controller/ajax/guild_view.ajax.php',
	    data : {},
	    type : 'POST',
	    dataType : 'json',
	    success : function(data) {
	       	if(JSON.parse(JSON.stringify(data)).result){
                var array = JSON.parse(JSON.stringify(data)).result;
                $.each(array, function( row_id, blocks ) {
                    var row = createRow();
                    $.each(blocks, function( block_id, block ) {
                        createColumn(row, block.text, block.src, block.extra);
                    });
                });
	       	}else{
	       		return false;
	       	}
	    },
	    error : function(xhr, status) {
	        
	    },
	    complete : function(xhr, status) {
            
	    }
    });
}

/**
 */
function createRow(){
    var row = 1;
    if($('.container-fluid .rows .row').length > 0){
        row = $('.container-fluid .rows .row').last().data('row') + 1;
    }

    var data = [{"row": row}];
    var template = $.templates("#edit_row_template");
    var htmlOutput = template.render(data);
    $(".container-fluid .rows").append(htmlOutput);

    $('.container-fluid .rows .row_' + row + ' .row_panel .add_column').click(function(){
        createColumn(row);
        if($('.container-fluid .rows .row_' + row + ' .column').length == 4){
            $('.container-fluid .rows .row_' + row + ' .add_column').prop('disabled', true);
        }
    })
    $('.container-fluid .rows .row_' + row + ' .remove_row').click(function(){
        if(confirm("¿Eliminar fila y todas sus columnas?")){
            removeRow(row);
        }
    })
    return row;
}

/**
 * @param  {int} row
 */
function createColumn(row, text = '', src = '', extra = ''){
    var column = 1;
    if($('.container-fluid .rows .row_' + row + ' .column').length > 0){
        column = $('.container-fluid .rows .row_' + row + ' .column').last().data('column') + 1;
    }

    if(text != '' && src == ''){
        var selected_text = true;
        var selected_image = false;
    }else if(text == '' && src != ''){
        var selected_text = false;
        var selected_image = true;
    }
    
    var data = [{"column": column, "row": row, "text": text, "src": src, "extra": extra, "selected_image": selected_image, "selected_text": selected_text}];
    var template = $.templates("#edit_block_template");
    var htmlOutput = template.render(data);
    $('.container-fluid .rows .row_' + row).append(htmlOutput);

    resizeColumns(row);
    
    CKEDITOR.replace('textarea_' + row + '_' + column, {
        toolbar: [
            { name: 'basics', items: [ 'Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'others', items: [ 'Link', 'Unlink', '-', 'BidiLtr', 'BidiRtl'] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'specials', items: [ 'Table', 'HorizontalRule', 'SpecialChar'] },
            { name: 'styles', items: [ 'Format', 'Font', 'FontSize', 'removeColumn' ] }
        ]
    }).on('instanceReady', function(e) { 
        var editor = e.editor
        $('.image_' + row + '_' + column).on('change', function(){
            previewImage(row, column);
        })
        hiddeAll();
        editor.on('focus', function(){
            saveColumn(last_row, last_column);
            last_row = row;
            last_column = column;
            showColumn(row, column);
        })
        $('.image_preview_' + row + '_' + column).on('click', function(){
            saveColumn(last_row, last_column);
            last_row = row;
            last_column = column;
            showColumn(row, column);
        })
        editor.on('blur', function(){
            if ($('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel .column_content').is(":focus")) {
                saveColumn(last_row, last_column);
                last_row = row;
                last_column = column;
                showColumn(row, column);
            }
        })
    });

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel .remove_column').click(function(){
        if(confirm("¿Eliminar columna?")){
            removeColumn(row, column);
            if($('.container-fluid .rows .row_' + row + ' .column').length == 1){
                $('.container-fluid .rows .row_' + row + ' .remove_column').prop('disabled', true);
            }else{
                $('.container-fluid .rows .row_' + row + ' .remove_column').prop('disabled', false);
            }
        }
    })

    if(text != '' && src == ''){
        showContent(row, column, 'text');
    }else if(text == '' && src != ''){
        showContent(row, column, 'image');
    }else{
        showContent(row, column, 'text');
    }
    
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel .column_content').change(function(){
        showContent(row, column, $(this).val());
    })

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content .image_left').click(function(){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_right');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_center');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').addClass('image_preview_left');
    });

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content .image_right').click(function(){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_left');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_center');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').addClass('image_preview_right');
    });

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content .image_center').click(function(){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_left');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').removeClass('image_preview_right');
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').addClass('image_preview_center');
    });

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content .image_expand_h').click(function(){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').toggleClass('image_preview_expand_h');
    });

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content .image_expand_v').click(function(){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').toggleClass('image_preview_expand_v');
    });


    if($('.container-fluid .rows .row_' + row + ' .column').length == 1){
        $('.container-fluid .rows .row_' + row + ' .remove_column').prop('disabled', true);
    }else{
        $('.container-fluid .rows .row_' + row + ' .remove_column').prop('disabled', false);
    }
    return column;
}

function showColumn(row, column){

    hiddeAll();
    $('.container-fluid .rows .row_' + row + ' .column_' + column).css('visibility', 'visible');
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel').css('visibility', 'visible');
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .cke_top').css('visibility', 'visible');
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .cke_contents').css("border", "none");
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .cke_chrome').css("border", "1px solid #d1d1d1");
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .cke_bottom').css('visibility', 'visible');
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content button').css('visibility', 'visible');
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content input').css('visibility', 'visible');
}

function hiddeAll(){
    $('.container-fluid .row .column .cke_contents').css("border", "1px solid #d1d1d1");
    $('.container-fluid .row .column .cke_top').css('visibility', 'hidden');
    $('.container-fluid .row .column .cke_chrome').css("border", "none");
    $('.container-fluid .row .column .cke_bottom').css('visibility', 'hidden');
    $('.container-fluid .row .column .column_panel').css('visibility', 'hidden');
    $('.container-fluid .row .column .image_content button').css('visibility', 'hidden');
    $('.container-fluid .row .column .image_content input').css('visibility', 'hidden');
    $('.container-fluid .row .column .image_content button').css('visibility', 'hidden');
    $('.container-fluid .row .column .image_content input').css('visibility', 'hidden');
}

function previewImage(row, column){
    
    var file = $('.image_' + row + '_' + column).get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $('.image_preview_' + row + '_' + column).attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
}

function showContent(row, column, content)
{
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').hide();
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').attr('data-enabled', null);
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').hide();
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').attr('data-enabled', null);
    if(content == 'text'){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').show();
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').attr('data-enabled', true);
    }else if(content == 'image'){
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').show();
        $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').attr('data-enabled', true);
    }
}

/**
 * @param  {int} row
 */
function removeRow(row){
    $('.container-fluid .rows .row_' + row).remove();
}

/**
 * @param  {int} row
 * @param  {int} column
 */
function removeColumn(row, column){
    $('.container-fluid .rows .row_' + row + ' .column_' + column).remove();
    saveColumn(row, column, true);
    resizeColumns(row);
}

/**
 * @param  {int} row
 */
function resizeColumns(row)
{
    var col = 12 / $('.container-fluid .rows .row_' + row + ' .column').length;
    $('.container-fluid .rows .row_' + row + ' .column').removeClass('col-12 col-6 col-4 col-3');
    $('.container-fluid .rows .row_' + row + ' .column').addClass('col-' + col);
}

function saveColumn(row, column, remove = false){
    if(row > 0 && column > 0){
        if(remove){
            var data = {"row": row, "column": column, "remove": remove}
            last_row = 0;
            last_column = 0;
        }else{
            var type = $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_content').val();
            if(type == 'image'){
                var value = $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview').attr('src').split("/");
                value = value[value.length - 1];
                var extra = $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_preview_content').attr('class').split(/\s+/);
                extra = jQuery.grep(extra, function(value) {
                    return value != 'image_preview_content';
                });
                extra = extra.join(" ");
            }else if(type == 'text'){
                var value = CKEDITOR.instances['textarea_' + row + '_' + column].getData();
                var extra = '';
            }
            var data = {"type": type, "value": value, "extra": extra, "row": row, "column": column};
        }

        $.ajax({
            url : '../controller/ajax/block_save.ajax.php',
            data : data,
            type : 'POST',
            dataType : 'json',
            success : function(data) {
                console.log(JSON.parse(JSON.stringify(data)).result);
                if(JSON.parse(JSON.stringify(data)).result){
                    
                }else{
                    
                }
            },
            error : function(xhr, status) {
                
            },
            complete : function(xhr, status) {
                
            }
        });
    }
}