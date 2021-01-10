<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b>分类</b></p>
					<p><span>生活中处处都有美，用心去发现生活中的美，那些人，那些事，那些景，尽情探险，尽情享受</span></p>
				</div>
				<div class="c_c_list">
					<ul>
						<?php
						foreach($sorts as $value){
							$pic=$value['pic']==''?getRandImg():str_replace('../',IDEA_URL,$value['pic']);
						?>
						<li>
							<a href="<?php echo Url::sort($value['id']);?>" title="<?php echo $value['sortname'];?>">
							<img src="<?php echo $pic;?>" />
							<p><span><?php echo $value['sortname'];?></span></p>
							</a>
						</li>
						<?php }?>
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include View::getView('footer');
?>