function Context(){
    var index = 0;
    var questions = $("#resource .item");
    var answerArea = $("#resource");
    this.serialize = function(){
        return [].slice.call(questions.map(function(index,dom){
            return $(dom).attr("qid") + "=" + getAnswer($(dom))
        })).join("&")
    }
    this.showAnswerAndResult = function(){
        var total = 0;
        questions.each(function(){
            var answer = getAnswer($(this));
            if(answer == ""){
                //Do nothing
                $(this).find(".answer").show();
            }else if(answer != $(this).find(".answer").attr("val")){
                $(this).find(".answer").show();
                //$("table.questions li").eq(parseInt($(this).attr("sort") - 1)).css("background", "#ff4b4b").css("color", "white")
            }else{
                total += parseInt($(this).attr("score"))
                //$("table.questions li").eq(parseInt($(this).attr("sort") - 1)).css("background", "#2196F3").css("color", "white")
            }
        })
        $(".paper-info th").eq(1).html("得分");
        $(".paper-info td").eq(1).html(total);
        localStartTime = 0;
        alert("您在本次测验中获得"+ total+"分");
    }

    //答题
    this.answerEvent = function(_this, initChecked){
        var type = $(_this).parents(".item").attr("type");
        var sort = $(_this).parents(".item").attr("sort");
        //var checked = typeof initChecked == "undefined" ? $(_this).parents(".item").find("input:checked").length > 0 : initChecked;
        //if(checked){
        //    $("table.questions li").eq(sort - 1).addClass("active");
        //}else{
        //    $("table.questions li").eq(sort - 1).removeClass("active");
        //}
        //$(".rate").html(Math.floor($("table.questions li.active").length * 100 / $("table.questions li").length) + "%");
        $(".rate").html(Math.floor($('#resource .item').filter(function(){return $(this).find('input:checked').length > 0}).length * 100 / $("#resource .item").length) + "%");
        //if(type == "0" || type == "2"){//如果单选题、是非题
        //    $(".prev_btn").show();
        //    if(index < questions.length - 1){
        //        answerArea.html(questions.eq(++index));
        //    }
        //    if(index == questions.length - 1){
        //        $(".next_btn").hide();
        //    }
        //}

    }

    this.init = function(totalTimeLeft,button){
        //if(questions.length > 0){
        //    answerArea.html(questions.eq(0));
        //}
        //if(questions.length > 1){
        //    $(".next_btn").show();
        //}
        checkLag();
        var currentTime = new Date().getTime();
        var currentTimeLeft = totalTimeLeft - (currentTime - localStartTime);
        if(currentTimeLeft > 0){
            countdown(totalTimeLeft,button);
            if(currentTimeLeft < notifyTime){
                alert("还有"+(Math.floor(currentTimeLeft/60000))+"分钟考试结束，请注意答题");
            }
        }else{
            alert("测验已经结束,请检查是否已交卷");
        }
    }

    this.initAnswers = function(){
        for(var i = 0;i < questions.length;i++){
            var initAnswer = questions.eq(i).attr("init-answer");
            if(initAnswer){
                var arr = initAnswer.split("");
                for(var e in arr){
                    questions.eq(i).find("input[value="+arr[e]+"]").trigger("click");
                }
            }
        }
    }
    var saved = false;
    this.JiaoJuan = function(url, self, showAnswer, redirect){
        if(saved)
            return;
        if(confirm("确定交卷？")){
            saved = true;
            $(self).css("background", "#ccc");
            questions.find("input").prop("readonly", true)
            var answer = context.serialize();
            jQuery.ajax({
                url:url,
                method:"post",
                data: answer,
                success:function(data, text, xhr){
                    if(xhr.status == 200){
                        if(showAnswer){
                            context.showAnswerAndResult();
                        }else{
                            alert("提交成功!");
                            if(url)
                                window.location.href = redirect;
                        }
                    }else{
                        saved = false;
                        alert(data);
                    }
                },
                error:function(data){
                    $(self).css("background", "#e91e1e");
                    saved = false;
                    if(data.status == 400){
                        alert(data.responseText)
                    }else{
                        alert("提交失败");
                    }
                }
            })
        }
    }
    ////上一题 不在支持
    //$(".prev_btn").click(function(){
    //    $(".next_btn").show();
    //    if(index > 0){
    //        answerArea.html(questions.eq(--index));
    //    }
    //    if(index == 0){
    //        $(".prev_btn").hide();
    //    }
    //});
    ////下一题 不在支持
    //$(".next_btn").click(function(){
    //    $(".prev_btn").show();
    //    if(index < questions.length - 1){
    //        answerArea.html(questions.eq(++index));
    //    }
    //    if(index == questions.length - 1){
    //        $(".next_btn").hide();
    //    }
    //});
    //初始化数字 不在支持
    //questions.each(function(i, e){
    //    var sort = i + 1;
    //    var type = $(e).attr("type");
    //    if($(".typeCount" + type).is(":hidden")){
    //        $(".typeCount" + type).show();
    //    }
    //    var li = $("<li>"+sort+"</li>").click(function(){
    //        var sort = parseInt($(this).html());
    //        index = sort - 1;
    //        answerArea.html(questions.eq(sort - 1));
    //        if(sort == 1){
    //            $(".prev_btn").hide();
    //        }
    //        if(sort > 1){
    //            $(".prev_btn").show();
    //        }
    //        if(sort == questions.length){
    //            $(".next_btn").hide();
    //        }
    //        if(sort < questions.length){
    //            $(".next_btn").show();
    //        }
    //    })
    //    $(".typeCount" + type).find("ul").append(li);
    //});

    var notifyTime = 15 * 60000;
    var notifyState = false;
    var localStartTime = new Date().getTime();

    //初始化闹钟点击
    $(".notifyGroup li").click(function(){
        if($(this).find("input:radio").prop("checked")){
            notifyTime = parseInt($(this).find("input:radio").val());
            notifyState = false;
        }
    })

    //倒计时
    function countdown(totalTimeLeft,button){
        var currentTime = new Date().getTime();
        var currentTimeLeft = totalTimeLeft - (currentTime - localStartTime);
        if(currentTimeLeft > 0){
            // $(".timer").html(format(Math.floor(currentTimeLeft / 1000)))
            if(!notifyState &&  currentTimeLeft < notifyTime){
                notifyState = true;
                alert("还有"+(Math.floor(currentTimeLeft/60000))+"分钟考试结束，请注意答题");
            }
            setTimeout(function(){
                countdown(totalTimeLeft,button);
            }, 1000)
        }else if(!saved){
            alert("考试时间已到，正在交卷！")
            $(button).click();
        }
    }

    //倒计时格式化
    function format(seconds) {
        if(seconds > 3600){
            return "大于1小时"
        }else {
            var sec = seconds % 60;
            seconds = (seconds - sec) / 60;
            var min = seconds % 60;
            seconds = (seconds - min) / 60;
            var hour = seconds;
            return ("0" + hour).substr(-2) + ':' + ("0" + min).substr(-2) + ':' + ("0" + sec).substr(-2);
        }

    }

    //延迟
    function checkLag(){
        setTimeout(function(){
            var start = new Date().getTime()
            $.ajax({
                url: "/study/lag",
                timeout: 3000,
                success: function(data, text, xhr){

                    if(xhr.status == 200){
                        var lag = new Date().getTime() - start;
                        if(lag < 200){
                            $("#lag").attr("title", "网络畅通:"+lag+"ms").attr("src", "/study/static/images/ic_network_cell_black_24dp.png")
                        }else if(lag < 500){
                            $("#lag").attr("title", "网络较慢:"+lag+"ms").attr("src", "/study/static/images/ic_network_cell_black_24dp_lag.png")
                        }else{
                            $("#lag").attr("title", "网络很慢:"+lag+"ms").attr("src", "/study/static/images/ic_network_cell_black_24dp_block.png")
                        }
                    }else{
                        $("#lag").attr("title", "网络未连接").attr("src", "/study/static/images/ic_network_cell_black_24dp_not.png")
                    }
                },
                error: function(){
                    $("#lag").attr("title", "网络未连接").attr("src", "/study/static/images/ic_network_cell_black_24dp_not.png")
                },
                complete: function(){
                    checkLag();
                }
            })
        }, 1000 * 60)
    }

    function getAnswer(jQ){
        return [].slice.call(jQ.find("input:checked").map(function(i,e){return $(e).val()})).join("");
    }
}