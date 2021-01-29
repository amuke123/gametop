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
						</div>
						<div class="cent_prove"><p><b><a target="_blank" href="<?php echo Url::author($uid);?>"> <?php echo $userinfo['name'];?> </a><?php echo $userinfo['sex']=='2'?'女生/先生':($userinfo['sex']=='0'?'女生':'先生');?></b></p></div>
						<div class="cent_mation">
							<p><b>ID号</b><span><?php echo $userinfo['username'];?></span></p>
							<p><b>权限</b><span><?php echo $roles[$userinfo['role']];?></span></p>
							<p><b>入驻</b><span><?php echo getToNowDays($userinfo['date']);?></span></p>
						</div>
					</div>
					<div class="cent_list">
						<ul id="c_left">
							<li id='nav_0'><a href="<?php echo Url::setting(UID);?>"><i class="icon aicon-user"></i>个人设置</a></li>
							<li id='nav_1'><a href="<?php echo Url::setting(UID);?>account"><i class="icon aicon-pass"></i>安全设置</a></li>
							<li id='nav_2'><a href="<?php echo Url::setting(UID);?>preference"><i class="icon aicon-tian"></i>个性设置</a></li>
							<li id='nav_3'><a href="<?php echo Url::setting(UID);?>wishset"><i class="icon aicon-page"></i>我的清单</a></li>
							<li id='nav_4'><a href="<?php echo Url::setting(UID);?>collect"><i class="icon aicon-bookmark"></i>关注与收藏</a></li>
						</ul>
						<div class="line2"></div>
					</div>
				</div>
				<div class="right cent_right">
					<div class="cent_nav">
						<p>您的位置： <a href="<?php echo Url::setting(UID);?>">设置 ▸</a><a href="<?php echo Url::setting(UID);echo $settype;?>"><?php echo  $settxt;?></a></p>
					</div>
					<div class="cent_lw" id="cent_lw">
						<div class="cent_li">
							<form action="" method="post">
								<li>
									<p><b>昵称</b></p>
									<p><span><input type="text" class="ptt" name="nickname" value="<?php echo $userinfo['nickname'];?>"></span></p>
								</li>
								<li>
									<p><b>性别</b></p>
									<p>
										<span><input type="radio" name="sex" <?php echo $userinfo['sex']=='1'?'checked ':'';?> value="1"> 男</span>
										<span><input type="radio" name="sex" <?php echo $userinfo['sex']=='0'?'checked ':'';?> value="0"> 女</span>
										<span><input type="radio" name="sex" <?php echo $userinfo['sex']=='2'?'checked ':'';?> value="2"> 保密</span>
									</p>
								</li>
								<li>
									<p><b>生日</b></p>
									<p><span><input type="date" class="ptt" name="birthday" value="<?php echo $userinfo['birthday'];?>"></span></p>
								</li>
								<li>
									<p><b>介绍一下自己：</b></p>
									<p><span><textarea name="description" placeholder="留下点什么吧"><?php echo $userinfo['description'];?></textarea></span></p>
								</li>
								<p><em><input type="submit" class="xg" name="tj" value="修改"></em></p>
							</form>
							<div class="line2"></div>
						</div>
						<div class="cent_li">
							<li>
								<p><b>邮箱</b></p>
								<p><span><?php echo hideEmail($userinfo['email']);?> </span><span><img align="absmiddle" title="<?php echo $userinfo['emailok']?'已认证':'未认证';?>" src="<?php echo IDEA_URL .ADMIN_TYPE .'/view/static/images/';echo $userinfo['emailok']?'onsel.gif':'onsel2.gif';?>"></span><span><a href="#" title="修改/认证"><i class="icon aicon-write"></i>&nbsp;</a></span></p>
							</li>
							<li>
								<p><b>手机</b></p>
								<p><span><?php if(!empty($userinfo['tel'])){echo substr_replace($userinfo['tel'], '****', 5, 4);}?></span><span><img align="absmiddle" title="<?php echo $userinfo['telok']?'已认证':'未认证';?>" src="<?php echo IDEA_URL .ADMIN_TYPE .'/view/static/images/';echo $userinfo['telok']?'onsel.gif':'onsel2.gif';?>"></span><span><a href="#" title="修改/认证"><i class="icon aicon-write"></i>&nbsp;</a></span></p>
							</li>
							<li>
								<p><b>密码</b></p>
								<p><span><a href="#" title="修改密码"><i class="icon aicon-write"></i>&nbsp;</a></span></p>
							</li>
							<li>
								<p><b>第三方账号绑定</b></p>
								<p><span>微信 微博 QQ</span></p>
							</li>
							<div class="line2"></div>
						</div>
						<div class="cent_li">
							<li>
								<p><b>个性域名</b></p>
								<form action="" method="post">
									<p><span><?php echo IDEA_URL .'author/';?><i id="diyurl"><?php echo $userinfo['diyurl'];?><input type="text" class="ptt" name="diyurl" value="<?php echo $userinfo['diyurl'];?>"></i></span>
									<span><a href="#" title="修改"><i class="icon aicon-write"></i>&nbsp;</a></span></p>
								</form>
							</li>
							<li>
								<p><b>配色方案</b></p>
								<form action="" method="post">
									<p><span><select name="colorstyle">
										<option value="">默认配色</option>
										<option value="blue">蓝色</option>
										<option value="red">红色</option>
										<option value="orange">橙色</option>
										<option value="green">绿色</option>
									</select></span></p>
								</form>
							</li>
							<li>
								<p><b>自定义背景</b></p>
								<form action="" method="post">
									<p><span><select name="color">
										<option value="color">纯色</option>
										<option value="image">图片</option>
									</select></span></p>
									<p><span><input type="color" class="cl" name="bgpic" value="<?php echo $userinfo['bgpic'];?>">
									<img src="<?php echo $userinfo['bgpic'];?>" /><input type="file" name="bgpic"></span></p>
								</form>
							</li>
							<div class="line2"></div>
						</div>
						<div class="cent_li">
							<li>
								<p><b>清单设置</b></p>
								<p><span></span></p>
							</li>
							<div class="line2"></div>
						</div>
						<div class="cent_li">
							<li>
								<p><b>关注的清单</b></p>
								<p><span></span></p>
							</li>
							<li>
								<p><b>关注的设计师</b></p>
								<p><span></span></p>
							</li>
							<li>
								<p><b>收藏的笔记</b></p>
								<p><span></span></p>
							</li>
							<div class="line2"></div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<script>
setShow(<?php echo $keynum;?>);
</script>
<?php
include View::getView('footer');
?>