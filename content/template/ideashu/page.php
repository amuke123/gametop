<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<article>
			<div class="center">
				<div class="d_cont">
					<div class="page">
						<h2><?php echo $art_title;?></h2>
						<div class="p_cont">
							<?php echo str_replace('../content/uploadfile/',IDEA_URL .'content/uploadfile/',htmlspecialchars_decode($art_content));?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<?php if($allow_remark){?>
					<div class="d_pl" id="comments">
						<?php getComments($comments,$aid);?>
						<div class="list_page"><p><?php echo $pagestr;?></p></div>
						<?php getCommentPost($aid,$ckname,$ckmail,$ckurl,$verifyCode);?>
					</div>
					<?php }?>
					<div class="clear"></div>
				</div>
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
			</div>
		</article>
	</div>
</div>

<?php
include View::getView('footer');
?>