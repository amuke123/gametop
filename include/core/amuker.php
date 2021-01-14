<?php
ob_start();
//error_reporting(0);//屏蔽错误
header('Content-Type: text/html; charset=UTF-8');
define('IDEA_ROOT', dirname(dirname(dirname(__FILE__))));
if(extension_loaded('mbstring')) {
	mb_internal_encoding('UTF-8');
}
require_once IDEA_ROOT.'/include/core/config.php';
require_once IDEA_ROOT.'/include/core/function.main.php';

spl_autoload_register("mkAutoload");
doStripslashes();

//权限
define('ROLE_ADMIN','admin');
define('ROLE_WRITER','writer');
define('ROLE_VISITOR','visitor');

$cache = Conn::getCache();
//$cache -> updateCache();
$uid = !empty(Checking::isLogin())?Checking::isLogin():0;
define('UID',$uid);
$userData = UID!=0?user_Model::getInfo():array();
define('ROLE', UID!=0?$userData['role']:ROLE_VISITOR);

//设置时区
date_default_timezone_set(Control::get('time_zone'));

define('SITE_NAME',Control::get('sitename'));//网站名称
//echo SITE_NAME;

$mkHooks=array();

$siteurl=substr(Control::get('siteurl'),-1)=="/"?Control::get('siteurl'):Control::get('siteurl')."/";
define('IDEA_URL',$siteurl);//网站URL
define('ADMIN_TYPE','admin');//后台路径
define('TPLS_PATH',IDEA_URL .'content/template/');//模板库目录
define('TEMPLATE_URL',TPLS_PATH .Control::get('template').'/');//模版地址
define('TEMPLATE_PATH',IDEA_ROOT .'/content/template/'.Control::get('template').'/');




?>