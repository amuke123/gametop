<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b>发现</b></p>
					<p><span>生活中处处都有美，用心去发现生活中的美，那些人，那些事，那些景，尽情探险，尽情享受</span></p>
				</div>
				<div class="list_li">
					<?php foreach($artlist as $value){?>
					<li>
						<div class="li_img">
							<a href="<?php echo $value['arturl'];?>"><img src="<?php echo $value['src'];?>" /></a>
							<b><a href="<?php echo $value['sorturl'];?>" class="cl<?php echo $value['s_id'];?>"><?php echo $value['sortname'];?></a></b>
						</div>
						<div class="li_title"><a href="<?php echo $value['arturl'];?>"><?php echo $value['title'];?></a></div>
						<div class="li_des"><p><?php echo $value['excerpt'];?>...<p></div>
						<div class="li_tag"><b>TAG:</b><?php echo getTag($value['tags']);?></div>
						<div class="li_info">
							<div class="left"><a target="_blank" href="<?php echo $value['authorurl']?>">by <?php echo $value['authorname'];?></a></div>
							<div class="right">
								<a href="<?php echo $value['arturl'];?>#comments"><?php echo $value['saynum'];?> 评论</a>
								<a href="<?php echo $value['arturl'];?>"><?php echo $value['collects'];?> 收藏</a>
								<a href="<?php echo $value['arturl'];?>"><?php echo $value['goodnum'];?> 攒</a>
								<a href="<?php echo $value['arturl'];?>"><?php echo $value['eyes'];?> 浏览</a>
							</div>
							<div class="clear"></div>
						</div>
					</li>
					<?php }?>
				</div>
				<div class="list_page">
					<p><a href="<?php echo Url::getActionUrl('find');?>"> 再 发 现 </a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include View::getView('footer');
?>