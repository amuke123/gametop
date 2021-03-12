<div class="c1">
	<div class="content">
		<div class="author_head">
			<div class="center">
				<div class="author_top">
					<div class="author_list">	
						<strong><a title="查看主页" href="<?php echo Url::author($uid);?>"><img src="<?php echo user_Model::getUserPhoto($userinfo['id']);?>" /></a></strong>
						<p><a title="查看主页" href="<?php echo Url::author($uid);?>"><?php echo $userinfo['name'];?></a> <a title="修改资料" href="<?php echo Url::setting(UID);?>" target="_blank"><span>✎</span></a></p>
						<p><span><?php echo $userinfo['role']==ROLE_ADMIN?'管理员':'设计师';?></span><span><?php echo date('Y-m-d',$userinfo['date']);?> 入驻</span></p>
						<p><?php echo $userinfo['description']=="" ? "这家伙很懒，什么都没留下!":$userinfo['description'];?></p>
						<div class="line2"></div>
						<div class="clear"></div>
					</div>
					<div class="author_nav" id="author_nav">
						<a href="<?php echo Url::person(UID);?>" class="action">动态</a><a href="<?php echo Url::person(UID);?>notes">笔记</a><a href="<?php echo Url::person(UID);?>collect">收藏</a><a href="<?php echo Url::person(UID);?>list">清单</a><a href="<?php echo Url::person(UID);?>follow">关注</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<article>
			<div class="center">
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
				<div class="author_cont c_cont_left left" id="author_cont">
					<div class="c4_list">
						<?php if($keyson==0){?>
						<div class="c_cl_top">
							<p>我的动态</p>
						</div>
						<div class="c_cl_li">
							<li>
								<div class="dt_box"><p class="left">发布了笔记</p><p class="right">2020-02-03</p><div class="clear"></div></div>
								<h2><a href="#">这是色彩理论概述标题</a></h2>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="#"><img src="<?php echo TEMPLATE_URL;?>images/4.jpg" ></a></p>
									</div>
									<div class="c_li_des">
										<p>这是摄影圈装逼指南 Instagram 贡献的又一圣餐， 来自用户 Trevino 的创意， 简单的说，如果你有很多很多的这是摄影圈装逼指南 Instagram 贡献的又一圣餐， 来自用户 Trevino 的创意， 简单的说，如果你有很多很多的... <a href="#">阅读全文</a></p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="c_li_info">
									<div class="left"><a href="#">by ddd</a></div>
									<div class="right">
										<a href="#">分类</a>
										<a href="#">1 评论</a>
										<a href="#">1 收藏</a>
										<a href="#">1 攒</a>
										<a href="#">11 浏览</a>
									</div>
									<div class="clear"></div>
								</div>
							</li>
							<li>
								<div class="dt_box"><p class="left">关注了清单</p><p class="right">2020-02-01</p><div class="clear"></div></div>
								<div class="c_li_cont">
									<div class="c_li_img c_li_img3">
										<p><a href="#"><img src="<?php echo TEMPLATE_URL;?>images/4.jpg" ></a></p>
									</div>
									<div class="c_li_des">
										<h2><a href="#">这是色彩理论概述标题</a></h2>
										<p>这是摄影圈装逼指南 Instagram 贡献的又一圣餐， 来自用户 Trevino 的创意， 简单的说，如果你有很多很多的这是摄影圈装逼指南 Instagram 贡献的又一圣餐... <a href="#">查看清单</a></p>
									</div>
									<div class="clear"></div>
								</div>
							</li>
							<li>
								<div class="dt_box"><p class="left">收藏了笔记</p><p class="right">2020-02-01</p><div class="clear"></div></div>
								<h2><a href="#">这是色彩理论概述标题</a></h2>
							</li>
							<li>
								<div class="dt_box"><p class="left">发表了一则评论</p><p class="right">2020-02-01</p><div class="clear"></div></div>
								<h2>笔记：<a href="#">这是色彩理论概述标题</a></h2>
								<div class="c_li_des">
									<p><b>评论内容：</b>简单的说，如果你有很多很多的这是摄影圈装逼指南 Instagram 贡献的又一圣餐... <a href="#">评论详情</a></p>
								</div>
							</li>
							<li>
								<div class="dt_box"><p class="left">关注了用户</p><p class="right">2020-02-03</p><div class="clear"></div><div class="clear"></div></div>
								<div class="dt_user">
									<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/6" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/3.jpg" /></a></div>
									<div class="c_c5_ldoc left">
										<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/6" target="_blank">小Q</a></div>
										<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
									</div>
									<div class="c_c5_gz right"><a href="javascript:outFocus('44','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');" class="action2" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已互相关注">互相关注</a></div><div class="clear"></div>
								</div>
							</li>
							<li>
								<div class="dt_box"><p class="left">发布了笔记</p><p class="right">2020-02-03</p><div class="clear"></div></div>
								<h2><a href="#">这是色彩理论概述标题</a></h2>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="#"><img src="<?php echo TEMPLATE_URL;?>images/4.jpg" ></a></p>
									</div>
									<div class="c_li_des">
										<p>这是摄影圈装逼指南 Instagram 贡献的又一圣餐， 来自用户 Trevino 的创意， 简单的说，如果你有很多很多的这是摄影圈装逼指南 Instagram 贡献的又一圣餐， 来自用户 Trevino 的创意， 简单的说，如果你有很多很多的... <a href="#">阅读全文</a></p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="c_li_info">
									<div class="left"><a href="#">by ddd</a></div>
									<div class="right">
										<a href="#">分类</a>
										<a href="#">1 评论</a>
										<a href="#">1 收藏</a>
										<a href="#">1 攒</a>
										<a href="#">11 浏览</a>
									</div>
									<div class="clear"></div>
								</div>
							</li>
						</div>
						<div class="list_page">
							<p><?php //echo $pagestr;?></p>
						</div>
						<?php }?>
					</div>
					<div class="c4_list">
						<?php if($keyson==1){?>
						<div class="c_cl_top">
							<p>我的笔记</p>
						</div>
						<div class="c_cl_li">
							<?php if(empty($arts)){?>
							<ul class="list_li">
								<p class="comment_header"><b>您没有撰写任何笔记！</b></p>
							</ul>
							<?php }else{foreach($arts as $value){?>
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
							<?php }}?>
						</div>
						<div class="list_page">
							<p><?php echo $pagestr;?></p>
						</div>
						<?php }?>
					</div>
					<div class="c4_list">
						<?php if($keyson==2){?>
						<div class="c_cl_top">
							<p>我的收藏</p>
						</div>
						<div class="c_cl_li">
							<?php if(empty($collects)){?>
							<ul class="list_li">
								<p class="comment_header"><b>您没有收藏任何笔记！</b></p>
							</ul>
							<?php }else{foreach($collects as $value){?>
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
							<?php }}?>
						</div>
						<div class="list_page">
							<p><?php echo $pagestr;?></p>
						</div>
						<?php }?>
					</div>
					<div class="c_c5_list c4_list">
						<?php if($keyson==3){?>
						<div class="c_cl_top">
							<p>我的清单</p>
						</div>
						<div class="qingdan">
							<ul>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
								<li><a title="清单1" href="#"><b><img src="<?php echo TEMPLATE_URL;?>images/3.jpg"></b><span>清单1</span></a></li>
							</ul>
							<div class="clear"></div>
						</div>
						<div class="list_page">
							<p><?php //echo $pagestr;?></p>
						</div>
						<?php }?>
						<div class="clear"></div>
					</div>
					<div class="c_c5_list c4_list">
						<?php if($keyson==4){?>
						<div class="c_cl_top" id="author_nav2">
							<a href="javascript:changeC22(0);" class="active">我的关注</a><a href="javascript:changeC22(1);">我的粉丝</a>
						</div>
						<div id="author_cont2">
							<div class="c_cl_li">
								<ul>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/6" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/3.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/6" target="_blank">小Q</a></div>
											<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('44','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');" class="action2" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已互相关注">互相关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/3" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/5.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/3" target="_blank">你的名字</a></div>
											<div class="c_c5_linfo">个人描述而已</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('45','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');" class="action2" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已互相关注">互相关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/4" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/4.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/4" target="_blank">伸手碰阳光</a></div>
											<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('51','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');"  onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已关注">已关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/5" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/5.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/5" target="_blank">清风饮露</a></div>
											<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('52','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');"  onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已关注">已关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/2" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/1.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/2" target="_blank">束缚の花</a></div>
											<div class="c_c5_linfo">admin</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('53','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已关注">已关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/102003" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/102003" target="_blank">七色彩虹</a></div>
											<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:outFocus('56','https://www.ideashu.com/include/action/action.php','4aMhwBj3TZ','5');" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="已关注">已关注</a></div>
									</li>
								</ul>
								<div class="list_page">
									<p><?php //echo $pagestr;?></p>
								</div>
							</div>
							<div class="c_cl_li">
								<ul>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/6" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/1.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/6" target="_blank">小Q</a></div>
											<div class="c_c5_linfo">这家伙很懒，什么都没留下!</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:void();" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" class="action" title="已互相关注">互相关注</a></div>
									</li>
									<li>
										<div class="c_c5_limg left"><a href="https://www.ideashu.com/author/3" target="_blank"><img src="<?php echo TEMPLATE_URL;?>images/2.jpg" /></a></div>
										<div class="c_c5_ldoc left">
											<div class="c_c5_ltitle"><a href="https://www.ideashu.com/author/3" target="_blank">你的名字</a></div>
											<div class="c_c5_linfo">个人描述而已</div>
										</div>
										<div class="c_c5_gz right"><a href="javascript:getFocus('1','3','https://www.ideashu.com/include/action/action.php','AxOo60bmne','4');" onmouseover="gz_change(this);" onmouseout="gz_change2(this);" title="关注">关注</a></div>
									</li>
								</ul>
								<div class="list_page">
									<p><?php //echo $pagestr;?></p>
								</div>
							</div>
						</div>
						<?php }?>
						<div class="clear"></div>
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
				<div class="line2"></div>
			</div>
		</article>
	</div>
</div>
<script>changeC4("<?php echo $keyson;?>");</script>
<?php
include View::getView('footer');
?>