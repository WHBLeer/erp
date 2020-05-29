var chuangInfo = {};
var urlCheckUser = "http://tb.taober.cn/chromeplug/user_check";
//var urlCheckUser = "http://tb.zdzltech.com/chromeplug/user_check";

function getCurrentTabUrl(callback) {
	var queryInfo = {
		active: true,
		currentWindow: true
	};
	browser.tabs.query(queryInfo).then(function(tabs) {
		for(var tab in tabs) {
			callback(tabs[tab].url, tabs[tab].title)
		}
	}, function() {})
}
document.addEventListener("DOMContentLoaded", function(cccc) {
	init_plug()
});

function init_plug() {
	requestUser();
	getCurrentTabUrl(function(url, title) {
		$("#curr_site").text("当前：" + title)
	});
	browser.storage.local.get("chuangInfo").then(onGot, onError)
}

function onError(e) {}

function onGot(item) {
	if(item && item.chuangInfo && item.chuangInfo.userinfo) {
		chuangInfo = item.chuangInfo;
		setUserUI(chuangInfo)
	} else {
		requestUser()
	}
}

function requestUser() {
	$("#user_info").hide();
	$("#content").hide();
	$("#need_login").show();
	$(function() {
		$.get(urlCheckUser, {
			v: 1
		}, function(json) {
			if(json.code != 1) {
				$("#login_jump").attr("href", json.data.url);
				$("#user_info").hide();
				$("#content").hide();
				$("#need_login").show();
				browser.storage.local.remove("chuangInfo")
			} else {
				json.data.curr_count = 0;
				if(chuangInfo && chuangInfo.curr_count > 0) {
					json.data.curr_count = chuangInfo.curr_count
				}
				browser.storage.local.set({
					chuangInfo: json.data
				});
				setUserUI(json.data)
			}
		}, "json")
	})
}

function setUserUI(data) {
	$("#need_login").hide();
	$("#user_info_company").text("[" + data.userinfo.company + "]");
	$("#user_info_nickname").html('<a href="' + data.userinfo.adminurl + '" target="_blank">' + data.userinfo.nickname + "</a>");
	$("#user_info").show();
	var html = "可认领站点：";
	for(var site in data.activesite) {
		html += '<a href="' + data.activesite[site] + '" target="_blank">' + site + "</a>"
	}
	$("#content #active_site").html(html);
	var curr_count = 0;
	if(data.curr_count) {
		curr_count = data.curr_count
	}
	$("#curr_spider label").text(curr_count);
	$("#content").show()
};