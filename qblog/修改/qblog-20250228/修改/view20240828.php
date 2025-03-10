<?php if(!defined('WMBLOG'))exit; ?>
<?php include "head.php";?>
  <div id="content" style="position: relative;">
  <div class="breadcrumb" style="margin-top: -5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" style="
    width: 10px;
    width: 14px;
    height: 14px;
    vertical-align: -2px;
"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><a href="/" style="padding-left: 5px;color: #7d8c8e;">首页</a>
<span>/</span><a href="/list-<?php  echo $v['tid']?>.html" style="color: #7d8c8e;"><?php  echo $class[$v['tid']]?></a>
<span>/</span>正文
</div>
<?php
function mbStrSplit ($string, $len = 1) { //对内容进行分割
$start = 0;
$strlen = mb_strlen($string);
while ($strlen) {
$array[] = mb_substr($string,$start,$len,"utf8");
$string = mb_substr($string, $len, $strlen,"utf8");
$strlen = mb_strlen($string);
}
return $array;
}

function match_chinese($chars,$encoding = 'utf8') //过滤特殊字符串
{
$pattern = ($encoding == 'utf8')?'/[\x{4e00}-\x{9fa5}a-zA-Z0-9,，。 ]/u':'/[\x80-\xFF]/';
preg_match_all($pattern,$chars,$result);
$temp = join('',$result[0]);
return $temp;
}
$str=$v['title'].'。'.$v['content'];
$str = strip_tags($str);
$str = str_replace("、","，",$str); //保留顿号
$str = match_chinese($str);
$zishu = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($str))),'UTF-8');
$r = mbStrSplit($str, 9999999);
$qian = "https://fanyi.sogou.com/reventondc/synthesis?speed=1.1&lang=zh-CHS&from=translateweb&speaker=4&text=";
?>
<?php if ($zishu <= 99999999): ?>
<center>

<textarea id="texts" rows="15" class="_play" style="display: none;"><?php echo $r[0]; ?></textarea>
<select id="voiceSelect" onchange="play()" style="display: none;">
<option data-lang="zh-CN" data-name="Microsoft Yunxi Online (Natural) - Chinese (Mainland)">Microsoft Yunxi Online (Natural) - Chinese (Mainland) (zh-CN)</option>
<option data-lang="zh-CN" data-name="Microsoft Yunjian Online (Natural) - Chinese (Mainland)">Microsoft Yunjian Online (Natural) - Chinese (Mainland) (zh-CN)</option>
<option data-lang="zh-CN" data-name="Microsoft Yunyang Online (Natural) - Chinese (Mainland)">Microsoft Yunyang Online (Natural) - Chinese (Mainland) (zh-CN)</option>
</select>

<span class="cancel1" id="speak" onclick="cancel()" style="border: 0px;cursor: pointer;float: right;padding-right: 20px;color: #7d8c8e;font-size: 12px;/* clear: both; */margin-top: -5px;" alt="使用 Microsoft Edge 浏览器收听效果最好" title="使用 Microsoft Edge 浏览器收听效果最好"><svg class="icon" style="width: 1em;height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3843"><path d="M162.706286 766.573714c0 59.574857 36.022857 94.72 96.438857 94.72h505.709714c60.434286 0 96.438857-35.145143 96.438857-94.72V257.426286c0-59.574857-36.022857-94.72-96.438857-94.72H259.145143c-60.434286 0-96.438857 35.145143-96.438857 94.72z m69.010285-16.274285V273.700571c0-26.148571 15.433143-42.002286 41.142858-42.002285h478.281142c25.709714 0 41.142857 15.853714 41.142858 42.002285V750.262857c0 26.148571-15.433143 42.002286-41.142858 42.002286H272.859429c-25.709714 0-41.142857-15.853714-41.142858-42.002286z" p-id="3844"></path></svg> 停止</span>
<span class="resume1" id="speak" onclick="resume()" style="border: 0px;cursor: pointer;float: right;padding-right: 20px;color: #7d8c8e;font-size: 12px;/* clear: both; */margin-top: -5px;" alt="使用 Microsoft Edge 浏览器收听效果最好" title="使用 Microsoft Edge 浏览器收听效果最好"><svg class="icon" style="width: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="566"><path d="M384 752.288l299.68-231.552L384 289.152V752.32z m-64 65.152V224a32 32 0 0 1 51.552-25.312l384 296.704a32 32 0 0 1 0 50.656l-384 296.736A32 32 0 0 1 320 817.44z" fill="#979797" p-id="567"></path></svg> 继续</span>
<style type="text/css">
@media screen and (max-width: 950px) {
  .cancel1 {
    display: none;
  }
  .resume1 {
    display: none;
  }
}
  </style>

<span id="speak" onclick="pause()" style="border: 0px;cursor: pointer;float: right;padding-right: 20px;color: #7d8c8e;font-size: 12px;/* clear: both; */margin-top: -5px;" alt="使用 Microsoft Edge 浏览器收听效果最好" title="使用 Microsoft Edge 浏览器收听效果最好"><svg class="icon" style="width: 20px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1454"><path d="M469.333333 847.004444a127.217778 127.217778 0 0 1-127.232 127.217778h-1.521777A127.232 127.232 0 0 1 213.333333 847.004444v-670.008888A127.217778 127.217778 0 0 1 340.565333 49.777778h1.521778A127.232 127.232 0 0 1 469.333333 176.995556v670.008888z m-56.888889-670.008888A70.328889 70.328889 0 0 0 342.101333 106.666667h-1.521777A70.328889 70.328889 0 0 0 270.222222 176.995556v669.994666a70.328889 70.328889 0 0 0 70.343111 70.328889h1.521778a70.328889 70.328889 0 0 0 70.343111-70.328889V176.995556z" fill="" p-id="1455"></path><path d="M312.888889 291.555556a14.222222 14.222222 0 0 1-14.222222-14.222223v-56.888889a14.222222 14.222222 0 1 1 28.444444 0v56.888889a14.222222 14.222222 0 0 1-14.222222 14.222223zM312.888889 334.222222a14.222222 14.222222 0 0 1-14.222222-14.222222v-5.888a14.222222 14.222222 0 1 1 28.444444 0v5.888a14.222222 14.222222 0 0 1-14.222222 14.222222zM810.666667 847.004444a127.232 127.232 0 0 1-127.232 127.217778h-1.521778a127.232 127.232 0 0 1-127.232-127.217778v-670.008888A127.232 127.232 0 0 1 681.912889 49.777778h1.521778A127.232 127.232 0 0 1 810.666667 176.995556v670.008888z m-56.888889-670.008888A70.343111 70.343111 0 0 0 683.434667 106.666667h-1.521778A70.343111 70.343111 0 0 0 611.555556 176.995556v669.994666a70.343111 70.343111 0 0 0 70.343111 70.328889h1.521777a70.343111 70.343111 0 0 0 70.343112-70.328889V176.995556z" fill="" p-id="1456"></path></svg> 暂停</span>

<span id="speak" onclick="play()" style="border: 0px;cursor: pointer;float: right;padding-right: 20px;color: #7d8c8e;font-size: 12px;/* clear: both; */margin-top: -5px;" alt="使用 Microsoft Edge 浏览器收听效果最好" title="使用 Microsoft Edge 浏览器收听效果最好"><img alt="headphone stoped" aria-hidden="true" class="icon-filled" src="/assets/file/2024/01/headphones_sound_wave_24_filled.svg" style=" width: 20px; vertical-align: middle;opacity: 0.5;"> 收听本文</span>

<button onclick="cls()" style="display: none;">清空文本</button>
	<script>
 
		var _play = document.querySelector("._play"),
			to_speak = window.speechSynthesis,
			dataName, voiceSelect = document.querySelector("#voiceSelect"),
			voices = [];
 
		function play() {
			myCheckFunc();//检查文本框是否为空
			cancel(); //
			to_speak = new SpeechSynthesisUtterance(_play.value);
 
			//to_speak.rate = 1.4;// 设置播放语速，范围：0.1 - 10之间
 
			var selectedOption = voiceSelect.selectedOptions[0].getAttribute('data-name');
			for(i = 0; i < voices.length; i++) {
				if(voices[i].name === selectedOption) {
					to_speak.voice = voices[i];
				}
			}
 
			window.speechSynthesis.speak(to_speak);
 
		}
 
		//暂停
		function pause() {
			myCheckFunc();//检查文本框是否为空
			window.speechSynthesis.pause();
		}
		//继续播放
		function resume() {
			myCheckFunc();//检查文本框是否为空
			window.speechSynthesis.resume(); //继续
		}
		//清除所有语音播报创建的队列
		function cancel() {
			window.speechSynthesis.cancel();
		}
		//清空文本框
		function cls()  {
			 document.getElementById("texts").value=""; 清空文本框
		}
		//检查文本框是否为空
		function myCheckFunc() {
		        let x;
		        x = document.getElementById("texts").value;
		        try {
		            if (x === "")
		                throw "文本框为空";
            
		        } catch (error) {
		            alert( "提示" + error);
		        }
		}
 
		//创建选择语言的select标签
		function populateVoiceList() {
			voices = speechSynthesis.getVoices();
			for(i = 0; i < voices.length; i++) {
				var option = document.createElement('option');
				option.textContent = voices[i].name + ' (' + voices[i].lang + ')';
 
				if(voices[i].default) {
					option.textContent += ' -- DEFAULT';
				}
				option.setAttribute('data-lang', voices[i].lang);
				option.setAttribute('data-name', voices[i].name);
				voiceSelect.appendChild(option);
			}
		}
 
		setTimeout(function() {
			populateVoiceList();
		}, 500) //
	</script>
</center>
<?php endif; ?>
    <div id="main1"<?php if($widget=="0") echo ' class="w100"';?>>         
<div id="article">
<div  id="printview">
<?php if ($v['title']<>"") echo '<h1>'.$title.'</h1>';?>
<div class="text">
<?php  if($v['pass']==""){echo $v['content']; }else { echo '<p style="color:red;">这是一篇密码日志！</p><p><input placeholder="请输入密码..." name="pass" type="password" value="" id="password" class="search-text" /> <button class="search-submit" onclick="ckpass(\''.$v['id'].'\');" />确认</button></p>';}?></div>
<div class="readall_box">
          <div class="read_more_mask"></div>
          <a class="read_more_btn" target="_self">阅读全文 <i class="fa fa-angle-down" aria-hidden="true" style="font-size: 18px; color: #ca0c16;vertical-align:middle;"></i></a>
      </div>
<p class="time clb"><?php  echo $class[$v['tid']].' '.$v['atime']?> 通过 <?php echo $v['fm'];?> <i class="iconfont icon-view"></i> 浏览(<?php echo $v['pv']; ?>) <span> <a href="javascript:printme()" target="_self" style="color: #999;"><i class="fa fa-print"></i> 打印</a></span></p>
<p class="navPost">  
	<?php  view_admin($v['id'],$v['ist'],$v['lock']|$v['hide']);?>
</p></div></div>  
<!-- 上一篇 下一篇开始 -->
<div style="overflow: hidden;margin-bottom: 10px;">

<div id="preup">
<p style="color: #999;"><i class="fa fa-angle-left em12" style="color: #d0d0d0;"></i>
<i class="fa fa-angle-left em12 mr6" style="margin-right: 6px;color: #d0d0d0;"></i>
上一篇</p>
<?php echo getprenext($v['id'],'pre');?>
</div>

<div id="predown">
<p style="color: #999;">下一篇
<i class="fa fa-angle-right em12 ml6" style="margin-left: 6px;color: #d0d0d0;"></i>
<i class="fa fa-angle-right em12" style="color: #d0d0d0;"></i></p>
<?php echo getprenext($v['id'],'next');?>
</div>
</div>
<!-- 上一篇 下一篇 结束-->
   <div id="comments">
   <h3><?php if($v['lock']==1 || $v['hide']==1) {echo '评论已关闭！';} else {echo '共有'.$v['num'].'条评论！'; }?></h3>
        <ol class="comment_list">
        <?php  $l=1;foreach($list as $vv){?>
		<li class="comlist" id="Com-<?php  echo $vv['id'];?>">
		<div id="Ctext-<?php  echo $vv['id'];?>" class="comment">
		<div class="comment_meta">
		<cite><a rel="external nofollow"<?php echo target($vv['purl'],$file);?>><?php echo $vv['pname'];?></a></cite> <span class="time"><?php echo $vv['ptime']; ?></span>
		<span class="reply"><?php echo '<em>'.$l.'#</em> ';pl_admin($vv['id'], $vv['cid'], $vv['isn'], $vv['pmail']);?></span>
		</div>
		<p><?php if($vv['isn']==1 && $admin===0){echo '评论审核中...'; } else { echo nl2br($vv['pcontent']);}?></p>
		<?php if($vv['rcontent']<>""){?><p class="re">&nbsp;&nbsp;<strong style="color:#C00"><?php echo $set['webuser']; ?>回复</strong>：<span><?php echo $vv['rcontent']; ?></span></p><?php }?>
		</div>
		</li>
       <?php $l++;} ?>
       </ol>
	   <?php if($v['lock']==0 && $v['hide']==0){?>
<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">发表评论</h3>
 <form id="formpl">
<div class="s_e mt10"><textarea tabindex="1" placeholder="发言要文明，评论有水平..." name="pcontent" rows="3" id="pcontent" class="input_textarea"></textarea></div>
<div id="pl_other" class="hide"><div class="s_e"><input name="pname" tabindex="2" placeholder="昵称(选填)" id="pname" type="text" class="input_narrow" value="<?php echo @$_COOKIE['pname'];?>" maxlength="10" /></div>
<div class="s_e"><input name="pmail" tabindex="2" placeholder="邮箱(选填)" id="pmail" type="email" class="input_narrow" value="<?php echo @$_COOKIE['pmail'];?>" maxlength="30" /></div>
<div class="s_e"><input name="purl" tabindex="3" placeholder="网址(选填)" id="purl" type="url" class="input_narrow" value="<?php echo @$_COOKIE['purl'];?>" maxlength="50" /></div>
</div>
	 <?php  if($safecode==1){?>
	 <div class="s_e"><input type="text" tabindex="4" id="pcode" placeholder="右侧计算答案" name="pcode" autocomplete="off"  class="input_narrow" value="" /> <img src="app/class/codes.php" id="codeimg" style="cursor:pointer" alt="更换一道题！" onclick="reloadcode()"/></div>
	 <?php }?>
	 <div class="s_e"><button type="button" onClick="addpl('<?php echo $id;?>','<?php echo $safecode;?>')" id="add" class="btn"> 提 交 </button> <button type="button" onClick="history.back();" id="bck" class="btn"> 返 回 </button><span id="errmsg"></span></div>
     </form></div>	
    <?php } ?>
    </div>	
    </div>
  </div>
<?php include "foot.php";?>
<?php echo $set['foot'];?>
</div>
<!--打印功能代码-->
<script type="text/javascript">
var global_Html = "";
	function printme() {
	global_Html = document.body.innerHTML;
	document.body.innerHTML = document.getElementById('printview').innerHTML;　　　　　　　　　　　　　　
	window.print();
	window.setTimeout(function() {
	document.body.innerHTML = global_Html;
	}, 1500);
}
</script>
<!--打印功能代码-->
</body>
</html>