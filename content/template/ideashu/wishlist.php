<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b>清单</b></p>
					<p><span>生活中处处都有美，用心去发现生活中的美，那些人，那些事，那些景，尽情探险，尽情享受</span></p>
				</div>
				<div class="qingdan">
					<ul>
						<?php foreach($wishlist as $value){?>
						<li><a title="<?php echo $value['text'];?>" href="<?php echo Url::wishlist($value['id']);?>"><b><img src="<?php echo $value['pic']==''?getRandImg():str_replace('../',IDEA_URL,$value['pic']);?>"></b><span><?php echo $value['name'];?></span></a></li>
						<?php }?>
					</ul>
					<div class="clear"></div>
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