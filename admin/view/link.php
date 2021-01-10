<div class="c_right">
	<div class="main">
	<?php if($action=='edit'){?>
		<div class="m_title">编辑友链</div>
		<div class="m_add2">
			<form action="" method="post" name="linkadd" onSubmit="return yzLinkAdd();" enctype="multipart/form-data" >
				<p>
					<select name="group" class="formsele">
						<option value='0' <?php echo $links[$linkid]['group']==0?'selected':'';?>><?php echo $groups[0];?></option>
						<option value='1' <?php echo $links[$linkid]['group']==1?'selected':'';?>><?php echo $groups[1];?></option>
					</select>
				</p>
				<input type="hidden" name="id" value="<?php echo $links[$linkid]['id']?>" />
				<input type="hidden" name="show" value="<?php echo $links[$linkid]['show']?>" />
				<p><input type="text" class="formin" name="index" value="<?php echo $links[$linkid]['index']?>" placeholder="序号" /></p>
				<p><input type="text" class="formput" name="sitename" value="<?php echo $links[$linkid]['name']?>" placeholder="名称" /></p>
				<p><input type="text" class="formput" name="siteurl" value="<?php echo $links[$linkid]['url']?>" placeholder="链接" /></p>
				<div class="group">
					<p><b>链接图标</b><img <?php echo $links[$linkid]['pic']==""?ADMIN_URL .'src="view/static/images/img.gif" title="无图"':'src="'.$links[$linkid]['pic'].'"';?> /><input type="hidden" name="pic2" value="<?php echo $links[$linkid]['pic']?>" /></p>
					<p><input type="file" class="formfile" name="pic" /></p>
				</div>
				<p><textarea name="description" class='formtext2' placeholder="描述"><?php echo $links[$linkid]['des']?></textarea></p>
				<p class="m_button"><input type="submit" class="m_sub" name='add' value='保存' /><input type="button" onclick="javascript:window.history.back();" class="m_but2" value='取消' /></p>
			</form>
		</div>
	<?php }else{?>
		<div class="m_title">友链管理</div>
		<div class="m_content">
			<div class="m_set">
				<div class="left">
					<select name="novesort" onChange="jumpMenu('parent',this,0)">
						<option value="<?php echo ADMIN_URL .'link.php';?>">全部链接..</option>
						<option value="<?php echo ADMIN_URL .'link.php?g=0';?>" <?php echo $gids=='0'?'selected':'';?> ><?php echo $groups[0];?></option>
						<option value="<?php echo ADMIN_URL .'link.php?g=1';?>" <?php echo $gids=='1'?'selected':'';?> ><?php echo $groups[1];?></option>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<form action="?action=index" method="post" name="myform">
				<?php $code=Checking::getAjCode(12);?>
				<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
				<div class="m_list" id="m_list">
					<p><b>序号</b><b>名称</b><b>描述</b><b>显隐</b><b>图片</b><b>查看</b><b>组</b><b>操作</b></p>
					<?php
					foreach($links as $value){
						$pic=$value['pic']==""?ADMIN_URL .'/view/static/images/img.gif':$value['pic'];
						if($gids<0){
					?>
							<p class="high <?php echo $value['show']=='0'?'gray':'';?>">
							<span><input type="text" name="num[]" alt="<?php echo $value['id'];?>" value="<?php echo $value['index'];?>" /></span>
							<span class="tleft"><a title="点击进入编辑" href="?action=edit&id=<?php echo $value['id'];?>"><?php echo $value['name']==''?'无名称':$value['name'];?></a></span>
							<span><?php echo $value['des'];?></span>
							<span><a href="javascript:showOrHide('<?php echo $value['id']."','".IDEA_URL."','";echo $value['show']==0?'1':'0';?>','link');"><?php echo $value['show']=="1"?'<img title="显示" src="'. ADMIN_URL .'/view/static/images/plugin_active.gif" />':'<img title="隐藏" src="'. ADMIN_URL .'/view/static/images/plugin_inactive.gif" />';?></a></span>
							<span><a <?php echo $value['pic']==''?'':'target="_blank" class="listimg" ';?> href="<?php echo $value['pic']==''?'':$pic;?>" title="<?php echo $value['pic']==''?'无图':'点击图片可查看原图';?>"><img src="<?php echo $pic;?>" /></a></span>
							<span><a  target="_blank" href="<?php echo $value['url'];?>"><img title='查看' src='<?php echo ADMIN_URL . "/view/static/images/eye.png";?>' /></a></span>
							<span><?php echo $groups[$value['group']];?></span>
							<span><a href="javascript:delLine('<?php echo $value['id']."','".IDEA_URL;?>','link');"><img title='删除' src='<?php echo ADMIN_URL . "/view/static/images/icon_error.gif";?>' /></a></span>
							</p>
						<?php }else{
							if($value['group']==$gids){
						?>
							<p class="high <?php echo $value['show']=='0'?'gray':'';?>">
							<span><input type="text" name="num[]" alt="<?php echo $value['id'];?>" value="<?php echo $value['index'];?>" /></span>
							<span class="tleft"><a title="点击进入编辑" href="?action=edit&id=<?php echo $value['id'];?>"><?php echo $value['name']==''?'无名称':$value['name'];?></a></span>
							<span><a href="javascript:showOrHide('<?php echo $value['id']."','".IDEA_URL."','";echo $value['show']==0?'1':'0';?>','link');"><?php echo $value['show']=="1"?'<img title="显示" src="'. ADMIN_URL .'/view/static/images/plugin_active.gif" />':'<img title="隐藏" src="'. ADMIN_URL .'/view/static/images/plugin_inactive.gif" />';?></a></span>
							<span><a <?php echo $value['pic']==''?'':'target="_blank"';?> class="listimg" href="<?php echo $value['pic']==''?'':$pic;?>" title="<?php echo $value['pic']==''?'无图':'点击图片可查看原图';?>"><img src="<?php echo $pic;?>" /></a></span>
							<span><?php echo $groups[$value['group']];?></span>
							<span><a  target="_blank" href="<?php echo $value['url'];?>"><img title='查看' src='<?php echo ADMIN_URL . "/view/static/images/eye.png";?>' /></a></span>
							<span><?php echo $value['des'];?></span>
							<span><a href="javascript:delLine('<?php echo $value['id']."','".IDEA_URL;?>','link');"><img title='删除' src='<?php echo ADMIN_URL . "/view/static/images/icon_error.gif";?>' /></a></span>
							</p>
						<?php }
						}?>
					<?php }?>
				</div>
				<div class="m_button">
					<input type="button" onClick="javascript:change_index('<?php echo IDEA_URL;?>','link');" class="m_sub" name='tj' value='更改序号' /><input type="button" onClick="javascript:show_add('link_add');" class="m_but" name='add' value='新建链接 +' />
				</div>
			</form>
		</div>
		<div class="m_add" id="link_add">
			<form action="" method="post" name="linkadd" onSubmit="return yzLinkAdd();" enctype="multipart/form-data" >
				<p>
					<select name="group" class="formsele">
						<option value='0'><?php echo $groups[0];?></option>
						<option value='1'><?php echo $groups[1];?></option>
					</select>
				</p>
				<p><input type="text" class="formin" name="index" placeholder="序号" /></p>
				<p><input type="text" class="formput" name="sitename" placeholder="名称" /></p>
				<p><input type="text" class="formput" name="siteurl" placeholder="链接" /></p>
				<div class="group">
					<p><b>链接图标</b></p>
					<p><input type="file" class="formfile" name="pic" /></p>
				</div>
				<p><textarea name="description" class='formtext2' placeholder="描述"></textarea></p>
				<p class="m_button"><input type="submit" class="m_sub" name='add' value='添加链接' /></p>
			</form>
		</div>
		
	<?php }?>
	</div>
</div>
<script>
window.onload=function(){
	autoShow('bookmark','link');
}
</script>