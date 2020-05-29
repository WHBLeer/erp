var chuangInfo = {};
var urlCheckUser = "http://tb.taober.cn/chromeplug/user_check";
//var urlCheckUser = "http://tb.zdzltech.com/chromeplug/user_check";
getStorageChuangInfo();

function getStorageChuangInfo() {
	browser.storage.local.get("chuangInfo").then(function(item) {
		if(item.chuangInfo && item.chuangInfo.userinfo) {
			chuangInfo = item.chuangInfo;
			notifyContentRefresh()
		} else {
			chuangInfo = {};
			requestUser()
		}
	}, onError)
}

function requestUser() {
	$(function() {
		$.post(urlCheckUser, {
			v: 1
		}, function(json) {
			if(json.code != 1) {
				browser.storage.local.remove("chuangInfo")
			} else {
				browser.storage.local.set({
					chuangInfo: json.data
				});
				chuangInfo = json.data;
				notifyContentRefresh()
			}
		}, "json")
	})
}

function handleMessage(request, sender, sendResponse) {
	if(request.action == "checklogin") {
		if(chuangInfo.userinfo) {
			sendResponse({
				response: 1
			})
		} else {
			getStorageChuangInfo();
			sendResponse({
				response: 0
			})
		}
	}
	if(request.action == "needlogin") {
		chuangInfo = {};
		browser.storage.local.remove("chuangInfo").then(function() {
			notifyContentRefresh()
		});
		sendResponse({
			response: "background removed chuangInfo yes"
		})
	}
	if(request.action == "addcount") {
		if(chuangInfo.curr_count) {
			chuangInfo.curr_count = chuangInfo.curr_count + 1
		} else {
			chuangInfo.curr_count = 1
		}
		browser.storage.local.set({
			chuangInfo: chuangInfo
		});
		sendResponse({
			response: "addcount yes"
		})
	}
}

function onError(e) {}
browser.runtime.onMessage.addListener(handleMessage);

function notifyContentRefresh() {
	browser.tabs.query({
		active: true,
		currentWindow: true
	}).then(function(tabs) {
		browser.tabs.sendMessage(tabs[0].id, {
			action: "refresh"
		})
	})
};