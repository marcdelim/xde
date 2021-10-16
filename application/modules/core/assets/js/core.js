var urlsLoaded = function(){}
$(document).ajaxSuccess(function(event,request,settings ) {
	
	if (typeof request.responseJSON != 'undefined'){
		var response = request.responseJSON;
		if(response.status == "error" && response.type=="session_expired"){
			window.location = urls.base_url+"site/site_error/session_expired?referrer="+window.location.href;
			return;
		}	
	}

	if(urls.ci_env=="production"){
		console.clear();
	}
});

$(document).ready(function(){
	
	var getUrl = {
		url : urls.base_url+'core/request/ajax/',
		async : false,
		type : "post",
		dataType: 'json',
		data :{
		mod:"core|core_api|get_urls",
		},success : function(response){
			if(response.status=='success'){
				window.urls = {
				  base_url : response.data.base_url,
				  current_url : response.data.current_url,
				  module_url : response.data.module_url,
				  module_assets_url : response.data.module_assets_url,
				  assets_url : response.data.assets_url,
				  ajax_url : response.data.ajax_url,
				  exec_url : response.data.exec_url,
				  request_url : response.data.request_url,
				  getfile_url :   response.data.getfile_url,
				  ci_env	:	response.data.ci_env,
				}
				urlsLoaded(); // callback
			}
		},
		error : function(response){
			console.log(false);
			console.log(response);
		}
	};
	$.ajax(getUrl);		
	
	
	
	// window.urls = {
		// ajax_url : urls.base_url+'core/request/ajax/',
	// }
	// urlsLoaded();
});


// function getCsrfToken(name) {
	// var cookieValue = null;
	// if (document.cookie && document.cookie != '') {
		// var cookies = document.cookie.split(';');
		// for (var i = 0; i < cookies.length; i++) {
			// var cookie = jQuery.trim(cookies[i]);
			// if (cookie.substring(0, name.length + 1) == (name + '=')) {
				// cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
				// break;
			// }
		// }
	// }
	// return cookieValue;
// }

