// Copyright (c) 2012 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.
// The onClicked callback function.
function onClickHandler(info, tab) { 
	alert("p6: " + JSON.stringify(info));
	alert("p7: " + JSON.stringify(tab));
	var curr_count = getData('curr_count');
	if(curr_count == undefined) {
		curr_count = 0;
	}
	curr_count++;
	saveData('curr_count', curr_count);
	var url_get = '';
	if(info.menuItemId == "link_goods") {
		url_get = info.linkUrl;
	} else if(info.menuItemId == "page_goods") {
		url_get = info.pageUrl;                                                           

		if(url_get.indexOf("detail.tmall.com") > 0) {
			chrome.tabs.getSelected(null, function(tab) {
				chrome.tabs.sendRequest(tab.id, {
					tmall_get: 1
				}, function(response) {
					if(response.code != 1) {
						alert(response.msg);
						return;
					}

					alert(JSON.stringify(response.data));
					$.post(getData('base_url'), {
						cmd: 'submit_tmall',
						v: 1,
						source_url: url_get,
						data: JSON.stringify(response.data)
					}, function(json) {
						if(json.code == 1) {
							alert(json.msg);
							chrome.tabs.getSelected(null, function(tab) {
								chrome.tabs.sendRequest(tab.id, {
									url_get: url_get
								}, function(response) {
									alert(response.msg);
								});
							});
						} else {
							alert(json.msg);
						}
					}, 'json');

				});
			});
			return false;
		}
		
		if(url_get.indexOf("item.taobao.com") > 0) {
			chrome.tabs.getSelected(null, function(tab) {
				chrome.tabs.sendRequest(tab.id, {
					get_taobao: 1
				}, function(response) {
					if(response.code != 1) {
						alert(response.msg);
						return;
					}

					$.post(getData('base_url'), {
						cmd: 'submit_taobao',
						v: 1,
						source_url: url_get,
						data: JSON.stringify(response.data)
					}, function(json) {
						if(json.code == 1) {
							//alert(json.msg);
							chrome.tabs.getSelected(null, function(tab) {
								chrome.tabs.sendRequest(tab.id, {
									url_get: url_get
								}, function(response) {
									alert(response.msg);
								});
							});
						} else {
							alert(json.msg);
						}
					}, 'json');

				});
			});
			return false;
		}

		if (url_get.indexOf("detail.1688.com") > 0) {
			// chrome.tabs.query({ 'active': true, 'lastFocusedWindow': true }, function (tab){
			chrome.tabs.getSelected(null, function (tab) {
				var tabid = tab.id;
				alert("p93: " + tabid);
				chrome.tabs.sendRequest(tabid, { get_1688: 1}, function (response) {
					alert("p96: " + JSON.stringify(response));
					if (response.code != 1) {
						alert(response.msg);
						return;
					}
					alert(url_get);
					alert(JSON.stringify(response));
					alert(JSON.stringify(response.data));
					$.post(getData('base_url'), {
						cmd: 'submit_1688',
						v: 1,
						source_url: url_get,
						data: JSON.stringify(response.data)
					}, function(json) {
						if(json.code == 1) {
							chrome.tabs.getSelected(null, function(tab) {
								chrome.tabs.sendRequest(tab.id, {
									url_get: url_get
								}, function(response) {
									alert(response.msg);
								});
							});
						} else {
							alert(json.msg);
						}
					}, 'json');

				});
			});
			return false;
		}

	} else if(info.menuItemId == "page_goods_price") {
		url_get = info.pageUrl;
		chrome.tabs.getSelected(null, function(tab) {
			chrome.tabs.sendRequest(tab.id, {
				price_get: 1
			}, function(response) {
				alert(url_get + ':' + response.msg);
			});
		});
		return false;
	} else if(info.menuItemId == "page_goods_tmall") {
		//chrome.contextMenus.update(info.menuItemId, {title:"asdasdsa"}, function(){});
		url_get = info.pageUrl;
		alert(url_get);
		chrome.tabs.getSelected(null, function(tab) {
			chrome.tabs.sendRequest(tab.id, {
				tmall_get: 1
			}, function(response) {
				if(response.code != 1) {
					alert(response.msg);
					return;
				}
			
				alert(response.data.title);
				alert(response.data.price);
				alert(response.data.pics);
				alert(response.data.attrs);
				for(var prop_name in response.data.skus){
					alert(prop_name+":"+response.data.skus[prop_name]);
				}
				
				$.post(getData('base_url'), {
					cmd: 'submit_tmall',
					v: 1,
					source_url: url_get,
					data: response.data
				}, function(json) {
					if(json.code == 1) {
						chrome.tabs.getSelected(null, function(tab) {
							chrome.tabs.sendRequest(tab.id, {
								url_get: url_get
							}, function(response) {
								alert(response.msg);
							});
						});
					} else {
						alert(json.msg);
					}
				}, 'json');

			});
		});
		return false;
	}
	
	/* $.post(getData('base_url'), {
		cmd: 'submit_taobao',
		v: 1,
		source_url: url_get
	}, function(json) {
		if(json.code == 1) {
			chrome.tabs.getSelected(null, function(tab) {
				chrome.tabs.sendRequest(tab.id, {
					url_get: url_get
				}, function(response) {
					alert(response.msg);
				});
			});
		} else {
			alert(json.msg);
		}
	}, 'json'); */
};

chrome.contextMenus.onClicked.addListener(onClickHandler);

// Set up context menu tree at install time.
chrome.runtime.onInstalled.addListener(function() {
	// Create one test item for each context type.
	var contexts = ["page", "selection", "link", "editable", "image", "video", "audio"];
	// for (var i = 0; i < contexts.length; i++) {
	// var context = contexts[i];
	// var title = "Test '" + context + "' menu item";
	// var id = chrome.contextMenus.create({"title": title, "contexts":[context],"id": "context" + context});
	// alert("'" + context + "' item:" + id);
	// }
	var id = chrome.contextMenus.create({
		"title": "采集该产品",
		"contexts": ["link"],
		"id": "link_goods"
	});
	var id2 = chrome.contextMenus.create({
		"title": "采集当前页面产品",
		"contexts": ["page"],
		"id": "page_goods"
	});
	//var id3 = chrome.contextMenus.create({"title": "采集当前价格", "contexts":["page"],"id": "page_goods_price"});
	//var id4 = chrome.contextMenus.create({"title": "天猫-采集当前页产品", "contexts":["page"],"id": "page_goods_tmall"});
});