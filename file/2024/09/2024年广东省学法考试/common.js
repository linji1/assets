function query(){
    var keyword = $("#queryForm input[name=keyword]").val();
    if(keyword == "")
        return false;
    window.location.href = "/study/chapters/text?page=1&keyword="+encodeURI(encodeURI(keyword));
}
function setCookie(name, value, expiredays){
    var exdate=new Date()
    exdate.setDate(exdate.getDate() + expiredays)
    document.cookie = name+ "=" + value + ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
function getCookie(name){
    if(document.cookie){
        var cookies = document.cookie.split(";");
        for(var k in cookies){
            if(cookies[k].indexOf(name + "=") > -1){
                return cookies[k].substring(cookies[k].indexOf("=") + 1);
            }
        }
    }
    return null;
}

function collect(_this, courseId, action){
    jQuery.post("/study/courseCollect/" + courseId + "?action=true");
    jQuery(_this).parent().html("已收藏");
}

function loginSkip(){
    setTimeout(function(){
        jQuery.ajax({
            url: "/study/lag",
            complete: function(){
                loginSkip();
            }
        })
    }, 1000 * 60*3)
}