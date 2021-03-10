<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="list">
			<div class="center">
				<div class="list_top">
					<p><i></i><b><?php echo $topname;?></b></p>
					<p><span>生活中处处都有美，用心去发现生活中的美，那些人，那些事，那些景，尽情探险，尽情享受</span></p>
				</div>
			</div>
		</div>
		<div class="c_cont">
			<div class="center">
				<div class="c_ad"><p class="left"></p><p class="right"></p><div class="clear"></div></div>
				<div class="c_cont_left left">
					<div class="c_cl_top" id="author_nav">
						<a href="javascript:changeC2(0);" class="active">总榜（TOP <?php echo $pagenum;?>）</a><a href="javascript:changeC2(1);">周榜（TOP <?php echo $pagenum;?>）</a>
					</div>
					<?php $code=Checking::getAjCode(12);?>
					<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
					<div class="author_cont" id="author_cont">
						<div class="c_cl_li">
							<?php if(isset($arts['all'])){$ii=1;foreach($arts['all'] as $value){?>
							<li>
								<h2><a href="<?php echo $value['arturl'];?>"><i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <?php echo $value['title'];?></a></h2>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="<?php echo $value['arturl'];?>"><img src="<?php echo $value['src'];?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p><?php echo $value['excerpt'];?>...<a href="<?php echo $value['arturl'];?>">阅读全文</a></p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="c_li_info">
									<div class="left"><a href="<?php echo $value['authorurl'];?>">by <?php echo $value['authorname'];?></a></div>
									<div class="right">
										<a href="<?php echo $value['sorturl'];?>"><?php echo $value['sortname'];?></a>
										<a href="<?php echo $value['arturl'];?>#comments"><?php echo $value['saynum'];?> 评论</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['collects'];?> 收藏</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['goodnum'];?> 攒</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['eyes'];?> 浏览</a>
									</div>
									<div class="clear"></div>
								</div>
							</li>
							<?php }}else if(isset($wooks['all'])){$ii=1;foreach($wooks['all'] as $key=>$value){$fslist=user_Model::getFs($key);?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img2">
										<p><a href="<?php echo Url::author($key);?>"><img src="<?php echo user_Model::getUserPhoto($key);?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <a href="<?php echo $value['arturl'];?>"><?php echo user_Model::getUserName($key);?></a>
											<span>设计师共撰写笔记 <b> <?php echo $value;?> </b> 篇;</span> 
											<?php if($key!=UID){?>
											<?php if(($keyid=user_Model::isGz($fslist,UID))!=0){?>
												<a href="javascript:outFocus(<?php echo "'".$keyid."','".IDEA_URL ."'";?>);" class="c_c4_gz2" id="c_c4_gz2" title="点击取消关注">已关注</a>
											<?php }else{?>
												<a href="javascript:getFocus(<?php echo "'".UID."','".$key."','".IDEA_URL ."'";?>);" class="c_c4_gz" id="c_c4_gz" title="点击关注">关注</a>
											<?php }}else{?>
												<strong>没错，是我</strong>
											<?php }?>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else if(isset($wish['all'])){$ii=1;foreach($wish['all'] as $key=>$value){?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="<?php echo Url::wishlist($value['id']);?>"><img src="<?php echo $value['pic']==''?getRandImg():str_replace('../',IDEA_URL,$value['pic']);?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <a href="<?php echo Url::wishlist($value['id']);?>"><?php echo $value['name'];?></a>
											<span>由 <a target="_blank" href="<?php echo Url::author($value['uid']);?>"><?php echo user_Model::getUserName($value['uid']);?></a> 创建于 <?php echo date('Y-m-d',$value['date']);?> ，最后更新时间 <?php echo date('Y-m-d',$value['lastdate']);?> 。</span>
											<span><?php echo $value['text'];?></span>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else if(isset($saytop['all'])){$ii=1;foreach($saytop['all'] as $key=>$value){
								$posterPhoto=user_Model::getUserPhoto($value['posterid'],'1');
								$poster=$value['url']?'<a href="'.$value['url'].'" target="_blank">'.$value['name'].'</a>':$value['name'];
							?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img2">
										<p><img src="<?php echo $posterPhoto==''?getGravatar($value['mail']):$posterPhoto;?>" ></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <b><?php echo $poster;?></b>
											<span>笔记： <a target="_blank" href="<?php echo Url::log($value['a_id']);?>"><?php echo art_Model::getArtName($value['a_id']);?></a> </span>
											<span>评论内容：<?php echo $value['del']=='0'?'评论内容已删除':strip_tags($value['content']); ?></span>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else{?>
							<div class="comment_header">
								<p>榜单暂无更新</p>
							</div>
							<?php }?>
						</div>
						<div class="c_cl_li">
							<?php if(isset($arts['week'])){$ii=1;foreach($arts['week'] as $value){?>
							<li>
								<h2><a href="<?php echo $value['arturl'];?>"><i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <?php echo $value['title'];?></a></h2>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="<?php echo $value['arturl'];?>"><img src="<?php echo $value['src'];?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p><?php echo $value['excerpt'];?>...<a href="<?php echo $value['arturl'];?>">阅读全文</a></p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="c_li_info">
									<div class="left"><a href="<?php echo $value['authorurl'];?>">by <?php echo $value['authorname'];?></a></div>
									<div class="right">
										<a href="<?php echo $value['sorturl'];?>"><?php echo $value['sortname'];?></a>
										<a href="<?php echo $value['arturl'];?>#comments"><?php echo $value['saynum'];?> 评论</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['collects'];?> 收藏</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['goodnum'];?> 攒</a>
										<a href="<?php echo $value['arturl'];?>"><?php echo $value['eyes'];?> 浏览</a>
									</div>
									<div class="clear"></div>
								</div>
							</li>
							<?php }}else if(isset($wooks['week'])){$ii=1;foreach($wooks['week'] as $key=>$value){$fslist=user_Model::getFs($key);?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img2">
										<p><a href="<?php echo Url::author($key);?>"><img src="<?php echo user_Model::getUserPhoto($key);?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <a href="<?php echo $value['arturl'];?>"><?php echo user_Model::getUserName($key);?></a>
											<span>一周内共撰写笔记 <b> <?php echo $value;?> </b> 篇;</span> 
											<?php if($key!=UID){?>
											<?php if(($keyid=user_Model::isGz($fslist,UID))!=0){?>
												<a href="javascript:outFocus(<?php echo "'".$keyid."','".IDEA_URL ."'";?>);" class="c_c4_gz2" id="c_c4_gz2" title="点击取消关注">已关注</a>
											<?php }else{?>
												<a href="javascript:getFocus(<?php echo "'".UID."','".$key."','".IDEA_URL ."'";?>);" class="c_c4_gz" id="c_c4_gz" title="点击关注">关注</a>
											<?php }}else{?>
												<strong>没错，是我</strong>
											<?php }?>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else if(isset($wish['week'])){$ii=1;foreach($wish['week'] as $key=>$value){?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img">
										<p><a href="<?php echo Url::wishlist($value['id']);?>"><img src="<?php echo $value['pic']==''?getRandImg():str_replace('../',IDEA_URL,$value['pic']);?>" ></a></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <a href="<?php echo Url::wishlist($value['id']);?>"><?php echo $value['name'];?></a>
											<span>由 <a target="_blank" href="<?php echo Url::author($value['uid']);?>"><?php echo user_Model::getUserName($value['uid']);?></a> 创建于 <?php echo date('Y-m-d',$value['date']);?> ，最后更新时间 <?php echo date('Y-m-d',$value['lastdate']);?> 。</span>
											<span><?php echo $value['text'];?></span>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else if(isset($saytop['week'])){$ii=1;foreach($saytop['week'] as $key=>$value){
								$posterPhoto=user_Model::getUserPhoto($value['posterid'],'1');
								$poster=$value['url']?'<a href="'.$value['url'].'" target="_blank">'.$value['name'].'</a>':$value['name'];
							?>
							<li>
								<div class="c_li_cont">
									<div class="c_li_img2">
										<p><img src="<?php echo $posterPhoto==''?getGravatar($value['mail']):$posterPhoto;?>" ></p>
									</div>
									<div class="c_li_des">
										<p>
											<i <?php echo $ii>3?'':'class="hot"';?>><?php echo $ii++;?></i> <b><?php echo $poster;?></b>
											<span>笔记： <a target="_blank" href="<?php echo Url::log($value['a_id']);?>"><?php echo art_Model::getArtName($value['a_id']);?></a> </span>
											<span>评论内容：<?php echo $value['del']=='0'?'评论内容已删除':strip_tags($value['content']); ?></span>
										</p>
									</div>
									<div class="clear"></div>
								</div>
								<div class="line3"></div>
							</li>
							<?php }}else{?>
							<div class="comment_header">
								<p>榜单暂无更新</p>
							</div>
							<?php }?>
						</div>
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