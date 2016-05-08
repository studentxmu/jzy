$(function(){
	var $leftMenu=$(".leftMenu");
		$list=$leftMenu.children('.leftList');
		$link=$list.find('a.leftLink');
		$secondMenu=$list.find('ul').find('a');    
	$link.mouseover(function(){
		if($(this).hasClass('setOn'))return;
		$(this).addClass('over').stop().animate({
			marginLeft:'8px',
		},300);
	}).mouseout(function(){
		if($(this).hasClass('setOn'))return;
		$(this).removeClass('over').stop().animate({
			marginLeft:'0',
		},300);
	}).click(function(){
		$(this).removeClass('over')
			   .addClass('setOn');
		var $ul=$(this).siblings('ul');
			$siblings=$(this).parent().siblings('li');
			$linkSiblings=$siblings.children('a.leftLink');
			$ulSiblings=$siblings.children('ul');
		$ul.slideDown(200);
		$linkSiblings.removeClass('setOn')
					 .animate({'margin-left':'0'},100);
		$ulSiblings.slideUp(200);
	});
	$link.each(function(){
        if($(this).next().children().length == 0){
            $(this).parent().hide();
        }
        if($(this).hasClass("setOn")){
           $(this).trigger("click");
        }
    })
	$secondMenu.mouseover(function(){
		if($(this).hasClass('setOn'))return;
		$(this).addClass('over').stop().animate({
			marginLeft:'8px',
		},300);
	}).mouseout(function(){
		if($(this).hasClass('setOn'))return;
		$(this).removeClass('over').stop().animate({
			marginLeft:'0',
		},300);
		
	});
	
	
	var $caret=$(".btn-caret");
		$btnMenu=$(".btn-menu");
		$btnGroup=$(".btn-group");
		$headBtn=$(".btn");
	$btnGroup.focus(function(){alert(1)
		$caret.css({
			'border-color':'#999999 #e6e6e6 #e6e6e6 #e6e6e6'
		});
		$headBtn.css({
			'box-shadow':'inset 0 3px 5px rgba(0,0,0,0.125)',
			'background-color':'#e6e6e6'
		});
		$btnMenu.show();
	})
	
//	$btnGroup.blur(function(){
////		if($(e.target)==$btnGroup)alert(2);
//		$caret.css({
//			'border-color':'#999999 #ffffff #ffffff #ffffff'
//		});
//		$headBtn.css({
//			'box-shadow':'none',
//			'background-color':'#ffffff'
//		});
////		if($(e.target)==$btnMenu)return;
//		$btnMenu.hide();
//		
//	})

    $(".tab").on("click",".btn-del",function(){
        var td_par=$(this).parent().parent();
        var flag=confirm("确定删除吗？");
        if(!flag){
            return false;
        }
    });
    $(".tab").on("click",".btn-audit",function(){
        var td_par=$(this).parent().parent();
        var flag=confirm("该车辆确定已审核？");
        if(!flag){
            return false;
        }
    });
    /*表单验证开始*/
    $(".validate").validationEngine("attach",{
        promptPosition:"topRight",
        showArrow:false
    });

    /*表单验证结束*/


    //阻止回车表单提交
    $(document).keydown(function(e){
        e = e || window.event;
        var keycode = e.which ? e.which : e.keyCode;
        if(keycode == 13){
            e.preventDefault();
        }
    });


    //登出登录
    $(".header").find(".btn-group").on("mouseenter",function(){
        $(this).children(".btn-menu").show();
    });
    $(".header").find(".btn-group").on("mouseleave",function(){
        $(this).children(".btn-menu").hide();
    });
});
