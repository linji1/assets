<?php if(!defined('WMBLOG'))exit; ?><div id="footer" alt="（linji.cn）域名注册时间：2004-04-02 14:50:54" title="（linji.cn）域名注册时间：2004-04-02 14:50:54"><p><i class="far fa-copyright"></i> 2004–<?php echo date('Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;博主稳定运行<span id="divClock" style="color: red;"></span><b style="display: none;">&nbsp;&nbsp;|&nbsp;&nbsp;Processed <?php $t2 = microtime(true); echo round($t2-$t1,3); ?>s</b>&nbsp;&nbsp;|&nbsp;&nbsp;<?php
//首先你要有读写文件的权限，首次访问肯不显示，正常情况刷新即可
$online_log = "maplers.dat"; //保存人数的文件到根目录,
$timeout = 300;//30秒内没动作者,认为掉线
$entries = file($online_log);
$temp = array();
for ($i=0;$i<count($entries);$i++){
$entry = explode(",",trim($entries[$i]));
if(($entry[0] != getenv('REMOTE_ADDR')) && ($entry[1] > time())) {
array_push($temp,$entry[0].",".$entry[1]."\n"); //取出其他浏览者的信息,并去掉超时者,保存进$temp
}}
array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout))."\n"); //更新浏览者的时间
$maplers = count($temp); //计算在线人数
$entries = implode("",$temp);
//写入文件
$fp = fopen($online_log,"w");
flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些网络文件系统中正常工作
fputs($fp,$entries);
flock($fp,LOCK_UN);
fclose($fp);
echo "在线人数：".$maplers."人";
?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="https://beian.miit.gov.cn/" rel="nofollow" target="_blank" style="color: #000;"><?php echo $set['icp'];?></a><br><?php require_once 'ip.php'; ?>
</div>
<script type="text/javascript" language="javascript" src="/assets/js/layer.js"></script>
<script type="text/javascript" language="javascript" src="/assets/js/ajax.js?v=4.1"></script>
<?php if(ADMIN) echo '<script type="text/javascript" language="javascript" src="/assets/js/admin.js?v=4.0"></script>';?>

<!--手机端底部导航开始-->
<div class="layout-footer">
    <div class="bottom_nav">
          <a href="https://linji.cn"><i class="fa fa-home" style="font-size:22px;"></i><div style="font-size:14px;text-decoration:none;">首页</div></a> 
    </div>
<div class="bottom_nav">
	<span style="cursor: pointer;" onclick="openSubmenu()">
		<i id="menu1" class="iconfont menu1" style="font-size:22px;"></i>
		<div style="font-size:14px;text-decoration:none;">分类</div>
	</span>
	<div class="dialog-Submenu-plane">
		<div class="dialog-Submenu-mask" onclick="closeSubmenu()"></div>
		<div class="layout-submenu">
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-3.html">小学数学</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-4.html">小学语文</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-5.html">小学校历</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-6.html">毕业记忆</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-7.html">相关通知</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-8.html">信息科技</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/list-0.html">生活随笔</a>
			</div>
			<div class="sub_menu" style="border-bottom:1.5px solid #F2F2F2">
				<a href="/archives.html">文章归档</a>
			</div>
			</div>
	</div>
</div>
    <div class="bottom_nav">
        <a href="/list-2.html"><i class="fa fa-laptop" style="font-size:22px;"></i><div style="font-size:14px;text-decoration:none;">继续教育</div></a>
    </div>
    <div class="bottom_nav">
       <a href="/list-1.html"><i class="fa fa-trophy" style="font-size:22px;"></i><div style="font-size:14px;text-decoration:none;">荣誉证书</div></a>
</div>
    <div class="bottom_nav">
       <a href="https://p.linji.cn/" target="_blank"><i class="fa fa-tags" style="font-size:22px;"></i><div style="font-size:14px;text-decoration:none;">老林导航</div></a>
</div>
</div>
<!--手机端底部导航结束-->