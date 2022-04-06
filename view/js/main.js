/**
 * @Author: Albert
 * @Date:   2022-04-02 00:06:21
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-06 03:14:21
 */

/**
 * @param  {string} name
 * @param  {midex} value
 * @param  {boolean} refresh
 */
function setParam(name, value, refresh)
{
	$.ajax({
	    url : '../controller/ajax/setparam.ajax.php',
	    data : {name: name, value: value},
	    type : 'POST',
	    dataType : 'json',
	    success : function(data) {
	    },
	    error : function(xhr, status) {
	        
	    },
	    complete : function(xhr, status) {
	        if(refresh){
	        	location.reload();
	        }
	    }
	});
}

/**
 * @param  {string} name
 * @param  {string} from
 */
function getParam(name, from)
{
	$.ajax({
	    url : '../controller/ajax/getparam.ajax.php',
	    data : {name: name, from: from},
	    type : 'POST',
	    dataType : 'json',
	    success : function(data) {
			
	    },
	    error : function(xhr, status) {
	        
	    },
	    complete : function(xhr, status) {
			
	    }
	});
}