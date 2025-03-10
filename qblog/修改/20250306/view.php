<?php if(!defined('WMBLOG'))exit; ?>
<?php include "head.php";?>
<!-- 引入layui库 -->
<script src="assets/qblog/layui/layui.js"></script>
<style type="text/css">
	/** 图标字体 **/
@font-face {
  font-family: 'layui-icon';
  src: url('assets/qblog/layui/font/iconfont.eot?v=282');
  src: url('assets/qblog/layui/font/iconfont.eot?v=282#iefix') format('embedded-opentype'),
       url('assets/qblog/layui/font/iconfont.woff2?v=282') format('woff2'),
       url('assets/qblog/layui/font/iconfont.woff?v=282') format('woff'),
       url('assets/qblog/layui/font/iconfont.ttf?v=282') format('truetype'),
       url('assets/qblog/layui/font/iconfont.svg?v=282#layui-icon') format('svg');
}

.layui-icon{
  font-family:"layui-icon" !important;
  font-size: 16px;
  font-style: normal;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/* font-class */
.layui-icon-leaf:before{content: "\e701";}
.layui-icon-folder:before{content: "\eabe";}
.layui-icon-folder-open:before{content: "\eac1";}
.layui-icon-gitee:before{content: "\e69b";}
.layui-icon-github:before{content:"\e6a7"}
.layui-icon-disabled:before{content:"\e6cc"}
.layui-icon-moon:before{content:"\e6c2"}
.layui-icon-error:before{content:"\e693"}
.layui-icon-success:before{content:"\e697"}
.layui-icon-question:before{content:"\e699"}
.layui-icon-lock:before{content:"\e69a"}
.layui-icon-eye:before{content:"\e695"}
.layui-icon-eye-invisible:before{content:"\e696"}
.layui-icon-backspace:before{content:"\e694"}
.layui-icon-tips-fill:before{content:"\eb2e"}
.layui-icon-test:before{content:"\e692"}
.layui-icon-clear:before{content:"\e788"}
.layui-icon-heart-fill:before{content:"\e68f"}
.layui-icon-light:before{content:"\e748"}
.layui-icon-music:before{content:"\e690"}
.layui-icon-time:before{content:"\e68d"}
.layui-icon-ie:before{content:"\e7bb"}
.layui-icon-firefox:before{content:"\e686"}
.layui-icon-at:before{content:"\e687"}
.layui-icon-bluetooth:before{content:"\e689"}
.layui-icon-chrome:before{content:"\e68a"}
.layui-icon-edge:before{content:"\e68b"}
.layui-icon-heart:before{content:"\e68c"}
.layui-icon-key:before{content:"\e683"}
.layui-icon-android:before{content:"\e684"}
.layui-icon-mike:before{content:"\e6dc"}
.layui-icon-mute:before{content:"\e685"}
.layui-icon-gift:before{content:"\e627"}
.layui-icon-windows:before{content:"\e67f"}
.layui-icon-ios:before{content:"\e680"}
.layui-icon-logout:before{content:"\e682"}
.layui-icon-wifi:before{content:"\e7e0"}
.layui-icon-rss:before{content:"\e808"}
.layui-icon-email:before{content:"\e618"}
.layui-icon-reduce-circle:before{content:"\e616"}
.layui-icon-transfer:before{content:"\e691"}
.layui-icon-service:before{content:"\e626"}
.layui-icon-addition:before{content:"\e624"}
.layui-icon-subtraction:before{content:"\e67e"}
.layui-icon-slider:before{content:"\e714"}
.layui-icon-print:before{content:"\e66d"}
.layui-icon-export:before{content:"\e67d"}
.layui-icon-cols:before{content:"\e610"}
.layui-icon-screen-full:before{content:"\e622"}
.layui-icon-screen-restore:before{content:"\e758"}
.layui-icon-rate-half:before{content:"\e6c9"}
.layui-icon-rate-solid:before{content:"\e67a"}
.layui-icon-rate:before{content:"\e67b"}
.layui-icon-cellphone:before{content:"\e678"}
.layui-icon-vercode:before{content:"\e679"}
.layui-icon-login-weibo:before{content:"\e675"}
.layui-icon-login-qq:before{content:"\e676"}
.layui-icon-login-wechat:before{content:"\e677"}
.layui-icon-username:before{content:"\e66f"}
.layui-icon-password:before{content:"\e673"}
.layui-icon-refresh-3:before{content:"\e9aa"}
.layui-icon-auz:before{content:"\e672"}
.layui-icon-shrink-right:before{content:"\e668"}
.layui-icon-spread-left:before{content:"\e66b"}
.layui-icon-snowflake:before{content:"\e6b1"}
.layui-icon-tips:before{content:"\e702"}
.layui-icon-note:before{content:"\e66e"}
.layui-icon-senior:before{content:"\e674"}
.layui-icon-refresh-1:before{content:"\e666"}
.layui-icon-refresh:before{content:"\e669"}
.layui-icon-flag:before{content:"\e66c"}
.layui-icon-theme:before{content:"\e66a"}
.layui-icon-notice:before{content:"\e667"}
.layui-icon-console:before{content:"\e665"}
.layui-icon-website:before{content:"\e7ae"}
.layui-icon-face-surprised:before{content:"\e664"}
.layui-icon-set:before{content:"\e716"}
.layui-icon-template:before{content:"\e663"}
.layui-icon-app:before{content:"\e653"}
.layui-icon-template-1:before{content:"\e656"}
.layui-icon-home:before{content:"\e68e"}
.layui-icon-female:before{content:"\e661"}
.layui-icon-male:before{content:"\e662"}
.layui-icon-tread:before{content:"\e6c5"}
.layui-icon-praise:before{content:"\e6c6"}
.layui-icon-rmb:before{content:"\e65e"}
.layui-icon-more:before{content:"\e65f"}
.layui-icon-camera:before{content:"\e660"}
.layui-icon-cart-simple:before{content:"\e698"}
.layui-icon-face-cry:before{content:"\e69c"}
.layui-icon-face-smile:before{content:"\e6af"}
.layui-icon-survey:before{content:"\e6b2"}
.layui-icon-read:before{content:"\e705"}
.layui-icon-location:before{content:"\e715"}
.layui-icon-dollar:before{content:"\e659"}
.layui-icon-diamond:before{content:"\e735"}
.layui-icon-return:before{content:"\e65c"}
.layui-icon-camera-fill:before{content:"\e65d"}
.layui-icon-fire:before{content:"\e756"}
.layui-icon-more-vertical:before{content:"\e671"}
.layui-icon-cart:before{content:"\e657"}
.layui-icon-star-fill:before{content:"\e658"}
.layui-icon-prev:before{content:"\e65a"}
.layui-icon-next:before{content:"\e65b"}
.layui-icon-upload:before{content:"\e67c"}
.layui-icon-upload-drag:before{content:"\e681"}
.layui-icon-user:before{content:"\e770"}
.layui-icon-file-b:before{content:"\e655"}
.layui-icon-component:before{content:"\e857"}
.layui-icon-find-fill:before{content:"\e670"}
.layui-icon-loading:before{content:"\e63d"}
.layui-icon-loading-1:before{content:"\e63e"}
.layui-icon-add-1:before{content:"\e654"}
.layui-icon-pause:before{content:"\e651"}
.layui-icon-play:before{content:"\e652"}
.layui-icon-video:before{content:"\e6ed"}
.layui-icon-headset:before{content:"\e6fc"}
.layui-icon-voice:before{content:"\e688"}
.layui-icon-speaker:before{content:"\e645"}
.layui-icon-fonts-del:before{content:"\e64f"}
.layui-icon-fonts-html:before{content:"\e64b"}
.layui-icon-fonts-code:before{content:"\e64e"}
.layui-icon-fonts-strong:before{content:"\e62b"}
.layui-icon-unlink:before{content:"\e64d"}
.layui-icon-picture:before{content:"\e64a"}
.layui-icon-link:before{content:"\e64c"}
.layui-icon-face-smile-b:before{content:"\e650"}
.layui-icon-align-center:before{content:"\e647"}
.layui-icon-align-right:before{content:"\e648"}
.layui-icon-align-left:before{content:"\e649"}
.layui-icon-fonts-u:before{content:"\e646"}
.layui-icon-fonts-i:before{content:"\e644"}
.layui-icon-tabs:before{content:"\e62a"}
.layui-icon-circle:before{content:"\e63f"}
.layui-icon-radio:before{content:"\e643"}
.layui-icon-share:before{content:"\e641"}
.layui-icon-edit:before{content:"\e642"}
.layui-icon-delete:before{content:"\e640"}
.layui-icon-engine:before{content:"\e628"}
.layui-icon-chart-screen:before{content:"\e629"}
.layui-icon-chart:before{content:"\e62c"}
.layui-icon-table:before{content:"\e62d"}
.layui-icon-tree:before{content:"\e62e"}
.layui-icon-upload-circle:before{content:"\e62f"}
.layui-icon-templeate-1:before{content:"\e630"}
.layui-icon-util:before{content:"\e631"}
.layui-icon-layouts:before{content:"\e632"}
.layui-icon-prev-circle:before{content:"\e633"}
.layui-icon-carousel:before{content:"\e634"}
.layui-icon-code-circle:before{content:"\e635"}
.layui-icon-water:before{content:"\e636"}
.layui-icon-date:before{content:"\e637"}
.layui-icon-layer:before{content:"\e638"}
.layui-icon-fonts-clear:before{content:"\e639"}
.layui-icon-dialogue:before{content:"\e63a"}
.layui-icon-cellphone-fine:before{content:"\e63b"}
.layui-icon-form:before{content:"\e63c"}
.layui-icon-file:before{content:"\e621"}
.layui-icon-triangle-r:before{content:"\e623"}
.layui-icon-triangle-d:before{content:"\e625"}
.layui-icon-set-sm:before{content:"\e620"}
.layui-icon-add-circle:before{content:"\e61f"}
.layui-icon-layim-download:before{content:"\e61e"}
.layui-icon-layim-uploadfile:before{content:"\e61d"}
.layui-icon-404:before{content:"\e61c"}
.layui-icon-about:before{content:"\e60b"}
.layui-icon-layim-theme:before{content:"\e61b"}
.layui-icon-down:before{content:"\e61a"}
.layui-icon-up:before{content:"\e619"}
.layui-icon-circle-dot:before{content:"\e617"}
.layui-icon-set-fill:before{content:"\e614"}
.layui-icon-search:before{content:"\e615"}
.layui-icon-friends:before{content:"\e612"}
.layui-icon-group:before{content:"\e613"}
.layui-icon-reply-fill:before{content:"\e611"}
.layui-icon-menu-fill:before{content:"\e60f"}
.layui-icon-face-smile-fine:before{content:"\e60c"}
.layui-icon-picture-fine:before{content:"\e60d"}
.layui-icon-log:before{content:"\e60e"}
.layui-icon-list:before{content:"\e60a"}
.layui-icon-release:before{content:"\e609"}
.layui-icon-add-circle-fine:before{content:"\e608"}
.layui-icon-ok:before{content:"\e605"}
.layui-icon-help:before{content:"\e607"}
.layui-icon-chat:before{content:"\e606"}
.layui-icon-top:before{content:"\e604"}
.layui-icon-right:before{content:"\e602"}
.layui-icon-left:before{content:"\e603"}
.layui-icon-star:before{content:"\e600"}
.layui-icon-download-circle:before{content:"\e601"}
.layui-icon-close:before{content:"\1006"}
.layui-icon-close-fill:before{content:"\1007"}
.layui-icon-ok-circle:before{content:"\1005"}
</style>
<script src="assets/js/translate.js"></script>
  <div id="content" style="position: relative;">
  <div class="breadcrumb" style="margin-top: -5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" style="width: 10px;   width: 14px;height: 14px;vertical-align: -2px;
"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><a href="/" style="padding-left: 5px;color: #7d8c8e;">首页</a>
<span>/</span><a href="list-<?php  echo $v['tid']?>.html" style="color: #7d8c8e;"><?php  echo $class[$v['tid']]?></a><span>/</span>正文</div>
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
$r = mbStrSplit($str, 300);
$qian = "https://dict.youdao.com/dictvoice?le=zh&audio=";
?>
<audio id="audioPlayer" controls preload style="max-width: 50%;opacity: .4;float: right;height: 24px;margin-top: -6px;" title="收听本文" src="<?php echo $qian.$r[0]; ?>">
  您的浏览器不支持 audio 元素。
</audio>
<span id="translate" style="border: 0px;cursor: pointer;float: right;color: #7d8c8e;font-size: 12px;margin-top: -5px;"></span>

    <script>
        const audioPlayer = document.getElementById('audioPlayer');
        const audioFiles = [
            <?php
             foreach ($r as $value) {
             echo "'$qian$value',";
             }?>
        ];
        let currentTrack = 0;

        // 点击播放按钮时开始播放
        function playAudio() {
            if (currentTrack < audioFiles.length) {
                audioPlayer.src = audioFiles[currentTrack];
                audioPlayer.play();
            } else {
                audioPlayer.pause();
            }
        }

        // 绑定播放按钮的点击事件
        audioPlayer.addEventListener('click', playAudio);

        // 监听播放结束事件
        audioPlayer.addEventListener('ended', () => {
            currentTrack++;
            if (currentTrack < audioFiles.length) {
                playAudio(); // 自动播放下一首
            }
        });
    </script>

<style type="text/css">
	span#translate select {
    width: 80px;
	padding-right:0px;
}
@media screen and (max-width: 950px) {
	span#translate select {
    display: none;
  }
}
</style>
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

<!--translate.js 两行js实现html全自动翻译。无需改动页面、无语言配置文件、无API Key、对SEO友好！-->


<script>
//translate.ignore.tag.push('img'); //翻译时追加上自己想指定忽略的tag标签，凡是在这里面的，都不进行翻译。
//translate.ignore.class.push('test');	//翻译时指定忽略的class name，凡是class name 在这里面的，都不进行翻译。如果不设置默认只有 ignore 这一个
var documents = [];
documents.push(document.getElementsByClassName("box-m"));
documents.push(document.getElementsByClassName("search-form"));
documents.push(document.getElementById('main1'));
translate.setDocuments(documents); //指定要翻译的元素的集合,可传入一个或多个元素。如果不设置，默认翻译整个网页
//指定tag标签
//translate.whole.tag.push('h3');
//指定id
//translate.whole.id.push('main1');
//指定 class 属性
//translate.whole.class.push('box-m');
//translate.whole.class.push('search-form');

translate.setAutoDiscriminateLocalLanguage();	//设置用户第一次用时，自动识别其所在国家的语种进行切换
//translate.language.setLocal('chinese_simplified'); //设置本地语种（当前网页的语种）。如果不设置，默认就是 'chinese_simplified' 简体中文。 可填写如 'english'、'chinese_simplified' 等，具体参见文档下方关于此的说明
translate.selectLanguageTag.languages = 'chinese_simplified,chinese_traditional,english,korean,corsican,guarani,kinyarwanda,hausa,norwegian,dutch,yoruba,gongen,latin,nepali,french,czech,hawaiian,georgian,russian,persian,bhojpuri,hindi,belarusian,swahili,icelandic,yiddish,twi,irish,gujarati,khmer,slovak,hebrew,kannada,hungarian,tamil,arabic,bengali,azerbaijani,samoan,afrikaans,indonesian,danish,shona,bambara,lithuanian,vietnamese,maltese,turkmen,assamese,catalan,singapore,cebuano,nskrit,polish,galician,latvian,ukrainian,tatar,scottish_gaelic,welsh,filipino,aymara,lao,telugu,romanian,haitian_creole,dogrid,swedish,maithili,thai,armenian,burmese,pashto,hmong,dhivehi,luxembourgish,sindhi,kurdish,turkish,macedonian,bulgarian,malay,luganda,marathi,estonian,malayalam,deutsch,slovene,urdu,portuguese,igbo,kurdish_sorani,oromo,greek,spanish,frisian,somali,amharic,nyanja,punjabi,basque,italian,albanian,tajik,finnish,kyrgyz,ewe,croatian,creole,quechua,bosnian,maori';
translate.language.setUrlParamControl(); //url参数后可以加get方式传递 language 参数的方式控制当前网页以什么语种显示
translate.selectLanguageTag.refreshRender();
//translate.language.setDefaultTo('english'); //先设置默认翻译为的什么语言
//translate.selectionTranslate.start(); //开启鼠标划词翻译能力
translate.listener.start();	//开启html页面变化的监控，对变化部分会进行自动翻译。注意，这里变化区域，是指使用 translate.setDocuments(...) 设置的区域。如果未设置，那么为监控整个网页的变化
//translate.service.use('client.edge');//由微软直接提供翻译支持，不在依赖翻译服务器
translate.execute(); //执行翻译初始化操作，显示出select语言选择
</script>
<!-- 为代码块加上双击复制功能 -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 确保Layui库加载完成后再执行
    layui.use(['layer'], function () {
        var layer = layui.layer;

        // 获取页面中所有的<div class="text">元素
        var textDivs = document.getElementsByClassName('text');
        for (var j = 0; j < textDivs.length; j++) {
            // 获取每个<div class="text">元素内部的所有<pre>标签
            var preTags = textDivs[j].getElementsByTagName('pre');
            for (var i = 0; i < preTags.length; i++) {
                // 为每个pre标签绑定双击事件
                preTags[i].addEventListener('dblclick', function () {
                    var codeContent = this.textContent;
                    var textarea = document.createElement('textarea');
                    textarea.value = codeContent;
                    document.body.appendChild(textarea);
                    textarea.select();
                    
                    try {
                        document.execCommand('copy');
                        layer.msg('代码已复制成功！', {icon: 1});  // 设置成功提示图标
                        console.log('尝试复制代码...');
                    } catch (err) {
                        layer.msg('复制代码失败，请手动复制。', {icon: 2});  // 设置失败提示图标
                        console.log('复制代码结果:', err);  // 在catch块中   
                    } finally {
                        // 确保无论是否成功，都移除textarea元素
                        document.body.removeChild(textarea);
                    }
                });

                // 为每个pre标签添加title属性
                preTags[i].setAttribute('title', '双击复制代码');
            }
        }
    });
});
</script>
<!-- 为代码块加上双击复制功能 -->
</body>
</html>