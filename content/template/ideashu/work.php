<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="c1">
	<div class="content">
		<div class="centre">
			<div class="center">
				<div class="left cent_left">
					<div class="cent_info">
						<div class="cent_head">
							<span><img src="<?php echo user_Model::getUserPhoto($userinfo['id']);?>"/></span>
							<b><a target="_blank" href="<?php echo Url::author($uid);?>"> <?php echo $userinfo['name'];?> </a><?php echo $userinfo['sex']=='2'?'女士/先生':($userinfo['sex']=='0'?'女士':'先生');?></b>
						</div>
						<div class="cent_prove">
							<p><a href="#">1</a><a href="#">2</a><a href="#">3</a></p>
						</div>
						<div class="cent_mation">
							<p><b>ID号</b><span><?php echo $userinfo['username'];?></span></p>
							<p><b>权限</b><span><?php echo $roles[$userinfo['role']];?></span></p>
							<p><b>入驻</b><span><?php echo getToNowDays($userinfo['date']);?></span></p>
							<p><b>积分</b><span><?php echo $userinfo['order'];?> <a href="#">赚积分</a></span></p>
						</div>
					</div>
					<div class="cent_list">
						<ul id="c_left">
							<li><a id='nav_home' onClick="show(this);" href="<?php echo Url::work(UID);?>"><i class="icon aicon-home"></i>创作中心</a></li>
							<li>
								<a id='nav_write' onClick="show(this);" href="<?php echo Url::work(UID);?>write"><i class="icon aicon-write"></i>记笔记</a>
							</li>
							<li>
								<a id='nav_list' onClick="show(this);" href="<?php echo Url::work(UID);?>notes"><i class="icon aicon-list"></i>笔记列表</a>
							</li>
							<li>
								<a id='nav_bookmark' onClick="show(this);" href="<?php echo Url::work(UID);?>wish"><i class="icon aicon-page"></i>清单</a>
							</li>
							<li>
								<a id='nav_collect' onClick="show(this);" href="<?php echo Url::work(UID);?>collect"><i class="icon aicon-bookmark"></i>收藏</a>
							</li>
							<li>
								<a id='nav_chat' onClick="show(this);" href="<?php echo Url::work(UID);?>comment"><i class="icon aicon-chat"></i>评论</a>
							</li>
							<li>
								<a id='nav_data' onClick="show(this);" href="<?php echo Url::work(UID);?>data"><i class="icon aicon-data"></i>数据</a>
							</li>
							<li>
								<a id='nav_pass' onClick="show(this);" href="<?php echo Url::work(UID);?>set"><i class="icon aicon-pass"></i>设置</a>
							</li>
							<!--li>
								<span id='nav_pass' onClick="show(this);"><i class="icon aicon-pass"></i>系统<i class="icon aicon-fold"></i></span>
								<ul>
									<li><a id='nav_set' href="#"><i class="icon aicon-set"><i></i></i>设置</a></li>
									<li><a id='nav_data' href="#"><i class="icon aicon-data"></i>数据</a></li>
									<li><a id='nav_plugin' href="#"><i class="icon aicon-plugin"></i>插件</a></li>
									<li><a id='nav_info' href="#"><i class="icon aicon-info"></i>应用</a></li>
								</ul>
							</li-->
						</ul>
						<div class="line2"></div>
					</div>
				</div>
				<div class="right cent_right">
					<div class="cent_top">
						<li>
							<p><strong>笔记</strong></p>
							<p><b> 15 </b><span>篇</span></p>
						</li>
						<li>
							<p><strong>清单</strong></p>
							<p><b> 5 </b><span>张</span></p>
						</li>
						<li>
							<p><strong>收藏</strong></p>
							<p><b> 5 </b><span>篇</span></p>
						</li>
					</div>
					<div class="cent_nav">
						<p>您的位置 <a href="#">创作中心 ▸</a><a href="#">笔记列表 ▸</a></p>
					</div>
					<div class="cent_cont">
						<div class="cent_title"><p><b>创作中心</b></p></div>
						<div class="cent_title"><span><b>创作中心</b></span></div>
						<div class="m_list" id="m_list">
							<p><b>序号</b><b>名称</b><b>描述</b><b>显隐</b><b>图片</b><b>查看</b><b>操作</b></p>
							<p><span>1</span><span>名称1</span><span>描述1</span><span>显隐1</span><span>图片1</span><span>查看1</span><span>操作1</span></p>
							<p><span>2</span><span>名称1</span><span>描述1</span><span>显隐1</span><span>图片1</span><span>查看1</span><span>操作1</span></p>
							<p><span>3</span><span>名称1</span><span>描述1</span><span>显隐1</span><span>图片1</span><span>查看1</span><span>操作1</span></p>
							<p><span>4</span><span>名称1</span><span>描述1</span><span>显隐1</span><span>图片1</span><span>查看1</span><span>操作1</span></p>
						</div>
						<div class="line2"></div>
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