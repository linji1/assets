<?php if(!defined('WMBLOG'))exit;?>
<?php include "head.php";?>
  <div id="content">
    <div id="main"<?php if($widget=="0") echo ' class="w100"';?>>
	<?php if($tid!=='')echo '<div class="class"><i class="fa fa-folder-open"></i><span style="padding-left: 10px;">'.$class[$tid].'</span><span style="padding-left: 10px;">共 '.$count.' 篇</span></div>';?>
	<?php if($s!=='')echo '<div class="class"><i class="fa fa-folder-open"></i><span style="padding-left: 10px;">搜索关键字：'.$s.'</span><span style="padding-left: 10px;">共 '.$count.' 篇</span></div>';?>
    <?php if(empty($list)){ echo '<div class="post_list">没有找到相关记录...</div>';}else{foreach($list as $v){ ?>	 
      <div id="log-<?php echo $v['id']; ?>" class="post_list">
	  <?php if($v['title']<>""){?><a href="<?php echo "/b".$v['tid']."/".vurl($v['id']); ?>"><h2 style="border-bottom: 1px dashed #e0e0e0;line-height: 1.5em;font-weight: bold;font-size: 20px;"><?php echo $v['title'];?></h2></a><?php } ?>
      <div class="excerpt">
	  <?php if($v['pic']<>""){ ?><div class="thumbnail"><a href="<?php echo vurl($v['id']); ?>"><img src="<?php echo $v['pic'];?>" /></a></div><?php } ?>
	  <div class="textPost" data-url="<?php echo "/b".$v['tid']."/".vurl($v['id']); ?>"><?php echo $v['sum']; ?></div>	  
	  </div>	
	  <div class="meta">
	  <p class="time"><?php echo timeago($v['atime']);?> 通过<?php echo $v['fm']; ?> 
	  <?php if($v['ist']==1){ ?><span class="ico">顶</span><?php } ?>
	  <?php if($v['hide']==1){ ?><span class="ico mi">私</span><?php } ?>
	  <?php if($v['lock']==1){ ?><span class="ico jin">禁</span><?php } ?>
	  </p>
      <p class="navPost"><i class="iconfont icon-view"></i> 浏览(<?php echo $v['pv']; ?>) <a href="<?php echo vurl($v['id']);?>#comments"><i class="iconfont icon-com"></i> 评论(<?php echo  $v['num']; ?>)</a> 
	 
	<?php  view_admin($v['id'],$v['ist'],2);?>
</p></div></div> 
<?php }} ?>
	<div class="pagination">
		<span class="info"> 共计：<?php echo $count; ?> 条记录 每页:<?php echo $per_page; ?>条</span><?php echo $pagelist; ?>
	</div>
    </div> 
	<?php include ("right.php");?>
  </div>
<?php include "foot.php";?>
<?php echo $set['foot'];?>
</div>

</body>
</html>