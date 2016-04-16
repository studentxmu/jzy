$(function(){
	var $list=$("#list");
		$listInput=$list.find('input').not('#number');
		$btn=$('.breadcrumb');
		$totalList=$(".totalList");
		$oilBtn=$("#oilBtn");
	/* 提示必填项 */
    /*$listInput.each(function(){
		$(this).blur(function(){
			if($(this).val()==''){
				$(this).css('border-color','red');
			}else{
				$(this).css('border-color','#cccccc');
			}
		});
	});*/
	
	/*柴油新增列表事件*/
	var oilNum=0;
	$oilBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>加油方式：</span><select class="sel" name=""><option>车队</option><option>柴油卡</option><option>现金</option></select></li><li><span>数量：</span><input type="text" class="oilNum" name="oilNum" id="oilNum'+oilNum+'"/></li><li><span>金额：</span><input type="text" class="oilMoney"  name="oilMoney" id="oilMoney'+oilNum+'"/></li><li><span>地址：</span><input type="text" class="oilAddress" name="oilAddress" id="oilAddress'+oilNum+'"/></li><li><span>日期：</span><input id="oilDate'+oilNum+'" type="text" onclick="WdatePicker({el:\'oilDate'+oilNum+'\'})"/><span onclick="WdatePicker({el:\'oilDate'+oilNum+'\'})"  class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="oilDel del">删除</a></li></ul>';
		$totalList.append($ul);
		oilNum++;
	});
	
	/*过桥收费站新增列表事件*/
	var $tollBtn=$("#tollBtn");
		$tollTotal=$("#tollTotal");
		tollNum=0;
	$tollBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>收费类型：</span><select name="tollType" class="tollType typeMargin"><option>现金</option><option>ETC</option></select></li><li><span>往返：</span><select name="tollGoCome" class="tollGoCome typeMargin"><option>往</option><option>返</option></select></li><li><span>名称：</span><input type="text" class="tollName" name="tollName" id="tollName'+tollNum+'"/></li><li><span>金额：</span><input type="text" class="tollMoney"  name="tollMoney" id="tollMoney'+tollNum+'"/></li><li><span>日期：</span><input id="tollDate'+tollNum+'" type="text" onclick="WdatePicker({el:\'tollDate'+tollNum+'\'})"/><span onclick="WdatePicker({el:\'tollDate'+tollNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="tollDel del">删除</a></li></ul>'; 
		$totalList.append($ul);
		tollNum++;
        
		var $length=$(this).parents('.totalList').children('ul').length;
        $tollTotal.val($length);
	});
	
	/*修车及金额合计新增列表事件*/
	var $repairBtn=$("#repairBtn");
		repairNum=0;
	$repairBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>配件名称：</span><input type="text" class="repairName" name="repairName" id="repairName'+repairNum+'"/></li><li><span>金额：</span><input type="text" class="repairMoney"  name="repairMoney" id="repairMoney'+repairNum+'"/></li><li><span>地址：</span><input type="text" class="repairAddress" name="repairAddress" id="repairAddress'+repairNum+'"/></li><li><span>日期：</span><input id="repairDate'+repairNum+'" type="text" onclick="WdatePicker({el:\'repairDate'+repairNum+'\'})"/><span onclick="WdatePicker({el:\'repairDate'+repairNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="repairDel del">删除</a></li></ul>';
		$totalList.append($ul);
		repairNum++;
	});
	
	
	/*罚款及金额合计新增列表事件*/
	var $fineBtn=$("#fineBtn");
		fineNum=0;
	$fineBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>罚款地点：</span><input type="text" class="fineAddress" name="fineAddress" id="fineAddress'+fineNum+'"/></li><li><span>金额：</span><input type="text" class="fineMoney"  name="fineMoney" id="fineMoney'+fineNum+'"/></li><li><span>日期：</span><input id="fineDate'+fineNum+'" type="text" onclick="WdatePicker({el:\'fineDate'+fineNum+'\'})"/><span onclick="WdatePicker({el:\'fineDate'+fineNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="fineDel del">删除</a></li></ul>';
		$totalList.append($ul);
		fineNum++;
	});
	/*伙食费及合计金额新增列表事件*/
	var $eatBtn=$("#eatBtn");
		eatNum=0;
	$eatBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>日期：</span><input id="eatDate'+eatNum+'" class="eatDate" type="text" onclick="WdatePicker({el:\'eatDate'+eatNum+'\'})"/><span onclick="WdatePicker({el:\'eatDate'+eatNum+'\'})" class="dateImg"></span></li><li><span>金额：</span><input type="text" class="eatMoney"  name="eatMoney" id="eatMoney'+eatNum+'"/></li><li class="editDel"><a href="javascript:void(0);" class="eatDel del">删除</a></li></ul>';
		$totalList.append($ul);
		eatNum++;
	});
	/*其他开支及金额新增列表事件*/
	var $otherBtn=$("#otherBtn");
		otherNum=0;
	$otherBtn.click(function(){
		var $totalList=$(this).parent('.totalList');
		if(inputFlag($(this))){
			alert("请输入内容")
			return;
		}
		var $ul='<ul class="clear"><li><span>名称：</span><input type="text" class="otherName" name="otherName" id="otherName'+otherNum+'"/></li><li><span>金额：</span><input type="text" class="otherMoney"  name="otherMoney" id="otherMoney'+otherNum+'"/></li><li><span>日期：</span><input id="otherDate'+otherNum+'" class="otherDate" type="text" onclick="WdatePicker({el:\'otherDate'+otherNum+'\'})"/><span onclick="WdatePicker({el:\'otherDate'+otherNum+'\'})" class="dateImg"></span></li></li><li class="editDel"><a href="javascript:void(0);" class="otherDel del">删除</a></li></ul>';
		$totalList.append($ul);
		otherNum++;
	});
	
	/*柴油合计数量及合计金额计算*/
	var $oilTotalNum=$("#oilTotal");
		$oilTotalMoney=$("#oilMoney");
	$totalList.on('keyup','input.oilNum',function(){
		addValue('oilNum',$oilTotalNum);
	});
	$totalList.on('keyup','input.oilMoney',function(){
		addValue('oilMoney',$oilTotalMoney);
	});	
	/*柴油删除列表及金额计算*/
	$totalList.on('click','a.oilDel',function(){
        if(confirm("确定删除吗？")){
		    $(this).parent().parent().remove();
        }
		addValue('oilNum',$oilTotalNum);
		addValue('oilMoney',$oilTotalMoney);
	});
	/*收费站金额计算*/
	var $tollMoney=$("#tollFee");
	$totalList.on('keyup','input.tollMoney',function(){
		addValue('tollMoney',$tollMoney);
	});
	/*收费站删除列表及金额计算*/
	$totalList.on('click','a.tollDel',function(){
	    delMoney($(this),'toll',$tollMoney);
        $('#tollTotal').val();
    });

	/*数据计算*/
	function addValue(obj,total){
		var $obj=$("."+obj);
			$total=0;
		$obj.each(function(i,val){
			var $val=parseFloat(val.value);
				$curVal=$(this).val();
			if(isNaN($curVal)){
				$(this).css({
					'border':'1px solid red',
					'width':'68px'	
				});
			}else{
				$(this).css({
					'border':'none',
					'border-bottom':'1px solid #cccccc',
					'width':'70px'	
				});
			};
			if(!isNaN($val)){
				$total+=$val;
			};
		});
		total.val($total);
	}

	/*收费站 && 修车 && 罚款次数计算*/
	/*$(".idToll").on('blur','input',function(){
        length($(this));
	});*/
    /*删除列表*/
    function delMoney(_this,str,money){
        var lengthTotal=_this.parents('.totalBox').find("input[id$='Total']");
        var length=lengthTotal.val();
        console.log(lengthTotal.attr('id'));
        if(confirm("确定删除吗？")){
		    _this.parent().parent().remove();
            lengthtotal.val(length-1);
        }
		addValue(str+'Money',money);
    }
    /*长度计算*/
	function length(_this){
		var $length=_this.parents('.totalList').children('ul').length;
        var lengthTotal=_this.parents('.totalBox').find("input[id$='Total']");
		if (!inputFlag(_this)) {
		    lengthTotal.val($length);
		}else{
			if($length==1){
				lengthTotal.val('');
			}else{
				lengthTotal.val($length-1);
			}
			
		}
    }
    /*判断列表最后一行是否有value值为空的input*/
    function inputFlag(_this) {
		if(!_this)return;
		var $tollInput=_this.parents('.totalList').children("ul:last").find('input');
		var num=0;
		$tollInput.each(function(i,val) {
			var $val=val.value;
			if ($val=='') {
				num++;
			}
		})
		return num;
	}
});
