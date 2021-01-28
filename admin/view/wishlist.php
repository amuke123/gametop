<div class="c_right">
	<div class="main">
		<div class="m_title"><?php echo $action=='edit'?'编辑清单':'清单列表';?></div>
		<div class="m_content">
		<?php if($action=='edit'){?>
			<div class="m_add2">
			<form action="" method="post" name="wishadd" onSubmit="return yzWishAdd();" enctype="multipart/form-data" >
				<input type="hidden" name="id" value="<?php echo $wishinfo['id']?>" />
				<input type="hidden" name="show" value="<?php echo $wishinfo['show']?>" />
				<p><input type="text" class="formput" name="name" value="<?php echo $wishinfo['name']?>" placeholder="名称" /></p>
				<div class="group">
					<p><b>链接图标</b><img <?php echo $wishinfo['pic']==""?ADMIN_URL .'src="view/static/images/img.gif" title="无图"':'src="'.$wishinfo['pic'].'"';?> /><input type="hidden" name="pic2" value="<?php echo $wishinfo['pic']?>" /></p>
					<p><input type="file" class="formfile" name="pic" /></p>
				</div>
				<p><textarea name="text" class='formtext2' placeholder="描述"><?php echo $wishinfo['text']?></textarea></p>
				<p class="m_button"><input type="submit" class="m_sub" name='tj' value='保存' /><input type="button" onclick="javascript:window.history.back();" class="m_but2" value='取消' /></p>
			</form>
			</div>
		<?php }else{?>
			<form action="" method="post" name="myform">
				<?php $code=Checking::getAjCode(12);?>
				<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
				<div class="m_list" id="m_list">
					<p><b></b><b>清单</b><b>作者</b><b>清单封面</b><b>笔记数</b><b>创建日期</b><b>最后修改日期</b><b>说明</b><b>状态</b><b>收藏</b><b>点赞</b></p>
					<?php
					foreach($wishlists as $value){
						$pic = $value['pic']==""?ADMIN_URL .'/view/static/images/img.gif':$value['pic'];
						$wishs=explode(',',$value['artids']);
						$widhnum=count($wishs);
					?>
						<p>
						<span><input type="checkbox" name="artck[]" value="<?php echo $value['id'];?>" /></span>
						<span class="tleft">
							<a title="点击标题编辑清单" href="<?php echo  ADMIN_URL ."wishlist.php?action=edit&id=".$value['id'];?>"><?php echo $value['name']==''?'无名称':$value['name'];?></a>
						</span>
						<span><?php echo user_Model::getUserName($value['uid']);?></span>
						<span><a <?php echo $value['pic']==''?'':'target="_blank" class="listimg"';?> title="<?php echo $value['pic']==''?'无图':'点击图片可查看原图';?>" href="<?php echo $value['pic']==''?'':$pic;?>"><img src="<?php echo $pic;?>" /></a></span>
						<span><?php echo $widhnum;?></span>
						<span><?php echo $value['date']!=''?date("Y-m-d H:i:s",$value['date']):'';?></span>
						<span><?php echo $value['lastdate']!=''?date("Y-m-d H:i:s",$value['lastdate']):'';?></span>
						<span title="<?php echo $value['text'];?>"><?php echo mb_substr($value['text'],0,18);?>...</span>
						<span><a href="javascript:showOrHide('<?php echo $value['id']."','".IDEA_URL."','";echo $value['show']==0?'1':'0';?>','wishlist');"><?php echo $value['show']==0?'<img title="隐藏" src="'. ADMIN_URL .'/view/static/images/plugin_inactive.gif" />':'<img title="显示" src="'. ADMIN_URL .'/view/static/images/plugin_active.gif" />';?></a></span>
						<span><?php echo $value['follownum'];?></span>
						<span><?php echo $value['likenum'];?></span>
						</p>
					<?php }?>
				</div>
				<div class="m_set">
					<a id="allselect" href="javascript:allSelect('allselect');">全选</a> 选中项：<a class="red" href="javascript:delList('<?php echo IDEA_URL;?>','wishlist');">删除</a> 
				</div>
			</form>
		<?php }?>
		</div>
	</div>
</div>
<script>
window.onload=function(){
	autoShow('list','wish');
}
</script>