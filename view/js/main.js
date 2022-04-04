/**
 * @Author: Albert
 * @Date:   2022-04-02 00:06:21
 * @Last Modified by:   Your name
 * @Last Modified time: 2022-04-04 03:07:47
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
	       	if(JSON.parse(JSON.stringify(data)).result){
	       		return JSON.parse(JSON.stringify(data)).result;
	       	}else{
	       		return false;
	       	}
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
	       	if(JSON.parse(JSON.stringify(data)).result){
	       		console.log(JSON.parse(JSON.stringify(data)).result);
	       	}else{
	       		return false;
	       	}
	    },
	    error : function(xhr, status) {
	        
	    },
	    complete : function(xhr, status) {
	        console.log('complete');
	    }
	});
}