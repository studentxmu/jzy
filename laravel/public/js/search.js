$(function(){
	function showName(parent,searchArr){
		var arr=searchArr;
		//var $ul="<ul class='_thisList' style='position:absolute;left:150px;top:37px;z-index:9;width:165px;height:auto;background:#ffffff;border:1px solid #ccc;box-shadow: 0 1px 6px 0 rgba(0,0,0,.12),0 1px 6px 0 rgba(0,0,0,.12);'></ul>";
		var $ul = $("#seach-list");
		
    	$ul.html("");
		
		var $li="";
		$.each(arr,function(i,val){
            if(i>9)return;
			$li+="<li style='width:165px;height:28px!important;line-height:28px;text-indent:6px;margin:0;padding:0'>"+arr[i]+"</li>";
		});
	    $ul.append($li);
		$ul.children(":first").css({"border-top":"none"});
		
	}
    var $ul = $("#search-list");
    var userName=$(".user-name");
    userName.on("keyup focus",function(){
        searchName($(this),user);
    });
    function searchName(_this,json){
        var val=_this.val();
        var arr=[];
        var arrName=[];
        var arrid=[];
       for(var i=0;i<json.length; i++){
            for(var j=0;j<json[i].length-1;j++){
                if(json[i][j].indexOf(val)!=-1){
                    arr.push(json[i][0]);
                    arrid.push(json[i][3])
                }
            }
       }
       arr=arr.delrepeat();
       arrid=arrid.delrepeat();
       //showName(_this.parent(),arr);
       $ul.html("");
       var $li="";
       $.each(arr,function(i,val){
            if(i>9)return;
            $li+="<li data-id='"+arrid[i]+"'>"+arr[i]+"</li>";
        });
      console.log($ul.attr("id")); 
       $ul.show().html($li);
    }
    $("#search-list").on("click","li",function(){
        var index=$(this).index();
        var parent=$(this).parent();
        var input=parent.siblings(".user-name");
        var txt=$(this).text();
        input.val(txt);
        $("#search-list").siblings(".formError").remove();
        $(this).parent().siblings(".searchid").val($(this).attr("data-id"));
        $("#search-list").hide();
    });

    $(document).click(function(e){
        if(!$(e.target).closest(".user-wrap").length>0){
            $("._thisList").hide();
        }
    
    });
    var search = $("#driver");
    $(document).keydown(function(e){
            e = e || window.event;
            var keycode = e.which ? e.which : e.keyCode;
            var list = $("#search-list>li");
            if(keycode == 38){
                 e.preventDefault();
                if($.trim($("#search-list").html()) == ""){
                    return;
                }
                moveup();

            }else if(keycode == 40){
                e.preventDefault();
                if($.trim($("#search-list").html()) == ""){
                    return;
                }
                movedown();

            }else if(keycode == 13){
                $("#search-list>li").each(function(){
                    if ($(this).hasClass("active")) {
                        search.siblings(".searchid").val($(this).attr("data-id"));
                        $ul.hide().html("");
                    }
                });
            }

    });


    function moveup(){//向上方向键触发
        search.blur();

        var index = $("#search-list>li.active").prevAll().length;

        var list = $("#search-list>li");

        if(index == 0){
            list.removeClass("active").eq(list.length-1).addClass("active");
        }else{
            list.removeClass("active").eq(index-1).addClass("active");
        }

        list.each(function(){
            if($(this).hasClass("active")){
                search.val($(this).text());
            }
        });

    }

    function movedown(){                    //向下方向键触发
        search.blur();

        var list = $("#search-list>li");

        if(list.hasClass("active")){
            var index = $("#search-list>li.active").prevAll().length; 
            if(index == list.length-1){
                list.removeClass("active").eq(0).addClass("active");
            }else{
                list.removeClass("active").eq(index+1).addClass("active");
            }
        }else{
            list.removeClass("active").eq(0).addClass("active");
        }

        list.each(function(){
                if($(this).hasClass("active")){
                search.val($(this).text());
                }
                });

    }

    $("#search-list").on("mouseenter","a",function(){
            getFocus($(this));
            });

    function getFocus(obj){list//搜索结果选中状态
        $("#search-list>li").removeClass("active");
        obj.addClass("active");
        $("#driver").val(obj.text());
    }

});
Array.prototype.delrepeat=function(){
    var arr=[];
    var json={};
    for(var i=0;i<this.length;i++){
        if(!json[this[i]]){
            json[this[i]]=1;
            arr.push(this[i]);
         }
    }
    return arr;
}
var user=[];
function echoUser(a){
    user=a;
}
