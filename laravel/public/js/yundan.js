$(function(){
    var oilList = $("#oil-wrap").find("li.oilNum");
    $("#oil-wrap").on("keyup",".oilNum input",function(){
        var index = $(this).parent().index();
        var sib = $(this).parents(".oilNum").siblings(".oilNum");
        var sibVal = sib.children().eq(index).children("input").val()
        var jine = $(this).parents(".oilNum").siblings(".oil-m");
        if(sibVal == ""){
            return;
        }else{
           var v = $(this).val() * sibVal;
           var num = 0;
           if(parseInt(v) != v)v=v.toFixed(2);
           jine.children().eq(index).children("input").val(v);
           $("#oil-wrap").find(".oil-m").find("input").each(function(){
              if($(this).val() == ""){
                return;
              }else{
                num += Number($(this).val());
              }                       
           });
           $("#oilMoney").val(num);
        }
    });

    //柴油新增
    var oilOrder = 0;
    $("#oilBtn").click(function(){
        //var htm = "<div class='totalList'><ul class='clear'>" + $(this).siblings(".totalList").children("ul").html() + "</ul></div>";
        oilOrder++;
        var htm = "<div class='totalList'>";
        htm += "<ul class='clear'>";
        htm += '<li class="oilNum"><p>数量</p><div class="t-wrap t-money"><input type="text" class="shu" data-attr="che"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="che"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="oil"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="oil"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="oil"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="oil"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="cash"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="cash"><span>升</span></div><div class="t-wrap t-money"><input type="text" class="shu" data-attr="cash"><span>升</span></div></li>';  
        htm += '<li class="oilNum"><p>单价</p><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><div class="t-wrap t-money"><input type="text" class="danjia"><span>元</span></div><li>';
        htm += '<li class="oil-m"><p>金额</p><div class="t-wrap t-money"><input type="text" class="jine" readonly><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div><div class="t-wrap t-money"><input type="text" class="jine" readonly=""><span>元</span></div></li>';
        htm += '<li class="on"><p>地址</p><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div><div class="t-wrap"><input type="text"></div></li>';
        htm += '<li class="on"><p>日期</p><div class="t-wrap"><input type="text" id="oilDate1' + oilOrder + '" onclick="WdatePicker({el:\'oilDate1' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate2' + oilOrder + '" onclick="WdatePicker({el:\'oilDate2' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate3' + oilOrder + '" onclick="WdatePicker({el:\'oilDate3' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate4' + oilOrder + '" onclick="WdatePicker({el:\'oilDate4' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate5' + oilOrder + '" onclick="WdatePicker({el:\'oilDate5' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate6' + oilOrder + '" onclick="WdatePicker({el:\'oilDate6' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate7' + oilOrder + '" onclick="WdatePicker({el:\'oilDate7' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate8' + oilOrder + '" onclick="WdatePicker({el:\'oilDate8' + oilOrder + '\'})" readonly=""></div><div class="t-wrap"><input type="text" id="oilDate9' + oilOrder + '" onclick="WdatePicker({el:\'oilDate9' + oilOrder + '\'})" readonly=""></div></li>';
        htm += "</ul>";
        htm += "</div>";
        $("#oil-wrap").append(htm);
        $("#oil-wrap").addVal({
           total : "total-l",
           child : "shu",
        }); 
        $("#oil-wrap").addVal({
            total : "sumMoney",
            child : "jine"
        });
    
    });

    $("#oil-wrap").on("keyup",".danjia",function(){
        var val = $.trim($(this).val());
        if(isNaN(val)){
            $(this).addClass("active");
        }else{
            $(this).removeClass("active");
        }
    
    });
    $("#oil-wrap").addVal({
       total : "total-l",
       child : "shu",
    }); 
    $("#company-wrap").addVal({
       total : "total-l",
       child : "shu",
    }); 
    $("#company-wrap").addVal({
       total : "chaiyou",
       child : "sheng",
    }); 
    $("#cash-wrap").addVal({
        total : "sumMoney",
        child : "jine"
    });
    $("#cash-wrap").addLen({
        total : "sumnum",
        child : "jine"
    });
    $("#etc-wrap").addVal({
        total : "sumMoney",
        child : "jine"
    });
    $("#etc-wrap").addLen({
        total : "sumnum",
        child : "jine"
    });
    $("#repair-wrap").addVal({
        total : "sumMoney",
        child : "jine"
    });
    $("#repair-wrap").addLen({
        total : "sumnum",
        child : "jine"
    });
    $("#fine-wrap").addVal({
        total : "sumMoney",
        child : "jine"
    });
    $("#fine-wrap").addLen({
        total : "sumnum",
        child : "jine"
    });
    $("#other-wrap").addVal({
        total : "sumMoney",
        child : "jine"
    });
    $("#beginweight,#perprice").keyup(function(){
        kaizhi();
    });

    var tInp = $(".t-wrap").children("input");
    tInp.click(function(){
       if($.trim($(this).val()) != "" && $(this).hasClass("active"))$(this).removeClass("active");
    });

    $("#sub-btn").on("click",function(e){
                    //e.preventDefault();
        var inp = $(".t-wrap").not(".no-wrap").children("input"); 
        var flag = false;
        inp.each(function(){
            var index = 0;
            if($.trim($(this).val()) != ""){
                index = $(this).parent().index();    
                var par = $(this).parents("ul").children();
               par.each(function(){
                    var input = $(this).children().eq(index).not(".no-wrap").children("input");
                    input.each(function(){
                        if($.trim($(this).val()) == ""){
                            $(this).addClass("active");
                            flag =true;
                            return;
                        }
                    });
               }); 
            }
        });
        $("#oil-wrap").find(".jine").removeClass("active");
        if($(".t-wrap").children("input").hasClass("active")){
            var top = $(".t-wrap").children("input.active").eq(0).parents(".totalBox").offset().top; 
            $("html,body").animate({
                scrollTop : top + "px"
            },500);
        }
        if(flag){e.preventDefault();return;}                            
        
        //柴油添加name
        var oilInp = $("#oil-wrap").find(".shu");
        oilInp.each(function(){
            var self = $(this);
            var attr = {"che" : "1", "oil" : "2", "cash" : "3"}
            var type = {"0" : "oilNum[]", "1" : "oilPer[]", "2" : "oilMoney[]", "3" : "oilAddress[]", "4" : "oilDate[]"}
            if($.trim(self.val()) != ""){
                if(self.attr("name") != undefined)return;
                var index = self.parent().index();
                var parSib = self.parents("ul").children();
                var htm = "<input type='hidden' name='oilType[]' value=" + attr[self.attr("data-attr")] + ">"; 
                parSib.each(function(){
                    var parIndex = $(this).index();
                    $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",type[parIndex]);
                });
                self.parent().append(htm);
            }
        });
        
        //公司报销柴油添加name
        var baoInp = $("#company-wrap").find(".shu");
        baoInp.each(function(){
            var self = $(this);
            var type = {"0" : "licheng[]", "1" : "youhao[]", "2" : "danjia[]"}
            if($.trim(self.val()) != ""){
                if(self.attr("name") != undefined)return;
                var index = self.parent().index();
                var parSib = self.parents("ul").children();
                parSib.each(function(){
                    var parIndex = $(this).index();
                    $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",type[parIndex]);
                });
            }
        });
        
        //现金过桥收费站添加name
        var cashInp = $("#cash-wrap>.totalList").find(".jine");
        cashInp.each(function(){
            var self = $(this);
            var type = {"0" : "tollName[]", "1" : "tollMoney[]"};
            var typeVal = '<input type="hidden" name="tollType[]" value="1">';
            var arr = ['<input type="hidden" name="tollGoCome[]" value="1">','<input type="hidden" name="tollGoCome[]" value="2">'];
            if($.trim(self.val()) != ""){
                if(self.attr("name") != undefined)return;
                var index = self.parent().index();
                var parSib = self.parents("ul").children();
                parSib.each(function(){
                    var parIndex = $(this).index();
                    $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",type[parIndex]);
                });
                self.parent().append(arr[self.parents(".totalList").attr("data-order")]);
                self.parent().append(typeVal);
            }
        });

        //ETC过桥收费站添加name
        var etcInp = $("#etc-wrap>.totalList").find(".jine");
        etcInp.each(function(){
            var self = $(this);
            var type = {"0" : "tollName[]", "1" : "tollMoney[]"};
            var typeVal = '<input type="hidden" name="tollType[]" value="2">';
            var arr = ['<input type="hidden" name="tollGoCome[]" value="1">','<input type="hidden" name="tollGoCome[]" value="2">'];
            if($.trim(self.val()) != ""){
                if(self.attr("name") != undefined)return;
                var index = self.parent().index();
                var parSib = self.parents("ul").children();
                parSib.each(function(){
                    var parIndex = $(this).index();
                    $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",type[parIndex]);
                });
                self.parent().append(arr[self.parents(".totalList").attr("data-order")]);
                self.parent().append(typeVal);
            }
        });


        $("#repair-wrap").addName({
            inp  : "jine",
            arr : ["repairMoney[]","repairAddress[]"]
        });
        $("#fine-wrap").addName({
            inp  : "jine",
            arr : ["fineAddress[]","fineMoney[]"]
        });
        $("#other-wrap").addName({
            inp  : "jine",
            arr : ["otherName[]","otherMoney[]"]
        });

/*
        var self = $(this);
        self.addClass("active").attr("disabled",true);
        setTimeout(function(){
            self.removeClass("active").attr("disabled",false);
        },20000);
 */       
    });
   


    $("#companyMoney").on("keyup",function(){
           $("#payTotal").spend({
                par : "content",
                spe : "spend"
           });
           kaizhi();
    
    });

   $(".t-wrap>input").keyup(function(){
       if($.trim($(this).val()) != "" && $(this).hasClass("active"))$(this).removeClass("active");
   });
    $("#oil-wrap").find("input[id^='oilDate']").click(function(){
        $(this).removeClass("active");
    });

});

//开支总计
function kaizhi(){
    var val = 0;
    var begin = $("#beginweight");
    var per = $("#perprice");
    if($.trim(begin.val()) == "" || $.trim(per.val()) == ""){
            return;
    }else{
        val = begin.val() * per.val();
        if(parseInt(val) != val)val = val.toFixed(2);
        $("#freightTotal").val(val);
        var sumVal = val - $("#payTotal").val();
       // sumVal = sumVal == parseInt(sumVal) ? sumVal : sumVal.toFixed(2);
        sumVal = parseInt(sumVal);
        $("#sumTotal").val(sumVal);
    
    }
}


(function($){
    $.fn.extend({
        addVal : function(options){
            var defaults = {
                total : "",
                child : "",  
            }
            var options = $.fn.extend(defaults,options);
            var par = $(this), total = par.find("."+options.total), child = par.find("."+options.child);
            par.on("keyup","."+options.child,function(){
                var num = 0;
                child.each(function(){
                    var self = $(this);
                    var val = $.trim(self.val());
                    if(isNaN(val)){
                        self.addClass("active");
                        return;
                    }else{
                        self.removeClass("active");
                        num += Number(val);
                    }
                });
                //if(parseInt(num) != num)num=num.toFixed(2);
                num=num.toFixed(2)
                total.val(num); 
               $("#payTotal").spend({
                    par : "content",
                    spe : "spend"
               });
               kaizhi();
            });
        },
        addLen : function(options){
            var defaults = {
                total : "",
                child : "",  
            }
            var options = $.fn.extend(defaults,options);
            var par = $(this), total = par.find("."+options.total), child = par.find("."+options.child);
            par.on("keyup","."+options.child,function(){
                var num = 0;
                child.each(function(){
                    var self = $(this);
                    var val = $.trim(self.val());
                    if(isNaN(val)){
                        self.addClass("active");
                        return;
                    }else{
                        self.removeClass("active");
                        if(val != ""){
                            num += 1;
                        }
                    }
                });
                total.val(num); 
            });
        },
        spend : function(options){
            var defaults = {
                par : "",
                spe : "",
            }
            var options = $.fn.extend(defaults,options);
            var par = $("." + options.par), spe = par.find("." + options.spe);
            var total = 0;
            spe.each(function(){
               total += Number($(this).val());
            });
            if(parseInt(total) != total)total = total.toFixed(2);
            $(this).val(total);
        },
        addFineName : function(options){
            var defaults = {
                inp  : "",
                type : {},
                arr  : [],
            }
            var options = $.fn.extend(defaults,options);
            var inp = $(this).find(".totalList").find(options.inp);
            inp.each(function(){
                var self = $(this);
                var type = {"che" : "1", "oil" : "2", "cash" : "3"}
                var arr = ["oilNum[]", "oilPer[]"];
                if($.trim(self.val()) != ""){
                    if(self.attr("name") != undefined && self.attr("name") != "")return;
                    var index = self.parent().index();
                    var parSib = self.parents("ul").children();
                    var htm = "<input type='hidden' name='oilType[]' value=" + attr[self.attr("data-attr")] + ">"; 
                    parSib.each(function(){
                        var parIndex = $(this).index();
                        $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",type[parIndex]);
                    });
                    self.parent().append(htm);
                }
            });
            
        },
        addName : function(options){
            var defaults = {
                arr : [],
            }
            var options = $.fn.extend(defaults,options);
            var inp = $(this).find(".totalList").find(".jine");
            var arr = options.arr;
            inp.each(function(){
                var self = $(this);
                if($.trim(self.val()) != ""){
                    if(self.attr("name") != undefined && self.attr("name") != "")return;
                    var index = self.parent().index();
                    var parSib = self.parents("ul").children();
                    parSib.each(function(){
                        var parIndex = $(this).index();
                        $(this).find(".t-wrap").eq(index-1).children("input[type='text']").attr("name",arr[parIndex]);
                    });

                }
            });
            
        },
        


    
    });


})(jQuery);




