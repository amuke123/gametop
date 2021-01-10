<div class="c_right">
	<div class="main">
		<div class="m_title">设置</div>
		<?php $code=Checking::getAjCode(12);?>
		<div class="m_content">
			<div class="navlist" id="navlist">
				<ul>
					<li class="active"><a href="javascript:void(0);" onclick="changeSet(1)">系统设置</a></li>
					<li><a href="javascript:void(0);" onclick="changeSet(2)">SEO设置</a></li>
					<li><a href="javascript:void(0);" onclick="changeSet(3)">邮件设置</a></li>
				</ul>
				<div class="clear"></div>
			</div><!--li><a href="javascript:void(0);" onclick="changeSet(4)">个人设置</a></li-->
			<div class="cont">
				<div class="cont1" id="cont1">
					<form action="" name="myform1" method="post">
						<p><b>网站标题：</b></p><p><input name="sitename" type="text" class="long" value="<?php echo SITE_NAME;?>" /></p>
						<p><b>网站副标题：</b></p><p>
						  <textarea name="siteinfo" class="long"><?php echo Control::get('siteinfo');?></textarea>
						</p>
						<p><b>网站域名：</b></p><p><input name="siteurl" type="text"  class="long" value="<?php echo Control::get('siteurl');?>" /></p>
						<p><b>每页显示</b><input name="artnum" type="text" class="short" value="<?php echo Control::get('art_num');?>" /><b>篇文章</b></p>
						<p><b>后台每页显示</b><input name="adminnum" type="text" class="short" value="<?php echo Control::get('admin_page_num');?>" /><b>项（笔记、用户、评论）</b></p>
						
						<p><b>你所在时区：</b><select name="timezone">
							<?php 
							foreach($timelist as $key => $value){
							?>
								<option value="<?php echo $key;?>" <?php echo $key!=Control::get('time_zone')?'':'selected="selected"';?>><?php echo $value;?></option>
							<?php 
							}?>
						</select></p>
						<p><b>自动生成登录名前缀：</b><input name="userpre" type="text" value="<?php echo Control::get('userpre');?>" /></p>
						
						<p><input name="artcheck" type="checkbox" value="1" <?php echo Control::get('excerpt')==1?'checked="checked"':'';?> /><b>用户文章审核</b></p>
						
						<p><input name="logincode" type="checkbox" value="1" <?php echo Control::get('login_code')==1?'checked="checked"':'';?> /><b>登录验证码</b></p>
						<p><input name="excerpt" type="checkbox" value="1" <?php echo Control::get('excerpt')==1?'checked="checked"':'';?> /><b>自动摘要，截取文章的前</b><input name="excnum" type="text" value="<?php echo Control::get('excerpt_long');?>" class="short2" /><b>个字作为摘要</b></p>
						<p><input name="comment" type="checkbox" value="1" <?php echo Control::get('sayok')==1?'checked="checked"':'';?> /><b>开启评论，发表评论间隔</b><input name="comtime" type="text" value="<?php echo Control::get('say_time');?>" class="short" /><b>秒</b></p>
						<p><input name="comcheck" type="checkbox" value="1" <?php echo Control::get('say_check')==1?'checked="checked"':'';?> /><b>评论审核</b></p>
						<p><input name="comcode" type="checkbox" value="1" <?php echo Control::get('say_code')==1?'checked="checked"':'';?> /><b>评论验证码</b></p>
						<p><input name="comgravatar" type="checkbox" value="1" <?php echo Control::get('say_gravatar')==1?'checked="checked"':'';?> /><b>评论人头像</b></p>
						<p><input name="comchinese" type="checkbox" value="1" <?php echo Control::get('say_chinese')==1?'checked="checked"':'';?> /><b>评论是否需要包含中文</b></p>
						<p><input name="replycode" type="checkbox" value="1" <?php echo Control::get('reply_code')==1?'checked="checked"':'';?> /><b>回复评论验证码</b></p>
						<p><input name="compage" type="checkbox" value="1" <?php echo Control::get('say_page')==1?'checked="checked"':'';?> /><b>评启分页，每页显示</b><input name="comnum" type="text" value="<?php echo Control::get('say_pnum');?>" class="short" /><b>条评论，</b><select name="comisnew"><option value="0" <?php echo Control::get('say_order')==0?'selected':'';?>>较老的</option><option value="1" <?php echo Control::get('say_order')==1?'selected':'';?>>较新的</option></select><b>排在前面</b></p>
						
						<p><input name="maxsize" type="text" value="<?php echo Control::get('file_maxsize');?>" class="short" /><b>MB，附件上传最大限制。</b></p>
						<p><input name="filetype" class="long3" type="text" value="<?php echo Control::get('file_type');?>" /><b>允许上传的文件类型（多个用半角逗号分隔）</b></p>
						<p><input name="thumbnail" type="checkbox" value="1" <?php echo Control::get('thumbnailok')==1?'checked="checked"':'';?> /><b>上传图片生成缩略图，最大尺寸：</b><input name="filewidth" type="text" value="<?php echo Control::get('thum_imgmaxw');?>" class="short2" /><b> X </b><input name="fileheight" type="text" value="<?php echo Control::get('thum_imgmaxh');?>" class="short2" /><b>（单位：像素）</b></p>
						
						<p><b>备案号：</b></p><p><input name="icp" type="text" class="long" value="<?php echo Control::get('icp');?>" /></p>
						<p><b>底部统计代码：</b></p><p><textarea name="footinfo" class="long4"><?php echo Control::get('footer_info');?></textarea></p>
						<p><b>网站验证：</b></p><p><textarea name="headmeta" class="long4"><?php echo Control::get('header_meta');?></textarea></p>
						<span><input name="checking" type="hidden" value="<?php echo $code;?>" /></span>
						<p><br/><input name="tjsys" type="submit" value="保存设置" /></p>
					</form>
				</div>
				<div class="cont2" id="cont2">
					<form action="" name="myform2" method="post">
						<p><h3>文章链接设置</h3></p>
						<p><span>你可以在这里修改文章链接的形式，如果修改后文章无法访问，那可能是你的服务器空间不支持URL重写，请修改回默认形式、关闭文章连接别名。 启用链接别名后可以自定义文章和页面的链接地址。</span></p>
						<p><input name="urltype" type="radio" value="1" <?php echo Control::get('url_type')==1?'checked':'';?> /><b>默认形式:/?post=1</b></p>
						<p><input name="urltype" type="radio" value="2" <?php echo Control::get('url_type')==2?'checked':'';?> /><b>文件形式：/post-1.html</b></p>
						<p><input name="urltype" type="radio" value="3" <?php echo Control::get('url_type')==3?'checked':'';?> /><b>分类形式：/category/1.html</b></p>
						<p><input name="alias" type="checkbox" value="1" <?php echo Control::get('aliasok')==1?'checked="checked"':'';?> /><b>启用文章链接别名</b></p>
						<p><input name="html" type="checkbox" value="1" <?php echo Control::get('htmlok')==1?'checked="checked"':'';?> /><b>启用文章链接别名html后缀</b></p>
						<p><h3>网站meta信息设置</h3></p>
						<p><b>网站浏览器标题(title)：</b></p><p><input name="sitetitle" type="text" class="long" value="<?php echo Control::get('seo_title');?>" /></p>
						<p><b>网站关键字(keywords)：</b></p><p><input name="key" type="text" class="long" value="<?php echo Control::get('seo_key');?>" /></p>
						<p><b>网站浏览器描述(description)：</b></p><p>
						  <textarea name="description" class="long"><?php echo Control::get('seo_description');?></textarea>
						</p>
						<p><b>网站浏览器标题显示方案：</b></p>
						<p><select name="seotype">
							<option value="1" <?php echo Control::get('seo_type')==1?'selected="selected"':'';?>>文章标题</option>
							<option value="2" <?php echo Control::get('seo_type')==2?'selected="selected"':'';?>>文章标题 - 站点标题</option>
							<option value="3" <?php echo Control::get('seo_type')==3?'selected="selected"':'';?>>文章标题 - 站点浏览器标题</option>
						</select></p>
						<span><input name="checking" type="hidden" value="<?php echo $code;?>" /></span>
						<p><br/><input name="tjseo" type="submit" value="保存设置" /></p>
					</form>
				</div>
				<div class="cont3" id="cont3">
					<form action="" name="myform3" method="post">
						<p><b>邮件服务器 （ 如：smtp.163.com   smtp.qq.com ）</b></p>
						<p><input name="mailhost" type="text" class="long" value="<?php echo Control::get('mailhost');?>" /></p>
						<p><b>服务器账号</b></p>
						<p><input name="mail" type="text"  class="long" value="<?php echo Control::get('mail');?>" /></p>
						<p><b>邮箱发送密码</b></p>
						<p><input name="mailpswd" type="text"  class="long" value="<?php echo Control::get('mailpswd');?>" /></p>
						<p><b>端口号</b></p>
						<p><input name="mailport" type="text"  class="long" value="<?php echo Control::get('mailport');?>" /></p>
						<span><input name="checking" type="hidden" value="<?php echo $code;?>" /></span>
						<p><br/><input name="tjmail" type="submit" value="保存设置" /></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if($action=='seo'){echo "<script>changeSet(2)</script>";}
if($action=='mail'){echo "<script>changeSet(3)</script>";}
if($action=='info'){echo "<script>changeSet(4)</script>";}
?>
<script>
window.onload=function(){
	autoShow('pass','set');
}
</script>