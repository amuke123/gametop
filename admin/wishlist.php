<?php
include_once 'global.php';

$wishlists = $cache->readCache('wishlist');
$action = isset($_GET['action'])?$_GET['action']:'';
$temp = 'wishlist';


if($action=='edit'){
	$wishid = $_GET['id'];
	$wishinfo=$wishlists[$wishid];
}

if(isset($_POST['tj'])){
	$adddata=array();
	$upfile=new Upfile();
	$lid=isset($_POST['id'])?$_POST['id']:'';
	$adddata['name']=isset($_POST['name'])?$_POST['name']:'';
	$adddata['pic']=isset($_POST['pic2'])?$_POST['pic2']:'';
	if(!empty($_FILES["pic"]["name"])){
		$adddata['pic'] = $upfile->upload($_FILES["pic"],'','wishlist');
		if($lid!=''){action_Model::delFile($lid,'wishlist');}
	}
	$adddata['text']=isset($_POST['text'])?$_POST['text']:'';
	$adddata['show']=isset($_POST['show'])?$_POST['show']:'1';

	if(action_Model::addLine($adddata,'wishlist',$lid)){echo "<script>location.href='".ADMIN_URL ."wishlist.php';</script>";exit;}
}

include View::getViewA('header');
require_once(View::getViewA($temp));
include View::getViewA('footer');
View::output();

?>