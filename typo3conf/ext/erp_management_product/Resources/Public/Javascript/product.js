var prefix = "/getproduct";


// 变体
function getAllBian(){
	$psoId=$("#psoId").val();
	$.ajax({
		type : "post",
		url : "/ymx/productCombination/listJson",
		// async:false,
		data : {
			"piId":$psoId,
			"sort":"pco_id",
			"order":"ASC",
			},
		dataType : "json",
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			var str=""
			for (var i = 0; i < data.length; i++) {// onchange='addprice(this)'
													// value='"+data[i].pcoSkuuppdate+"'
				str+="<tr><td><input onclick='onclikOneChecked()' type='checkbox'/></td>" +
						"<td>"+(i+1)+"</td>" +
						"<td class='com' width:'auto'>" +
						'<input type="hidden"  value="'+data[i].pcoName+'">'+data[i].pcoName+'</td>' +
						"<td><input  class='form-control skuClass updateskuget' type='text'  style='width:120px' readonly value='"+data[i].pcoSkuuppdate+"'></td><td><input class='form-control' onchange='addprice(this)' type='text' value='"+data[i].pcoIncrease+"'></td><td><input  class='form-control' type='text' value='"+data[i].pcoStock+"'></td><td><input  class='form-control  upceanclass' type='text' value='"+data[i].pcoUpcean+"'></td><td class='imgtd'>";
						var data2=data[i].pcoUrlList;
						for (var j = 0; j < data2.length; j++) {
							// 遍历所有图片
							str+="<img data='"+data2[j].pphId+"' src='"+data2[j].pphUrl+"' onclick='deleteImg(this)' width='50' height='50'>";
						}
						str+="</td></tr>"
						if(data[i].pcoAddprice!=null){
							if(data[i].pcoAddprice.length>0){
								str+="<tr><td colspan='7' class='tdprice'>"+data[i].pcoAddprice+"</td></tr>"
							}
						}
				
			}
			$("#tbAdd").html(str);
			
			var skuval=$("#piSku").val();
			var tr=$('#tbAdd').children("tr");
			var tdarry=new Array();
		    for (var p = 0; p < tr.length; p++) {
		    	var td=$(tr[p]).children("td");
		    	if($(td[0]).find("input").attr("type")=="checkbox"){
		    		tdarry.push(tr[p]);
		    	}
			}
			
		}
	})
}

function addprice(obj){
	var objinp=$(obj);
	var guoarray=new Array("美国","加拿大","墨西哥","英国","法国","德国","意大利","西班牙","日本","澳大利亚")
	var trpar=objinp.parent().parent();
	
	if(typeof($(trpar).next().html())!= "undefined"){
		if($(trpar).next().html().indexOf("美国")!=-1){
			$(trpar).next().remove();
			if($(objinp).val().length>0){
				var qufen=$(trpar.children()[2]).find("input").val();
				var str="<tr><td colspan='7' data='"+qufen+"' class='tdprice'>";
				$(".pricehid").each(function(i){
					var spantex=$(this).parent().prev().prev().find("span").text();
					var zongprice=(parseFloat(spantex)+parseFloat($(objinp).val()))*parseFloat($(this).val());
					str+=guoarray[i]+" : "+zongprice.toFixed(2)+" ; "
				})
				str+="</td></tr>";
				$(str).insertAfter(trpar);
			}
		}else{
			if($(objinp).val().length>0){
				var qufen=$(trpar.children()[2]).find("input").val();
				var str="<tr><td colspan='7' data='"+qufen+"' class='tdprice'>";
				$(".pricehid").each(function(i){
					var spantex=$(this).parent().prev().prev().find("span").text();
					var zongprice=(parseFloat(spantex)+parseFloat($(objinp).val()))*parseFloat($(this).val());
					str+=guoarray[i]+" : "+zongprice.toFixed(2)+" ; "
				})
				str+="</td></tr>";
				$(str).insertAfter(trpar);
			}
		}
	}else{
		if($(objinp).val().length>0){
			var qufen=$(trpar.children()[2]).find("input").val();
			var str="<tr><td colspan='7' data='"+qufen+"' class='tdprice'>";
			$(".pricehid").each(function(i){
				var spantex=$(this).parent().prev().prev().find("span").text();
				var zongprice=(parseFloat(spantex)+parseFloat($(objinp).val()))*parseFloat($(this).val());
				str+=guoarray[i]+" : "+zongprice.toFixed(2)+" ; "
			})
			str+="</td></tr>";
			$(str).insertAfter(trpar);
		}
	}
	
	
}

// 保存成本运费
var yunTable=new Array(); 
function getyunTable(){
	yunTable=new Array();
    var tr=$('#priceTbody').children("tr");
    for (var i = 0; i < tr.length; i++) {
    	var td=$(tr[i]).children("td");
    	var inp=new Object();
    	inp[0]=$($(td[0]).find("input")).val();
    	inp[1]=$(td[1]).text();
    	inp[2]=$(td[2]).text();
    	inp[3]=$($(td[3]).find("span")).text();
    	inp[4]=$(td[4]).find("input").val();
    	var span=$(td[5]).find("span");
    	inp[5]=$(span[0]).text();
    	inp[6]=$(span[1]).text();
    	yunTable.push(inp);
	}
	yuntableJson = encodeURI(JSON.stringify(yunTable));
}

var priceTable=new Array();
// 成本运费
function changePrice(obj){
	priceTable=new Array();
	var tr=$('#priceTbody').children("tr");
    for (var i = 0; i < tr.length; i++) {
    	var td=$(tr[i]).children("td");
    	var inp=new Object();
    	inp[1]=$(td[1]).text();
    	inp[2]="";
    	priceTable.push(inp);
	}
	pricetableJson = encodeURI(JSON.stringify(priceTable));
	if($("#piWeight").valid()){
		$.ajax({
			type : "post",
			url : prefix+"/ymx/productInfo/changePrice",
			data : {
				"cmd":"changePrice",
				"piId":$("#psoId").val(),
				"piPrice":$("#piPrice").val(),
				"piWeight":$("#piWeight").val(),
				"piLong":$("#piLong").val(),
				"piWide":$("#piWide").val(),
				"piHigh":$("#piHigh").val(),
				"piFreight":$("#piFreight").val(),
				"piDiscount":$("#piDiscount").val(),
				"obj":obj,
				"pricetableJson" :pricetableJson,
			},
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				$("#priceTbody").html('');
				var str="";
				for (var i = 0; i < data.length; i++) {
					$("#priceTbody").append('<tr><td><span>'+data[i].cityName+'</span><input type="hidden" value="'+data[i].freId+'"></td><td><span>'+data[i].freFreight+'</span></td><td><span>'+data[i].frePrice+'</span></td>'
						+'<td><span>'+data[i].freCurrency+'</span>['+data[i].backup+']</td><td><input type="text"class="form-control" name="piUsprice" value="'+data[i].freFinal+'" onchange="freChange(this)"><input type="hidden" class="pricehid" value="'+data[i].bbackup+'"></td>'
						+'<td><span>'+data[i].freProfit+'</span>(<span>'+data[i].frePromargin+'</span>)</td></tr>')
				}
			}
		})
	}
}

// 选择分类
function goToCategory(){
	layer.open({
		type : 2, 
		title : '选择分类',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '620px' ],
		content :  "/ymx/productInfo/goToCategory" // iframe的url
	});
}
// 添加
function addVariant(){
	layer.open({
		type : 2,
		title : '变体',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '520px' ],
		content :  "/ymx/productSource/addvalue" // iframe的url
	});
}
// 删除变体
function removeMyself(it){
	$this=$(it);
	$this.parent().remove();
	var shtml=$this.prev().html();
	$("#valueli li[data]").each(function(){
		if($(this).attr("data")==shtml){
			$(this).remove();
			return false;
		}
	})
	var array=new Array();
	array[0]="";
	diedai(0,array);
}
// 通过变体志迭代遍历所有变体组合
function diedai(i,array){
	// 变体为空，重置变体组合列表
	if($("#valueli>li").length==0){
		$("#tbAdd").html("")
	}
	// 迭代次数等于迭代变体个数，迭代出口
	if(i==$("#valueli>li").length){
		return;
	}
	// 迭代拼接变态组合
	var arr=new Array()
	for (var int3 = 0; int3 < array.length; int3++) {
		for (var int2 = 0; int2 < $("#valueli>li").eq(i).children().eq(1).children().length; int2++){
			if(array.length==1&&array[0]===""){
				arr[arr.length]=array[int3]+$("#valueli>li").eq(i).children().eq(1).children().eq(int2).html();
			}else{
				arr[arr.length]=array[int3]+"-"+$("#valueli>li").eq(i).children().eq(1).children().eq(int2).html();
			}
		}
	}
	// 迭代次数等于迭代变体个数，返回所有变体组合
	if(i==$("#valueli>li").length-1){
		$sku=$("#piSku").val();
		// $piQuantity=$("#piQuantity").val();
		$("#tbAdd").html("");
		for (var int = 0; int < arr.length; int++) {
			$piQuantity=Math.round(Math.random()*10+50);
			var str='<tr><td><input onclick="onclikOneChecked()" type="checkbox"/></td><td >'+(int+1)+'</td><td class="com" width:"auto"><input type="hidden"  value="'+arr[int]+'">'+arr[int]+'</td><td><input  class="form-control skuClass updateskuget" type="text"  style="width:120px" readonly value="'+$sku+'-'+(int+1)+'"></td><td><input onchange="addprice(this)" class="form-control" type="text"></td><td><input  class="form-control" type="text"  value="'+$piQuantity+'"></td><td><input  class="form-control upceanclass" type="text"></td><td class="imgtd"></td></tr>'
			$("#tbAdd").append(str);
			i++;
		}
		/*
		 * $('.com').each(function() { var $this = $(this); var text_length =
		 * $this.width;//获取当前文本框的长度 if(text_length>200){
		 * $this.css("width","100px"); } });
		 */
		/*
		 * $('.skuClass').each(function() { var $this = $(this); var text_length =
		 * $this.val().length;//获取当前文本框的长度 if(text_length>20){
		 * $this.css("width","100px"); } });
		 */
	// 迭代次数小于迭代变体个数，返回所有变体组合
	}else{
		i++;
		diedai(i,arr);
	}
}
var tip;
var layopenclo;
// 弹出图片
/*
 * $(document).click(function (e) { var drag = $("#imgdisplay"), dragel =
 * $("#imgdisplay")[0], target = e.target; if (dragel !== target &&
 * !$.contains(dragel, target)) { layer.close(layopenclo); } });
 */
function tipImg(it){
	if(isCheckFalse()&&$("li[data-ck='1']").length==0){
		layer.msg('请选择变体组合');
	}else{
		var tipid="#"+$(it).attr("id");
		$psoId=$("#psoId").val();
		$.ajax({
			type : "get",
			url : "/ymx/productPhoto/listJson",
			data : {"pphPid":$psoId,"sort":"pph_order"},// 你的formid
			error : function(request) {
				parent.layer.alert("Connection error");
			},
			success : function(data) {
				var str="<div id='imgli'>"
				for (var int = 0; int < data.length; int++) {
					str+="<img data='"+data[int].pphId+"' src='"+data[int].pphUrl+"' onclick='totd(this)' width='60' height='60'></img>"
				}
				str+="</div>"
				$("#imgdisplay").html(str);
				layopenclo=layer.open({
			        type: 1,
			        title: false,
			        shade: 0,
			        area : "300px",
			        content: $('#imgdisplay'),
			        offset: 'rb',
			    });
// layer.open({
// title: '图片选择',
// shade: 0,
// // shadeClose : true, // 点击遮罩关闭层
// offset: 'rb',
// content: str,
// });
// var str="<div id='imgli'>"
// for (var int = 0; int < data.length; int++) {
// str+="<img data='"+data[int].pphId+"' src='"+data[int].pphUrl+"'
// onclick='totd(this)' width='50' height='50'></img>"
// }
// str+="</div>"
// tip=layer.tips(
// str,
// tipid,
// {
// tips: [1,'#fff'],
// time:false,
// closeBtn:[0,true] ,
// maxWidth:430,
// }
//						
// );
			}
		})
		
		
		
	}
	
	
};
/*
 * document.onclick=function(){ if(tip!=null){ layer.close(tip); } }
 */
// 删除变体组合
function deleC(){
	if(isCheckFalse()){
		layer.msg('请选择变体组合');
	}else{
		$("#vtable input[type=checkbox]:not(:first)").each(function(){
			if(this.checked){
				if(typeof($(this).parent().parent().next().html())!="undefined"){
					if($(this).parent().parent().next().html().indexOf("美国")!=-1){
						$(this).parent().parent().next().remove();
					}
				}
				$(this).parent().parent().remove();
			}
		})	
	}
	/*
	 * var skuval=$("#piSku").val(); var tr=$('#tbAdd').children("tr"); var
	 * tdarry=new Array(); for (var i = 0; i < tr.length; i++) { var
	 * td=$(tr[i]).children("td");
	 * if($(td[0]).find("input").attr("type")=="checkbox"){ tdarry.push(tr[i]); } }
	 * $(".updateskuget").each(function(w){ var td=$(tdarry[w]).children("td");
	 * var inpval=$(td[2]).find("input").val(); var inparr=inpval.split("-");
	 * inparr[0]=skuval; $(td[2]).find("input").val(inparr[0]+"-"+(w+1)); })
	 */
}

function chooseColor(it){
	if($(it).attr("data-ck")=="1"){
		$(it).removeAttr("data-ck");
		$(it).css("background-color","");
	}else{
		var lis=$("li[data-ck='1']")
		if(lis!=null){
			lis.each(function(){
				$(this).removeAttr("data-ck");
				$(this).css("background-color","")
			})
			$(it).attr("data-ck","1");
			$(it).css("background-color","#4CAE4C");
		}
	
	}
	
	
}
// 将图片保存到td中
function totd(it){
	$("#vtable input[type=checkbox]:not(:first)").each(function(){
		$td=$(this).parent().parent().children().last()
		if(this.checked){
			$td.append("<img data='"+$(it).attr("data")+"' src='"+$(it).attr("src")+"' onclick='deleteImg(this)' width='50' height='50'>");
		}
	})
	var lis=$("li[data-ck='1']")
	if(lis!=null){
		var str=lis.eq(0).html();
		// alert($("#vtable tr td:eq(2)").html());
		$(".com input").each(function(){
			$td=$(this).parent().parent().children().last()
			var arr = $(this).val().split('-');
			if($.inArray(str, arr)!=-1){
				$td.append("<img data='"+$(it).attr("data")+"' src='"+$(it).attr("src")+"' onclick='deleteImg(this)' width='50' height='50'>");
			}
		})
	}
}
// 点击删除图片
function deleteImg(it){
	if(isCheckFalse()&&$("li[data-ck='1']").length==0){
		$(it).remove();
	}else{
		$("#vtable input[type=checkbox]:not(:first)").each(function(){
			if(this.checked){
				var tdchild=$(this).parent().parent().children();
				var imgs=$(tdchild[7]).find("img");
				for (var j = 0; j < imgs.length; j++) {
					if($(imgs[j]).attr("data")==$(it).attr("data")){
						$(imgs[j]).remove();
					}
				}
			}
		})
		var lis=$("li[data-ck='1']")
		if(lis!=null){
			var str=lis.eq(0).html();
			// alert($("#vtable tr td:eq(2)").html());
			$(".com input").each(function(){
				var arr = $(this).val().split('-');
				if($.inArray(str, arr)!=-1){
					var tdchild=$(this).parent().parent().children();
					var imgs=$(tdchild[7]).find("img");
					for (var j = 0; j < imgs.length; j++) {
						if($(imgs[j]).attr("data")==$(it).attr("data")){
							$(imgs[j]).remove();
						}
					}
				}	
			})
		}
	}
// $(it).remove();
}
// 全选
function checkAll(){
	$("#vtable input[type=checkbox]").each(function(){
		this.checked=true;
	})
}
// 全不选
function checkFalseAll(){
	$("#vtable input[type=checkbox]").each(function(){
		$(this).attr("checked",false);
	})
}
// 点击全选方法
function oclickAllChecked(it){
	if(it.checked){
		checkAll();
    }else {
    	checkFalseAll();
    }
}
// 判断是否全选
function isChecked(){
	var flag=true;
	$("#vtable input[type=checkbox]:not(:first)").each(function(){
		if(!this.checked){
			flag=false;
			return false;
		}
	})
	return flag;
}
// 判断是否全未选
function isCheckFalse(){
	var flag=true;
	$("#vtable input[type=checkbox]:not(:first)").each(function(){
		if(this.checked){
			flag=false;
			return false;
		}
	})
	return flag;
}