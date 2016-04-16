$(function(){
    $(".mingzi").on("keyup keydown change blur",function (){
            var pinyin=$(this).toPinyin();
            $(".pinyin").val(pinyin.delspace());
            $(".shouzimu").val(pinyin.firstword());
     });
});
String.prototype.delspace=function(){
    return this.replace(/\s/g,"");
}
String.prototype.firstword=function(){
    var arr=this.split(" ");
    var str="";
    for (var i=0;i<arr.length;i++) {
        str+=arr[i].charAt(0)
    }
    return str;
}
