/**
 * @Author: Albert
 * @Date:   2022-04-02 23:13:32
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 09:27:23
 */

$('#add_row').click(function(){
    createRow();
});

createRow();
createColumn(1);
createColumn(1);

var data = [
    {
      "name": "Robert",
      "nickname": "Bob",
      "showNickname": true
    },
    {
      "name": "Susan",
      "nickname": "Sue",
      "showNickname": false
    }
  ];
var template = $.templates("#block_template");

var htmlOutput = template.render(data);

$(".container-fluid").html(htmlOutput);
/**
 */
function createRow(){
    var row = 1;
    if($('.container-fluid .row').length > 0){
        row = $('.container-fluid .row').last().data('row') + 1;
    }
    $('.container-fluid').append('<div data-row="' + row + '" class="row row_' + row + '"><div class="row_panel"></div></div>');
    createColumn(row);
    createRowContent(row);
}

/**
 * @param  {int} row
 */
function createRowContent(row){
    $('.container-fluid .row_' + row + ' .row_panel').append('<div><button data-row="' + row + '" class="add_column">Añadir columna</button></div>');
    $('.container-fluid .row_' + row + ' .row_panel').append('<div><button data-row="' + row + '" class="remove_row">Eliminar fila</button></div>');
    $('.container-fluid .row_' + row + ' .row_panel .add_column').click(function(){
        createColumn(row);
        if($('.container-fluid .row_' + row + ' .column').length == 4){
            $('.container-fluid .row_' + row + ' .add_column').prop('disabled', true);
        }
    })
    $('.container-fluid .row_' + row + ' .remove_row').click(function(){
        removeRow(row);
    })
}

/**
 * @param  {int} row
 */
function createColumn(row){
    var column = 1;
    if($('.container-fluid .row_' + row + ' .column').length > 0){
        column = $('.container-fluid .row_' + row + ' .column').last().data('column') + 1;
    }
    $('.container-fluid .row_' + row).append('<div data-column="' + column + '" class="column column_' + column + '"><div class="column_panel"></div></div>');
    var col = 12 / $('.container-fluid .row_' + row + ' .column').length;
    $('.container-fluid .row_' + row + ' .column').removeClass('col-12 col-6 col-4 col-3');
    $('.container-fluid .row_' + row + ' .column').addClass('col-' + col);
    createColumnContent(row, column);
}

/**
 * @param  {int} row
 * @param  {int} column
 */
function createColumnContent(row, column){
    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel').append('<div><button data-row="' + row + '" class="remove_column">Eliminar columna</button><select class="column_content"><option value="text">Texto</option><option value="image">Imagen</option></select></div>');
    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel').append('<div class="textarea_content"><textarea name="textarea_' + row + '_' + column + '" rows="10" cols="50"></textarea></div><div class="image_content"><input type="file" accept="image/png, image/jpeg"></div>');
    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .image_content').hide();
    CKEDITOR.replace('textarea_' + row + '_' + column);
    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .remove_column').click(function(){
        removeColumn(row, column);
        if($('.container-fluid .row_' + row + ' .column').length == 1){
            $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', true);
        }else{
            $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', false);
        }
    })
    $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .column_content').change(function(){
        if($(this).val() == 'text'){
            $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .image_content').hide();
            $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .textarea_content').show();
        }else if($(this).val() == 'image'){
            $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .image_content').show();
            $('.container-fluid .row_' + row + ' .column_' + column + ' .column_panel .textarea_content').hide();
        }
    })
    if($('.container-fluid .row_' + row + ' .column').length == 1){
        $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', true);
    }else{
        $('.container-fluid .row_' + row + ' .remove_column').prop('disabled', false);
    }
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
    var col = 12 / $('.container-fluid .row_' + row + ' .column').length;
    $('.container-fluid .row_' + row + ' .column').removeClass('col-12 col-6 col-4 col-3');
    $('.container-fluid .row_' + row + ' .column').addClass('col-' + col);
}

