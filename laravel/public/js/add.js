$(function(){
    $("input[type='text']").attr("disabled",true);
    var results = JSON.parse('<?php echo json_encode($results) ?>');
    if(results.chaiyou != "" && results != undefined){
        var chaiyou = results['chaiyou'];
        var list = $("#oil-wrap").find("ul").children();
        if(chaiyou['1'].length>0){
            $.each(chaiyou['1'],function(index,val){
                var self = chaiyou['1'];
                var chaiIndex = index;
                list.each(function(){
                    var index = $(this).index();
                    var tWrap = $(this).find(".t-wrap");
                    tWrap.eq(chaiIndex).find("input[type='text']").val(self[chaiIndex][index])         
                });
            }) 
        }else if(chaiyou[2].length>0){
            $.each(chaiyou['2'],function(index,val){
                var self = chaiyou['2'];
                var chaiIndex = index;
                list.each(function(){
                    var index = $(this).index();
                    var tWrap = $(this).find(".t-wrap");
                    tWrap.eq(chaiIndex).find("input[type='text']").val(self[chaiIndex][index])         
                });
            }) 
        
        }
    }

})
