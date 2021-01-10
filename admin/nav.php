<?php
include_once 'global.php';

$tem='nav';
$navs = $cache->readCache('nav');
$sorts = $cache->readCache('sort');
$booksorts = array();
//$booksorts = $cache->readCache('booksort');
$db=Conn::getConnect();
$group = isset($_GET['group'])?$_GET['group']:'0';
$action = isset($_GET['action'])?$_GET['action']:'';

$pages=art_Model::getPages();
$pagearr=$pages;

if($action=='edit'){
	$navid=isset($_GET['id'])?$_GET['id']:'0';
	$navline=nav_Model::getNav($navid);
	$tem='navedit';
}

if(isset($_POST['addsort'])){
	$sck=isset($_POST['sck'])?$_POST['sck']:'';
	$groups=isset($_POST['group'])?$_POST['group']:'';
	nav_Model::addNav($sck,$groups,$sorts,'sort','4');
	echo "<script>location.href='". ADMIN_URL ."nav.php';</script>";exit;
}
if(isset($_POST['addbook'])){
	$bck=isset($_POST['bck'])?$_POST['bck']:'';
	$groupb=isset($_POST['group'])?$_POST['group']:'';
	nav_Model::addNav($bck,$groupb,$booksorts,'book','6');
	echo "<script>location.href='". ADMIN_URL ."nav.php';</script>";exit;
}
if(isset($_POST['addpage'])){
	$pck=isset($_POST['pck'])?$_POST['pck']:'';
	$groupp=isset($_POST['group'])?$_POST['group']:'';
	nav_Model::addNav($pck,$groupp,$pagearr,'page','5');
	echo "<script>location.href='". ADMIN_URL ."nav.php';</script>";exit;
}

if(isset($_POST['adddiy'])){
	$adddata=array();
	$upfile=new Upfile();
	$lid=isset($_POST['id'])?$_POST['id']:'';
	
	$adddata['index'] = isset($_POST['index'])?$_POST['index']:'0';
	$adddata['name'] = isset($_POST['name'])?$_POST['name']:'0';
	if(isset($_POST['url'])){$adddata['url'] = $_POST['url'];}
	$adddata['pic']=isset($_POST['pic2'])?$_POST['pic2']:'';
	if(!empty($_FILES["pic"]["name"])){
		$adddata['pic'] = $upfile->upload($_FILES["pic"],'','book');
	}
	$adddata['group'] = isset($_POST['group'])?$_POST['group']:'0';
	$adddata['top_id'] = isset($_POST['topid'])?$_POST['topid']:'0';
	$adddata['blank'] = isset($_POST['blank'])?$_POST['blank']:'0';
	
	nav_Model::addDiyNav($adddata,$lid);
	echo "<script>location.href='". ADMIN_URL ."nav.php';</script>";exit;
}


include View::getViewA('header');
require_once(View::getViewA($tem));
include View::getViewA('footer');
View::output();

?>