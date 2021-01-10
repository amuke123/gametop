<div class="c_right">
	<div class="main">
		<div class="m_title">插件</div>
		<div class="m_content">
			<form action="" method="post" name="myform">
				<?php $code=Checking::getAjCode(12);?>
				<input type="hidden" name='ajcode' id='ajcode' value="<?php echo $code;?>" />
				<div class="m_list" id="m_list">
					<p><b></b><b>开启/禁用</b><b>版本</b><b>描述</b><b></b></p>
					<p>
						<span><a href="#">垃圾评论拦截插件 <img src='<?php echo ADMIN_URL . "/view/static/images/set.png";?>' /></a></span>
						<span><a href="#"><img title='查看' src='<?php echo ADMIN_URL . "/view/static/images/plugin_active.gif";?>' /></a></span>
						<span>1.1</span>
						<span class="tleft linesort">尝试判断垃圾评论并过滤之，可设置IP黑名单和屏蔽词汇<br/>作者： <a href="#">苏晓晴</a></span>
						<span> <a href="#">删除</a></span>
					</p>
					<p>
						<span><a href="#">垃圾评论拦截插件 <img src='<?php echo ADMIN_URL . "/view/static/images/set.png";?>' /></a></span>
						<span><a href="#"><img title='查看' src='<?php echo ADMIN_URL . "/view/static/images/plugin_active.gif";?>' /></a></span>
						<span>1.1</span>
						<span class="tleft linesort">尝试判断垃圾评论并过滤之，可设置IP黑名单和屏蔽词汇<br/>作者： <a href="#">苏晓晴</a></span>
						<span> <a href="#">删除</a></span>
					</p>
				</div>
				<div class="m_button">
					<input type="button" onClick="javascript:location.href='<?php echo ADMIN_URL .'plugin.php?action=add';?>';" class="m_but" name='add' value='安装插件 +' />
				</div>
			</form>
		</div>
		<?php 
		$preopin='pass';$nextopin='plugin';
		if(isset($_GET['plugin'])){
			$preopin='expand';
			$nextopin='more_'.$_GET['plugin'];
		}
		?>
		
	</div>
</div>
<script>
window.onload=function(){
	autoShow('<?php echo $preopin;?>','<?php echo $nextopin;?>');
}
</script>