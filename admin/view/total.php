<?php
//print_r(get_tq());
?>
<div class="c_right">
	<div class="main">
		<div class="m_title">站点统计</div>
		<div class="total">
			<div class="to_user left">
				<div class="to_u_top">
					<h2><?php echo ROLE==ROLE_ADMIN?$name." - ".'超级管理员':$name." - ".'作者';?></h2>
					<p><img src="<?php echo $avatar;?>" /></p>
				</div>
				<div class="to_u_center">
					<ul>
						<li><i class="icon-notes"></i>笔记：<?php echo $sta_cache[UID]['artnum'];?></li>
						<li><i class="icon-collect"></i>收藏：<?php echo $userinfo['collectnum'];?></li>
						<li><i class="icon-follow"><i></i></i>关注：<?php echo $userinfo['prenum'];?></li>
						<li><i class="icon-fans"></i>粉丝：<?php echo $userinfo['pronum'];?></li>
					</ul>
				</div>
			</div>
			<div class="to_list right">
				<ul class="to_li_get">
					<?php 
					$lives=get_tq();
					$wd=(int)$lives['lives'][0]['temperature'];
					?>
					<li style="background:rgb(<?php echo 160+($wd-15)*3;?>,<?php echo 200-($wd-5)*3;?>,<?php echo 200-$wd*4;?>);">
						<span><?php echo $lives['lives'][0]['city']." : ";?></span>
						<b><?php echo $lives['lives'][0]['weather'];?></b>
						<i><?php echo $wd." ℃";?></i>
					</li>
					<li class="to_time" id="time"></li>
					<div class="clear"></div>
				</ul>
				<p><i class="icon-total"></i>数据统计</p>
				<ul class="to_li_data">
					<li>笔记：<a href="<?php echo ADMIN_URL .'article.php';?>"><?php echo $sta_cache['artnum'];?></a></li>
					<li>评论：<a href="<?php echo ADMIN_URL .'say.php';?>"><?php echo $sta_cache['saynum_all'];?></a></li>
					<li>清单：<a href="<?php echo ADMIN_URL .'wishlist.php';?>"><?php echo $sta_cache['wishlistnum'];?></a></li>
					<li>用户：<a href="<?php echo ADMIN_URL .'user.php';?>"><?php echo $sta_cache['usernum'];?></a></li>
					<li>标签：<a href="<?php echo ADMIN_URL .'tag.php';?>"><?php echo $sta_cache['tagsnum'];?></a></li>
					<li>友链：<a href="<?php echo ADMIN_URL .'link.php';?>"><?php echo $sta_cache['linknum'];?></a></li>
				</ul>
				<div class="clear"></div>
				<p><i class="icon-wait"></i>待办事项</p>
				<ul class="to_li_get">
					<li>待审笔记：<a href="<?php echo ADMIN_URL .'article.php?examine=0';?>"><?php echo $sta_cache['checknum'];?></a></li>
					<li>待审评论：<a href="<?php echo ADMIN_URL .'say.php?examine=0';?>"><?php echo $sta_cache['checksay'];?></a></li>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="m_infor"><i class="icon-bell"></i><b>提示：</b>如果统计数据不准确，请点击此处<a href="<?php echo Url::getActionUrl('setcache');?>">更新缓存</a>即可更新为网站最新数据。</div>
	</div>
</div>
<script>
window.onload=function(){
	autoShow('home');
	start();
}

</script>