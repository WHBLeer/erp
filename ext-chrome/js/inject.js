chrome.extension.onRequest.addListener(
	function (request, sender, sendResponse) {
		alert("p4: " + JSON.stringify(request));
		alert("p5: " + JSON.stringify(sender));
		alert("p6: " + JSON.stringify(sendResponse));
		if (sender.tab) {
			alert("from a content script:" + sender.tab.url);
		} else {
			alert("from the extension");
		}
		if (request.url_get == 1) {
			$('a[href="' + request.url_get + '"]').addClass("spider_yes");
			sendResponse({
				code: 1,
				msg: "采集成功"
			});
		} else if (request.price_get == 1) {
			var price = 0;
			if ($('#J_PromoPrice .tm-price').text() != '') {
				$('#J_PromoPrice .tm-price').addClass("spider_yes");
				price = $('.spider_yes').text();
			} else if ($('#J_StrPriceModBox .tm-price').text() != '') {
				$('#J_StrPriceModBox .tm-price').addClass("spider_yes");
				price = $('.spider_yes').text();
			}
			alert('price:' + price);

			if (price != '') {
				sendResponse({
					code: 0,
					msg: "get price:" + price
				}); // snub them.
			}

		} else if (request.tmall_get == 1) {
			var retData = {};
			var price = 0;
			if ($('#J_PromoPrice .tm-price').text() != '') {
				$('#J_PromoPrice .tm-price').addClass("spider_yes");
				price = $('#J_PromoPrice .tm-price').text();
			} else if ($('#J_StrPriceModBox .tm-price').text() != '') {
				$('#J_StrPriceModBox .tm-price').addClass("spider_yes");
				price = $('#J_StrPriceModBox .tm-price').text();
			}
			var title = '';
			if ($("meta[name=keywords]").attr("content") != "") {
				title = $("meta[name=keywords]").attr("content");
			}
			var pics = [];
			if ($("#J_UlThumb") != undefined) {
				$("#J_UlThumb img").each(function () {
					$(this).addClass("spider_yes");
					pics.push($(this).attr("src"));
				});
			}
			var skus = {};
			if ($(".J_TSaleProp") != undefined) {
				$(".J_TSaleProp").each(function () {
					var prop_name = $(this).attr('data-property');
					skus[prop_name] = [];
					$(this).addClass("spider_yes");
					if ($(this).hasClass("tb-img")) {
						$(this).find("a").each(function () {
							var tmp_url = $(this).css('backgroundImage');
							tmp_url = tmp_url.slice(5, -2);
							pics.push($.trim(tmp_url));
							skus[prop_name].push($.trim($(this).text()));
						});
					} else {
						$(this).find("a").each(function () {
							skus[prop_name].push($.trim($(this).text()));
						});
					}
				});
			}
			var attrs = {};
			if ($("#J_AttrUL li") != undefined) {
				$("#J_AttrUL li").each(function () {
					$(this).addClass("spider_yes");
					var tmp_attr = $.trim($(this).text());
					var tmp_attr_arr = tmp_attr.split(":");
					if (tmp_attr_arr.length == 2) {
						attrs[$.trim(tmp_attr_arr[0])] = $.trim(tmp_attr_arr[1]);
					}

				});

			}

			if (price != '') {
				retData['title'] = title;
				retData['price'] = price;
				retData['pics'] = pics;
				retData['skus'] = skus;
				retData['attrs'] = attrs;
				sendResponse({
					code: 1,
					msg: "yes",
					data: retData
				}); // snub them.
			}

		} else if (request.get_1688 == 1) {

			var retData = {};

			var price = 0;
			if ($("meta[property='og:product:price']").attr("content") != "") { //
				price = $("meta[property='og:product:price']").attr("content");
			}
			alert("price:" + price);
			var title = '';
			if ($("meta[property='og:title']").attr("content") != "") { //og:product:price
				title = $("meta[property='og:title']").attr("content");
			}
			alert("title:" + title + "price:" + price);

			var keywords = '';
			if ($("meta[name=keywords]").attr("content") != "") {
				keywords = $("meta[name=keywords]").attr("content");
			}
			alert("keywords:" + keywords);
			var pics = [];
			if ($("#dt-tab .tab-trigger") != undefined) {
				$("#dt-tab .tab-trigger").each(function () {
					$(this).addClass("spider_yes");
					var data_imgs = JSON.parse($(this).attr("data-imgs"));
					pics.push(data_imgs.original);
				});
			}
			var skus = {};

			if ($(".offerdetail_ditto_purchasing") != undefined) {
				$(".offerdetail_ditto_purchasing").addClass("spider_yes");
				var skuProps = [];
				$(".offerdetail_ditto_purchasing").find('.obj-header').each(function () {
					var prop_item = {};
					prop_item['prop'] = $.trim($(this).text());;
					prop_item['value'] = [];
					$(this).next('.obj-content').find('*[data-unit-config]').each(function () {
						var unit_config = JSON.parse($(this).attr("data-unit-config"));
						prop_item['value'].push({
							name: unit_config.name
						});
					});
					$(this).next('.obj-content').find('*[data-sku-config]').each(function () {
						var sku_config = JSON.parse($(this).attr("data-sku-config"));
						prop_item['value'].push({
							name: sku_config.skuName
						});
					});
					skuProps.push(prop_item);
				});
				skus['sku'] = {
					skuProps: skuProps
				};
			}
			alert(JSON.stringify(skus));

			var attrs = {};

			if ($("#mod-detail-attributes .obj-content") != undefined) {
				$("#mod-detail-attributes").addClass("spider_yes");
				$("#mod-detail-attributes .obj-content").find('.de-feature').each(function () {
					if ($.trim($(this).text()) != '') {
						attrs[$.trim($(this).text())] = $.trim($(this).next('.de-value').text());
					}
				});
			}

			if (title != '') {
				retData['title'] = title;
				retData['keywords'] = keywords;
				retData['price'] = price;
				retData['pics'] = pics;
				retData['skus'] = skus;
				retData['attrs'] = attrs;
				sendResponse({
					code: 1,
					msg: "yes",
					data: retData
				});
			}

		} else if (request.get_taobao == 1) {
			var retData = {};

			var price = 0;
			if ($("#J_PromoPriceNum").text() != "") { //
				price = $("#J_PromoPriceNum").text();
			}
			alert("price:" + price);
			var title = '';
			if ($(".tb-main-title").attr("data-title") != "") { //og:product:price
				title = $(".tb-main-title").attr("data-title");
			}
			alert("title:" + title + "price:" + price);

			var keywords = '';
			if ($("meta[name=keywords]").attr("content") != "") {
				keywords = $("meta[name=keywords]").attr("content");
			}
			alert("keywords:" + keywords);

			var pics = [];
			if ($("#J_UlThumb") != undefined) {
				$("#J_UlThumb img").each(function () {
					$(this).addClass("spider_yes");
					pics.push($(this).attr("src"));
				});
			}
			var pics = [];
			if ($("#J_UlThumb") != undefined) {
				$("#J_UlThumb img").each(function () {
					$(this).addClass("spider_yes");
					pics.push($(this).attr("src"));
				});
			}
			var skus = {};
			if ($(".J_TSaleProp") != undefined) {
				$(".J_TSaleProp").each(function () {
					var prop_name = $(this).attr('data-property');
					skus[prop_name] = [];
					$(this).addClass("spider_yes");
					if ($(this).hasClass("tb-img")) {
						$(this).find("a").each(function () {
							var tmp_url = $(this).css('backgroundImage');
							tmp_url = tmp_url.slice(5, -2);
							pics.push($.trim(tmp_url));
							skus[prop_name].push($.trim($(this).text()));
						});
					} else {
						$(this).find("a").each(function () {
							skus[prop_name].push($.trim($(this).text()));
						});
					}
				});
			}
			var attrs = {};
			if ($("#J_AttrUL li") != undefined) {
				$("#J_AttrUL li").each(function () {
					$(this).addClass("spider_yes");
					var tmp_attr = $.trim($(this).text());
					var tmp_attr_arr = tmp_attr.split(":");
					if (tmp_attr_arr.length == 2) {
						attrs[$.trim(tmp_attr_arr[0])] = $.trim(tmp_attr_arr[1]);
					}

				});

			}

			if (title != '') {
				retData['title'] = title;
				retData['keywords'] = keywords;
				retData['price'] = price;
				retData['pics'] = pics;
				retData['skus'] = skus;
				retData['attrs'] = attrs;
				sendResponse({
					code: 1,
					msg: "yes",
					data: retData
				});
			}

		} else {
			sendResponse({
				code: 0,
				msg: "failed mark"
			}); // snub them.
		}
	}
);