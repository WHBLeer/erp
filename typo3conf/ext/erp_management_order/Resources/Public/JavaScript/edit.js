$().ready(function() {
	// validateRule();
	//获取多个产品的订购数量
//	getProductnum();
//	获取订单号
//	getOrderNum();
	$(".delea").each(function(i){
		if($(this).text()=="已作废"){
			var objjie=$(this).parent().next();
			var obchild=$(objjie).children();
			var obspan=$(obchild[4]).find("a");
			$(obspan[0]).hide();
		}
	})
	$(".remark_type").each(function(){
		if($(this).text()==""){
			var iico=$(this).prev();
			$(iico).hide();
		}
	})
	$(".tbyundan").each(function(i){
		var objjie=$(this).parent().next();
		if($(this).text()=="未同步"||$(this).text()=="同步失败"){
			objjie.find(".bt_waybill_tongbu").show();
			objjie.find(".bt_waybill_ongoing").hide();
			objjie.find(".bt_waybill_shuaxin").hide();
		}else if($(this).text()=="正在同步"){
			objjie.find(".bt_waybill_tongbu").hide();
			objjie.find(".bt_waybill_ongoing").show();
			objjie.find(".bt_waybill_shuaxin").hide();
		}else{
			objjie.find(".bt_waybill_tongbu").hide();
			objjie.find(".bt_waybill_ongoing").hide();
			objjie.find(".bt_waybill_shuaxin").show();
		}
		
		if($(this).text()=="同步失败"){
			$(this).css("cursor","pointer");
			$(this).attr("title","查看详情");
			$(this).attr("onclick","getxiangxi(this);");
		}
	})
	$(".caigou_status").each(function(){
		if($(this).val()=="2"){
			var iico=$(this).parent().parent().parent();
			var obj=$(iico).find(".bt_supplierOrder_add");
			var qucg=$(obj[0]).show();//去采购
		}else if($(this).val()=="1"){
			var iico=$(this).parent().parent().parent();
			var obj=$(iico).find(".bt_supplierOrder_edit");
			var qucg=$(obj[0]).show();//已采购
		}
	})
});
function gotoProductInfo(it){
	$sku=$(it).html();
	var indexed=layer.open({
		type : 2,
		title : '产品',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '520px' ],
		content : '/ymx/productInfo/editBySKU/'+$sku // iframe的url
	});
	layer.full(indexed);
}
/*$.validator.setDefaults({
	submitHandler : function() {
		update();
	}
});*/

function getProductnum(){
	var numid=$("#numid").val();
	var numarr=numid.split(',');
	$(".waybill_num").each(function(i){
		$(this).val(numarr[i]);
	})
	$(".spannum").each(function(i){
		$(this).text(numarr[i]);
	})
	$(".spannumla").each(function(i){
		$(this).text(numarr[i]);
	})
}
/*function getOrderNum() {
	var caigouyunnum=document.getElementById("txt_caigou_express_num_");
	var replacementyunnum=document.getElementById("txt_replacement_express_num_");
	if(caigouyunnum.innerText==null && replacementyunnum.innerText==null  ){
		confirm("为避免影响国际物流发货,请尽快填写国内物流运单号1");
	}
	if( caigouyunnum.innerText=="" && replacementyunnum.innerText==""){
		parent.layer.open({
			type: 0,
			title: '基本信息',
			area:['200px','180px'],
			content: "&emsp;&emsp;该订单暂未添加国内运单号,为避免影响国际物流发货,请尽快填写。",
			shade: 0.2,
			resize: false
			})
	}
	
}*/
function update() {
	$.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/orderInfo/update",
		data : $('#signupForm').serialize(),// 你的formid
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				parent.reLoad();
				var index = parent.layer.getFrameIndex(window.name); // 获取窗口索引
				parent.layer.close(index);

			} else {
				parent.layer.alert(data.msg)
			}

		}
	});

}

var arrTable1=new Array();
var arrTable2=new Array();
var arrTable3=new Array();
var arrTable=new Array();
//获取多个产品信息
function getProductTable(){
	arrTable1=new Array();
	arrTable2=new Array();
	arrTable3=new Array();
	arrTable=new Array();
	//产品数量
	$(".waybill_num").each(function(){
		arrTable1.push($(this).val());
	})
	//采购价格
	$(".txt_caigou_price_").each(function(){
		arrTable2.push($(this).text());
	})
	//SKU码
	$(".SKU_num").each(function(){
		arrTable3.push($(this).text());
	})
	for (var i = 0; i < arrTable1.length; i++) {
		var inp=new Object();
		inp[1]=arrTable1[i];//产品数量
		inp[2]=arrTable2[i];//采购价格
		//英文名称
		inp[3]=$(".goods_title_short_en").val();
		//重量
		inp[4]=$(".goods_weight").val();
		//中文名称
		inp[5]=$(".goods_title_short_cn").val();
		
		inp[6]=arrTable3[i];//SKU码
		
		arrTable.push(inp);
	}
	tableJson = encodeURI(JSON.stringify(arrTable));
}

//添加保存生成运单
function addYundan(){
	getProductTable();
	if($("#shipping_method_code").val().length==0){
		parent.layer.alert("请选择线路");
		if($(".goods_title_short_en").val().length==0){
			parent.layer.alert("请输入英文简称");
		}
		if($(".goods_weight").val().length==0){
			parent.layer.alert("请输入重量");
		}
	}else{
		var type = $("#shipping_method").val();
//		parent.layer.alert("++++++++++"+type);
		if(type==1){
			$.ajax({
				type : "POST",
				url : "/ymx/orderInfo/addYundan",
				data : {
					shippingFirstName:$("#txt_shipping_name").text(),
					shippingAddress:$("#txt_shipping_addressline1").text(),
					shippingAddress2:$("#txt_shipping_addressline2").text(),
					shippingCity:$("#txt_shipping_city").text(),
					ShippingState:$("#txt_shipping_stateorregion").text(),
					ShippingZip:$("#txt_shipping_postalcode").text(),
					ShippingPhone:$("#txt_shipping_phone").text(),
					orderNumber:$("#idhid").val(),
					shippingMethodCode:$("#shipping_method_code").val(),
					tableJson:tableJson,
					zwName:$(".goods_title_short_cn").val(),
					ywName:$(".goods_title_short_en").val(),
					wulong:$(".goods_size_l").val(),
					wuwide:$(".goods_size_w").val(),
					wuhigh:$(".goods_size_h").val(),
					weight:$(".goods_weight").val(),
					shippingMethodText:$("#shipping_method_code").find("option:selected").text(),
				},
				async : false,
				error : function(request) {
					parent.layer.alert("Connection error");
				},
				success : function(data) {
					if (data.code == 0) {
						$(".tanyun").val(data.abroadYunnum);
						$(".tanzhui").val(data.abroadTracknum);
						parent.layer.msg("操作成功");
						location=location;
					} else {
						if(data.Feedback=="提交成功"){
							location=location;
						}
						parent.layer.alert(data.Feedback);
					}
				}
			});
		}else if(type==2){
			$.ajax({
				type : "POST",
				url : "/system/orderWuliuSt/addYundan",
				data : {
					customerOrderNo:$("#idhid").val(),//订单号
//					shipperName:$("").text(),//发件人姓名
					shippingMethod:$("#shipping_method_code").val(),//货运方式code
					recipientCountry:$("#countryName").text(),//收件人国家中文
					recipientName:$("#txt_shipping_name").text(),//收件人姓名
					recipientState:$("#txt_shipping_stateorregion").text(),// 收件人州或者省份 
					recipientCity:$("#txt_shipping_city").text(),//收件人城市 
					recipientAddress:$("#txt_shipping_addressline1").text(),//收件人地址/街道详细地址
					shippingAddress2:$("#txt_shipping_addressline2").text(),
					recipientZipCode:$("#txt_shipping_postalcode").text(),//收件人邮编 
					recipientPhone:$("#txt_shipping_phone").text(),//收件人电话 
					goodsDescription:$(".goods_title_short_en").val(),//包裹内物品描述 
					tableJson:tableJson,//物品详细
//					goodsDeclareWorth:$("").text(),// 包裹内物品申报价值（单位美元 USD） 
//					evaluate:$("").text(),//投保价值 
//					taxesNumber:$("").text(),//税号
					zwName:$(".goods_title_short_cn").val(),
					ywName:$(".goods_title_short_en").val(),
					goodsLength:$(".goods_size_l").val(),
					goodsWidth:$(".goods_size_w").val(),
					goodsHeight:$(".goods_size_h").val(),
					goodsWeight:$(".goods_weight").val(),
					recipientEmail:$(".recipientEmail").val(),
					shippingMethodText:$("#shipping_method_code").find("option:selected").text(),
				},
				async : false,
				error : function(request) {
					parent.layer.alert("Connection error");
				},
				success : function(data) {
					if (data.code == 0) {
						$(".tanyun").val(data.abroadYunnum);
						$(".tanzhui").val(data.abroadTracknum);
						parent.layer.msg("操作成功");
						location=location;
					} else {
						if(data.Feedback=="提交成功"){
							location=location;
						}
						parent.layer.alert(data.Feedback);
					}
				}
			});
		}else if(type==3){
			$.ajax({
				type : "POST",
				url : "/ymx/orderWuliuYw/addExpresses",
				data : {
					Channel:$("#shipping_method_code").val(),//发货方式编号
					ChannelName:$("#shipping_method_code").find("option:selected").text(),//发货方式名称
					UserOrderNumber:$("#idhid").val(),//客户订单号
					Name:$("#txt_shipping_name").text(),//收件人姓名
					Phone:$("#txt_shipping_phone").text(),//收件人电话 
					Email:$(".recipientEmail").val(),//收件人邮箱
					Country:$("#countryName").text(),//收件人国家中文
					Postcode:$("#txt_shipping_postalcode").text(),//收件人邮编 
					State:$("#txt_shipping_stateorregion").text(),// 收件人州或者省份 
					City:$("#txt_shipping_city").text(),//收件人城市 
					Address1:$("#txt_shipping_addressline1").text(),//收件人地址/街道详细地址
					Address2:$("#txt_shipping_addressline2").text(),
					NameCh:$(".goods_title_short_cn").val(),//商品中文名
					NameEn:$(".goods_title_short_en").val(),//商品英文名
					Weight:$(".goods_weight").val(),//包裹内总重量
					Length:$(".goods_size_l").val(),//包裹长
					Width:$(".goods_size_w").val(),//包裹宽
					Height:$(".goods_size_h").val(),//包裹高
					shippingMethodText:$("#shipping_method_code").find("option:selected").text(),//选择的路线
					tableJson:tableJson,//物品详细
					
				},
				async : false,
				error : function(request) {
					parent.layer.alert("Connection error");
				},
				success : function(data) {
					if (data.code == 0) {
						$(".tanyun").val(data.abroadYunnum);
						$(".tanzhui").val(data.abroadTracknum);
						parent.layer.msg("操作成功");
						location=location;
					} else {
						if(data.Feedback=="提交成功"){
							location=location;
						}
						parent.layer.alert(data.Feedback);
					}
				}
			});
		}else if(type==4){
			$.ajax({
				type : "POST",
				url : "/ymx/orderWuliuZh/createorder",
				data : {
					Channel:$("#shipping_method_code").val(),//发货方式编号
					ChannelName:$("#shipping_method_code").find("option:selected").text(),//发货方式名称
					UserOrderNumber:$("#idhid").val(),//客户订单号
					Name:$("#txt_shipping_name").text(),//收件人姓名
					Phone:$("#txt_shipping_phone").text(),//收件人电话 
					Email:$(".recipientEmail").val(),//收件人邮箱
					Country:$("#countryName").text(),//收件人国家中文
					Postcode:$("#txt_shipping_postalcode").text(),//收件人邮编 
					State:$("#txt_shipping_stateorregion").text(),// 收件人州或者省份 
					City:$("#txt_shipping_city").text(),//收件人城市 
					Address1:$("#txt_shipping_addressline1").text(),//收件人地址/街道详细地址
					Address2:$("#txt_shipping_addressline2").text(),
					NameCh:$(".goods_title_short_cn").val(),//商品中文名
					NameEn:$(".goods_title_short_en").val(),//商品英文名
					Weight:$(".goods_weight").val(),//包裹内总重量
					Length:$(".goods_size_l").val(),//包裹长
					Width:$(".goods_size_w").val(),//包裹宽
					Height:$(".goods_size_h").val(),//包裹高
					tableJson:tableJson//物品详细
					
				},
				async : false,
				error : function(request) {
					parent.layer.alert("Connection error");
				},
				success : function(data) {
					if (data.code == 0) {
						$(".tanyun").val(data.abroadYunnum);
						$(".tanzhui").val(data.abroadTracknum);
						parent.layer.msg("操作成功");
						location=location;
					} else {
						if(data.cnmessage=="提交成功"){
							location=location;
						}
						parent.layer.alert(data.cnmessage);
					}
				}
			});
		}
		
	}
}

//标签打印
function printYundan(obj){
	var objjie=$(obj);
	var obparent=$(objjie).parent().parent().parent();
	var obchild=$(obparent).children();
	var obspan=$(obchild[0]).find("span");
	var obtext=$(obspan[0]).text();
	
	var oblaber=$(obchild[0]).find("label");
	var labertext=$(oblaber[5]).text();
	if(labertext.length==0){
		$.ajax({
			type : "POST",
			url : "/ymx/orderInfo/printYundan",
			data : {
				yunId:obtext,
			},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				console.log(data);
				console.log(data==000);
				if(data==000){
					parent.layer.msg("无效的运单");
				}else if(data==111){
					window.location.href='/ymx/orderWuliuYw/downFile?yunId='+obtext;
				}else{
					window.open(data,"_blank"); 
				}
				
			}
		});
	}else{
		parent.layer.msg("无效的运单");
	}
	
}
//更新国际运单状态
function uprenew(){
	$.ajax({
		type : "POST",
		url : "/ymx/orderInfo/getYuntra",
		data : {
			orderId:$("#idhid").val(),
		},
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
			} else {
				parent.layer.alert(data.msg)
			}
		}
	});
}
//运单删除
function DeleteYundan(obj){
	layer.confirm('确认作废?', {
		btn : [ '确定', '取消' ]
	}, function(index) {
		var objjie=$(obj);
		var obparent=$(objjie).parent().parent().parent();
		var obchild=$(obparent).children();
		var obspan=$(obchild[0]).find("span");
		var obtext=$(obspan[0]).text();
		$.ajax({
			type : "POST",
			url : "/ymx/orderInfo/DeleteYundan",
			data : {
				yunId:obtext,
			},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				parent.layer.msg(data);
				location=location;
			}
		});
	})
}

/*function validateRule() {
	var icon = "<i class='fa fa-times-circle'></i> ";
	$("#signupForm").validate({
		rules : {
			name : {
				required : true
			}
		},
		messages : {
			name : {
				required : icon + "请输入名字"
			}
		}
	})
}*/

//修改采购信息
$('.bt_purchase_edit').click(function(){
    var order_item_id = $(this).attr('order_item_id');
    $('.bt_purchase_save[order_item_id='+order_item_id+']').show();
    $('.bt_purchase_cancle[order_item_id='+order_item_id+']').show();
    $('.bt_purchase_edit[order_item_id='+order_item_id+']').hide();
    $('.block_info_purchase_[order_item_id='+order_item_id+']').hide();
    $('.block_info_purchase_edit_[order_item_id='+order_item_id+']').show();
    $('.caigou_price_[order_item_id='+order_item_id+']').val($('.txt_caigou_price_[order_item_id='+order_item_id+']').text());
    $(".caigou_express_num_[order_item_id='"+order_item_id+"']").val($('.txt_caigou_express_num_[order_item_id='+order_item_id+']').text());
});
function purchaseback(order_item_id){
    $('.bt_purchase_save[order_item_id='+order_item_id+']').hide();
    $('.bt_purchase_cancle[order_item_id='+order_item_id+']').hide();
    $('.bt_purchase_edit[order_item_id='+order_item_id+']').show();
    $('.block_info_purchase_[order_item_id='+order_item_id+']').show();
    $('.block_info_purchase_edit_[order_item_id='+order_item_id+']').hide();
}
//取消保存采购信息
$('.bt_purchase_cancle').click(function(){
	var order_item_id = $(this).attr('order_item_id');
	purchaseback(order_item_id);
});
//保存采购信息
$('.bt_purchase_save').click(function(){
    var order_item_id = $(this).attr('order_item_id');
    var caigouprice=$('.caigou_price_[order_item_id='+order_item_id+']').val();
    var homeyunnum=$('.caigou_express_num_[order_item_id='+order_item_id+']').val();
    caigouprice = caigouprice.replace(/\s+/g,"");
    homeyunnum = homeyunnum.replace(/\s+/g,"");
    $.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/orderInfo/updateHome",
		data : {
			id:$('.homehidid[order_item_id='+order_item_id+']').val(),
			orderid:$("#idhid").val(),
			homeYunnum:homeyunnum,
			homeCaigou:caigouprice,
		},// 你的formid
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
			} else {
				parent.layer.alert(data.msg)
			}
		}
	});
});
//修改收货人地址
$('#bt_addr_edit').click(function(){
    $('#bt_addr_save').show();
    $('#bt_addr_cancle').show();
    $('#bt_addr_edit').hide();
    $('#block_info_addr').hide();
    $('#block_info_addr_edit').show();

    $('input[name="shipping_name"]').val($('#txt_shipping_name').text());
    $('input[name="shipping_phone"]').val($('#txt_shipping_phone').text());
    $('input[name="shipping_postalcode"]').val($('#txt_shipping_postalcode').text());
    $('input[name="shipping_stateorregion"]').val($('#txt_shipping_stateorregion').text());
    $('input[name="shipping_city"]').val($('#txt_shipping_city').text());
    $('input[name="shipping_addressline1"]').val($('#txt_shipping_addressline1').text());
    $('textarea[name="shipping_addressline2"]').val($('#txt_shipping_addressline2').text());

});
function addrback(){
	$('#bt_addr_save').hide();
    $('#bt_addr_cancle').hide();
    $('#bt_addr_edit').show();
    $('#block_info_addr').show();
    $('#block_info_addr_edit').hide();
}
//取消修改收货人地址
$('#bt_addr_cancle').click(function(){
	addrback();
});
//保存收货人地址
$('#bt_addr_save').click(function(){
	$.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/orderInfo/updatePerson",
		data : {
			id:$("#idhid").val(),
			buyerName:$("#lianxiren").val(),
			buyerPhone:$("#dianhua").val(),
			buyerCode:$("#youbian").val(),
			buyerState:$("#zhouzhou").val(),
			buyerCity:$("#shishi").val(),
			buyerDoor:$("#jiedao").val(),
			buyerAdress:$("#shipping_addressline2").val(),
		},// 你的formid
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
			} else {
				parent.layer.alert(data.msg)
			}

		}
	});
});



//添加运单
$('#bt_add_waybill').click(function(){
    check_waybill_form();
    var cgcost=$("#txt_caigou_price_").text();
    if(cgcost==null||""==cgcost){
    	parent.layer.alert("请先填写采购价");
    }else{
    	$.ajax({
    		type : "POST",
			url: "/api/getlogistics/?cmd=GetShippingMethods",
    		data : {
    			id:$("#idhid").val()
    		},
    		async : false,
    		success : function(data) {
    			if(data!=null&&data!=""){
    				var str='<option value="">-运输线路-</option>';
    				for (var i = 0; i < data.length; i++) {
						str += '<option value="' + data[i].Code + '">' + data[i].CName+'</option>';
    				}
    				$("#shipping_method_code").html(str);
    				layer.open({
    			        type: 1,
    			        title: '国际运单',
    			        area: ['70%',  '60%'],
    			        shade: 0,
    			        closeBtn: 1,
    			        shadeClose: true,
    			        content: $('#block_waybill_edit'),
    			        scrollbar: false,
    			        end:function(){
    			            location=location;
    			        }
    			    });
    			}else{
    				parent.layer.alert("您的账号余额不足，无法生成运单，请充值");
//    				layer.alert("账号余额不足500元，无法生成运单，请充值");
//    				layer.open({
//    					  title: '信息',
//    					  content: '账号余额不足500元，无法生成运单，请充值'
//    					});
    			}
    			
    		}
    	});
    }
    
});
//运单明细
function getMingxi(obj){
	var objjie=$(obj);
	var obparent=$(objjie).parent().parent().parent();
	var obchild=$(obparent).children();
	var obspan=$(obchild[0]).find("span");
	var obtext=$(obspan[0]).next().val();
	var objdata;
	
	var oblaber=$(obchild[0]).find("label");
	var labertext=$(oblaber[5]).text();
	if(labertext.length==0){
		$.ajax({
			type : "get",
			url : "/ymx/orderAbroad/getById",
			data : {
				id:obtext
			},
			async : false,
			success : function(data) {
				objdata=data;
			}
		});
		check_waybill_form(objdata);
		layer.open({
	        type: 1,
	        title: '国际运单',
	        area: ['85%',  '65%'],
	        shade: 0,
	        closeBtn: 1,
	        shadeClose: true,
	        content: $('#block_waybill_edit'),
	        scrollbar: false,
	        end:function(){
	            location=location;
	        }
	    });
	}else{
		parent.layer.msg("无效的运单");
	}
	
	
}
//运单表单核对，有运单信息为编辑，没有为新建
function check_waybill_form(waybill){
    if(waybill == undefined){
        //创建
        $('input[name="waybill_number"]').val('');
        $('#waybill_remark').val('');
        $('input[name="goods_size_l"]').removeAttr("readonly");
        $('input[name="goods_size_w"]').removeAttr("readonly");
        $('input[name="goods_size_h"]').removeAttr("readonly");
        $('input[name="goods_weight"]').removeAttr("readonly");
        $('input[name="goods_title_short_cn"]').removeAttr("readonly");
        $('input[name="goods_title_short_en"]').removeAttr("readonly");
        $('select[name="partner_com"]').removeAttr("disabled");
        $('select[name="shipping_method_code"]').removeAttr("disabled");
        $('#btns_waybill_action').show();
        $('.box_waybill_num_action .layui-form-item').show();
        $('.box_waybill_num_action .waybill_num_edit_text').hide();

        $('#shipping_method_code').children('option[value!=""]').remove();
        $('#partner_com').change();

        $('.waybill_deliver_action').hide();
        $('#box_waybill_remark').hide();
    }else{
        //编辑
        $('#block_waybill_edit').data('waybill-id',waybill.id);
        $('input[name="goods_size_l"]').attr("readonly","readonly");
        $('input[name="goods_size_w"]').attr("readonly","readonly");
        $('input[name="goods_size_h"]').attr("readonly","readonly");
        $('input[name="goods_weight"]').attr("readonly","readonly");
        $('input[name="goods_title_short_cn"]').attr("readonly","readonly");
        $('input[name="goods_title_short_en"]').attr("readonly","readonly");
        $('select[name="partner_com"]').attr("disabled","disabled");
        $('select[name="shipping_method_code"]').attr("disabled","disabled");
        $('.box_waybill_num_action .layui-form-item').hide();
        $('.box_waybill_num_action .waybill_num_edit_text').show();
        $('#btns_waybill_action').hide();

//        if(waybill.item_type_num > 1){
//            for(sub_item in waybill.items_json){
//                $('.box_waybill_num_action[data-item-id="'+waybill.items_json[sub_item].item_id+'"] .layui-form-item').hide();
//                $('.box_waybill_num_action[data-item-id="'+waybill.items_json[sub_item].item_id+'"] .waybill_num_edit_text span').text(waybill.items_json[sub_item].item_num);
//                $('.box_waybill_num_action[data-item-id="'+waybill.items_json[sub_item].item_id+'"] .waybill_num_edit_text').show();
//            }
//        }else{
//            //
//            $('.box_waybill_num_action[data-item-id="'+waybill.item_id+'"] .layui-form-item').hide();
//            $('.box_waybill_num_action[data-item-id="'+waybill.item_id+'"] .waybill_num_edit_text span').text(waybill.item_num);
//            $('.box_waybill_num_action[data-item-id="'+waybill.item_id+'"] .waybill_num_edit_text').show();
//        }
        $('input[name="goods_title_short_cn"]').val(waybill.abroadZwmc);
        $('input[name="goods_title_short_en"]').val(waybill.abroadYwmc);
        $('input[name="goods_size_l"]').val(waybill.abroadLong);
        $('input[name="goods_size_w"]').val(waybill.abroadWide);
        $('input[name="goods_size_h"]').val(waybill.abroadHigh);
        $('input[name="goods_weight"]').val(waybill.abroadWeight);
        $('input[name="waybill_number"]').val(waybill.abroadYunnum);
        $('input[name="tracking_number"]').val(waybill.abroadTracknum);
        $("#text_deliver_confirm").text(waybill.abroadYunstate);
//        $('select[name="partner_com"]').val(waybill.partner_com);
//        if(waybill.partner_com == 'santai'){
//            $('input[name="hs_code"]').val(waybill.hs_code);
//            $('#box_hs_code').show();
//        }else{
//            $('#box_hs_code').hide();
//        }
//        $('#shipping_method_code').children('option[value!=""]').remove();
//        $('#shipping_method_code').append('<option value="'+waybill.shipping_method_code+'" selected="selected">'+waybill.shipping_method_name+'</option>');
//        //$('select[name="shipping_method_code"]').val(waybill.shipping_method_code);
//        $('#waybill_remark').val(waybill.remark);
//
//        //waybill.
//        if(waybill.status == 1){
//            $('#text_deliver_confirm').text('未发货');
//        }else{
//            $('#text_deliver_confirm').text(waybill.status==2?'已发货':'已签收');
//        }
//        if(waybill.sync_amazon == 0){
//            $('#text_waybill_sync').text('未同步');
//            $('#bt_waybill_sync').show();
//        }else{
//            var text_waybill_sync = '';
//            if(waybill.sync_amazon == 1){
//                text_waybill_sync = '已提交';
//            }
//            if(waybill.sync_amazon == 2){
//                text_waybill_sync = '同步成功';
//            }
//            if(waybill.sync_amazon == 3){
//                text_waybill_sync = '同步失败';
//            }
//            if(waybill.sync_amazon == 4){
//                text_waybill_sync = '不需同步';
//            }
//            $('#text_waybill_sync').text(text_waybill_sync);
//            $('#bt_waybill_sync').hide();
//        }
//        $('.waybill_deliver_action').show();
//        $('#box_waybill_remark').show();
    }
}

//添加备注
$('#bt_remark').click(function(){
    var content = $('#content_remark').val();
    var remark_type = $('#remark_type').val();
    $.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/orderMessage/save",
		data : {
			messageType:remark_type,
			messageContent:content,
            orderId:$("#idhid").val(),
		},
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
			} else {
				parent.layer.alert(data.msg)
			}

		}
	});
});
//图片放大查看
function img_view(obj){
	//var str = $(obj).attr('src').match(/._SL(\S*)_.jpg/)[1];
	var str =$(obj).attr('src').match(/._SL(\S*)/)[1];
	str=$(obj).attr('src').replace(str,"");
	str=str+"500_.jpg";
	$('#img_viewer img').attr('src',str);
    // $('#img_viewer').css('left',$(obj).offset().left+$(obj).width()+20);
    $('#img_viewer').css('left',$(obj).width()+60);
    $('#img_viewer').css('top',$(obj).offset().top-100||10);
    $('#img_viewer').show();
}
function normalImg(obj){
	$('#img_viewer').hide();
}

//保存补发信息
$('.bt_replacement_save').click(function(){
    var order_item_id = $(this).attr('order_item_id');
    var bufaprice=$('.replacement_price_[order_item_id='+order_item_id+']').val();
    var bufayunnum=$('.replacement_express_num_[order_item_id='+order_item_id+']').val();
    bufaprice = bufaprice.replace(/\s+/g,"");
    bufayunnum = bufayunnum.replace(/\s+/g,"");
    $.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/orderInfo/updateReplacement",
		data : {
			id:$('.replacementhidid[order_item_id='+order_item_id+']').val(),//补发的id
			orderid:$("#idhid").val(),//订单id
			bufaYunnum:bufayunnum,//补发单号
			bufaPrice:bufaprice,//补发价
		},// 你的formid
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
			} else {
				parent.layer.alert(data.msg);
			}
		}
	});
});

//修改补发信息
$('.bt_replacement_edit').click(function(){
    var order_item_id = $(this).attr('order_item_id');
    $('.bt_replacement_save[order_item_id='+order_item_id+']').show();
    $('.bt_replacement_cancle[order_item_id='+order_item_id+']').show();
    $('.bt_replacement_edit[order_item_id='+order_item_id+']').hide();
    $('.block_info_replacement_[order_item_id='+order_item_id+']').hide();
    $('.block_info_replacement_edit_[order_item_id='+order_item_id+']').show();
    $('.replacement_price_[order_item_id='+order_item_id+']').val($('.txt_replacement_price_[order_item_id='+order_item_id+']').text());
    $(".replacement_express_num_[order_item_id='"+order_item_id+"']").val($('.txt_replacement_express_num_[order_item_id='+order_item_id+']').text());
});
function purchaseback1(order_item_id){
    $('.bt_replacement_save[order_item_id='+order_item_id+']').hide();
    $('.bt_replacement_cancle[order_item_id='+order_item_id+']').hide();
    $('.bt_replacement_edit[order_item_id='+order_item_id+']').show();
    $('.block_info_replacement_[order_item_id='+order_item_id+']').show();
    $('.block_info_replacement_edit_[order_item_id='+order_item_id+']').hide();
}
//获取相应物流路线
function getload(){
	var type = $("#shipping_method").val();
	if(type==2){
		$.ajax({
			cache : true,
			type : "get",
			url : "/system/orderWuliuSt/listByCountry",
			data :{
				customerOrderNo:$("#idhid").val(),//订单号
				goodsLength:$(".goods_size_l").val(),//长
				goodsWidth:$(".goods_size_w").val(),//宽
				goodsHeight:$(".goods_size_h").val(),//高
				goodsWeight:$(".goods_weight").val(),//重量
				num:$("#totalNum").text()//商品数量
			},
			async : false,
			dataType : "json", // 接受数据格式
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				var str="<option value=''>--线路--</option>";
				if(data.length>0){
					for (var i = 0; i < data.length; i++) {
//						str+="<option value='"+data[i].methodCode+"'>"+data[i].cnName+"</option>";
						str+="<option value='"+data[i].shiptype+"'>"+data[i].shiptypecnname+"(￥"+data[i].totalfee+")"+"</option>";
					}
					$("#shipping_method_code").html(str);
				}else{
					$("#shipping_method_code").html(str);
				}
			}
		});
	}else if(type==1){
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/orderInfo/getAllWuXian",
//			data :{
//				customerOrderNo:$("#idhid").val(),//订单号
//				goodsLength:$(".goods_size_l").val(),//长
//				goodsWidth:$(".goods_size_w").val(),//宽
//				goodsHeight:$(".goods_size_h").val(),//高
//				goodsWeight:$(".goods_weight").val(),//重量
//			},
			async : false,
			dataType : "json",
			success : function(data) {
				var str='<option value="">-线路-</option>';
				if(data!=null&&data!=""){
					for (var i = 0; i < data.length; i++) {
//						str+='<option value="'+data[i].code+'">'+data[i].shippingMethodName+'(￥'+data[i].totalFee+')'+'</option>';
						str+='<option value="'+data[i].code+'">'+data[i].fullName+'</option>';
					}
					$("#shipping_method_code").html(str);
				}else{
					$("#shipping_method_code").html(str);
				}
			}
		})
	}else if(type==3){
		$.ajax({
			cache : true,
			type : "GET",
			url : "/ymx/orderWuliuYw/listJson",
//			data :{
//				customerOrderNo:$("#idhid").val(),//订单号
//				goodsLength:$(".goods_size_l").val(),//长
//				goodsWidth:$(".goods_size_w").val(),//宽
//				goodsHeight:$(".goods_size_h").val(),//高
//				goodsWeight:$(".goods_weight").val(),//重量
//			},
			async : false,
			dataType : "json",
			success : function(data) {
				var str='<option value="">-线路-</option>';
				if(data!=null&&data!=""){
					for (var i = 0; i < data.length; i++) {
//						str+='<option value="'+data[i].code+'">'+data[i].shippingMethodName+'(￥'+data[i].totalFee+')'+'</option>';
						str+='<option value="'+data[i].code+'">'+data[i].name+'</option>';
					}
					$("#shipping_method_code").html(str);
				}else{
					$("#shipping_method_code").html(str);
				}
			}
		})
	}else if(type==4){
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/orderWuliuZh/getFeetrail",
			data :{
				customerOrderNo:$("#idhid").val(),//订单号
				length:$(".goods_size_l").val(),//长
				width:$(".goods_size_w").val(),//宽
				height:$(".goods_size_h").val(),//高
				weight:$(".goods_weight").val(),//重量
				postCode:$("#txt_shipping_postalcode").text(),//邮编
				num:$("#totalNum").text()//商品数量
			},
			async : false,
			dataType : "json",
			success : function(data) {
				var str='<option value="">-线路-</option>';
				if(data!=null&&data!=""){
					for (var i = 0; i < data.length; i++) {
						str+='<option value="'+data[i].code+'">'+data[i].cnname+'(￥'+data[i].totalFee+')'+'</option>';
//						str+='<option value="'+data[i].code+'">'+data[i].name+'</option>';
					}
					$("#shipping_method_code").html(str);
				}else{
					$("#shipping_method_code").html(str);
				}
			}
		})
	}
	
}
//取消保存补发信息
$('.bt_replacement_cancle').click(function(){
	var order_item_id = $(this).attr('order_item_id');
	purchaseback1(order_item_id);
});
//跳转物流路线选择指南
function preview() {
	//window.open("../getInstruction");
	window.location.href="/blog/open/post/"+127;
}

$(".goods_weight").change(function(){
	getload();
})

$(".goods_size_l").change(function(){
	getload();
})

$(".goods_size_w").change(function(){
	getload();
})

$(".goods_size_h").change(function(){
	getload();
})

function tongbu(obj){
	layer.confirm('确定同步该运单信息并发货？', {
		btn : [ '确定', '取消' ]
	}, function(index) {
		var objjie=$(obj);
		var obparent=$(objjie).parent().parent().parent();
		var obchild=$(obparent).children();
		var obspan=$(obchild[0]).find("span");
		var obtext=$(obspan[0]).text();//运单号
		
		var oblaber=$(obchild[0]).find("label");
		var labertext=$(oblaber[5]).text();//运单状态
		if(labertext.length==0){
			$.ajax({
				type : "POST",
				url : "/ymx/orderInfo/tongBuYundan",
				data : {
					yunId:obtext,
					amazonId:$("#amazonId").text(),
					shopName:$("#shopName").text(),
					id:$("#idhid").val()
				},
				async : false,
				error : function(request) {
					parent.layer.alert("Connection error");
				},
				success : function(r) {
					if(r.code!=0){
						parent.layer.msg("无效的运单");
					}else{
						parent.layer.msg(r.msg);
						location=location;
						$.ajax({
							cache : true,
							type : "POST",
							url : "/ymx/orderInfo/autoUpload1",
							data : r.data,// 你的formid
						});
					}
					
				}
			});
		}else{
			parent.layer.msg("无效的运单");
		};
		layer.close(index);
	})
	
}

function shuaxin(obj){
	var objjie=$(obj);
	var obparent=$(objjie).parent().parent().parent();
	var obchild=$(obparent).children();
	var obspan=$(obchild[0]).find("span");
	var obtext=$(obspan[0]).text();//运单号
	
	var objinput=$(obparent).find(".yundanUploadId");
	var obtyuid=$(objinput[0]).val();
	
	var oblaber=$(obchild[0]).find("label");
	var labertext=$(oblaber[5]).text();//运单状态
	if(labertext.length==0){
		$.ajax({
			type : "POST",
			url : "/ymx/orderInfo/refresh",
			data : {
				id:obtyuid
			},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if(data.code!=0){
					parent.layer.msg("无效的运单");
				}else{
					parent.layer.msg(data.msg);
					location=location;
				}
				
			}
		});
	}else{
		parent.layer.msg("无效的运单");
	}
}

function getxiangxi(obj){
	var objjie=$(obj);
	var obparent=$(objjie).parent().parent();
	var objinput=$(obparent).find(".yundanUploadId");
	var obtyuid=$(objinput[0]).val();
	if(obtyuid!=null){
		$.ajax({
			type : "POST",
			url : "/ymx/orderInfo/gettbErrotr",
			data : {
				yunuploadid:obtyuid
			},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if(data.code!=0){
					parent.layer.msg("暂无同步失败信息");
				}else{
					parent.layer.alert(data.msg);
				}
				
			}
		});
	}else{
		parent.layer.msg("暂无同步失败信息");
	}
}

$('.bt_supplierOrder_add').click(function(){
//    var order_item_id = $(this).attr('order_item_id');
	var obparent=$(this).parent().parent().parent().parent();
	var obspan=$(obparent).find(".SKU_num");
	var obtext=$(obspan[0]).text();//SKU
	var obspan1=$(obparent).find(".spannumla");
	var num=$(obspan1[0]).text();//数量
	var idhid=$("#idhid").val();
	
    if(obtext!=null){
    	$.ajax({
    		url : "/ymx/productInfo/getBySKU",
    		type : "get",
    		data : {
    			SKU : obtext
    		},
    		success : function(r) {
    			console.log("code:"+r.piId);
    			if(r.code==0){
    				layer.open({
    		    		type : 2,
    		    		title : '采购',
    		    		maxmin : true,
    		    		shadeClose : false, // 点击遮罩关闭层
    		    		area : [ '800px', '520px' ],
    		    		content : '/ymx/supplierOrderInfo/add/'+r.piId+"/"+idhid+"/"+num+"/"+r.homeId // iframe的url
    		    	});
    			}else{
    				parent.layer.msg("该产品不存在");
    			}
    		}
    	});
    }else{
    	parent.layer.msg("该产品不存在");
    }
});

$('.bt_supplierOrder_edit').click(function(){
//  var order_item_id = $(this).attr('order_item_id');
	var obparent=$(this).parent().parent().parent().parent();
	var obspan=$(obparent).find(".supplier_order_id");//供应商订单id
	var obtext=$(obspan[0]).val();//供应商订单id
	
  if(obtext!=null){
	  layer.open({
    		type : 2,
    		title : '已采购',
    		maxmin : true,
    		shadeClose : false, // 点击遮罩关闭层
    		area : [ '800px', '520px' ],
    		content : '/ymx/supplierOrderInfo/editnew/'+obtext // iframe的url
    	});
  }else{
  	parent.layer.msg("该订单不存在");
  }
});
