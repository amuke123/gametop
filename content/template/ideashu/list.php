<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b><?php echo $sortName;?></b></p>
					<p><span><?php echo $sort['description'];?></span></p>
				</div>
				<div class="list_li">
					<?php foreach($arts as $value){?>
					<li>
						<div class="li_img">
							<a href="<?php echo Url::log($value['id']);?>"><img src="<?php echo $value['pic']!=''?str_replace('../',IDEA_URL,$value['pic']):getImg($value['id']);?>" /></a>
							<b><a href="<?php echo Url::sort($value['s_id']);?>" class="cl1"><?php echo $sortName;?></a></b>
						</div>
						<div class="li_title"><a href="<?php echo Url::log($value['id']);?>"><?php echo $value['title'];?></a></div>
						<?php $excerpt=$value['excerpt']==''?strip_tags(htmlspecialchars_decode($value['content'])):strip_tags($value['excerpt']);?>
						<div class="li_des"><p><?php echo mb_substr(trim($excerpt),0,100);?>...<p></div>
						<div class="li_tag"><b>TAG:</b><?php echo getTag($value['tags']);?></div>
						<div class="li_info">
							<div class="left"><a target="_blank" href="<?php echo Url::author($value['author'])?>">by <?php echo user_Model::getUserName($value['author']);?></a></div>
							<div class="right">
								<a href="<?php echo Url::log($value['id']);?>#comments"><?php echo $value['saynum'];?> 评论</a>
								<a href="<?php echo Url::log($value['id']);?>"><?php echo $collects[$value['id']];?> 收藏</a>
								<a href="<?php echo Url::log($value['id']);?>"><?php echo $value['goodnum'];?> 攒</a>
								<a href="<?php echo Url::log($value['id']);?>"><?php echo $value['eyes'];?> 浏览</a>
							</div>
							<div class="clear"></div>
						</div>
					</li>
					<?php }?>
				</div>
				<div class="list_page">
					<p><?php echo $pagestr;?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include View::getView('footer');
?>