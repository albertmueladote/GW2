/**
 * @Author: Albert
 * @Date:   2022-04-02 23:13:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-19 18:06:03
 */

$('#add_row').click(function(){
    createColumn(createRow());
});

load();

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
                var last_row = 0;
                $.each(array, function( row_id, blocks ) {
                    if(last_row < row_id){
                        last_row = row_id;
                    }
                });
                if(last_row > 0){
                    for(var x = 1; x <= last_row; x++){
                        createRow();
                        if(x in array){
                            var last_block = 0
                            $.each(array[x], function( block_id, block ) {
                                if(last_block < block_id){
                                    last_block = block_id;
                                }
                            });
                            for(var y = 1; y <= last_block; y++){
                                if(y in array[x]){
                                    if(array[x][y].type == 'text'){
                                        createColumn(x,array[x][y].value);
                                    }
                                }else{
                                    createColumn(x);
                                }
                                
                            }
                        }else{
                            createColumn(x);
                        }
                    }
                }
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
function createColumn(row, text = ''){
    var column = 1;
    if($('.container-fluid .rows .row_' + row + ' .column').length > 0){
        column = $('.container-fluid .rows .row_' + row + ' .column').last().data('column') + 1;
    }

    var data = [{"column": column, "row": row, "text": text}];
    var template = $.templates("#edit_block_template");
    var htmlOutput = template.render(data);
    $('.container-fluid .rows .row_' + row).append(htmlOutput);

    resizeColumns(row);
    
    /*var editor = CKEDITOR.replace('textarea_' + row + '_' + column, {
            toolbar: [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
        ]
    });*/ 
    
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
            showColumn(row, column);
        })
        $('.image_preview_' + row + '_' + column).on('click', function(){
            showColumn(row, column);
        })
        editor.on('blur', function(){
            if ($('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel .column_content').is(":focus")) {
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

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').hide();
    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').show();

    $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .column_panel .column_content').change(function(){
        if($(this).val() == 'text'){
            $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').hide();
            $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').show();
        }else if($(this).val() == 'image'){
            $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .image_content').show();
            $('.container-fluid .rows .row_' + row + ' .column_' + column + ' .textarea_content').hide();
        }
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
