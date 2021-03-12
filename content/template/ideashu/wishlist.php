<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b>清单</b></p>
					<p><span>清单会帮助我们记住那些不想忘记的、重要的东西：我们的决心与渴望，我们喜欢和讨厌的东西，我们欢笑或哭泣的理由，还有那些，我们不曾说出口的秘密。</span></p>
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