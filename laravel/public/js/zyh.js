(function($){
	$.fn.extend({
		search : function(options){ 
			var defaults = {
				user : [],
				par  : "",
				list : "",
				hide : "",
                url  : ""
			}
			var options = $.extend(defaults,options);
			var user = options.user;
			var par = "#" + options.par;
			var list = $("#" + options.list);
			var hide = options.hide;
			var val = $(this).val();
			var dataid="dataid";
		    var arrName = [];
		    var arrid = [];
		    for(var i=0;i<user.length; i++){
		        for(var j=0;j<user[i].length-1;j++){
		            if(user[i][j].indexOf(val)!=-1){
		                arrName.push(user[i][0]);
		                arrid.push(user[i][3])
		            }
		        }
		   }
		   arrName=arrName.delrepeat();
		   arrid=arrid.delrepeat();
		  /* if(arrName.length == 0 || $.trim($(this).val()).length == 0){
		   		list.hide().html("");
		   		return;
		   }*/
		   $(this).showName(list,arrName,arrid);
		   $(this).keyChoice({
		   		textid : $(this).attr("id"),
		   		listid : options.list,
		   		hideid : options.hide,
                url    : options.url
		   });

           $(this).blur(function(){
                if($.trim($(this).val()) == ""){
                    $("#" + options.hide).val("");
                }
           
           });
		   $(document).click(function(e){
		   		if ($(e.target).closest(par).length == 0) {
			   		list.hide().html("");
		   		}
		   }); 
		   
		},
		showName : function(parent,name,id){
	   	 	parent.html("");
			var html = "";
			$.each(name,function(i,val){
	            if(i>9)return;
				html += "<li data-id='"+id[i]+"'>"+name[i]+"</li>";
			});
    		   	parent.show().html(html);
		}
	
	});
	
	$.fn.extend({
		keyChoice : function(options){
			var defaults = {
				textid : "",		//搜索input栏id
				listid : "",		//搜索列表ul id
				hideid : "",		//hidden域id
                url    : "",        //url
			}
			var options = $.extend(defaults,options);
			
			var $hide = $("#" + options.hideid);
			var val = options.val;
			$(document).keydown(function(e){
				e = e || window.event;
				var keycode = e.which ? e.which : e.keyCode;
			    var $list =  $("#" + options.listid);
				var $listChild = $("#" + options.listid).children();
				if(keycode == 38){
				    e.preventDefault();
				    if($.trim($list.html()) == ""){
					    return;
					}
					$("#" + options.listid).movePrev();
			
				}else if(keycode == 40){
				    e.preventDefault();
				    if($.trim($list.html()) == ""){
					    return;
					}
					$("#" + options.listid).moveNext();
				}else if(keycode == 13){
                    if(options.url == '' || options.url == undefined){
				        $("#" + options.listid).children().getContent($hide); 
                    }else{
                        var id = "";
                        $list.children().each(function(){
                            if($(this).hasClass("active")){
                                id = $(this).attr("data-id");
                            }
                        });
                       // window.location = options.url + id;
                        window.open(options.url + id);
                    }

		        }
			});
			
			$("#" + options.listid).on("mouseenter","li",function(){
				$(this).getFocus($hide);
			});
			$("#" + options.listid).on("click","li",function(){
                if(options.url == '' || options.url == undefined){
                    $(this).getContent($hide);
                }else{
                    var id = $(this).attr("data-id");
                    window.open(options.url + id);
                }
			});
		},
		movePrev : function(){
			var prev = $(this).prev();
			prev.blur();
	        var index = $(this).children("li.active").prevAll().length;
	        var list = $(this).children("li");
	        if(index == 0){
	            list.removeClass("active").eq(list.length-1).addClass("active");
	        }else{
	            list.removeClass("active").eq(index-1).addClass("active");
	        }
	        list.each(function(){
	            if($(this).hasClass("active")){
	                prev.val($(this).text());
	            }
	        });
		},
		moveNext : function(){
			var prev = $(this).prev();
			prev.blur();
	        var list = $(this).children("li");
	        if(list.hasClass("active")){
	            var index = $(this).children("li.active").prevAll().length; 
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
	                prev.val($(this).text());
                }
            });
		},
		getFocus : function(hide){
			this.parent().children().removeClass("active");
	        this.addClass("active");
	        this.parent().prev().val(this.text());
	        hide.val($(this).attr("data-id"));
		},
		getContent : function(hide){
			this.each(function(){
		        if ($(this).hasClass("active")) {
					    $(this).parent().prev().val($(this).text());
        		        $(this).parent().hide().html("");
        		        hide.val($(this).attr("data-id"));
                }
            });
		},
	
	
	});
})(jQuery);
 
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






