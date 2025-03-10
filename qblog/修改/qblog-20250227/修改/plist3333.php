<?php if(!defined('WMBLOG'))exit; ?>
<?php include "head.php";?>
  <div id="content">
  <div id="main1"<?php if($widget=="0") echo ' class="w100"';?>>
     <div id="comments">
	    <h3>评论列表（共 <?php echo $count; ?>  条）</h3>
		 <ol class="comment_list">
         <?php foreach($list as $v){ ?>
		<li class="comlist" id="Com-<?php  echo $v['id'];?>">
		<div id="Ctext-<?php  echo $v['id'];?>" class="comment">
		<div class="comment_meta">
		<cite><a rel="external nofollow"<?php echo target($v['purl'],$file);?>><?php echo $v['pname'];?></a></cite> <span class="time"><?php echo $v['ptime'].($v['hide']==1?' [隐藏]':''); ?></span>
		<span class="reply"><a href="<?php echo vurl($v['cid']).'#Com-'.$v['id'];?>">[查看]</a> <?php pl_admin( $v['id'], $v['cid'], $v['isn'], $v['pmail']);?></span>
		</div>
		<p><?php if($v['isn']==1 && $admin===0){echo '评论审核中...'; } else { echo nl2br($v['pcontent']);}?></p>
		<?php if($v['rcontent']<>""){?><p class="re">&nbsp;&nbsp;<strong style="color:#C00"><?php echo $set['webuser']; ?>回复</strong>：<span><?php echo $v['rcontent']; ?></span></p><?php }?>
		</div>
		</li>
       <?php } ?>
		</ol>
	 </div>
	 <?php if($pagelist!=='')echo '<div class="pagination"><span class="info"> 共计：'.$count.' 条记录 每页：'.$per_page.' 条'.$pagelist.'</div>';?>
	 </div>
  </div>
  <?php include ("foot.php");?>
<?php echo $set['foot'];?>
  </div>
</body>
</html> 