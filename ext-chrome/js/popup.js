/**
 * Get the current URL.
 * @param {function(string)} callback - called when the URL of the current tab
 *   is found. 
 */
function getCurrentTabUrl(callback) {
  var queryInfo = {
    active: true,
    currentWindow: true
  };
  chrome.tabs.query(queryInfo, function(tabs) {
    var tab = tabs[0];
    var url = tab.url;
    callback(url,tab);
  });
}

document.addEventListener('DOMContentLoaded', function(cccc) {
  init_plug();
});

function saveData(key,value){
	localStorage[key] = value; 
}

function getData(key){
	return localStorage[key];
}

function init_plug(){
	getCurrentTabUrl(function(url,tab) {
		$('#curr_site').text('当前产品：'+tab.title);
	});
	$(function(){
		$.get(getData('base_url'), { cmd: 'user_check', v: 1 }, function (json) {
			$('#official_web').attr('href', json.offweb);
			if(json.code != 1){
				$('#login_jump').attr('href', json.data.url);
				$('#need_login').show();
			}else{
				$('#need_login').hide();
				$('#user_info_company').text('['+json.data.userinfo.company+']');
				$('#user_info_nickname').html('<a href="'+json.data.userinfo.adminurl+'" target="_blank">'+json.data.userinfo.nickname+'</a>');
				$('#user_info').show();
				var html = '支持采集站点：';
				for(var site in json.data.activesite){
					html += '<a href="'+json.data.activesite[site]+'" target="_blank">'+site+'</a>';
				}
				$("#content #active_site").html(html);
				var curr_count = getData('curr_count');
				if(curr_count == undefined){
					curr_count = 0;
				}
				$('#curr_spider label').text(curr_count);
				$('#content').show();
			}
		},'json');
	});    
}