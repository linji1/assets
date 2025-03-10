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
$qian = "https://dict.youdao.com/dictvoice?le=zh&audio=";
?>
<?php if ($zishu <= 99999999): ?>
<center><audio controls="" autobuffer="" style="max-width: 50%;opacity: .4;float: right;height: 24px;margin-top: -6px;" title="收听本文">
  <source src="<?php echo $qian.$r[0]; ?>" type="audio/mpeg">
  您的浏览器不支持 audio 元素。
</audio></center>
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