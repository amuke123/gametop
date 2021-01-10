<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>管理中心-<?php echo SITE_NAME;?></title>
<link href="<?php echo TEMPLATE_URLA;?>static/style/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo TEMPLATE_URLA;?>static/style/main.css" rel="stylesheet" type="text/css">
<link href="<?php echo TEMPLATE_URLA;?>static/style/icon.css" rel="stylesheet" type="text/css">
<script charset="utf-8" src="<?php echo TEMPLATE_URLA;?>static/js/action.js"></script>
<script charset="utf-8" src="<?php echo TEMPLATE_URLA;?>static/js/ajax.js"></script>
<script charset="utf-8" src="<?php echo TEMPLATE_URLA;?>static/js/index.js"></script>
<script src="<?php echo ADMIN_URL;?>editor/mukeEditor.js"></script>
</head>

<body>
<div class="header">
	<div class="left h_logo"><a href="<?php echo IDEA_URL;?>" target="_blank" title="查看站点"><img src="<?php echo TEMPLATE_URLA;?>static/images/logo.png" alt="IDEASHU" /></a></div>
	<div class="left h_title"><a href="<?php echo ADMIN_URL;?>" title="系统主页">管理中心-<?php echo SITE_NAME;?></a></div>
	<div class="right h_right">
		<div class="left h_cache"><a href="<?php echo Url::getActionUrl('setcache');?>">更新缓存</a></div>
		<div class="left h_user">
			<span><?php echo $name;?></span>
			<ul>
				<li><a href="<?php echo ADMIN_URL.'system.php';?>">网站设置</a></li>
				<li><a target="_blank" href="<?php echo Url::person(UID);?>">个人中心</a></li>
				<li><a target="_blank" href="<?php echo Url::work(UID);?>">创作中心</a></li>
				<li><a target="_blank" href="<?php echo Url::setting(UID);?>">个人设置</a></li>
			</ul>
		</div>
		<div class="left h_out"><a href="<?php echo Url::getActionUrl('goout');?>">退出</a></div>
	</div>
</div>
<div class="content"></div>
<?php
include_once View::getViewA('navlist');
?>