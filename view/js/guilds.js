/**
 * @Author: Albert
 * @Date:   2022-04-05 18:12:46
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-19 20:40:27
 */

$('#guilds').DataTable();

load();

function load()
{
	$.ajax({
        url : '../controller/ajax/guilds.ajax.php',
	    data : {},
	    type : 'POST',
	    dataType : 'json',
	    success : function(data) {
	       	if(JSON.parse(JSON.stringify(data)).result){
                var array = JSON.parse(JSON.stringify(data)).result;

                var template = $.templates("#table_template");
                var htmlOutput = template.render(data);
                $(".container-fluid").append(htmlOutput);                
                
                $.each(array, function( array, guild ) {
                    var data = [{"url": guild.url, "name": guild.name, "preferences": guild.preferences, "activity": guild.activity}];
                    var template = $.templates("#row_template");
                    var htmlOutput = template.render(data);
                    $("#guilds tbody").append(htmlOutput);
                });

                var table = $('#guilds').DataTable({
                    searchPanes: {
                        viewTotal: true
                    },
                    dom: 'Plfrtip'
                });
             
                 table.columns().every( function() {
                    var that = this;
              
                    $('input', this.footer()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
                loadGuild();
	       	}else{
	       		console.log(false);
	       	}
	    },
	    error : function(xhr, status) {
	        
	    },
	    complete : function(xhr, status) {

	    }
	});
}

function loadGuild(){
    $('tr').click(function(){
        window.location.replace($(this).data('url'));
    });
}