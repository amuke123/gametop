<?php
include_once 'global.php';

$banners=$cache->readCache('banner');
$db=Conn::getConnect();
$groups=array('主页轮换','轮换组一','轮换组二','轮换组三','轮换组四','轮换组五','轮换组六','轮换组七','轮换组八','轮换组九');
$gids=isset($_GET['g'])?$_GET['g']:'-1';
$temp = 'banner';

if(isset($_GET['action'])){
	if($_GET['action']=='edit'){
		$temp='bannedit';
		if(isset($_GET['id'])){$bannid=$_GET['id'];}
	}
}

if(isset($_POST['add'])){
	$adddata=array();
	$upfile=new Upfile();
	$bid=isset($_POST['id'])?$_POST['id']:'';
	$adddata['name']=isset($_POST['name'])?$_POST['name']:'';
	$adddata['pic']=isset($_POST['pic2'])?$_POST['pic2']:'';
	if(!empty($_FILES["pic"]["name"])){
		$adddata['pic'] = $upfile->upload($_FILES["pic"],'','banner');
		if($bid!=''){action_Model::delFile($bid,'banner');}
	}
	$adddata['blank']=isset($_POST['blank'])?$_POST['blank']:'0';
	$adddata['group']=isset($_POST['group'])?$_POST['group']:'0';
	$adddata['link']=isset($_POST['link'])?$_POST['link']:'0';
	$adddata['show']=isset($_POST['show'])?$_POST['show']:'1';
	$adddata['index']=isset($_POST['index'])?$_POST['index']:'0';
	$adddata['index']=$adddata['index']!=''?$adddata['index']:'0';
	
	if(action_Model::addLine($adddata,'banner',$bid)){echo "<script>location.href='".ADMIN_URL ."banner.php';</script>";exit;}
}

include View::getViewA('header');
require_once(View::getViewA($temp));
include View::getViewA('footer');
View::output();

?>