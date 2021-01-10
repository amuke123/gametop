<div class="c_right">
	<div class="main">
		<div class="m_title">修改导航</div>
		<div class="m_content">
			<div class="m_add2">
				<form action="" method="post" name="navadddiy" onSubmit="return yzNavAdd();" enctype="multipart/form-data" >
					<input type="hidden" name="id" value="<?php echo $navline['id'];?>" />
					<?php if($navline['type']!='1'){?>
					<p>
						<select name="group" class="formsele">
							<option value="0">默认分组</option>
							<option value="1" <?php echo $navline['group']=="1"?'selected':'';?>>分组1</option>
							<option value="2" <?php echo $navline['group']=="2"?'selected':'';?>>分组2</option>
							<option value="3" <?php echo $navline['group']=="3"?'selected':'';?>>分组3</option>
							<option value="4" <?php echo $navline['group']=="4"?'selected':'';?>>分组4</option>
						</select> <b>分组</b>
					</p>
					<?php }?>
					<p><input type="text" class="formin" name="index" value="<?php echo $navline['index'];?>" placeholder="序号" /> <b>序号</b></p>
					<p><input type="text" class="formput" name="name" value="<?php echo $navline['name'];?>" placeholder="导航名称" /> <b>导航名称</b></p>
					<p><input type="text" class="formput" name="url" <?php if($navline['type']!='0'){echo "disabled='disabled'";}?> value="<?php echo $navline['type']!='0'?'该导航地址由系统生成，无法修改':$navline['url'];?>" placeholder="链接(带http或https)" /> <b>导航地址</b></p>
					<div class="group">
						<p><img <?php echo $navline['pic']==""?'src="'.ADMIN_URL .'view/static/images/img.gif" class="xt" title="无图"':'src="'.$navline['pic'].'"';?> /><input type="hidden" name="pic2" value="<?php echo $navline['pic'];?>" /> <b>导航图标</b></p>
						<p><input type="file" class="formfile" name="pic" /></p>
					</div>
					<?php if($navline['type']=='0'){?>
					<p>
						<select name="topid" class="formsele">
							<option value="0">无</option>
							<?php
							foreach($navs as $valuena){
								if($valuena['group']==$group){
									if($valuena['type']=='0'&&$valuena['top_id']=='0'){
							?>
										<option value="<?php echo $valuena['id'];?>" <?php echo $navline['top_id']==$valuena['id']?'selected':'';?> ><?php echo $valuena['name'];?></option>
							<?php 
										$childnav2=isset($valuena['childnav'])?$valuena['childnav']:'';
										if($childnav2!=''){
											foreach($childnav2 as $val2){
							?>
												<option value="<?php echo $navs[$val2]['id'];?>" <?php echo $navline['top_id']==$valuena['id']?'selected':'';?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $navs[$val2]['name'];?></option>
							<?php
											}
										}
									}
								}
							}?>
						</select> <b>父导航</b>
					</p>
					<?php }?>
					<p>
						<select name="blank" class="formsele">
							<option value="0">当前页打开</option>
							<option value="1" <?php echo $navline['blank']=='1'?'selected':'';?>>新页面打开</option>
						</select> <b>打开方式</b>
					</p>
					<p class="m_button"><input type="submit" class="m_sub" name='adddiy' value='保存修改' /><input type="button" onclick="window.history.back();" class="m_but2" value='取消' /></p>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
window.onload=function(){
	autoShow('eye','nav');
}
</script>