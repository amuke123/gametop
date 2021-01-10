<?php
include_once 'global.php';

$links=$cache->readCache('link');
$action=isset($_GET['action'])?$_GET['action']:'';
$db=Conn::getConnect();
$groups=array('主页','内页');
$gids=isset($_GET['g'])?$_GET['g']:'-1';

if($action=='edit'){
	$linkid=isset($_GET['id'])?$_GET['id']:'-1';
}


if(isset($_POST['add'])){
	$adddata=array();
	$upfile=new Upfile();
	$lid=isset($_POST['id'])?$_POST['id']:'';
	$adddata['sitename']=isset($_POST['sitename'])?$_POST['sitename']:'';
	$adddata['pic']=isset($_POST['pic2'])?$_POST['pic2']:'';
	if(!empty($_FILES["pic"]["name"])){
		$adddata['pic'] = $upfile->upload($_FILES["pic"],'','link');
		if($lid!=''){action_Model::delFile($lid,'link');}
	}
	$adddata['description']=isset($_POST['description'])?$_POST['description']:'';
	$adddata['group']=isset($_POST['group'])?$_POST['group']:'0';
	$adddata['siteurl']=isset($_POST['siteurl'])?$_POST['siteurl']:'';
	$adddata['show']=isset($_POST['show'])?$_POST['show']:'1';
	$adddata['index']=isset($_POST['index'])?$_POST['index']:'0';
	$adddata['index']=$adddata['index']!=''?$adddata['index']:'0';
	
	if(action_Model::addLine($adddata,'link',$lid)){echo "<script>location.href='".ADMIN_URL ."link.php';</script>";exit;}
}

include View::getViewA('header');
require_once(View::getViewA('link'));
include View::getViewA('footer');
View::output();

?>