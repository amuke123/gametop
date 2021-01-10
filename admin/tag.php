<?php
include_once 'global.php';

$tags=$cache->readCache('tags');
$action=isset($_GET["action"])?$_GET["action"]:'';
$db=Conn::getConnect();

if(isset($_POST['add'])){
	$adddata=array();
	$tid=isset($_POST["tid"])?$_POST["tid"]:'';
	$adddata['name']=isset($_POST["name"])?$_POST["name"]:'';
	if(action_Model::addLine($adddata,'tags',$tid)){echo "<script>location.href='".ADMIN_URL ."tag.php';</script>";exit;}
}

if($action=='edit'){
	$tagid=isset($_GET["id"])?$_GET["id"]:'';
}

if($action=='del'){
	$taglist=isset($_POST['tag'])?$_POST['tag']:"";
	if(tag_Model::delTags($taglist)){echo "<script>window.location.href='".ADMIN_URL."tag.php';</script>";exit;}
}

include View::getViewA('header');
require_once(View::getViewA('tag'));
include View::getViewA('footer');
View::output();

?>