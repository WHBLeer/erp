var prefix = "/getproduct"
$().ready(function() {
	validateRule();
	$("#description_zh").text($("#description_zh").text().replace(/\<br>/g,"\n"));
	$("#description_en").text($("#description_en").text().replace(/\<br>/g,"\n"));
	$("#description_fr").text($("#description_fr").text().replace(/\<br>/g,"\n"));
	$("#description_de").text($("#description_de").text().replace(/\<br>/g,"\n"));
	$("#description_it").text($("#description_it").text().replace(/\<br>/g,"\n"));
	$("#description_es").text($("#description_es").text().replace(/\<br>/g,"\n"));
	$("#description_ja").text($("#description_ja").text().replace(/\<br>/g,"\n"));
	$("#description_us").text($("#description_us").text().replace(/\<br>/g,"\n"));
	$("#description_ca").text($("#description_ca").text().replace(/\<br>/g,"\n"));
	$("#description_mx").text($("#description_mx").text().replace(/\<br>/g,"\n"));
	$("#description_au").text($("#description_au").text().replace(/\<br>/g,"\n"));
	getImg();
	uploadimg();
	getAllBian();
	initbianti();
	parsing();
	getWhetherProduct();
	if($("#productstatus").val()==0){
		$("#shanchubutton1").attr("style","visibility:hidden");
		$("#shanchubutton2").attr("style","visibility:hidden");
	}
	layer.open({
        type: 1,
        title: false,
        shade: 0,
        closeBtn:0,
        area : "400px",
        content: $('#buttondisplay'),
        offset: 'rt',
    });
});
$.validator.setDefaults({
	submitHandler : function() {
		update();
	}
});

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

var arrTable3=new Array();
function ceshi(){
	arrTable3=new Array();
	var div=$('#myTabContent').children("div");
	for(var i=1;i<div.length;i++){
		var div1=$(div[i]).children("div");
		var inp=new Object();
		for(var j=0;j<div1.length;j++){
			inp[j]=$(div1[j]).find('textarea').val();
		}
		arrTable3.push(inp);
	}
	tableJson3 = encodeURI(JSON.stringify(arrTable3));
}
var arrTable=new Array(); 
function getTable(){
	// alert($('#tbAdd').html())
	arrTable=new Array();
    var tr=$('#tbAdd').children("tr");
    var tdarry=new Array();
    for (var i = 0; i < tr.length; i++) {
    	var td=$(tr[i]).children("td");
    	if($(td[0]).find("input").attr("type")=="checkbox"){
    		tdarry.push(tr[i]);
    	}
	}
    for (var w = 0; w < tdarry.length; w++) {
    	var tdd=$(tdarry[w]).children("td");
    	var inp=new Object();
    	for (var j = 1; j < tdd.length; j++){
    		inp[j]=$(tdd[j+1]).find('input').val();
    		if(j!=tdd.length-2){
    			inp[j]=$(tdd[j+1]).find('input').val();
    		}else{
    			inp[j]=""
    			$(tdd[j+1]).children().each(function(n){
    				if(n==0){
    					inp[j]+=$(this).attr("data")
    				}else{
    					inp[j]+=","+$(this).attr("data")
    				}
    			})
    		}
    	}
    	if(typeof($(tdarry[w]).next().html())!= "undefined"){
    		if($(tdarry[w]).next().html().indexOf("美国")!=-1){
    			var tdhtm=$(tdarry[w]).next().find("td").html();
// var tddata=$(tdarry[w]).next().attr("data");
    	    	inp[7]=tdhtm;
        	}else{
        		inp[7]="";
        	}
    	}else{
    		inp[7]="";
    	}
    	
    	arrTable.push(inp);
	}
    
// for (var i = 0; i < tr.length; i++) {
// var td=$(tr[i]).children("td");
// var inp=new Object();
// for (var j = 1; j < td.length; j++){
// inp[j]=$(td[j]).find('input').val();
// if(j!=td.length-1){
// inp[j]=$(td[j]).find('input').val();
// }else{
// inp[j]=""
// $(td[j]).children().each(function(n){
// if(n==0){
// inp[j]+=$(this).attr("data")
// }else{
// inp[j]+=","+$(this).attr("data")
// }
//    				
// })
// }
// }
// arrTable.push(inp);
// }
    var ss=arrTable;
  // alert(arrTable)
	tableJson = encodeURI(JSON.stringify(arrTable));
}
var arrTable2=new Array(); 
function getTable2(){
	arrTable2=new Array();
	var $valuelis=$("#valueli>li");
	for (var i = 0; i < $valuelis.length; i++) {
		var inp=new Object();
		inp[0]=$valuelis.eq(i).attr("iddata");
		var str=""
		$valuelis.eq(i).find("ul>li").each(function(n){
		if(n==0){
			str+=$(this).html();
		}else{
			str+=","+$(this).html();
		}
		});
		inp[1]=str;
		arrTable2.push(inp);
	}
	tableJson2 = encodeURI(JSON.stringify(arrTable2));
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

// 输入触发验证
// $(".keytitle").on("input propertychange", function(){
// var keytitle=$(this).val();
// if(keytitle.length>200){
// $(this).css("border-color","red");
// }else{
// $(this).css("border-color","black");
// }
// });
function getzijielength(s){
    var len = 0;
	for(var i=0; i<s.length; i++) 
	{
		var c = s.substr(i,1);
		var ts = escape(c);
		if(ts.substring(0,2) == "%u") 
		{
			len+=2;
		} else 
		{
			len+=1;
		}
	}
	return len;
}
$(".keytitle").change(function(){
	var keytitle=$(this).val();
	keytitle=getzijielength(keytitle);
	var className=$(this).attr('id');// span标签的className
	$("."+className).text("已填写"+keytitle+"/200");
	$("."+className).css("color","#C4C4C4");
	if(keytitle>200){
		$(this).css("border-color","red");
		$("."+className).css("color","red");
		return;
	}else{
		$(this).css("border-color","black");
		$("."+className).css("color","#C4C4C4");
	}
})
$(".keyword").change(function(){	
	var keyword=$(this).val();
	var keywordArry=keyword.split("\n");
	var className=$(this).attr('id');// span标签的className
	$("."+className).text("");
	$("."+className).css("color","#C4C4C4");
	if(keywordArry.length>1){
		$(this).css("border-color","red");
		return;
	}else{
		for (var i = 0; i < keywordArry.length; i++) {
			keywordArry[i]=getzijielength(keywordArry[i]);
			var num=i+1;
			$("."+className).append("<span>第"+num+"行已填写"+keywordArry[i]+"/250</span>&nbsp;&nbsp;&nbsp;");
			if(keywordArry[i]>250){
				$(this).css("border-color","red");
				$("."+className).css("color","red");
				return;
			}else{
				$(this).css("border-color","black");
				$("."+className).css("color","#C4C4C4");
			}
		}
	}
});

$(".keypoint").change(function(){
	var keypoint=$(this).val();
	var keypointArry=keypoint.split("\n");
	var className=$(this).attr('id');// span标签的className
	$("."+className).text("");
	$("."+className).css("color","#C4C4C4");
	if(keypointArry.length>5){
		$(this).css("border-color","red");
		return;
	}else{
		for (var  j= 0; j < keypointArry.length; j++) {
			keypointArry[j]=getzijielength(keypointArry[j]);
			var num=j+1;
			$("."+className).append("<span>第"+num+"行已填写"+keypointArry[j]+"/500</span>&nbsp;&nbsp;");
			if(keypointArry[j]>500){
				$(this).css("border-color","red");
				$("."+className).css("color","red");
				return;
			}else{
				$(this).css("border-color","black");
				$("."+className).css("color","#C4C4C4");
			}
		}
	}
});

$(".keydesc").change(function(){
	var keydesc=$(this).val();
	keydesc=getzijielength(keydesc);
	var className=$(this).attr('id');// span标签的className
	$("."+className).text("已填写"+keydesc+"/2000");
	$("."+className).css("color","#C4C4C4");
	if(keydesc>2000){
		$(this).css("border-color","red");
		$("."+className).css("color","red");
		return;
	}else{
		$(this).css("border-color","black");
		$("."+className).css("color","C4C4C4");
	}
});

function getWhetherProduct(){
	if($("#piManufacturer").val().length==0){
		$("#piManufacturer").css("borderColor","red");
	}
	if($("#piBrand").val().length==0){
		$("#piBrand").css("border-color","red");
	}
	if($("#piMnumber").val().length==0){
		$("#piMnumber").css("border-color","red");
	}
	$(".keytitle").each(function(){
		if($(this).attr("id").indexOf("ja")!=-1||$(this).attr("id").indexOf("zh")!=-1){
			
		}else{
			var keytitle=$(this).val();
			if(keytitle.length==0){
				$(this).css("border-color","red");
				return;
			}else{
				keytitle=getzijielength(keytitle);
				if(keytitle>200){
					$(this).css("border-color","red");
					return;
				}else{
					$(this).css("border-color","black");
				}
			}
		}
	})
	$(".keyword").each(function(){	
		if($(this).attr("id").indexOf("ja")!=-1||$(this).attr("id").indexOf("zh")!=-1){
			
		}else{
			var keyword=$(this).val();
			if(keyword.length==0){
				$(this).css("border-color","red");
				return;
			}else{
				var keywordArry=keyword.split("\n");
				if(keywordArry.length>5){
					$(this).css("border-color","red");
					return;
				}else{
					for (var i = 0; i < keywordArry.length; i++) {
						keywordArry[i]=getzijielength(keywordArry[i]);
						if(keywordArry[i]>250){
							$(this).css("border-color","red");
							return;
						}else{
							$(this).css("border-color","black");
						}
					}
				}
			}
		}
	});

	$(".keypoint").each(function(){
		if($(this).attr("id").indexOf("ja")!=-1||$(this).attr("id").indexOf("zh")!=-1){
			
		}else{
			var keypoint=$(this).val();
			if(keypoint.length==0){
				$(this).css("border-color","red");
				return;
			}else{
				var keypointArry=keypoint.split("\n");
				if(keypointArry.length>5){
					$(this).css("border-color","red");
					return;
				}else{
					for (var  j= 0; j < keypointArry.length; j++) {
						keypointArry[j]=getzijielength(keypointArry[j]);
						if(keypointArry[j]>500){
							$(this).css("border-color","red");
							return;
						}else{
							$(this).css("border-color","black");
						}
					}
				}
			}
		}
	});

	$(".keydesc").each(function(){
		if($(this).attr("id").indexOf("ja")!=-1||$(this).attr("id").indexOf("zh")!=-1){
			
		}else{
			var keydesc=$(this).val();
			if(keydesc.length==0){
				$(this).css("border-color","red");
				return;
			}else{
				keydesc=getzijielength(keydesc);
				if(keydesc>2000){
					$(this).css("border-color","red");
					return;
				}else{
					$(this).css("border-color","black");
				}
			}
		}
	});
}



// 修改完报错前验证
function yanzheng(){
	var isBreak = true;
	var arryCity=new Array("中文","英语","法语","德语","意大利语","西班牙语","日语")
	$(".keyword").each(function(k){
		var keyword=$(this).val();
		var keywordArry=keyword.split("\n");
		if(keywordArry.length>5){
			parent.layer.msg(arryCity[k]+"--关键字不超过5行");
			isBreak=false;
			return false;
		}else{
			for (var i = 0; i < keywordArry.length; i++) {
				if(keywordArry[i].length>250){
					parent.layer.msg(arryCity[k]+"--关键字每行250字符以内");
					isBreak=false;
					return false;
				}
			}
		}
	})
	
	if(isBreak){
		$(".keypoint").each(function(g){
			var keypoint=$(this).val();
			var keypointArry=keypoint.split("\n");
			if(keypointArry.length>5){
				parent.layer.msg(arryCity[g]+"--要点不超过5行");
				isBreak=false;
				return false;
			}else{
				for (var  j= 0; j < keypointArry.length; j++) {
					if(keypointArry[j].length>250){
						parent.layer.msg(arryCity[g]+"--要点每行250字符以内");
						isBreak=false;
						return false;
					}
				}
			}
		})
	}
	
	if(isBreak){
		$(".keydesc").each(function(w){
			var keydesc=$(this).val();
			if(keydesc.length>2000){
				parent.layer.msg(arryCity[w]+"--产品描述在2000字符以内");
				isBreak=false;
				return false;
			}
		})
	}
	
	if(isBreak){
		$(".keytitle").each(function(r){
			var keytitle=$(this).val();
			if(keytitle.length>200){
				parent.layer.msg(arryCity[r]+"--产品标题在200字符以内");
				isBreak=false;
				return false;
			}
		})
	}
	return isBreak;
}

function update() {
// var ifreturn=yanzheng();
// if(ifreturn){
	var a = true;
	$("textarea").each(function(index,item){
		if($(this).val().indexOf("&")!=-1 || $(this).val().indexOf("<")!=-1 || $(this).val().indexOf(">")!=-1){
			alert("产品文案中包含'&','<'或'>'字符，请修改后重新提交");
			a=false;
			return;
		}
	});
	// 判断敏感词
/*
 * var str = ""; $.ajax({ cache : true, type : "GET", url :
 * "/ymx/productSensitiveReplace/listByUser", async : false, error :
 * function(request) { parent.layer.alert("Connection error"); }, success :
 * function(data) { $("textarea").each(function(index,item){ for(var i=0;i<data.length;i++){
 * var originalWord = data[i].originalWord;
 * if($(this).val().indexOf(originalWord)!=-1){
 * if(str.indexOf(originalWord)==-1){ str+="“"+originalWord+"”，"; } } } });
 * if(str!=""){ layer.confirm('产品文案中包含'+str+'敏感字符，确认提交么？', { btn: ['确认','取消']
 * //按钮 }, function(){ alert("确认"); }, function(){ alert("取消"); a=false; return;
 * }); alert('产品文案中包含'+str+'敏感字符，请修改后提交'); a=false; return; } } });
 */
	
	$("#valueli").find("li").each(function(){
		if($(this).text().indexOf("Color:")!=-1 || $(this).text().indexOf("Size:")!=-1){
		}else{
			if($(this).text().indexOf("-")!=-1){
				alert("变体中包含'-'字符，请修改后重新提交");
				a=false;
				return;
			}
		}
	})
	if(a==false){
		return;
	}
		getTable();
		getTable2();
		ceshi();
		getyunTable();
		$("#paIdHid").val($('input:radio[name="productAudit"]:checked').val());
		$("#ptIdHid").val($('input:radio[name="productType"]:checked').val());
		$("#psIdHid").val($('input:radio[name="productShelf"]:checked').val());
		$.ajax({
			cache : true,
			url:"/ymx/productSensitiveReplace/listBykeyword",
			type : "POST",
			async:false,
			data:{
				piManufacturer:$('#piManufacturer').val().trim(),
				piBrand:$('#piBrand').val().trim(),
				/* piMnumber:$('#piMnumber').val(), */
				
				title_zh:$('#title_zh').val(),
				keywords_zh:$('#keywords_zh').val(),
				keypoints_zh:$('#keypoints_zh').val(),
				description_zh:$('#description_zh').val(),
				
				title_en:$('#title_en').val(),
				keywords_en:$('#keywords_en').val(),
				keypoints_en:$('#keypoints_en').val(),
				description_en:$('#description_en').val(),
				
				title_fr:$('#title_fr').val(),
				keywords_fr:$('#keywords_fr').val(),
				keypoints_fr:$('#keypoints_fr').val(),
				description_fr:$('#description_fr').val(),
				
				title_de:$('#title_de').val(),
				keywords_de:$('#keywords_de').val(),
				keypoints_de:$('#keypoints_de').val(),
				description_de:$('#description_de').val(),
				
				title_it:$('#title_it').val(),
				keywords_it:$('#keywords_it').val(),
				keypoints_it:$('#keypoints_it').val(),
				description_it:$('#description_it').val(),
				
				title_es:$('#title_es').val(),
				keywords_es:$('#keywords_es').val(),
				keypoints_es:$('#keypoints_es').val(),
				description_es:$('#description_es').val(),
				
				title_ja:$('#title_ja').val(),
				keywords_ja:$('#keywords_ja').val(),
				keypoints_ja:$('#keypoints_ja').val(),
				description_ja:$('#description_ja').val()
				
			},
			error:function(r) {
				parent.layer.alert("Connection error");
			
			},
			success:function(t){
				
				/*if(! isnull($("#title_en").val())){
					alert("英文标题不能为空");
					a=false;
					return;
				}//判断英文标题是否为空;
				if(! isnull($("#keywords_en").val())){
					alert("英文关键字不能为空");
					a=false;
					return;
				}//判断英文关键字是否为空
				if(! isnull($("#keypoints_en").val())){
					alert("英文要点说明不能为空");
					a=false;
					return;
				}//判断英文要点是否为空
				if(! isnull($("#description_en").val())){
					alert("英文描述不能为空");
					a=false;
					return;
				}//判断英文描述是否为空
				if(! isnull($("#title_fr").val())){
					alert("法语标题不能为空");
					a=false;
					return;
				}//判断法语标题是否为空;
				if(! isnull($("#keywords_fr").val())){
					alert("法语关键字不能为空");
					a=false;
					return;
				}//判断法语关键字是否为空
				if(! isnull($("#keypoints_fr").val())){
					alert("法语要点说明不能为空");
					a=false;
					return;
				}//判断法语要点是否为空
				if(! isnull($("#description_fr").val())){
					alert("法语描述不能为空");
					a=false;
					return;
				}//判断法语描述是否为空
				if(! isnull($("#title_de").val())){
					alert("德语标题不能为空");
					a=false;
					return;
				}//判断德语标题是否为空;
				if(! isnull($("#keywords_de").val())){
					alert("德语关键字不能为空");
					a=false;
					return;
				}//判断德语关键字是否为空
				if(! isnull($("#keypoints_de").val())){
					alert("德语要点说明不能为空");
					a=false;
					return;
				}//判断德语要点是否为空
				if(! isnull($("#description_de").val())){
					alert("德语描述不能为空");
					a=false;
					return;
				}//判断德语描述是否为空
				if(! isnull($("#title_it").val())){
					alert("意大利语标题不能为空");
					a=false;
					return;
				}//判断意大利语标题是否为空;
				if(! isnull($("#keywords_it").val())){
					alert("意大利语关键字不能为空");
					a=false;
					return;
				}//判断意大利语关键字是否为空
				if(! isnull($("#keypoints_it").val())){
					alert("意大利语要点说明不能为空");
					a=false;
					return;
				}//判断意大利语要点是否为空
				if(! isnull($("#description_it").val())){
					alert("意大利语描述不能为空");
					a=false;
					return;
				}//判断意大利语描述是否为空
				if(! isnull($("#title_es").val())){
					alert("西班牙语标题不能为空");
					a=false;
					return;
				}//判断西班牙语标题是否为空;
				if(! isnull($("#keywords_es").val())){
					alert("西班牙语关键字不能为空");
					a=false;
					return;
				}//判断西班牙语关键字是否为空
				if(! isnull($("#keypoints_es").val())){
					alert("西班牙语要点说明不能为空");
					a=false;
					return;
				}//判断西班牙语要点是否为空
				if(! isnull($("#description_es").val())){
					alert("西班牙语描述不能为空");
					a=false;
					return;
				}//判断西班牙语描述是否为空
				if(! isnull($("#title_ja").val())){
					alert("日语标题不能为空");
					a=false;
					return;
				}//判断日语标题是否为空;
				if(! isnull($("#keywords_ja").val())){
					alert("日语关键字不能为空");
					a=false;
					return;
				}//判断日语关键字是否为空
				if(! isnull($("#keypoints_ja").val())){
					alert("日语要点说明不能为空");
					a=false;
					return;
				}//判断日语要点是否为空
				if(! isnull($("#description_ja").val())){
					alert("日语描述不能为空");
					a=false;
					return;
				}//判断日语描述是否为空*/		
				
				/*
				 * if(! isnull($("#title_en").val())){ alert("英文标题不能为空");
				 * a=false; return; }//判断英文标题是否为空; if(!
				 * isnull($("#keywords_en").val())){ alert("英文关键字不能为空");
				 * a=false; return; }//判断英文关键字是否为空 if(!
				 * isnull($("#keypoints_en").val())){ alert("英文要点说明不能为空");
				 * a=false; return; }//判断英文要点是否为空 if(!
				 * isnull($("#description_en").val())){ alert("英文描述不能为空");
				 * a=false; return; }//判断英文描述是否为空 if(!
				 * isnull($("#title_fr").val())){ alert("法语标题不能为空"); a=false;
				 * return; }//判断法语标题是否为空; if(! isnull($("#keywords_fr").val())){
				 * alert("法语关键字不能为空"); a=false; return; }//判断法语关键字是否为空 if(!
				 * isnull($("#keypoints_fr").val())){ alert("法语要点说明不能为空");
				 * a=false; return; }//判断法语要点是否为空 if(!
				 * isnull($("#description_fr").val())){ alert("法语描述不能为空");
				 * a=false; return; }//判断法语描述是否为空 if(!
				 * isnull($("#title_de").val())){ alert("德语标题不能为空"); a=false;
				 * return; }//判断德语标题是否为空; if(! isnull($("#keywords_de").val())){
				 * alert("德语关键字不能为空"); a=false; return; }//判断德语关键字是否为空 if(!
				 * isnull($("#keypoints_de").val())){ alert("德语要点说明不能为空");
				 * a=false; return; }//判断德语要点是否为空 if(!
				 * isnull($("#description_de").val())){ alert("德语描述不能为空");
				 * a=false; return; }//判断德语描述是否为空 if(!
				 * isnull($("#title_it").val())){ alert("意大利语标题不能为空"); a=false;
				 * return; }//判断意大利语标题是否为空; if(!
				 * isnull($("#keywords_it").val())){ alert("意大利语关键字不能为空");
				 * a=false; return; }//判断意大利语关键字是否为空 if(!
				 * isnull($("#keypoints_it").val())){ alert("意大利语要点说明不能为空");
				 * a=false; return; }//判断意大利语要点是否为空 if(!
				 * isnull($("#description_it").val())){ alert("意大利语描述不能为空");
				 * a=false; return; }//判断意大利语描述是否为空 if(!
				 * isnull($("#title_es").val())){ alert("西班牙语标题不能为空"); a=false;
				 * return; }//判断西班牙语标题是否为空; if(!
				 * isnull($("#keywords_es").val())){ alert("西班牙语关键字不能为空");
				 * a=false; return; }//判断西班牙语关键字是否为空 if(!
				 * isnull($("#keypoints_es").val())){ alert("西班牙语要点说明不能为空");
				 * a=false; return; }//判断西班牙语要点是否为空 if(!
				 * isnull($("#description_es").val())){ alert("西班牙语描述不能为空");
				 * a=false; return; }//判断西班牙语描述是否为空 if(!
				 * isnull($("#title_ja").val())){ alert("日语标题不能为空"); a=false;
				 * return; }//判断日语标题是否为空; if(! isnull($("#keywords_ja").val())){
				 * alert("日语关键字不能为空"); a=false; return; }//判断日语关键字是否为空 if(!
				 * isnull($("#keypoints_ja").val())){ alert("日语要点说明不能为空");
				 * a=false; return; }//判断日语要点是否为空 if(!
				 * isnull($("#description_ja").val())){ alert("日语描述不能为空");
				 * a=false; return; }//判断日语描述是否为空
				 */				
				if(t.code == 0){
					updateBrand();
				}
				
				if(t.code==121){
					alert(t.msg);
				}
				if(t.code==122){
					alert(t.msg);
				}
				if(t.code==123){
					alert(t.msg);
				}
				if(t.code==124){
					alert(t.msg);
				}
				if(t.code==125){
					alert(t.msg);
				}
				if(t.code==126){
					alert(t.msg);
				}
				if(t.code==127){
					alert(t.msg);
				}
				if(t.code==128){
					alert(t.msg);
				}
				if(t.code==129){
					alert(t.msg);
				}
				if(t.code==130){
					alert(t.msg);
				}
				if(t.code==131){
					alert(t.msg);
				}
				if(t.code==132){
					alert(t.msg);
				}
				if(t.code==133){
					alert(t.msg);
				}
				if(t.code==134){
					alert(t.msg);
				}
				if(t.code==135){
					alert(t.msg);
				}
				if(t.code==136){
					alert(t.msg);
				}
				if(t.code==137){
					alert(t.msg);
				}
				if(t.code==138){
					alert(t.msg);
				}
				if(t.code==139){
					alert(t.msg);
				}
				if(t.code==140){
					alert(t.msg);
				}
				if(t.code==141){
					alert(t.msg);
				}
				if(t.code==142){
					alert(t.msg);
				}
				if(t.code==143){
					alert(t.msg);
				}
				if(t.code==144){
					alert(t.msg);
				}
				if(t.code==145){
					alert(t.msg);
				}
				if(t.code==146){
					alert(t.msg);
				}
				if(t.code==147){
					alert(t.msg);
				}
				if(t.code==148){
					alert(t.msg);
				}
				if(t.code==149){
					alert(t.msg);
				}
				if(t.code==150){
					alert(t.msg);
				}
			}
		})
	
// }
}
function updateBrand() {
	console.log("错误：111");
	$.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/productInfo/update",
		data : $('#signupForm').serialize()+"&tableJson="+tableJson+"&tableJson2="+tableJson2+"&tableJson3="+tableJson3+"&yuntableJson="+yuntableJson,// 你的formid
		async : false,
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			if (data.code == 0) {
				parent.layer.msg("操作成功");
				location=location;
				/*
				 * parent.reLoad(); var index =
				 * parent.layer.getFrameIndex(window.name); // 获取窗口索引
				 * parent.layer.close(index);
				 */
					
			} else {
				parent.layer.alert(data.msg)
			}

		}
	});
}
function validateRule() {
	var icon = "<i class='fa fa-times-circle'></i> ";
	$("#signupForm").validate({
		rules : {
// piManufacturer:{required : true,},
// piBrand:{required : true,},
// piMnumber:{required : true,},
// piSku:{required : true,},
// piPrice:{required : true,},
// piWeight : {
// required : true,
// // min : 0.1,
// },
// piLong:{required : true,},
// piWide:{required : true,},
// piHigh:{required : true,},
// piFreight:{required : true,},
// piDiscount:{required : true,},
		},
		messages : {
// piManufacturer:{required : icon + "请输入厂家名称",},
// piBrand:{required : icon + "请输入品牌名称",},
// piMnumber:{required : icon + "请输入厂家编号",},
// piSku:{required : icon + "请输入sku",},
// piPrice:{required : icon + "请输入采购价格",},
// piWeight : {
// required : icon + "请输入产品重量",
// // min : icon + "最小值为0.1",
// },
// piLong:{required : icon + "请输入产品长",},
// piWide:{required : icon + "请输入产品宽",},
// piHigh:{required : icon + "请输入产品高",},
// piFreight:{required : icon + "请输入国内运费",},
// piDiscount:{required : icon + "请输入产品折扣",},
		}
	})
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
// 单击每列复选框调用方法
function onclikOneChecked(){
	if(isChecked()){
		$("#vtable input[type=checkbox]:first").get(0).checked=true;
	}else{
		$("#vtable input[type=checkbox]:first").attr("checked",false);
	}
}
// 初始化img列表
function getImg(){
	$psoId=$("#psoId").val();
	$.ajax({
		type : "get",
		url : "/ymx/productPhoto/listJson",
		data : {"pphPid":$psoId,"sort":"pph_order","order":"asc"},// 你的formid
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			var str="";
			 str+="<ul id='ul1'>";
				
			for (var int = 0; int < data.length; int++) {// ondblclick='deleteOrUpdate(this)'
				/*
				 * str+="<li><img src='"+data[int].pphUrl+"' width='20'
				 * height='150' />" + "<i class='fa fa-download fa-fw'
				 * style='right: 82px;' onclick='downPhoto(this)'></i><i
				 * class='fa fa-search fa-fw' style='right: 40px;'
				 * onclick='searPhoto(this)'></i><span class='img_del'
				 * onclick='delePhoto(this)'>X</span></li>"
				 */
				str+="<li>";
				str+="<div class='item' ondblclick='clickitemphoto(this)'>";
				str+="<img  src='"+data[int].pphUrl+"' id='"+data[int].pphPid+"'  data='"+data[int].pphId+"' order='"+data[int].pphOrder+"'/>";
				str+="<i class='fa fa-pencil fa-fw "+s_move_h+"' style='right: 166px;' onclick='xiuPhoto("+data[int].pphId+")'></i><i class='fa fa-upload fa-fw "+s_move_h+"' style='right: 124px;' onclick='movePhoto(this)'></i>";
				str+="<i class='fa fa-download fa-fw' style='right: 82px;' onclick='downPhoto(this)'></i><i class='fa fa-search fa-fw' style='right: 40px;' onclick='searPhoto(this)'></i><span class='img_del' onclick='delePhoto(this)'>X</span></li>";
				str+="</div>";
				str+="</li>";
			}
			str+="</ul>";
			$("#item_content-id").html(str);
			imgmove();
			var div = document.getElementById('item_content-id');
			var clientWidth = div.clientWidth;
			var height=Math.ceil(data.length/(Math.floor(clientWidth/220)));
			$("#item_content-id").attr("style","height:"+(height*230)+"px");
			// alert(document.getElementById('imgcol').clientWidth*2);
			/*
			 * $("#ul1").attr("style","width:"+document.getElementById('imgdiv').clientWidth-document.getElementById('imgcol').clientWidth*2+"px");
			 * //alert(Math.floor(clientWidth/220));
			 */
			
		}
	})
}
// 图片上传
function uploadimg(){
	layui.use('upload', function () {
		var upload = layui.upload;
		// 执行实例
		var uploadInst = upload.render({
			elem: '#test1', // 绑定元素
			url: '/ymx/productPhoto/upload?pphPid='+$("#psoId").val(), // 上传接口
			multiple:true,
			accept: 'file',
			done: function (r) {
				parent.layer.msg("操作成功");
				getImg();
				/*
				 * layer.msg(r.msg); app.getData();
				 */
			},
			error: function (r) {
				parent.layer.msg(r.msg)
				/* layer.msg(r.msg); */
			}
		});
	});
}


// 修改变体值
function updateV(it){
	$pvaId=$(it).html();
	var str="";
	$("#valueli li[data]").each(function(){
		if($(this).attr("data")==$pvaId){
			$(this).find("ul").children().each(function(i){
				if(i==0){
					str+=$(this).html();
				}else{
					str+=","+$(this).html();
				}
			});
		}
	})
	layer.open({
		type : 2,
		title : '变体',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '520px' ],
		content :  "/ymx/productSource/editvalue?pvaName="+$pvaId+"&pvNames="+str+"&pvaid="+$(it).attr("data") // iframe的url
	});
}

function initbianti(){
	$psoId=$("#psoId").val();
	$.ajax({
		type : "get",
		url : "/ymx/productValue/listJson",
		data : {"piId":$psoId},// 你的formid
		error : function(request) {
			parent.layer.alert("Connection error");
		},
		success : function(data) {
			var str2=""
			for (var i = 0; i < data.length; i++) {
				str2+="<li><span class='sku_text' data='"+data[i].pvaId+"' onclick='updateV(this)'>"+data[i].pvaName+"</span><span class='close bt_del_skutype' onclick='removeMyself(this)'>x</span></li>";
				var $pvaId= data[i].pvaId;
				var $pvaName= data[i].pvaName;
				$.ajax({
					type : "get",
					url : "/ymx/productValue/listJson2",
					data : {
						"pvaId":$pvaId,
						"sort":"pv_id",
						"order":"asc",
						"piId":$psoId
					},
					async :false,
					error : function(request) {
						parent.layer.alert("Connection error");
					},
					success : function(data2) {
						var str="<li iddata='"+$pvaId+"' data='"+$pvaName+"'><span>"+$pvaName+': </span><ul>'
						for (var j = 0; j < data2.length; j++) {
								str+="<li onclick='chooseColor(this)'>"+data2[j].pvName+"</li>";
						}
						str+="</ul></li>";
						$("#valueli").append(str);
					}
				})
			}
			$("#sku").append(str2);
			
		}
	})
}

function parsing(){
	var source=$("#psoSource").val();
	var jsona=$("#jx").val();
	if(jsona!=null&&jsona!=''){
		var jsonObj = eval('(' + jsona + ')');
		if(source=="tmall"){
		      for(var name in jsonObj){
		    	  var json1=jsonObj[name];
		    	 
		    	  var str="<li  data='"+name+"'><span>"+name+': </span><ul>'
					for (var j = 0; j < json1.length; j++) {
							str+="<li>"+json1[j]+"</li>";
					}
					str+="</ul></li>";
					$("#valuejx").append(str);
		      }

		}
		if(source=="taobao"){
		      for(var name in jsonObj){
		    	  var json1=jsonObj[name];
		    	 
		    	  var str="<li  data='"+name+"'><span>"+name+': </span><ul>'
					for (var j = 0; j < json1.length; j++) {
							str+="<li>"+json1[j]+"</li>";
					}
					str+="</ul></li>";
					$("#valuejx").append(str);
		      }

		}
		if(source=="1688"){
		      for(var name in jsonObj){
		    	  var jsonObj1=jsonObj[name];
		    	  
		    	  for(var name1 in jsonObj1){
		    		  var json2=jsonObj1[name1];
		    		  for(var j = 0; j < json2.length; j++){
		    			var str="<li  data='"+json2[j].prop+"'><span>"+json2[j].prop+': </span><ul>'
		    			
		  				for (var i = 0; i < json2[j].value.length; i++) {
		  					
		  						str+="<li>"+json2[j].value[i].name+"</li>";
		  				}
		  				str+="</ul></li>";
		  				$("#valuejx").append(str);
		    		  }
		    	  }
		    	 
		      }

		}
		if(source=="amazon"){
			for(var name in jsonObj){
		    	  var json1=jsonObj[name];
		    	 
		    	  var str="<li  data='"+name+"'><span>"+name+': </span><ul>'
					for (var j = 0; j < json1.length; j++) {
							str+="<li>"+json1[j]+"</li>";
					}
					str+="</ul></li>";
					$("#valuejx").append(str);
		      }
		}
		if(source=="兰亭集势"){
            for(var name in jsonObj){
                var jsonObj1=jsonObj[name];
                var str="<li  data='"+name+"'><span>"+name+': </span><ul>'
                for(var name1 in jsonObj1){
                        str+="<li>"+name1+"</li>";
                }
                str+="</ul></li>";
                $("#valuejx").append(str);
            }
        }
	}
	
}
function entranslation(obj){
	$.ajax({
		type : "POST",
		url : "/ymx/productTranslation/entranslation",
		data:{
			"to":obj,
			ptTitle:$("#title_en").val(),
			ptKeyword:$("#keywords_en").val(),
			ptPoint:$("#keypoints_en").val(),
			ptDesc:$("#description_en").val()
		},
		success : function(data) {
			$("#title_"+obj).val(data.ptTitle);
			$("#keywords_"+obj).val(data.ptKeyword);
			$("#keypoints_"+obj).val(data.ptPoint);
			$("#description_"+obj).val(data.ptDesc);
		}
	})
}
function translation(obj){
	$.ajax({
		type : "POST",
		url : "/ymx/productTranslation/translation",
		data:{
			"to":obj,
			ptTitle:$("#title_zh").val(),
			ptKeyword:$("#keywords_zh").val(),
			ptPoint:$("#keypoints_zh").val(),
			ptDesc:$("#description_zh").val()
		},
		success : function(data) {
			$("#title_"+obj).val(data.ptTitle);
			$("#keywords_"+obj).val(data.ptKeyword);
			$("#keypoints_"+obj).val(data.ptPoint);
			$("#description_"+obj).val(data.ptDesc);
		}
	})
	
	
// $.ajax({
// cache : true,
// type : "POST",
// url : "/ymx/productTranslation/translation",
// data:{
// languages:obj,
// ptTitle:$("#title_zh").val(),
// ptKeyword:$("#keywords_zh").val(),
// ptPoint:$("#keypoints_zh").val(),
// ptDesc:$("#description_zh").val()
// },
// async : false,
// success : function(data) {
//			
// if(data.languages=="en"){
// $("#title_en").val(data.ptTitle);
// $("#keywords_en").val(data.ptKeyword);
// $("#keypoints_en").val(data.ptPoint);
// $("#description_en").val(data.ptDesc);
// }
// if(data.languages=="fr"){
// $("#title_fr").val(data.ptTitle);
// $("#keywords_fr").val(data.ptKeyword);
// $("#keypoints_fr").val(data.ptPoint);
// $("#description_fr").val(data.ptDesc);
// }
// if(data.languages=="de"){
// $("#title_de").val(data.ptTitle);
// $("#keywords_de").val(data.ptKeyword);
// $("#keypoints_de").val(data.ptPoint);
// $("#description_de").val(data.ptDesc);
// }
// if(data.languages=="it"){
// $("#title_it").val(data.ptTitle);
// $("#keywords_it").val(data.ptKeyword);
// $("#keypoints_it").val(data.ptPoint);
// $("#description_it").val(data.ptDesc);
// }
// if(data.languages=="es"){
// $("#title_es").val(data.ptTitle);
// $("#keywords_es").val(data.ptKeyword);
// $("#keypoints_es").val(data.ptPoint);
// $("#description_es").val(data.ptDesc);
// }
// if(data.languages=="ja"){
// $("#title_ja").val(data.ptTitle);
// $("#keywords_ja").val(data.ptKeyword);
// $("#keypoints_ja").val(data.ptPoint);
// $("#description_ja").val(data.ptDesc);
// }
// }
// });
}

// 从中文一键翻译
function translationList(){
	$("#label_lang_en").css("background-color","#4CAE4C");
	$("#label_lang_fr").css("background-color","#4CAE4C");
	$("#label_lang_de").css("background-color","#4CAE4C");
	$("#label_lang_it").css("background-color","#4CAE4C");
	$("#label_lang_es").css("background-color","#4CAE4C");
	$("#label_lang_ja").css("background-color","#4CAE4C");
	$.ajax({
// cache : true,
		type : "POST",
		url : "/ymx/productTranslation/translationList",
		data:{
// ptTitle:$("#title_en").val(),
// ptKeyword:$("#keywords_en").val(),
// ptPoint:$("#keypoints_en").val(),
// ptDesc:$("#description_en").val()
			
			ptTitle:$("#title_zh").val(),
			ptKeyword:$("#keywords_zh").val(),
			ptPoint:$("#keypoints_zh").val(),
			ptDesc:$("#description_zh").val()
		},
// async : false,
		success : function(data) {
			var title_zh=isnull($("#title_zh").val());// 判断中文标题是否为空;
			var keywords_zh=isnull($("#keywords_zh").val());// 判断中文关键字是否为空
			var keypoints_zh=isnull($("#keypoints_zh").val());// 判断中文要点是否为空
			var description_zh=isnull($("#description_zh").val());// 判断中文描述是否为空
			for(var i=0;i<data.length;i++){
				var traptTitle=data[i].ptTitle.replace("\\n","\n");
				var traptKeyword=data[i].ptKeyword.replace("\\n","\n");
				var traptPoint=data[i].ptPoint.replace("\\n","\n");
				var traptDesc=data[i].ptDesc.replace("\\n","\n");
				traptTitle = traptTitle.substring(0,1).toUpperCase()+traptTitle.substring(1);
				traptKeyword = traptKeyword.substring(0,1).toUpperCase()+traptKeyword.substring(1);
				traptPoint = traptPoint.substring(0,1).toUpperCase()+traptPoint.substring(1);
				traptDesc = traptDesc.substring(0,1).toUpperCase()+traptDesc.substring(1);
				if(data[i].languages=="en"){
					$("#title_en").val(traptTitle);
					$("#keywords_en").val(traptKeyword);
					$("#keypoints_en").val(traptPoint);
					$("#description_en").val(traptDesc);
					$("#label_lang_en").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_en");
				}
				if(data[i].languages=="fr"){
					$("#title_fr").val(traptTitle);
					$("#keywords_fr").val(traptKeyword);
					$("#keypoints_fr").val(traptPoint);
					$("#description_fr").val(traptDesc);
					$("#label_lang_fr").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_fr");
				}
				if(data[i].languages=="de"){
					$("#title_de").val(traptTitle);
					$("#keywords_de").val(traptKeyword);
					$("#keypoints_de").val(traptPoint);
					$("#description_de").val(traptDesc);
					$("#label_lang_de").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_de");
				}
				if(data[i].languages=="it"){
					$("#title_it").val(traptTitle);
					$("#keywords_it").val(traptKeyword);
					$("#keypoints_it").val(traptPoint);
					$("#description_it").val(traptDesc);
					$("#label_lang_it").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_it");
				}
				if(data[i].languages=="es"){
					$("#title_es").val(traptTitle);
					$("#keywords_es").val(traptKeyword);
					$("#keypoints_es").val(traptPoint);
					$("#description_es").val(traptDesc);
					$("#label_lang_es").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_es");
				}
				if(data[i].languages=="ja"){
					$("#title_ja").val(data[i].ptTitle.replace("\\n","\n"));
					$("#keywords_ja").val(data[i].ptKeyword.replace("\\n","\n"));
					$("#keypoints_ja").val(data[i].ptPoint.replace("\\n","\n"));
					$("#description_ja").val(data[i].ptDesc.replace("\\n","\n"));
					$("#label_lang_ja").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_ja");
				}
			}
		}
	});
}
// 从英文一键翻译
function translationYingList(){
	$("#label_lang_fr").css("background-color","#4CAE4C");
	$("#label_lang_de").css("background-color","#4CAE4C");
	$("#label_lang_it").css("background-color","#4CAE4C");
	$("#label_lang_es").css("background-color","#4CAE4C");
	$("#label_lang_ja").css("background-color","#4CAE4C");
	$.ajax({
		// cache : true,
		type : "POST",
		url : "/ymx/productTranslation/translationYingList",
		data:{
			ptTitle:$("#title_en").val(),
			ptKeyword:$("#keywords_en").val(),
			ptPoint:$("#keypoints_en").val(),
			ptDesc:$("#description_en").val()
		},
		// async : false,
		success : function(data) {
			var title_en=isnull($("#title_en").val());// 判断英文标题是否为空;
			var keywords_en=isnull($("#keywords_en").val());// 判断英文关键字是否为空
			var keypoints_en=isnull($("#keypoints_en").val());// 判断英文要点是否为空
			var description_en=isnull($("#description_en").val());// 判断英文描述是否为空
			for(var i=0;i<data.length;i++){
				var traptTitle=data[i].ptTitle.replace("\\n","\n");
				var traptKeyword=data[i].ptKeyword.replace("\\n","\n");
				var traptPoint=data[i].ptPoint.replace("\\n","\n");
				var traptDesc=data[i].ptDesc.replace("\\n","\n");
				traptTitle = traptTitle.substring(0,1).toUpperCase()+traptTitle.substring(1);
				traptKeyword = traptKeyword.substring(0,1).toUpperCase()+traptKeyword.substring(1);
				traptPoint = traptPoint.substring(0,1).toUpperCase()+traptPoint.substring(1);
				traptDesc = traptDesc.substring(0,1).toUpperCase()+traptDesc.substring(1);
				if(data[i].languages=="fr"){
					$("#title_fr").val(traptTitle);
					$("#keywords_fr").val(traptKeyword);
					$("#keypoints_fr").val(traptPoint);
					$("#description_fr").val(traptDesc);
					$("#label_lang_fr").css("background-color","#FFFFFF");
					isChangeColor(title_en,keywords_en,keypoints_en,description_en,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_fr");
				}
				if(data[i].languages=="de"){
					$("#title_de").val(traptTitle);
					$("#keywords_de").val(traptKeyword);
					$("#keypoints_de").val(traptPoint);
					$("#description_de").val(traptDesc);
					$("#label_lang_de").css("background-color","#FFFFFF");
					isChangeColor(title_en,keywords_en,keypoints_en,description_en,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_de");
				}
				if(data[i].languages=="it"){
					$("#title_it").val(traptTitle);
					$("#keywords_it").val(traptKeyword);
					$("#keypoints_it").val(traptPoint);
					$("#description_it").val(traptDesc);
					$("#label_lang_it").css("background-color","#FFFFFF");
					isChangeColor(title_en,keywords_en,keypoints_en,description_en,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_it");
				}
				if(data[i].languages=="es"){
					$("#title_es").val(traptTitle);
					$("#keywords_es").val(traptKeyword);
					$("#keypoints_es").val(traptPoint);
					$("#description_es").val(traptDesc);
					$("#label_lang_es").css("background-color","#FFFFFF");
					isChangeColor(title_en,keywords_en,keypoints_en,description_en,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_es");
				}
				if(data[i].languages=="ja"){
					$("#title_ja").val(data[i].ptTitle.replace("\\n","\n"));
					$("#keywords_ja").val(data[i].ptKeyword.replace("\\n","\n"));
					$("#keypoints_ja").val(data[i].ptPoint.replace("\\n","\n"));
					$("#description_ja").val(data[i].ptDesc.replace("\\n","\n"));
					$("#label_lang_ja").css("background-color","#FFFFFF");
					isChangeColor(title_en,keywords_en,keypoints_en,description_en,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_ja");
				}
			}
		}
	});
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

// sku值变化
function skuChange(obj){
	var skuval=$(obj);
	var tr=$('#tbAdd').children("tr");
	var tdarry=new Array();
    for (var t = 0; t < tr.length; t++) {
    	var td=$(tr[t]).children("td");
    	if($(td[0]).find("input").attr("type")=="checkbox"){
    		tdarry.push(tr[t]);
    	}
	}
    for (var i = 0; i < tdarry.length; i++) {
    	var td=$(tdarry[i]).children("td");
    	var inpval=$(td[3]).find("input").val();
    	var inparr=inpval.split("-");
    	inparr[0]=skuval.val();
    	$(td[3]).find("input").val(inparr[0]+"-"+inparr[1]);
	}
    /*
	 * $('.skuClass').each(function() { var $this = $(this); var text_length =
	 * $this.val().length;//获取当前文本框的长度 var current_width = parseInt(text_length)
	 * *15;//该15是改变前的宽度除以当前字符串的长度,算出每个字符的长度 if(current_width>100){
	 * $this.css("width",current_width+"px"); } });
	 */
    $("piCpmvalue").val("");
    $('.upceanclass').each(function() {
        var $this = $(this);
        $this.val("");// 获取当前文本框的长度
    });
}
// 最终价格
function freChange(obj){
	var $obFre=$(obj);
	var xdJie=$obFre.next().val();
	var par=$obFre.parent().parent();
	var ch=par.children();
	var yuntd=$(ch[1]).text();
	var cgprice=$("#piPrice").val();
	var gnprice=$("#piFreight").val();
	// 利润
	var lrprice=parseFloat($obFre.val())/parseFloat(xdJie)-(parseFloat(yuntd)+parseFloat(cgprice)+parseFloat(gnprice));
	// 利润率
	var lrlv=parseFloat(lrprice)/(parseFloat($obFre.val())/parseFloat(xdJie))*100;
	lrlv=lrlv.toFixed(2);
	$(ch[5]).html('<span>'+lrprice.toFixed(2)+'</span>(<span>'+lrlv+'%</span>)');
}
// 产品页链接
function clickProduct(){
	window.open(''+$('#psoWebsite').val()+'');
}


function edit(id) {
	if(id !=null){
		var index = parent.layer.getFrameIndex(window.name);
		var indexed=parent.layer.open({
			type : 2,
			title : '编辑',
			maxmin : true,
			shadeClose : false, // 点击遮罩关闭层
			area : [ '100%', '100%' ],
			content : prefix + '/edit/' + id // iframe的url
		});
		
		parent.layer.close(index);
		// parent.layer.full(indexed);
		/*
		 * parent.reLoad(); // 获取窗口索引
		 */	
	}else{
		parent.layer.msg("已是最后一页")
	}
	
	layer.full(indexed);
}

function back(){
	var index = parent.layer.getFrameIndex(window.name);
	parent.layer.close(index);
	parent.reLoad();
}


function imgmove(){
	var thisCurrentItem;
	var start;
	var end;
	 function Pointer(x, y) {
         this.x = x;
         this.y = y;
     }

     function Position(left, top) {
         this.left = left;
         this.top = top;
     }

     $(".item_content .item").each(function (i) {
         this.init = function () { // 初始化
             this.box = $(this).parent();
             $(this).attr("index", i).css({
                 position: "absolute",
                 left: this.box.offset().left,
                 top: this.box.offset().top
             }).appendTo(".item_content");
             this.drag();
         },
             this.move = function (callback) {  // 移动
                 $(this).stop(true).animate({
                     left: this.box.offset().left,
                     top: this.box.offset().top
                 }, 500, function () {
                     if (callback) {
                         callback.call(this);
                     }
                 });
             },
             this.collisionCheck = function () {
                 var currentItem = this;
                 var direction = null;
                 $(this).siblings(".item").each(function () {
                     if (
                         currentItem.pointer.x > this.box.offset().left &&
                         currentItem.pointer.y > this.box.offset().top &&
                         (currentItem.pointer.x < this.box.offset().left + this.box.width()) &&
                         (currentItem.pointer.y < this.box.offset().top + this.box.height())
                     ) {
                         // 返回对象和方向
                         if (currentItem.box.offset().top < this.box.offset().top) {
                             direction = "down";
                         } else if (currentItem.box.offset().top > this.box.offset().top) {
                             direction = "up";
                         } else {
                             direction = "normal";
                         }
                         this.swap(currentItem, direction);
                     }
                 });
             },
             this.swap = function (currentItem, direction) { // 交换位置
                 if (this.moveing) return false;
                 var directions = {
                     normal: function () {
                         var saveBox = this.box;
                         this.box = currentItem.box;
                         currentItem.box = saveBox;
                         this.move();
                         $(this).attr("index", this.box.index());
                         $(currentItem).attr("index", currentItem.box.index());
                     },
                     down: function () {
                         // 移到上方
                         var box = this.box;
                         var node = this;
                         var startIndex = currentItem.box.index();
                         var endIndex = node.box.index();
                         ;
                         for (var i = endIndex; i > startIndex; i--) {
                             var prevNode = $(".item_content .item[index=" + (i - 1) + "]")[0];
                             node.box = prevNode.box;
                             $(node).attr("index", node.box.index());
                             node.move();
                             node = prevNode;
                         }
                         currentItem.box = box;
                         $(currentItem).attr("index", box.index());

                     },
                     up: function () {
                         // 移到上方
                         var box = this.box;
                         var node = this;
                         var startIndex = node.box.index();
                         var endIndex = currentItem.box.index();
                         for (var i = startIndex; i < endIndex; i++) {
                             var nextNode = $(".item_content .item[index=" + (i + 1) + "]")[0];
                             node.box = nextNode.box;
                             $(node).attr("index", node.box.index());
                             node.move();
                             node = nextNode;
                         }
                         currentItem.box = box;
                         $(currentItem).attr("index", box.index());

                     }
                 }
                 directions[direction].call(this);
             },
             this.drag = function () { // 拖拽
                 var oldPosition = new Position();
                 var oldPointer = new Pointer();
                 var isDrag = false;
                 var currentItem = null;
                 $(this).mousedown(function (e) {
                     e.preventDefault();
                     oldPosition.left = $(this).position().left;
                     oldPosition.top = $(this).position().top;
                     oldPointer.x = e.pageX;
                     oldPointer.y = e.pageY;
                     isDrag = true;
                     currentItem = this;
                     thisCurrentItem=currentItem;
                     if(start==undefined){
                    	 start=$(currentItem).attr("index");
                     }

                 });
                 $("#item_content-id").mousemove(function (e) {
                     var currentPointer = new Pointer(e.pageX, e.pageY);
                     if (!isDrag) return false;
                     $(currentItem).css({
                         "opacity": "0.8",
                         "z-index": 999
                     });
                     var left = currentPointer.x - oldPointer.x + oldPosition.left;
                     var top = currentPointer.y - oldPointer.y + oldPosition.top;
                     $(currentItem).css({
                         left: left,
                         top: top
                     });
                     currentItem.pointer = currentPointer;
                     // 开始交换位置
                     currentItem.collisionCheck();


                 });
                 $("#item_content-id").mouseup(function (e) {
                     if (!isDrag) return false;
                     end=$(thisCurrentItem).attr("index");
                 	var pphPid=$(thisCurrentItem).children().eq(0).attr('id');
                 	if(start!=end){
                 		$.ajax({
                 			cache : true,
                 			type : "POST",
                 			url : "/ymx/productPhoto/updateOrder",
                 			data :  {"pphPid": pphPid, "start":start, "end":end},// 你的formid
                 			error : function(request) {
                 			},
                 			success : function() {
                 				
                 			}
                 		});
                 	}
                 	 start=undefined;
                     isDrag = false;
                     currentItem.move(function () {
                         $(this).css({
                             "opacity": "1",
                             "z-index": 0
                         });
                     });
                 });
                
                  
             }
         this.init();
     });
}

function delePhoto(obj){
	$.ajax({
		type : "post",
		url : "/ymx/productPhoto/updatePid",
		data : {"pphId":$(obj).prev().prev().prev().prev().prev().attr('data')},
		// async:false,
		success : function() {
			 getImg();
		}
	})
	return false;
}
// 点击图片
function clickitemphoto(obj){
	if(!$(obj).hasClass("check")){
		$(obj).addClass("check");
		$(obj).css("background-color","grey");
	 }else{
	    $(obj).removeClass("check");
	    $(obj).css("background-color","");
	 }
}
// 下载图片
function downPhoto(obj){
	window.location.href='/ymx/productPhoto/downFile?filepath='+$(obj).prev().prev().prev().attr('src');
}
// 批量下载图片
function downloadphoto(){
	var imgcheck=$(".check").find("img");
	if(imgcheck.length==0){
		layer.confirm('确定要下载所有图片吗,可以双击选择图片!', {
			btn : [ '确定', '取消' ]
		}, function(index) {
			var imgitem=$(".item").find("img");
			imgitem.each(function(j){
				var imgitemsrc=$(this).attr('src');
			    setTimeout(function(){
			    	window.location.href='/ymx/productPhoto/downFile?filepath='+imgitemsrc;
			    	/*
					 * var aLink = document.createElement('a'); aLink.href =
					 * '/ymx/productPhoto/downFile?filepath='+imgitemsrc;
					 * document.body.appendChild(aLink); aLink.click();
					 * document.body.removeChild(aLink);
					 */
			    }, j*500);
			})
			 layer.close(index);
		})
	}else{
		$(imgcheck).each(function(i){
			var imgchecksrc=$(this).attr('src');
		    setTimeout(function(){
		    	window.location.href='/ymx/productPhoto/downFile?filepath='+imgchecksrc;
		    }, i*500);
		})
	}
}
function searPhoto(obj){
	window.open($(obj).prev().prev().prev().prev().attr('src'));
// layer.open({
// type: 1,
// title: false,
// closeBtn: 0,
// // area:['100%','100%'],
// // area: '516px',
// skin: 'layui-layer-nobg',
// shadeClose: true,
// content:"<img src='"+$(obj).prev().prev().attr('src')+"'/>"
// });
}

// 删除某个产品
function removeProduct(id,nextid) {
	$.ajax({
		url : prefix+"/remove",
		type : "post",
		data : {
			'piId' : id
		},
		success : function(r) {
			if (r.code==0) {
				if(nextid!=''){
					edit(nextid);
				}else{
					// parent.reLoad();
					back();
				}
				// layer.msg(r.msg);
				// reLoad();
			}else{
				// layer.msg(r.msg);
			}
		}
	});
}
// 添加品牌名
function addzhbardname(obj){
	var bardname="";
	if(obj=="zhbardname"){
		bardname=$("#zhbardname").val();
	}else if(obj=="enbardname"){
		bardname=$("#enbardname").val();
	}
	$("#title_zh").val(bardname+$("#title_zh").val());
	$("#title_en").val(bardname+$("#title_en").val());
	$("#title_fr").val(bardname+$("#title_fr").val());
	$("#title_de").val(bardname+$("#title_de").val());
	$("#title_it").val(bardname+$("#title_it").val());
	$("#title_es").val(bardname+$("#title_es").val());
	$("#title_ja").val(bardname+$("#title_ja").val());
}
// 移除品牌名
function removezhbardname(obj){
	var bardname="";
	if(obj=="zhbardname"){
		bardname=$("#zhbardname").val();
	}else if(obj=="enbardname"){
		bardname=$("#enbardname").val();
	}
	// 包含
	if ($("#title_zh").val().indexOf(bardname)!=-1){
		$("#title_zh").val($("#title_zh").val().replace(bardname,""));
	}
	if ($("#title_en").val().indexOf(bardname)!=-1){
		$("#title_en").val($("#title_en").val().replace(bardname,""));
	}
	if ($("#title_fr").val().indexOf(bardname)!=-1){
		$("#title_fr").val($("#title_fr").val().replace(bardname,""));
	}
	if ($("#title_de").val().indexOf(bardname)!=-1){
		$("#title_de").val($("#title_de").val().replace(bardname,""));
	}
	if ($("#title_it").val().indexOf(bardname)!=-1){
		$("#title_it").val($("#title_it").val().replace(bardname,""));
	}
	if ($("#title_es").val().indexOf(bardname)!=-1){
		$("#title_es").val($("#title_es").val().replace(bardname,""));
	}
	if ($("#title_ja").val().indexOf(bardname)!=-1){
		$("#title_ja").val($("#title_ja").val().replace(bardname,""));
	}
}
// 标题打乱顺序
function luanxutitle(){
	var luannum=$("#luanxunum").val();
	var res = $("#title_en").val();
	var index = find(res,' ',luannum-1);   
	var ress = res.substring(index+1);  
	var arryqian=ress.split(" ");
	var qian =res.substring(0,index); 
	var hou=(shuffle(arryqian)).join(' ');
	$("#title_en").val(qian+" "+hou);
}
// 字符串res中第几个‘ ’的下标位置
function find(str,cha,num){
    var x=str.indexOf(cha);
    for(var i=0;i<num;i++){
        x=str.indexOf(cha,x+1);
    }
    return x;
}
// 快速排序函数
function shuffle(arr) {
    var len = arr.length;
    for (var i = 0; i < len - 1; i++) {
        var index = parseInt(Math.random() * (len - i));
        var temp = arr[index];
        arr[index] = arr[len - i - 1];
        arr[len - i - 1] = temp;
    }
    return arr;
}

// 判断字符是否为空
function isnull(val){
	var str = val.replace(/(^\s*)|(\s*$)/g, '');// 去除空格
	var flag=true;// 默认true为非空
	if(str == '' || str == undefined || str == null){
		flag=false;
	}
	return flag;
}

// 翻译错误标题选项卡title变色提示
function isChangeColor(sx1,sx2,sx3,sx4,val1,val2,val3,val4,dz){
	if(sx1){
// $(dz).css("color","#a7b1c2");
		$(dz).removeClass("chColor");
		if(!isnull(val1)){
			$(dz).addClass("chColor");
// $(".chColor").css("color","#FF0000");
		}
	}
	if(sx2){
// $(dz).css("color","#a7b1c2");
		$(dz).removeClass("chColor");
		if(!isnull(val2)){
			$(dz).addClass("chColor");
// $(".chColor").css("color","#FF0000");
		}
	}
	if(sx3){
// $(dz).css("color","#a7b1c2");
		$(dz).removeClass("chColor");
		if(!isnull(val3)){
			$(dz).addClass("chColor");
// $(".chColor").css("color","#FF0000");
		}
	}
	if(sx4){
// $(dz).css("color","#a7b1c2");
		$(dz).removeClass("chColor");
		if(!isnull(val4)){
			$(dz).addClass("chColor");
// $(".chColor").css("color","#FF0000");
		}
	}
}

// 标题清空换行、空格符号
function removezhspace(obj){
	var bardname="";
	if(obj=="title_zh"){
		bardname=$("#title_zh").val();
	}else if(obj=="title_en"){
		bardname=$("#title_en").val();
	}
	newbardname=bardname.trim().replace(/\s/g,"");
	$("#title_zh").val(newbardname);
	$("#title_en").val(newbardname);
	$("#title_fr").val(newbardname);
	$("#title_de").val(newbardname);
	$("#title_it").val(newbardname);
	$("#title_es").val(newbardname);
	$("#title_ja").val(newbardname);
}

// 文案翻译每项添加一个翻译按钮，只翻译该项内容
function translationByItem(thisObj){
	$("#label_lang_en").css("background-color","#4CAE4C");
	$("#label_lang_fr").css("background-color","#4CAE4C");
	$("#label_lang_de").css("background-color","#4CAE4C");
	$("#label_lang_it").css("background-color","#4CAE4C");
	$("#label_lang_es").css("background-color","#4CAE4C");
	$("#label_lang_ja").css("background-color","#4CAE4C");
	$.ajax({
		cache : true,
		type : "POST",
		url : "/ymx/productTranslation/translationByItem",
		data :{
			id:$(thisObj).prev().attr('id'),          // $(this).attr('id'),
			content:$(thisObj).prev().val(),
			title_zh:$("#title_zh").val(),
			keywords_zh:$("#keywords_zh").val(),
			keypoints_zh:$("#keypoints_zh").val(),
			description_zh:$("#description_zh").val(),
			title_en:$("#title_en").val(),
			keywords_en:$("#keywords_en").val(),
			keypoints_en:$("#keypoints_en").val(),
			description_en:$("#description_en").val(),
			title_fr:$("#title_fr").val(),
			keywords_fr:$("#keywords_fr").val(),
			keypoints_fr:$("#keypoints_fr").val(),
			description_fr:$("#description_fr").val(),
			title_de:$("#title_de").val(),
			keywords_de:$("#keywords_de").val(),
			keypoints_de:$("#keypoints_de").val(),
			description_de:$("#description_de").val(),
			title_it:$("#title_it").val(),
			keywords_it:$("#keywords_it").val(),
			keypoints_it:$("#keypoints_it").val(),
			description_it:$("#description_it").val(),
			title_es:$("#title_es").val(),
			keywords_es:$("#keywords_es").val(),
			keypoints_es:$("#keypoints_es").val(),
			description_es:$("#description_es").val(),
			title_ja:$("#title_ja").val(),
			keywords_ja:$("#keywords_ja").val(),
			keypoints_ja:$("#keypoints_ja").val(),
			description_ja:$("#description_ja").val()
		},
// async : false,
		success : function(data){
			var title_zh=isnull($("#title_zh").val());// 判断中文标题是否为空;
			var keywords_zh=isnull($("#keywords_zh").val());// 判断中文关键字是否为空
			var keypoints_zh=isnull($("#keypoints_zh").val());// 判断中文要点是否为空
			var description_zh=isnull($("#description_zh").val());// 判断中文描述是否为空
			for(var i=0;i<data.length;i++){
				var traptTitle=data[i].ptTitle.replace("\\n","\n");
				var traptKeyword=data[i].ptKeyword.replace("\\n","\n");
				var traptPoint=data[i].ptPoint.replace("\\n","\n");
				var traptDesc=data[i].ptDesc.replace("\\n","\n");
				traptTitle = traptTitle.substring(0,1).toUpperCase()+traptTitle.substring(1);
				traptKeyword = traptKeyword.substring(0,1).toUpperCase()+traptKeyword.substring(1);
				traptPoint = traptPoint.substring(0,1).toUpperCase()+traptPoint.substring(1);
				traptDesc = traptDesc.substring(0,1).toUpperCase()+traptDesc.substring(1);
				if(data[i].languages=="en"){
					$("#title_en").val(traptTitle);
					$("#keywords_en").val(traptKeyword);
					$("#keypoints_en").val(traptPoint);
					$("#description_en").val(traptDesc);
					$("#label_lang_en").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_en");
				}
				if(data[i].languages=="fr"){
					$("#title_fr").val(traptTitle);
					$("#keywords_fr").val(traptKeyword);
					$("#keypoints_fr").val(traptPoint);
					$("#description_fr").val(traptDesc);
					$("#label_lang_fr").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_fr");
				}
				if(data[i].languages=="de"){
					$("#title_de").val(traptTitle);
					$("#keywords_de").val(traptKeyword);
					$("#keypoints_de").val(traptPoint);
					$("#description_de").val(traptDesc);
					$("#label_lang_de").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_de");
				}
				if(data[i].languages=="it"){
					$("#title_it").val(traptTitle);
					$("#keywords_it").val(traptKeyword);
					$("#keypoints_it").val(traptPoint);
					$("#description_it").val(traptDesc);
					$("#label_lang_it").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_it");
				}
				if(data[i].languages=="es"){
					$("#title_es").val(traptTitle);
					$("#keywords_es").val(traptKeyword);
					$("#keypoints_es").val(traptPoint);
					$("#description_es").val(traptDesc);
					$("#label_lang_es").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_es");
				}
				if(data[i].languages=="ja"){
					$("#title_ja").val(data[i].ptTitle.replace("\\n","\n"));
					$("#keywords_ja").val(data[i].ptKeyword.replace("\\n","\n"));
					$("#keypoints_ja").val(data[i].ptPoint.replace("\\n","\n"));
					$("#description_ja").val(data[i].ptDesc.replace("\\n","\n"));
					$("#label_lang_ja").css("background-color","#FFFFFF");
					isChangeColor(title_zh,keywords_zh,keypoints_zh,description_zh,traptTitle,traptKeyword,traptPoint,traptDesc,"#label_lang_ja");
				}
			}
		}
	});
}

// 放入图片库
function movePhoto(obj){
	layer.confirm('确定上传该图片到图片库？', {
		btn : [ '确定', '取消' ]
	}, function(index) {
		$.ajax({
			type : "post",
			url : "/ymx/productPhoto/movePhoto",
			data : {"pphId":$(obj).prev().prev().attr('data')},
			// async:false,
			success : function(data) {
				if(data.code==0){
					parent.layer.msg("操作成功");
				}else{
					parent.layer.msg(data.msg);
				}
			}
		});
		layer.close(index);
	})
}

// 批量存入图片库
function moveToLibrary(){
	var imgcheck=$(".check").find("img");
	if(imgcheck.length==0){
		layer.confirm('确定要上传所有图片到图片库吗,可以双击选择图片!', {
			btn : [ '确定', '取消' ]
		}, function(index) {
			var imgitem=$(".item").find("img");
			imgitem.each(function(j){
				$.ajax({
		    		type : "post",
		    		url : "/ymx/productPhoto/movePhoto",
		    		data : {
		    				"pphId":$(this).attr('data')
		    				},
		    		// async:false,
		    		success : function(r) {
		    			if(r.code==0){
		    				parent.layer.msg("操作成功");
							getImg();
		    			}else{
		    				parent.layer.msg(r.msg);
		    			}
		    			
		    		}
		    	});
// return false;
			});
			layer.close(index);
		})
	}else{
		$(imgcheck).each(function(i){
			$.ajax({
	    		type : "post",
	    		url : "/ymx/productPhoto/movePhoto",
	    		data : {
	    				"pphId":$(this).attr('data')
	    				},
	    		// async:false,
	    		success : function(r) {
	    			if(r.code==0){
	    				parent.layer.msg("操作成功");
						getImg();
	    			}else{
	    				parent.layer.msg(r.msg);
	    			}
	    			
	    		}
	    	});
// return false;
		})
	}
}

function choosetemplate(language){
	layer.open({
		type : 2,
		title : '模板',
		maxmin : true,
		shadeClose : false, // 点击遮罩关闭层
		area : [ '800px', '520px' ],
		content :  "/ymx/productTemplate/showTemplate/"+language // iframe的url
	});
}
function xiuPhoto(data){
	var src = $("img[data="+data+"]").attr("src");
	var id = $("img[data="+data+"]").attr("id");
	console.log(src);
	/*
	 * layer.open({ type : 2, title : '美图', maxmin : true, shadeClose : false, //
	 * 点击遮罩关闭层 area : [ '800px', '520px' ], content : xiuxiu.embedSWF("photo1",
	 * 3, "100%", "100%","xiuxiuEditor") // iframe的url });
	 */
	/* 第1个参数是加载编辑器div容器，第2个参数是编辑器类型，第3个参数是div容器宽，第4个参数是div容器高 */
    xiuxiu.embedSWF("photo1", 3, "100%", "100%","xiuxiuEditor");
    $("#closemeitu").css("display","block");
    // 修改为您自己的图片上传接口
    xiuxiu.setUploadURL("http://tb.taober.cn/ymx/productPhoto/upload?pphPid="+id);// http://ycxamd.natapp1.cc/upload
    xiuxiu.setUploadType(2);
    xiuxiu.setUploadDataFieldName("file");
    xiuxiu.onInit = function () {
    	xiuxiu.loadPhoto("http://tb.taober.cn"+src);
    }
    xiuxiu.onUploadResponse = function (data)
    {
    	xiuxiu.remove("xiuxiuEditor");
    	$("#closemeitu").css("display","none");
    	window.location.reload();
    }
}
function closemeitu(){
	xiuxiu.remove("xiuxiuEditor");
	$("#closemeitu").css("display","none");
	window.location.reload();
}