<?php
include_once 'global.php';
Checking::setSession();
$db=Conn::getConnect();

$timelist=Control::gettime();
$action=isset($_GET['action'])?$_GET['action']:'sys';
if(isset($_POST['tjsys'])){
	$data1=array();
	$data1['sitename']=isset($_POST['sitename'])?addslashes($_POST['sitename']):'';
	$data1['siteinfo']=isset($_POST['siteinfo'])?addslashes($_POST['siteinfo']):'';
	$data1['siteurl']=isset($_POST['siteurl'])?$_POST['siteurl']:'';
	$data1['art_num']=isset($_POST['artnum'])?$_POST['artnum']:'';
	$data1['admin_page_num']=isset($_POST['adminnum'])?$_POST['adminnum']:'';
	$data1['time_zone']=isset($_POST['timezone'])?$_POST['timezone']:'';
	$data1['userpre']=isset($_POST['userpre'])?addslashes($_POST['userpre']):'';
	
	$artcheck=isset($_POST['artcheck'])?$_POST['artcheck']:'';
	$data1['art_check']=$artcheck!=''?$artcheck:'0';
	$logincode=isset($_POST['logincode'])?$_POST['logincode']:'';
	$data1['login_code']=$logincode!=''?$logincode:'0';
	$excerpt=isset($_POST['excerpt'])?$_POST['excerpt']:'';
	$data1['excerpt']=$excerpt!=''?$excerpt:'0';
	$data1['excerpt_long']=isset($_POST['excnum'])?$_POST['excnum']:'';
	
	$comment=isset($_POST['comment'])?$_POST['comment']:'';
	$data1['sayok']=$comment!=''?$comment:'0';
	$data1['say_time']=isset($_POST['comtime'])?$_POST['comtime']:'';
	
	$comcheck=isset($_POST['comcheck'])?$_POST['comcheck']:'';
	$data1['say_check']=$comcheck!=''?$comcheck:'0';
	$comcode=isset($_POST['comcode'])?$_POST['comcode']:'';
	$data1['say_code']=$comcode!=''?$comcode:'0';
	$comgravatar=isset($_POST['comgravatar'])?$_POST['comgravatar']:'';
	$data1['say_gravatar']=$comgravatar!=''?$comgravatar:'0';
	$comchinese=isset($_POST['comchinese'])?$_POST['comchinese']:'';
	$data1['say_chinese']=$comchinese!=''?$comchinese:'0';
	$replycode=isset($_POST['replycode'])?$_POST['replycode']:'';
	$data1['reply_code']=$replycode!=''?$replycode:'0';
	$compage=isset($_POST['compage'])?$_POST['compage']:'';
	$data1['say_page']=$compage!=''?$compage:'0';
	$data1['say_pnum']=isset($_POST['comnum'])?$_POST['comnum']:'';
	$data1['say_order']=isset($_POST['comisnew'])?$_POST['comisnew']:'';
	
	$data1['file_maxsize']=isset($_POST['maxsize'])?$_POST['maxsize']:'';
	$data1['file_type']=isset($_POST['filetype'])?addslashes($_POST['filetype']):'';
	$thumbnail=isset($_POST['thumbnail'])?$_POST['thumbnail']:'';
	$data1['thumbnailok']=$thumbnail!=''?$thumbnail:'0';
	$data1['thum_imgmaxw']=isset($_POST['filewidth'])?$_POST['filewidth']:'';
	$data1['thum_imgmaxh']=isset($_POST['fileheight'])?$_POST['fileheight']:'';
	
	$data1['icp']=isset($_POST['icp'])?addslashes($_POST['icp']):'';
	$data1['footer_info']=isset($_POST['footinfo'])?addslashes($_POST['footinfo']):'';
	$data1['header_meta']=isset($_POST['headmeta'])?addslashes($_POST['headmeta']):'';
	
	$ajcode=isset($_POST['checking'])?$_POST['checking']:'';
	
	if($ajcode==$_SESSION['ajcode']){
		foreach($data1 as $keys => $vals){
			$sql2="UPDATE `" . DB_PRE . "options` SET `value`='".$vals."' WHERE `key`='".$keys."'";
			$db->query($sql2);
		}
		updateCacheAll('options');
		echo "<script>location.href='". ADMIN_URL ."system.php?action=sys';</script>";
	}else{
		echo "<script>alert('非法操作');location.href='". ADMIN_URL ."system.php';</script>";
	}
}
if(isset($_POST['tjseo'])){
	$data2=array();
	$data2['url_type']=isset($_POST['urltype'])?$_POST['urltype']:'';
	
	$alias=isset($_POST['alias'])?$_POST['alias']:'';
	$data2['aliasok']=$alias!=''?$alias:'0';
	
	$html=isset($_POST['html'])?$_POST['html']:'';
	$data2['htmlok']=$html!=''?$html:'0';
	
	$data2['seo_title']=isset($_POST['sitetitle'])?addslashes(htmlspecialchars($_POST['sitetitle'])):'';
	$data2['seo_key']=isset($_POST['key'])?addslashes(htmlspecialchars($_POST['key'])):'';
	$data2['seo_description']=isset($_POST['description'])?addslashes(htmlspecialchars($_POST['description'])):'';
	$data2['seo_type']=isset($_POST['seotype'])?$_POST['seotype']:'';
	$ajcode=isset($_POST['checking'])?$_POST['checking']:'';
	if($ajcode==$_SESSION['ajcode']){
		foreach($data2 as $keys => $vals){
			$sql2="UPDATE `" . DB_PRE . "options` SET `value`='".$vals."' WHERE `key`='".$keys."'";
			$db->query($sql2);
		}
		updateCacheAll('options');
		echo "<script>location.href='". ADMIN_URL ."system.php?action=seo';</script>";
	}else{
		echo "<script>alert('非法操作');location.href='". ADMIN_URL ."system.php';</script>";
	}
}
if(isset($_POST['tjmail'])){
	$data3=array();
	$data3['mailhost']=isset($_POST['mailhost'])?$_POST['mailhost']:'';
	$data3['mail']=isset($_POST['mail'])?$_POST['mail']:'';
	$data3['mailpswd']=isset($_POST['mailpswd'])?$_POST['mailpswd']:'';
	$data3['mailport']=isset($_POST['mailport'])?$_POST['mailport']:'';
	$ajcode=isset($_POST['checking'])?$_POST['checking']:'';
	if($ajcode==$_SESSION['ajcode']){
		foreach($data3 as $keys => $vals){
			$sql3="UPDATE `" . DB_PRE . "options` SET `value`='".$vals."' WHERE `key`='".$keys."'";
			$db->query($sql3);
		}
		updateCacheAll('options');
		echo "<script>location.href='". ADMIN_URL ."system.php?action=mail';</script>";
	}else{
		echo "<script>alert('非法操作');location.href='". ADMIN_URL ."system.php';</script>";
	}
}
if(isset($_POST['tjinfo'])){
	//$data4=array();
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	//$data4['username']=isset($_POST['username'])?$_POST['username']:'';
	
	
	//$ajcode=isset($_POST['checking'])?$_POST['checking']:'';
	//if($ajcode==$_SESSION['ajcode']){
		//foreach($data3 as $keys => $vals){
			//$sql3="UPDATE `" . DB_PRE . "options` SET `value`='".$vals."' WHERE `key`='".$keys."'";
			//$db->query($sql3);
		//}
		//updateCacheAll();
		//echo "<script>location.href='". ADMIN_URL ."system.php?action=info';</script>";
	//}else{
		//echo "<script>alert('非法操作');location.href='". ADMIN_URL ."system.php';</script>";
	//}
}



include View::getViewA('header');
require_once(View::getViewA('system'));
include View::getViewA('footer');
View::output();

?>