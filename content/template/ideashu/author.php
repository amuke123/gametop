<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="author_head">
			<div class="center">
				<div class="author_top">
					<div class="author_list">
						<strong><a href="<?php echo Url::author($uid);?>"><img src="<?php echo user_Model::getUserPhoto($userinfo['id']);?>" /></a></strong>
						<p><a href="<?php echo Url::author($uid);?>"><?php echo $userinfo['name'];?></a></p>
						<p><span><?php echo $userinfo['role']==ROLE_ADMIN?'管理员':'设计师';?></span><span><?php echo date('Y-m-d',$userinfo['date']);?> 入驻</span></p>
						<div class="author_p">
							<p><?php echo $userinfo['description']=="" ? "这家伙很懒，什么都没留下!":$userinfo['description'];?></p>
							<?php if($uid!=UID){?>
							<p class="c_c4_p">
								<?php if(($keyid=user_Model::isGz($fslist,UID))!=0){?>
									<a href="javascript:outFocus(<?php echo "'".$keyid."','".IDEA_URL ."'";?>);" class="c_c4_gz2" id="c_c4_gz2" title="点击取消关注">已关注</a>
								<?php }else{?>
									<a href="javascript:getFocus(<?php echo "'".UID."','".$uid."','".IDEA_URL ."'";?>);" class="c_c4_gz" id="c_c4_gz" title="点击关注">关注</a>
								<?php }?>
								<a href="mailto:<?php echo $mail;?>" class="c_c4_mail" title="Mail：<?php echo $mail;?>">&#9993;</a>
							</p>
							<?php }else{?><div class="line2"></div><?php }?>
							<div class="clear"></div>
						</div>
						<div class="line"></div>
						<div class="d_ac">
							<ul>
								<li><i class="icono-heart"></i><?php echo $userinfo['prenum'];?> 关注</li>
								<li><i class="icono-eye"></i><?php echo $userinfo['pronum'];?> 粉丝</li>
								<li><i class="icono-write"></i><?php echo $userinfo['artnum'];?> 笔记</li>
								<li><i class="icono-bookmark"></i><?php echo $userinfo['collectnum'];?> 收藏</li>
								<li><i class="icono-bookmark"></i><?php echo $userinfo['wishnum'];?> 清单</li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="c_cont">
			<div class="center">
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
				<div class="c_cont_left left">
					<div class="c_cl_top">
						<p>笔记</p>
					</div>
					<?php $code=Checking::getAjCode(12);?>
					<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
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
									<a href="<?php echo Url::sort($value['s_id']);?>"><?php echo sort_Model::getSortName($value['s_id']);?></a>
									<a href="<?php echo Url::log($value['id']);?>#comments"><?php echo $value['saynum'];?> 评论</a>
									<a href="<?php echo Url::log($value['id']);?>"><?php echo art_Model::getCollects($value['id']);?> 收藏</a>
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