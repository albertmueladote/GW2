/**
 * @Author: Albert
 * @Date:   2022-04-05 16:43:29
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-21 18:01:23
 */

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

    var data = [{'row': row}];
    var template = $.templates('#show_row_template');
    var htmlOutput = template.render(data);
    $('.container-fluid .rows').append(htmlOutput);

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
        var data = [{'column': column, 'text': text}];
        var template = $.templates('#show_text_block_template');
    }else if(text == '' && src != ''){
        var data = [{'column': column, 'src': src, 'extra': extra}];
        var template = $.templates('#show_image_block_template');
    }
    var htmlOutput = template.render(data);
    $('.container-fluid .rows .row_' + row).append(htmlOutput);
    resizeColumns(row);

    return column;
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