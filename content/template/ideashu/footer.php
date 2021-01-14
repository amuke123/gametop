<?php
if(!defined('IDEA_ROOT')){exit('error!');}
?>
<div class="hint" id="hint"></div>
<div class="c1">
	<div class="content">
		<footer>
			<div class="center">
				<div class="f_list">
					<a href="<?php echo IDEA_URL;?>">首页</a><a href="<?php echo IDEA_URL .'download.html';?>">下载</a><a href="<?php echo IDEA_URL .'about.html';?>">关于</a><a href="<?php echo IDEA_URL .'disclaimer.html';?>">免责</a><a href="<?php echo IDEA_URL .'message.html';?>">留言</a>
				</div>
				<div class="f_info">
					<p>Copyright © 2019-2020 <a href="<?php echo IDEA_URL;?>" title="IDEASHU·<?php echo $siteinfo;?>" target="_blank"><?php echo $SITE_NAME;?></a> All Rights Reserved. <a href="https://beian.miit.gov.cn/" target="_blank"><?php echo $icp;?></a> <?php echo $footer_info;?> <?php doAction('index_footer');?></p>
				</div>
			</div>
		</footer>
	</div>
</div>
</body>
</html>