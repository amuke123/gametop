<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b><?php echo $wishinfo['name'];?></b></p>
					<p><span>本清单由 <a target="_blank" href="<?php echo Url::author($wishinfo['uid']);?>"><?php echo user_Model::getUserName($wishinfo['uid']);?></a> 创建于 <?php echo date('Y-m-d',$wishinfo['date']);?> ，最后更新时间 <?php echo date('Y-m-d',$wishinfo['lastdate']);?> 。</span></p>
					<p><span><?php echo $wishinfo['text'];?></span></p>
				</div>
			</div>
		</div>
		<div class="c_cont">
			<div class="center">
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
				<div class="c_cont_left left">
					<div class="c_cl_top">
						<p>收录列表</p>
					</div>
					<?php $code=Checking::getAjCode(12);?>
					<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
					<?php if(isset($arts)&&count($arts)>0){?>
					<div class="c_cl_li">
						<?php
						foreach($arts as $val){
							$value=art_Model::getOnceArt($val);
							if(empty($value)){
						?>
						<li>
							<div class="comment_header">
								<p>不好，收录的笔记被作者删除了</p>
							</div>
						</li>
						<?php }else{?>
						<li>
							<h2><a href="<?php echo Url::log($value['id']);?>"><?php echo $value['title'];?></a></h2>
							<div class="c_li_cont">
								<div class="c_li_img">
									<p><a href="<?php echo Url::log($value['id']);?>"><img src="<?php echo $value['pic']!=''?str_replace('../',IDEA_URL,$value['pic']):getImg($value['id']);?>" ></a></p>
								</div>
								<div class="c_li_des">
									<?php $excerpt=$value['excerpt']==''?strip_tags(htmlspecialchars_decode($value['content'])):strip_tags($value['excerpt']);?>
									<p><?php echo mb_substr(trim($excerpt),0,180);?>...<a href="<?php echo Url::log($value['id']);?>">阅读全文</a></p>
								</div>
								<div class="clear"></div>
							</div>
							<div class="c_li_info">
								<div class="left"><a href="<?php echo Url::author($value['author']);?>">by <?php echo user_Model::getUserName($value['author']);?></a></div>
								<div class="right">
									<a href="<?php echo Url::sort($value['s_id']);?>"><?php echo $sorts[$value['s_id']]['sortname'];?></a>
									<a href="<?php echo Url::log($value['id']);?>#comments"><?php echo $value['saynum'];?> 评论</a>
									<a href="<?php echo Url::log($value['id']);?>"><?php echo $collects[$value['id']];?> 收藏</a>
									<a href="<?php echo Url::log($value['id']);?>"><?php echo $value['goodnum'];?> 攒</a>
									<a href="<?php echo Url::log($value['id']);?>"><?php echo $value['eyes'];?> 浏览</a>
								</div>
								<div class="clear"></div>
							</div>
						</li>
						<?php }}?>
					</div>
					<div class="list_page">
						<p><?php echo $pagestr;?></p>
					</div>
					<?php }else{?>
					<div class="comment_header">
						<p>该清单没有收录任何笔记</p>
					</div>
					<?php }?>
					
				</div>
				<div class="c_cont_hot right">
					<div class="c_cr_top">
						<p><b>一周热点</b></p>
					</div>
					<div class="c_cr_hot">
						<p><b><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></b></p>
						<?php if(!empty($hotArts)){$ii=1;foreach($hotArts as $hotval){?>
						<li><i <?php echo $ii<4?'class="hot"':'';?>><?php echo $ii++;?></i><a href="<?php echo $hotval['arturl'];?>"><?php echo $hotval['title'];?></a></li>
						<?php }}?>
					</div>
					<div class="c_cr_ad">
						<p><b><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></b></p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<?php
include View::getView('footer');
?>