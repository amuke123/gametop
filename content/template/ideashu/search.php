<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<div class="h_search">
						<form action="<?php echo IDEA_URL;?>" method="get" name="so">
							<li>
								<input class="h_s_key" type="text" name="keyword" placeholder="您有一颗发现美的眼睛" value="<?php echo $keyword==''?'':$keyword;?>">
								<i class="icno-search"></i>
								<input class="h_s_bt" type="submit" value="">
							</li>
						</form>
					</div>
				</div>
				<div class="list_top">
					<p><i></i><b>搜索“ <?php echo $keyword;?> ”结果</b></p>
					<p><em>共搜索到关于 “ <span style="color:red;"><?php echo $keyword;?></span> ” 的笔记 “ <?php echo $artnumb;?> ” 条.</em></p>
					<div class="clear"></div>
				</div>
				<div class="c_cont_left left">
					<div class="c_cl_top">
						<p><b><?php echo $keyword;?></b>-笔记</p>
					</div>
					<div class="c_cl_li">
						<?php foreach($arts as $value){?>
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
						<?php }?>
					</div>
					<div class="list_page">
						<p><?php echo $pagestr;?></p>
					</div>
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