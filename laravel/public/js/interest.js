(function($){
	$.fn.extend({
		interest : function(options){
			var defaluts = {
				tableid    : "",
				dateclass  : "",
				moneyclass : "",
				btnparid   : "",
				btnid      : "",
			};
			var options = $.extend(defaluts,options);
			var btnpar = $("#"+options.btnparid);
			var table = $("#"+options.tableid);
			var tr = table.children("tbody").children("tr");
			var btnok = $("#btnok");
            tr.css({"position":"relative"});
			$(this).on("click",function(){
				if($("#interestWrap").length == 1){
					$("#interestWrap").remove();
					tr.children("span").remove();
				}else{
					btnpar.create();				
				}

			});
            
			btnpar.on("click","#btnok",function(){
				var rates = $("#rates").val();
				var endtime = $("#endtime").val();
				var intertotal = 0;
				if(endtime == ""){
					alert("请输入结束日期");
                    return;
				}else if(rates == ""){
					alert("请输入利率");
                    return;
				}else if(isNaN(rates)){
					alert("利率需输入数字");
                    return;
				}
				tr.each(function(){
					if ($(this).children("span").length == 1) {
						$(this).children("span").remove();
					}
					var starttime = $(this).children("." + options.dateclass).text();
					var money = $(this).children("." + options.moneyclass).text();
					var time = $(this).datanum(starttime,endtime);
					var m = money*(rates/100)*(time/365);
					m = m.toFixed(2)
					$(this).append("<td class='inter-td' style='width:200px; height:54px;line-height:54px;padding-left:5px;'>￥" + m + '(共' + time + '天)' + "</td>");
					intertotal += parseFloat(m);
				});
				intertotal = intertotal.toFixed(2)
				$("#inter-total").text("总额：" + intertotal);	
			});
			

		},
		create : function(){
			var inputhtml = '<div id="interestWrap">';
				inputhtml += '<div class="datePicker">';
				inputhtml += '<input name="begindate" id="endtime" type="text" onclick="WdatePicker({el:'+'endtime'+'})" value="" placeholder="请输入结束日期" readonly>'; 
				inputhtml += '</div>';		
				inputhtml += '<input id="btnok" type="button" value="确定"/>';		
				inputhtml += '<span>%</span>';				
				inputhtml += '<input id="rates" type="text" placeholder="请输入利率">';
				inputhtml += '<div id="inter-total">总额：</div>';
				inputhtml += '</div>';				
				$(this).append(inputhtml);
				$("#interestWrap").css({
					"width" : "300px",
					"height": "30px",
					"margin-top" : "10px"
				});
				$("#interestWrap>.datePicker").css({
					"float" : "left",
					"width" : "100px",
					"height": "32px",
				});
				$("#endtime").css({
					"width" : "100px",
					"height": "30px",
					"padding" : "0px 4px",
					"border" : "1px solid #ccc"
				});
				$("#rates").css({
					"float" : "right",
					"width" : "72px",
					"height": "30px",
					"padding" : "0px 4px",
					"border" : "1px solid #ccc"					
				});
				$("#interestWrap>span").css({
					"float" : "right",
					"height" : "32px",
					"line-height" : "32px"
				});
				$("#btnok").css({
					"float" : "right",
					"width" : "60px",
					"height": "30px",
					"border" : "none",
					"color" : "#fff",
					"margin-left" : "15px",
					"background-color" : "#54b4eb",
					"cursor" : "pointer"
				});
				$("#inter-total").css({
					"clear" : "both",
					"width" : "300px",
					"height": "30px",
					"line-height": "30px",
				});
		},
		datanum :function(sDate1,sDate2) {
			var  aDate,  oDate1,  oDate2,  iDays;  
			aDate  =  sDate1.split("-"); 
			oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0]);    //转换为12-18-2002格式  
			aDate  =  sDate2.split("-");  
			oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0]);  
			iDays  =  parseInt((oDate2  -  oDate1)  /  1000  /  60  /  60  /24);    //把相差的毫秒数转换为天数  
			return  iDays;  
		}
		
	});
	
})(jQuery)
