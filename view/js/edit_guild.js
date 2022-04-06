/**
 * @Author: Albert
 * @Date:   2022-04-02 23:13:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-05 16:55:10
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
    if($('.container-fluid .row').length > 0){
        row = $('.container-fluid .row').last().data('row') + 1;
    }

    var data = [{"row": row}];
    var template = $.templates("#edit_row_template");
    var htmlOutput = template.render(data);
    $(".container-fluid").append(htmlOutput);

    $('.container-fluid .row_' + row + ' .row_panel .add_column').click(function(){
        createColumn(row);
        if($('.container-fluid .row_' + row + ' .column').length == 4){
            $('.container-fluid .row_' + row + ' .add_column').prop('disabled', true);
        }
    })
    $('.container-fluid .row_' + row + ' .remove_row').click(function(){
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
    if($('.container-fluid .row_' + row + ' .column').length > 0){
        column = $('.container-fluid .row_' + row + ' .column').last().data('column') + 1;
    }

    var data = [{"column": column, "row": row, "text": text}];
    var template = $.templates("#edit_block_template");
    var htmlOutput = template.render(data);
    $('.container-fluid .row_' + row).append(htmlOutput);

    resizeColumns(row);
    
    CKEDITOR.replace('textarea_' + row + '_' + column);

    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .remove_column').click(function(){
        if(confirm("¿Eliminar columna?")){
            removeColumn(row, column);
            if($('.container-fluid .row_' + row + ' .column').length == 1){
                $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', true);
            }else{
                $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', false);
            }
        }
    })

    $('.container-fluid .row_' + row + ' .column_' + column + ' .image_content').hide();
    $('.container-fluid .row_' + row + ' .column_' + column + ' .textarea_content').show();

    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .column_content').change(function(){
        if($(this).val() == 'text'){
            $('.container-fluid .row_' + row + ' .column_' + column + ' .image_content').hide();
            $('.container-fluid .row_' + row + ' .column_' + column + ' .textarea_content').show();
        }else if($(this).val() == 'image'){
            $('.container-fluid .row_' + row + ' .column_' + column + ' .image_content').show();
            $('.container-fluid .row_' + row + ' .column_' + column + ' .textarea_content').hide();
        }
    })

    if($('.container-fluid .row_' + row + ' .column').length == 1){
        $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', true);
    }else{
        $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', false);
    }

    return column;
}

/**
 * @param  {int} row
 */
function removeRow(row){
    $('.container-fluid .row_' + row).remove();
}

/**
 * @param  {int} row
 * @param  {int} column
 */
function removeColumn(row, column){
    $('.container-fluid .row_' + row + ' .column_' + column).remove();
    resizeColumns(row);
}

/**
 * @param  {int} row
 */
function resizeColumns(row)
{
    var col = 12 / $('.container-fluid .row_' + row + ' .column').length;
    $('.container-fluid .row_' + row + ' .column').removeClass('col-12 col-6 col-4 col-3');
    $('.container-fluid .row_' + row + ' .column').addClass('col-' + col);
}
