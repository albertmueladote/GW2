/**
 * @Author: Albert
 * @Date:   2022-04-05 16:43:29
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-05 16:53:45
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
    var template = $.templates("#show_row_template");
    var htmlOutput = template.render(data);
    $(".container-fluid").append(htmlOutput);

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
    var template = $.templates("#show_block_template");
    var htmlOutput = template.render(data);
    $('.container-fluid .row_' + row).append(htmlOutput);

    resizeColumns(row);

    return column;
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