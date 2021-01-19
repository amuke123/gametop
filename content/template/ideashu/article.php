<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="art_title">
			<div class="center">
				<div class="d_bg">
					<h2><?php echo $art_title;?></h2>
					<div class="u_info">
						<div class="left"><p><img src="<?php echo $art_authorUrl;?>"/></p></div>
						<div class="right"><b><a href="<?php echo Url::author($art_uid);?>" target='_blank' >by <?php echo $art_author;?></a></b><span><?php echo date("Y-m-d",$art_date);?></span></div>
					</div>
					<div class="d_ac">
						<ul>
							<li id="goods"><i class="icono-heart"></i><?php echo $art_goodnum;?> 赞</li>
							<li id="sc"><i class="icono-bookmark"></i><?php echo $art_collects;?> 收藏</li>
							<li><i class="icono-fied"></i><a href="<?php echo Url::sort($art_sortid);?>" target="_blank" ><?php echo $art_sortName;?></a></li>
							<li><i class="icono-write"></i><?php echo $art_saynum;?> 评论</li>
							<li><i class="icono-eye"></i><?php echo $art_eyes;?> 阅读</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<article>
			<div class="center">
				<div class="d_cont">
					<div class="d_copy">
						<span title="版权">©</span> 本文 <a href="<?php echo Url::author($art_uid);?>" target='_blank' >by <?php echo $art_author;?></a> 
						<?php if($art_getsite=='原创'){echo $art_copyrights==1?'版权所有，未经作者本人的书面许可任何人不得转载或使用整体或任何部分的内容。':'版权所有，作者未对本笔记声明转载限制，转载时请注明本文标题和链接。';}else if($art_getsite=='网络'){echo '转载自 <a target="_blank" rel="nofollow" href="'.$art_geturl.'" >网络</a>，如有任何版权问题可联系管理员进行处理。';}else{echo '版权所有.';}?>
					</div>
					<div class="c_title"><b></b><span>笔记</span></div>
					<div class="d_contc">
						<?php echo str_replace('../content/uploadfile/',IDEA_URL .'content/uploadfile/',htmlspecialchars_decode($art_content));?>
					</div>
					<div class="d_contc"><p>---</p></div>
					<div class="d_contc">转载请注明本文标题和链接：《 <a href="<?php echo Url::log($aid);?>"><?php echo $art_title;?></a> 》</div>
					<div class="d_tag"><b>TAG：</b>	<?php echo getTag($art_tags);?><div class="clear"></div></div>
					<div class="d_good">
						<?php $code=Checking::getAjCode(12);?>
						<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
						<a href="javascript:good('<?php echo $aid;?>','<?php echo IDEA_URL;?>');"><i class="icono-heart"></i>攒</a>
						<a href="javascript:sc('<?php echo $aid;?>','<?php echo IDEA_URL;?>','<?php echo UID;?>');"><i class="icono-bookmark"></i>收藏</a>
						<a href="javascript:bad('<?php echo $aid;?>','<?php echo IDEA_URL;?>');"><i class="icono-heart"></i>踩</a>
					</div>
					<div class="d_next">
						<div class="left">上一篇：<a href="<?php echo Url::log($neighbour['prev']['id']);?>"><?php echo $neighbour['prev']['title'];?></a></div>
						<div class="right">下一篇：<a href="<?php echo Url::log($neighbour['next']['id']);?>"><?php echo $neighbour['next']['title'];?></a></div>
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

			</div>
		</article>
	</div>
</div>

<?php
include View::getView('footer');
?>