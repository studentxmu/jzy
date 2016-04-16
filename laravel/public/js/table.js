/*柴油新增列表事件*/
var oilNum=0;
$("#oilBtn").click(function(){
    var $totalList=$(this).parent('.totalList');
    if(inputFlag($(this))){
        alert("请输入内容")
        return;
    }
    var $ul='<ul class="clear"><li><span>加油方式：</span><select class="sel" name=""><option>车队</option><option>柴油卡</option><option>现金</option></select></li><li><span>数量：</span><input type="text" class="oilNum" name="oilNum[]" id="oilNum"/></li><li><span>金额：</span><input type="text" class="oilMoney"  name="oilMoney[]" id="oilMoney'+oilNum+'"/></li><li><span>地址：</span><input type="text" class="oilAddress" name="oilAddress[]" id="oilAddress'+oilNum+'"/></li><li><span>日期：</span><input id="oilDate'+oilNum+'" name="oilDate[]" type="text" onclick="WdatePicker({el:\'oilDate'+oilNum+'\'})"/><span onclick="WdatePicker({el:\'oilDate'+oilNum+'\'})"  class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="oilDel del">删除</a></li></ul>';
    $totalList.append($ul);
    oilNum++;
});

/*柴油新增列表事件*/
var comNum=0;
$("#companyBtn").click(function(){
    var $totalList=$(this).parent('.totalList');
    if(inputFlag($(this))){
        alert("请输入内容")
        return;
    }
var $ul = '<ul class="clear"><li><span>里程：</span><input type="text" class="licheng comInput" name="licheng[]"></li><li><span>油耗：</span><input type="text" class="youhao comInput" name="youhao[]"></li><li><span>单价：</span><input type="text" class="danjia comInput" name="danjia[]"></li><li><span>金额：</span><input type="text" class="addMoney comMoney" name="comMoney[]"></li><li><span>日期：</span><input id="comDate'+comNum+'" name="comDate[]" type="text" onclick="WdatePicker({el:\'comDate'+comNum+'\'})"><span onclick="WdatePicker({el:\'comDate'+comNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="comDel del">删除</a></li></ul>';
    $totalList.append($ul);
    comNum++;
});

/*过桥收费站新增列表事件*/
var $tollTotal=$("#tollTotal");
    tollNum=0;
$("#tollBtn").click(function(){
    var $totalList=$(this).parent('.totalList');
    if(inputFlag($(this))){
        alert("请输入内容")
        return;
    }
    var $ul='<ul class="clear"><li><span>收费类型：</span><select name="tollType[]" class="tollType typeMargin"><option value="1">现金</option><option value="2">ETC</option></select></li><li><span>往返：</span><select name="tollGoCome[]" class="tollGoCome typeMargin"><option value="1">往</option><option value="2">返</option></select></li><li><span>名称：</span><input type="text" class="tollName" name="tollName[]" id="tollName'+tollNum+'"/></li><li><span>金额：</span><input type="text" class="tollMoney"  name="tollMoney[]" id="tollMoney'+tollNum+'"/></li><li><span>日期：</span><input id="tollDate'+tollNum+'" name="tollDate[]" type="text" onclick="WdatePicker({el:\'tollDate'+tollNum+'\'})"/><span onclick="WdatePicker({el:\'tollDate'+tollNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="tollDel del">删除</a></li></ul>'; 
    $totalList.append($ul);
    tollNum++;
	    var $length=$(this).parents('.totalList').children('ul').length;
    $tollTotal.val($length);
});


/*修车及金额合计新增列表事件*/
var repairNum=0;
$("#repairBtn").click(function(){
    var $totalList=$(this).parent('.totalList');
    if(inputFlag($(this))){
        alert("请输入内容")
        return;
    }
    var $ul='<ul class="clear"><li><span>配件名称：</span><input type="text" class="repairName" name="repairName[]" id="repairName'+repairNum+'"/></li><li><span>金额：</span><input type="text" class="repairMoney"  name="repairMoney[]" id="repairMoney'+repairNum+'"/></li><li><span>地址：</span><input type="text" class="repairAddress" name="repairAddress[]" id="repairAddress'+repairNum+'"/></li><li><span>日期：</span><input id="repairDate'+repairNum+'" type="text" name="repairDate[]" onclick="WdatePicker({el:\'repairDate'+repairNum+'\'})"/><span onclick="WdatePicker({el:\'repairDate'+repairNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="repairDel del">删除</a></li></ul>';
    $totalList.append($ul);
    repairNum++;
    var $length=$(this).parents('.totalList').children('ul').length;
    $("#repairTotal").val($length);
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
    var $ul='<ul class="clear"><li><span>罚款地点：</span><input type="text" class="fineAddress" name="fineAddress[]" id="fineAddress'+fineNum+'"/></li><li><span>金额：</span><input type="text" class="fineMoney"  name="fineMoney[]" id="fineMoney'+fineNum+'"/></li><li><span>日期：</span><input id="fineDate'+fineNum+'" name="fineDate[]" type="text" onclick="WdatePicker({el:\'fineDate'+fineNum+'\'})"/><span onclick="WdatePicker({el:\'fineDate'+fineNum+'\'})" class="dateImg"></span></li><li class="editDel"><a href="javascript:void(0);" class="fineDel del">删除</a></li></ul>';
    $totalList.append($ul);
    fineNum++;
    var $length=$(this).parents('.totalList').children('ul').length;
    $("#fineTotal").val($length);
});


/*其他开支及金额新增列表事件*/
var otherNum=0;
$("#otherBtn").click(function(){
    var $totalList=$(this).parent('.totalList');
    if(inputFlag($(this))){
        alert("请输入内容")
        return;
    }
    var $ul='<ul class="clear"><li><span>名称：</span><input type="text" class="otherName" name="otherName[]" id="otherName'+otherNum+'"/></li><li><span>金额：</span><input type="text" class="otherMoney"  name="otherMoney[]" id="otherMoney'+otherNum+'"/></li><li><span>日期：</span><input id="otherDate'+otherNum+'" class="otherDate" name="otherDate[]" type="text" onclick="WdatePicker({el:\'otherDate'+otherNum+'\'})"/><span onclick="WdatePicker({el:\'otherDate'+otherNum+'\'})" class="dateImg"></span></li></li><li class="editDel"><a href="javascript:void(0);" class="otherDel del">删除</a></li></ul>';
    $totalList.append($ul);
    otherNum++;
});

var $totalList = $(".totalList");
/*柴油合计数量及合计金额计算*/
var $oilTotalNum=$("#oilTotal");
    $oilTotalMoney=$("#oilMoney");
$totalList.on('keyup','input.oilNum',function(){
    addValue('oilNum',$oilTotalNum);
});
$totalList.on('keyup','input.oilMoney',function(){
    addValue('oilMoney',$oilTotalMoney);
});	

/*公司报销柴油数量及金额计算*/
$totalList.on('keyup','input.licheng',function(){
    addValue('licheng',$('#lichengTotal'));
});
$(".comList").on('keyup','input.comInput',function(){
    var par = $(this).parents("ul"),child = par.find(".comInput"),num = 0,money = par.find(".comMoney");
    var companyMoney = $("#companyMoney");
    num = child.eq(0).val()*child.eq(1).val()*child.eq(2).val();
    money.val(num);
    var comMoney = $(".comList").find(".comMoney");
    var comVal = 0;
    comMoney.each(function(i,v){
        comVal += parseFloat($(this).val());
    });
    companyMoney.val(comVal);
    var sumMoney = 0;
    $(".sumMoney").each(function(){
        if($(this).val() == ""){
            sumMoney += 0;
        }else{
            sumMoney += parseFloat($(this).val());
        }
    });
    $("#payTotal").val(sumMoney);
    if($("#freightTotal").val() == ""){
        return;
    }else{
        $("#sumTotal").val($("#freightTotal").val() - $("#payTotal").val());
    }
});	

/*收费站金额计算*/
$totalList.on('keyup','input.tollMoney',function(){
	var tollType = $(this).parents("ul").find(".tollType"); 
	if(tollType.find("option:selected").val() == 2){
		return;
	}else{
		var toll = $(this).parents(".totalList").find(".tollType"); 
		var num = 0;
		toll.each(function(){
			var money = $(this).parents("ul").find(".tollMoney"); 
			if($(this).find("option:selected").val() == 1){
				money.addClass("tollMoney1");
			}else{
				money.removeClass("tollMoney1");
			}
		});
		addValue('tollMoney1',$("#tollFee"));
	} 
});
$totalList.on("change",".tollType",function(){
	var tollMoney = $(this).parents("ul").find(".tollMoney"); 
	tollMoney.val("");
	addValue('tollMoney1',$("#tollFee"));
	
});

/*修车金额计算*/
$totalList.on('keyup','input.repairMoney',function(){
    addValue('repairMoney',$("#repairFee"));
});


/*罚款金额计算*/
$totalList.on('keyup','input.fineMoney',function(){
    addValue('fineMoney',$("#fineFee"));
});


/*其他开支金额计算*/
$totalList.on('keyup','input.otherMoney',function(){
    addValue('otherMoney',$("#otherFee"));
});

/*金额删除*/
$totalList.on("click",".del",function(){
    var sumMoney = $(this).parents(".totalBox").find(".sumMoney");
    var klass = $(this).parents(".totalBox").find(".addMoney").attr("class");
    var len = $(this).parents("ul").find(".oilNum").length;
    klass = klass.substring(9);
    if(confirm("是否删除")){
        $(this).parent().parent().remove();
        if(len>0){
            addValue("oilNum",$("#oilTotal"));
        }
        addValue(klass,sumMoney);
        var sumnum = $(this).parents(".totalBox");
        if(sumnum.length > 0){
            var $length=$(this).parents('.totalList').children('uli').length;
            sumnum.val($length);
        }
    }
});

/*过桥收费站金额删除*/
$totalList.on("click",".tollDel",function(){
    var sumMoney = $(this).parents(".totalBox").find(".sumMoney");
    if(confirm("是否删除")){
        $(this).parent().parent().remove();
        addValue("tollMoney1",sumMoney);
        var sumnum = $(this).parents(".totalBox");
        if(sumnum.length > 0){
            var $length=$(this).parents('.totalList').children('uli').length;
            sumnum.val($length);
        }
    }
});


/*开支总计计算*/
var begin = $("#beginweight");
var perprice = $("#perprice");
var freight = $("#freightTotal");
$(".sum").on("keyup","#beginweight,#perprice",function(){
    freight.val(begin.val()*perprice.val());
    $("#sumTotal").val($("#freightTotal").val() - $("#payTotal").val());
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
    var sumMoney = 0;
    $(".sumMoney").each(function(){
        if($(this).val() == ""){
            sumMoney += 0;
        }else{
            sumMoney += parseFloat($(this).val());
        }
    });
    $("#payTotal").val(sumMoney);
    if($("#freightTotal").val() == ""){
        return;
    }else{
        $("#sumTotal").val($("#freightTotal").val() - $("#payTotal").val());
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
