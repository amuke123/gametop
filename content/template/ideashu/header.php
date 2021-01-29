<?php
/*
Template Name:IDEASHU
Description:IDEASHU模板，简洁优雅
Author:IDEASHU
Author Url:https://www.ideashu.com
*/
if(!defined('IDEA_ROOT')){exit('error!');}
require_once View::getView('function');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="amuker" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo TEMPLATE_URL;?>style/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL;?>style/index.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL;?>style/icono.css" rel="stylesheet" type="text/css" />
<link href="<?php echo IDEA_URL . ADMIN_TYPE;?>/view/static/style/icon.css" rel="stylesheet" type="text/css" />
<link href="<?php echo IDEA_URL . ADMIN_TYPE;?>/editor/themes/code/prettify.css" rel="stylesheet" type="text/css" />
<?php echo $header_meta;?>
<script src="<?php echo TEMPLATE_URL;?>js/index.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL;?>js/action.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL;?>js/ajax.js" type="text/javascript"></script>
<?php doAction('index_head');?>
</head>
<body>
<div class="c1">
	<div class="content">
		<header>
			<div class="center">
				<div class="left h_logo"><a href="<?php echo IDEA_URL;?>"><img src="<?php echo TEMPLATE_URL;?>images/logo.png" /><b><?php echo SITE_NAME;?></b></a></div>
				<div class="left h_nav">
					<ul>
						<?php site_nav();?>
					</ul>
				</div>
				<div class="right h_s">
					<div class="left h_search">
						<form action="<?php echo IDEA_URL;?>" method="get" name="so">
							<input class="h_s_key" type="text" name="keyword" placeholder="您有一颗发现美的眼睛" value="">
							<i class="icno-search"></i>
							<input class="h_s_bt" type="submit" value="">
						</form>
					</div>
					<?php if(UID==0){?>
					<div class="left h_user">
						<a href="<?php echo Url::getActionUrl('login');?>">登陆</a><a href="<?php echo Url::getActionUrl('register');?>">注册</a>
					</div>
					<?php
					}else{
						$userData=user_Model::getInfo(UID);
						$avatar = empty($userData['avatar']) ? IDEA_URL . ADMIN_TYPE .'/view/static/images/avatar.jpg' : '../' . $userData['avatar'];
						$name = $userData['name'];
					?>
					<div class="h_login right">
						<ul>
							<li class="h_login_zx"><b><img src="<?php echo $avatar;?>" title="<?php echo $name;?>" /></b>
							<p><a href="<?php echo Url::setting(UID);?>">设置</a><a href="<?php echo Url::person(UID);?>">管理中心</a><a href="<?php echo Url::work(UID);?>" target="_blank">创作平台</a><?php if(ROLE==ROLE_ADMIN){?><a  target="_blank" href="<?php echo IDEA_URL .ADMIN_TYPE; ?>">后台管理</a><?php }?><a href="<?php echo Url::getActionUrl('goout');?>">退出</a><p>
							</li>
						</ul>
					</div>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div>
		</header>
	</div>
</div>