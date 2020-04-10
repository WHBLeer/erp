
var prefix = "/ymx/productInfo"
$(function() {
	layuidate();
	loadType("ymx_product_audit");
	loadType("ymx_product_shelf");
	loadType("ymx_product_type");
	load();
	//getCount();
	inintqueryStopSale();
	getAgent();
	defineRole();
});
//获取代理商
function getAgent(){
	$.ajax({
		cache : true,
		type : "get",
		url : "/sys/user/listAgentJson",
		async : false,
		dataType : "json", // 接受数据格式
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if(data.length>0){
				var str="";
				for (var i = 0; i < data.length; i++) {
					str+="<option value='"+data[i].userId+"'>"+data[i].name+"</option>";
				}
				$("#userIdCreate").append(str);
			}

		}
	});
}
//获取员工
function getUser(){
	var userIdCreate=$("#userIdCreate").val();
	if(""==userIdCreate){
		$("#userId").html("<option value=''>选择员工</option>");
	}else{
		$.ajax({
			cache : true,
			type : "get",
			url : "/sys/user/listJson?userIdCreate="+userIdCreate,
			async : false,
			dataType : "json", // 接受数据格式
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				var str="<option value=''>选择员工</option>";
				if(data.length>0){
					for (var i = 0; i < data.length; i++) {
						str+="<option value='"+data[i].userId+"'>"+data[i].name+"</option>";
					}
					$("#userId").html(str);
				}else{
					$("#userId").html(str);
				}

			}
		});
	}
}
function huoquUser(rowval){
	$.ajax({
		url : '/sys/user/listJson',
		async: false,
		success : function(data) {
			//加载数据
			for (var i = 0; i < data.length; i++) {
				if(data[i].userId==rowval){
					rowval=data[i].name;
				}
			}
		}
	});
	return rowval;
}
//清空
function clearBtn(){
	$(':input','#myformBtn').not(':button,:submit, :reset, :hidden')
	.val('')
	.removeAttr('checked')
	.removeAttr('selected');
	var opt = {
        query:{
        	pcaId:"",
        }
    };
	$('#exampleTable').bootstrapTable('refresh',opt);
}
function getCount(){
	$.ajax({
		url : prefix + "/countNum",
		type: "POST",
		async: false,
		data:{
			paId:$("#ymx_product_auditstate").val(),
			psId:$("#ymx_product_shelfstate").val(),
			ptId:$("#ymx_product_typestate").val(),
			psoSpare3:$("#myproducts").val()
		},
		success : function(data) {
			//加载数据
			$("#qbNum").text(data.qbNum);
			$("#hbtcps").text(data.hbtcps);
			$("#btzs").text(data.btzs);
		}
	});
}
function load() {
	$('#exampleTable')
			.bootstrapTable(
					{
						method : 'get', // 服务器数据的请求方式 get or post
						url : prefix + "/list", // 服务器数据的加载地址
					//	showRefresh : true,
					//	showToggle : true,
					//	showColumns : true,
						iconSize : 'outline',
						toolbar : '#exampleToolbar',
						striped : true, // 设置为true会有隔行变色效果
						dataType : "json", // 服务器返回的数据类型
						pagination : true, // 设置为true会在底部显示分页条
						// queryParamsType : "limit",
						// //设置为limit则会发送符合RESTFull格式的参数
						singleSelect : false, // 设置为true将禁止多选
						// contentType : "application/x-www-form-urlencoded",
						// //发送到服务器的数据编码类型
						pageSize : 20, // 如果设置了分页，每页数据条数
						pageNumber : 1, // 如果设置了分布，首页页码
						//search : true, // 是否显示搜索框
						showColumns : false, // 是否显示内容下拉框（选择显示的列）
						sidePagination : "server", // 设置在哪里进行分页，可选值为"client" 或者 "server"
						queryParams : function(params) {
							return {
								//说明：传入后台的参数包括offset开始索引，limit步长，sort排序列，order：desc或者,以及所有列的键值对
								limit: params.limit,
								offset:params.offset,
								pcaId:$("#cplminp").val(),
								piTitle:$("#btinp").val(),
								piSku:$("#skuinp").val(),
								paId:$("#ymx_product_auditstate").val(),
								psId:$("#ymx_product_shelfstate").val(),
								ptId:$("#ymx_product_typestate").val(),
								beginstartTime:$("#test14").val(),
								beginendTime:$("#test15").val(),
								userId:$("#userId").val(),
								companyId:$("#userIdCreate").val(),
								psoSpare3:$("#myproducts").val(),
					           // name:$('#searchName').val(),
					           // username:$('#searchName').val()
							};
						},
						// //请求服务器数据时，你可以通过重写参数的方式添加一些额外的参数，例如 toolbar 中的参数 如果
						// queryParamsType = 'limit' ,返回参数必须包含
						// limit, offset, search, sort, order 否则, 需要包含:
						// pageSize, pageNumber, searchText, sortName,
						// sortOrder.
						// 返回false将会终止请求
						columns : [
								{
									checkbox : true
								},{
									field : 'piId', 
									title : '产品编号',
									visible: false
								},
																{
									field : '', 
									title : '图片',
									formatter : function(value, row, index){
										var str="";var photourl="";
										photourl=row.imgUrl;
										str+='<a  href="#" onclick="edit(\''+ row.piId + '\')"><img onmousemove="img_view(this)" onmouseout="normalImg(this)" style="width:40px"  src="'+photourl+'" /></a>';
										return str;
									}
								},
																{
									field : 'pcaId', 
									title : '产品信息',
									formatter : function(value, row, index){
										console.log(row);
										var str="";var pa="";var ps="";var pt="";
										str+='<a  href="#" style="font-size:15px"  onclick="edit(\''+ row.piId + '\')">'+row.piTitle+'&nbsp;&nbsp;&nbsp;&nbsp;<br></a>';
										if(row.productTranslationDO.ptTitle != null){
											if(row.whetherProduct=="NO"){
												str+='<span style="color:red">'+row.productTranslationDO.ptTitle+'</span>&nbsp;&nbsp;&nbsp;&nbsp;<br>'
											}else{
												str+=row.productTranslationDO.ptTitle+'&nbsp;&nbsp;&nbsp;&nbsp;<br>'
											}
										}
										str+="编号:"+row.piId+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+="SKU:"+row.piSku+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+="¥"+row.piPrice+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+="¥"+row.piPrice+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+='<a  href="'+row.piWebsite+'" target="view_window">'+row.piSource+'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
										pa=row.paIdName;
										ps=row.psIdName;
										pt=row.ptIdName;
										str+=pa+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+=ps+"&nbsp;&nbsp;&nbsp;&nbsp;";
										str+=pt;
										return str;
									}
								},
																{
									field : '', 
									title : '操作人',
									formatter : function(value, row, index){
										var str="";var username="";
										str+=row.piAddtime+'&nbsp;&nbsp;&nbsp;&nbsp;<br>';
										username=row.userName;
										/*companyName=huoquUser(row.companyId);
										str+='<span style="color: #ff9f57">业务员：'+username+'&nbsp;('+companyName+')</span>';*/
										str+='<span style="color: #ff9f57">业务员：'+username+'</span>';
										return str;
									}
								},
																{
									title : '操作',
									field : 'id',
									align : 'center',
									formatter : function(value, row, index) {
										var e = '<a class="btn btn-primary btn-sm '+s_edit_h+'" href="#" mce_href="#" title="编辑" onclick="edit(\''
												+ row.piId
												+ '\')"><i class="fa fa-edit"></i></a> ';
										var d = '<a class="btn btn-warning btn-sm '+s_remove_h+'" href="#" title="删除"  mce_href="#" onclick="remove(\''
												+ row.piId
												+ '\')"><i class="fa fa-remove"></i></a> ';
										var g = '<a class="btn btn-primary btn-sm '+s_copy_h+'" href="#" mce_href="#" title="复制产品" onclick="copyProduct(\''
												+ row.piId
												+ '\')"><i class="fa fa-copy"></i></a> ';
										var f = '<a class="btn btn-success btn-sm" href="#" title="备用"  mce_href="#" onclick="resetPwd(\''
												+ row.piId
												+ '\')"><i class="fa fa-key"></i></a> ';
										
										if(row.psoSpare3=="0"){
											$("#sele").html('<option>操作</option><option id="restore">恢复</option><option id="del_real">彻底删除</option>')
											return e ;
										}else{
											return e + d + g ;
										}
									}
								} ],
								
					});
}
function huoqu(obj,rowval){
	$.ajax({
		url : '/common/dict/list/'+obj,
		async: false,
		success : function(data) {
			//加载数据
			for (var i = 0; i < data.length; i++) {
				if(data[i].value==rowval){
					rowval=data[i].name;
				}
			}
		}
	});
	return rowval;
}
function huoquUser(rowval){
	$.ajax({
		url : '/sys/user/listJson',
		async: false,
		success : function(data) {
			//加载数据
			for (var i = 0; i < data.length; i++) {
				if(data[i].userId==rowval){
					rowval=data[i].name;
				}
			}
		}
	});
	return rowval;
}
function huoquPhoto(rowval){
	$.ajax({
		url : '/ymx/productPhoto/listJson',
		async: false,
		data:{
			pphPid:rowval,
			sort:"pph_order"
		},
		success : function(data) {
			if(typeof(data[0])!="undefined"&&data[0]!=null){
				//加载数据
				rowval=data[0].pphUrl;
			}
		}
	});
	return rowval;
}
function reLoad() {
	$('#exampleTable').bootstrapTable('refresh');
}
function img_view(obj){
	//var str = $(obj).attr('src').match(/._SL(\S*)_.jpg/)[1];
	var str=$(obj).attr('src');
	$('#img_viewer img').attr('src',str);
    $('#img_viewer').css('left',$(obj).offset().left+$(obj).width()+20);
    $('#img_viewer').css('top',$(obj).offset().top-300||10);
    $('#img_viewer').show();
}
function normalImg(obj){
	$('#img_viewer').hide();
}
function add() {
	$.ajax({
		url : prefix+"/addToUpdate",
		type : "get",
		success : function(r) {
			var indexed=layer.open({
				type : 2,
				title : '添加',
				maxmin : true,
				shadeClose : false, // 点击遮罩关闭层
				area : [ '800px', '520px' ],
				content : prefix + '/edit/' + r // iframe的url
			});
			layer.full(indexed);
		}
	});
}
function copyProduct(id){
	$.ajax({
		url : prefix+"/copyProduct",
		type : "post",
		data : {piId:id},
		success : function(r) {
			if (r.code==0) {
				layer.msg(r.msg);
				reLoad();
			}else{
				layer.msg(r.msg);
			}
		}
	});
}

function edit(id) {
	var indexed=layer.open({
		type : 2,
		title : '编辑',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '100%', '100%' ],
		content : prefix + '/edit/' + id // iframe的url
	});
	//layer.full(indexed);
}
function remove(id) {
	layer.confirm('确定要删除选中的记录？', {
		btn : [ '确定', '取消' ]
	}, function() {
		$.ajax({
			url : prefix+"/remove",
			type : "post",
			data : {
				'piId' : id
			},
			success : function(r) {
				if (r.code==0) {
					layer.msg(r.msg);
					reLoad();
				}else{
					layer.msg(r.msg);
				}
			}
		});
	})
}

function resetPwd(id) {
}
function batchUpdateSpare() {
	var rows = $('#exampleTable').bootstrapTable('getSelections'); // 返回所有选择的行，当没有选择的记录时，返回一个空数组
	if (rows.length == 0) {
		layer.msg("请选择数据");
		$("#sele option:first").prop("selected", 'selected');
		return;
	}
	layer.confirm("确认要删除选中的'" + rows.length + "'条数据吗?", {
		btn : [ '确定', '取消' ]
	// 按钮
	}, function() {
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(rows, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			type : 'POST',
			data : {
				"ids" : ids
			},
			url : prefix + '/batchUpdateSpare',
			success : function(r) {
				if (r.code == 0) {
					$("#sele option:first").prop("selected", 'selected');
					layer.msg(r.msg);
					reLoad();
				} else {
					layer.msg(r.msg);
				}
			}
		});
	}, function() {
		$("#sele option:first").prop("selected", 'selected');
	});
}
function batchUpdateSpare2() {
	var rows = $('#exampleTable').bootstrapTable('getSelections'); // 返回所有选择的行，当没有选择的记录时，返回一个空数组
	if (rows.length == 0) {
		layer.msg("请选择数据");
		$("#sele option:first").prop("selected", 'selected');
		return;
	}
	layer.confirm("确认要恢复选中的'" + rows.length + "'条数据吗?", {
		btn : [ '确定', '取消' ]
	// 按钮
	}, function() {
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(rows, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			type : 'POST',
			data : {
				"ids" : ids
			},
			url : prefix + '/batchUpdateSpare2',
			success : function(r) {
				if (r.code == 0) {
					$("#sele option:first").prop("selected", 'selected');
					layer.msg(r.msg);
					reLoad();
				} else {
					layer.msg(r.msg);
				}
			}
		});
	}, function() {
		$("#sele option:first").prop("selected", 'selected');
	});
}
function batchRemove() {
	var rows = $('#exampleTable').bootstrapTable('getSelections'); // 返回所有选择的行，当没有选择的记录时，返回一个空数组
	if (rows.length == 0) {
		layer.msg("请选择数据");
		$("#sele option:first").prop("selected", 'selected');
		return;
	}
	layer.confirm("确认要删除选中的'" + rows.length + "'条数据吗?", {
		btn : [ '确定', '取消' ]
	// 按钮
	}, function() {
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(rows, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			type : 'POST',
			data : {
				"ids" : ids
			},
			url : prefix + '/batchRemove',
			success : function(r) {
				if (r.code == 0) {
					$("#sele option:first").prop("selected", 'selected');
					layer.msg(r.msg);
					reLoad();
				} else {
					layer.msg(r.msg);
				}
			}
		});
	}, function() {
		$("#sele option:first").prop("selected", 'selected');
	});
}
function layuidate(){
	var nowTime = new Date().valueOf();
	var beginDate=laydate.render({
	    elem: '#test14',//指定元素
	    type: 'date',//日期
	    done:function(value, date){
	    	endDate.config.min=getDateArray(date);//重点
        }
	});
	var endDate=laydate.render({
	    elem: '#test15',//指定元素
	    type: 'date',//日期
	    done:function(value, date){
	    	beginDate.config.max=getDateArray(date);//重点
        }
	});
}
function getDateArray(date){//获取时间数组
    var darray={};
    darray.year=date.year;
    darray.month=date.month - 1;
    var day=date.date;
    if(date.hours == 23 && date.minutes == 59 && date.seconds == 59){
        day = day + 1;
    }else{
        darray.hours = date.hours;
        darray.minutes = date.minutes;
        darray.seconds = date.seconds;
    }
    darray.date=day;
    return darray;
}
function checkAndFid(it){
	$this=$(it);
	$this.parent().children("input").val($this.val());
	if($this.attr("data")==0){
		$this.attr("data",1);
		$this.parent().children("input").val($this.val());
		$this.attr("style","background: white;color:red;border: 1px solid red;margin-right:5px ");
		$this.siblings().each(function(){
			if($(this).attr("data")==1){
				$(this).attr("data",0);
				$(this).attr("style","background: white;color:black;margin-right:5px");
			}
		})
	}else{
		$this.attr("data",0);
		$this.parent().children("input").val("");
		$this.attr("style","background: white;color:black;margin-right:5px");
	}
	getCount();
	reLoad();
}
function loadType(obj){
	var html = "";
	$.ajax({
		url : '/common/dict/list/'+obj,
		success : function(data) {
			//加载数据
			for (var i = 0; i < data.length; i++) {
				var sum="";
				if(data[i].name=="通过"){
					sum=$("#tg").val()
				}
				if(data[i].name=="待审核"){
					sum=$("#dsh").val()
				}
				if(data[i].name=="上架"){
					sum=$("#sj").val()
				}
				if(data[i].name=="重点"){
					sum=$("#zd").val()
				}
				if(data[i].name=="失效"){
					sum=$("#sx").val()
				}
				if(data[i].name=="屏蔽"){
					sum=$("#pb").val()
				}
				if(data[i].name=="侵权"){
					sum=$("#qq").val()
				}
				if(data[i].name=="过滤"){
					sum=$("#gl").val()
				}
				if(data[i].name=="下架"){
					sum=$("#xj").val()
				}
				if(data[i].name=="其他"){
					sum=$("#qt").val()
				}
				if(data[i].name=="产品库"){
					sum=$("#cpk").val()
				}
				if(data[i].name=="抓取"){
					sum=$("#zq").val()
				}
				if(data[i].name=="海外"){
					sum=$("#hy").val()
				}
				if(data[i].name=="原创"){
					sum=$("#yc").val()
				}
				html += '<button class="btn btn-default  btn-sm" type="button" value="'+data[i].value+'"  data="0" style="background: white;color:black;margin-right:5px" onclick="checkAndFid(this)">'+data[i].name+'('+sum+')';
			}
			$("#"+obj).append(html);
		}
	});
}
//选择分类
function goToCategory(){
	layer.open({
		type : 2,
		title : '选择分类',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '620px' ],
		content :  prefix + '/goToCategory', // iframe的url
	});
}
//批量修改
function batchUpdate(){
	var check=$("#exampleTable").bootstrapTable('getSelections');
	var ids = new Array();
	// 遍历所有选择的行数据，取每条数据对应的ID
	$.each(check, function(i, row) {
		ids[i] = row['piId'];
	});
	if(check.length==0){
		layer.alert('请选择产品', {
			icon: 5,
			title: "提示"
		});
	}else{
		layer.open({
			type : 2,
			title : '批量编辑（选中'+check.length+'件产品）',
			maxmin : true,
			shadeClose : false, // 点击遮罩关闭层
			area : [ '40%', '100%' ],
			content :  prefix + '/batchUpdate?ids='+ids, // iframe的url
		});
	}
}
function aa(){
	var f=$("#sele").find("option:selected").attr("id");
	if(f=='ee'){
//		batchRemove();
		batchUpdateSpare();
	}else if(f=='aa'||f=='bb'){
		var check=$("#exampleTable").bootstrapTable('getSelections');
		if (check.length == 0) {
			layer.msg("请选择数据");
			$("#sele option:first").prop("selected", 'selected');
			return;
		}
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(check, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/productInfo/updateProductDan?ids="+ids,
			data : {
				"psId":$("#sele").find("option:selected").val(),
				
				},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if (data.code == 0) {
					$("#sele option:first").prop("selected", 'selected');
					parent.layer.msg("操作成功");
					reLoad();
				} else {
					$("#sele option:first").prop("selected", 'selected');
					parent.layer.alert(data.msg)
				}

			}
		});
	}else if(f=='cc'||f=='dd'){
		var check=$("#exampleTable").bootstrapTable('getSelections');
		if (check.length == 0) {
			layer.msg("请选择数据");
			$("#sele option:first").prop("selected", 'selected');
			return;
		}
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(check, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/productInfo/updateProductDan?ids="+ids,
			data : {
				"paId":$("#sele").find("option:selected").val(),
				},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if (data.code == 0) {
					$("#sele option:first").prop("selected", 'selected');
					parent.layer.msg("操作成功");
					reLoad();
				} else {
					$("#sele option:first").prop("selected", 'selected');
					parent.layer.alert(data.msg)
				}

			}
		});
	}else if(f=='restore'){
		batchUpdateSpare2();
	}else if(f=='del_real'){
		batchRemove();
	}
}
//批量清除SKU
function batchRemovesku(){
	var check=$("#exampleTable").bootstrapTable('getSelections');
	if (check.length == 0) {
		layer.msg("请选择数据");
		$("#sele option:first").prop("selected", 'selected');
		return;
	}

	layer.confirm('确定要清除SKU吗?', {
		btn : [ '确定', '取消' ]
	}, function(index) {
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(check, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/productInfo/batchRemoveSku?ids="+ids,
			//data : {"ids":ids},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if (data.code == 0) {
					parent.layer.msg("操作成功");
					reLoad();
				} else {
					parent.layer.alert(data.msg)
				}

			}
		});
		 layer.close(index);
	})
}
function batchRemoveofficial(){
	var check=$("#exampleTable").bootstrapTable('getSelections');
	if (check.length == 0) {
		layer.msg("请选择数据");
		$("#sele option:first").prop("selected", 'selected');
		return;
	}else{
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(check, function(i, row) {
			ids[i] = row['piId'];
		});
		layer.open({
			type : 2,
			title : '批量清除文案',
			maxmin : true,
			shadeClose : false, // 点击遮罩关闭层
			area : [ '30%', '30%' ],
			content :  prefix + '/RemoveOfficial?ids='+ids, // iframe的url
		});
	}
	/*layer.confirm('确定要清除文案吗?', {
		btn : [ '确定', '取消' ]
	},*/
	/*function(index) {
		var ids = new Array();
		// 遍历所有选择的行数据，取每条数据对应的ID
		$.each(check, function(i, row) {
			ids[i] = row['piId'];
		});
		$.ajax({
			cache : true,
			type : "POST",
			url : "/ymx/productInfo/batchRemoveofficial?ids="+ids,
			//data : {"ids":ids},
			async : false,
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if (data.code == 0) {
					parent.layer.msg("操作成功");
					reLoad();
				} else {
					parent.layer.alert(data.msg)
				}

			}
		});
		 layer.close(index);
	})*/
}
function inintqueryStopSale(){
	$.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/productInfo/queryStopSale",
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.length > 0) {
				$("#tingshouhid").show();
				var str="<ul>";
				for (var i = 0; i < data.length; i++) {
					str+="<li>产品编号:<a onclick='edit("+data[i].piId+")'>"+data[i].piId+"</a>&nbsp;&nbsp;&nbsp;&nbsp;产品源址:<a href='"+data[i].piWebsite+"' target='view_window'>"+data[i].piWebsite+"</a></li>"
				}
				str+="</ul>";
				$("#tingshoudiv").html(str);
			}
		}
	});
}
function queryStopSale(){
	layer.open({
        type: 1,
        title: false,
        area : "800px",
        content: $('#tingshoudiv'),
    });
}

function defineRole(){
	var roleName=getRoleName();
	if(roleName=="组长"){
//		$("#userIdCreate").hide();
//		$("#chuanshu").hide();
		$.ajax({
			cache : true,
			type : "get",
			url : "/sys/user/listMemberJson",
			async : false,
			dataType : "json", // 接受数据格式
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				if(data.length>0){
					var str="<option value=''>选择员工</option>";
					for (var i = 0; i < data.length; i++) {
						str+="<option value='"+data[i].userId+"'>"+data[i].name+"</option>";
					}
					$("#userId").html(str);
				}

			}
		});
	}
}

function getRoleName(){
	var role="";
	$.ajax({
		type : 'POST',
		async: false,
		dataType:"json",
		url : '/ymx/orderInfo/getRoleName',
		success : function(data) {
			role=data.roleName;
//			parent.layer.alert("*****"+role);
//			return role;
		}
	});
	return role;
}

//产品传输
function transferProduct(){
	layer.open({
		type : 2,
		title : '产品库传输',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '80%', '80%' ],
		content :'/ymx/productInfo/upTransferProduct?typehid=productchuanshu' // iframe的url
	});
}