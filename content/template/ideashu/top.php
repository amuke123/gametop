<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b>榜单</b></p>
					<p><span>生活中处处都有美，用心去发现生活中的美，那些人，那些事，那些景，尽情探险，尽情享受</span></p>
				</div>
				<div class="c_c_list">
					<ul>
						<?php $i=1;foreach($tops as $value){?>
						<li>
							<a href="<?php echo IDEA_URL .$value['url'];?>" class="cl<?php echo $i++;?>" title="<?php echo $value['name'];?>">
							<p class="ck"><span><?php echo $value['name'];?></span></p>
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