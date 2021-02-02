<?php
/*
**设置页面
*/
class setting_Control{

	function display($params=array()){
		//echo "设置页<pre>";
		//print_r($params);
		$cache=Conn::getCache();
		$userdiy_cache=$cache->readCache('userdiy');
		$system_cache=Control::getAll();
		extract($system_cache);
		
		$settype=isset($params[2])?$params[2]:'';
		if(!empty($settype)){
			switch($settype){
				case 'account':$keynum=1;$settxt='安全设置';break;
				case 'preference':$keynum=2;$settxt='个性设置';break;
				case 'wishset':$keynum=3;$settxt='我的清单';break;
				case 'collect':$keynum=4;$settxt='关注于收藏';break;
				default:$keynum=0;$settxt='个人设置';
			}
		}else{$keynum=0;$settxt='个人设置';}
		
		$roles=Control::getRoles();
		$uid=UID;
		
		if(!$uid){show_404();}
		$userinfo=user_Model::getInfo($uid);
		if(empty($userinfo)){show_404();}
		
		$site_title=$userinfo['name'].'-设置中心-'.$site_title;
		$site_description=$userinfo['name'].'，'.$site_description;
		$site_key=$userinfo['name'].','.$site_key;
		
		$gzlist=user_Model::getGz($uid);//关注列表
		$fslist=user_Model::getFs($uid);//粉丝列表
		
		if(isset($_POST['jcset'])){
			$datauser=array();
			$ajcode=isset($_POST['ajcode'])?$_POST['ajcode']:'';
			if($ajcode==$_SESSION['ajcode']){
				$datauser['nickname']=isset($_POST['nickname'])?$_POST['nickname']:'';
				$datauser['sex']=isset($_POST['sex'])?$_POST['sex']:'2';
				$datauser['birthday']=isset($_POST['birthday'])?$_POST['birthday']:'';
				$datauser['description']=isset($_POST['description'])?$_POST['description']:'';
				if(user_Model::addLine($datauser,'user',$uid)){echo "<script>location.href='".Url::setting($uid)."';</script>";exit;}
			}else{
				echo "<script>alert('非法操作');window.history.back();</script>";exit;
			}
		}
		if(isset($_POST['xgpw'])){
			$datauser=array();
			$ajcode=isset($_POST['ajcode'])?$_POST['ajcode']:'';
			if($ajcode==$_SESSION['ajcode']){
				$oldpw=isset($_POST['pw_old'])?$_POST['pw_old']:'';
				$cxjg=user_Model::getInfo($uid);
				$password=setUTF8(Checking::jm($oldpw));
				if(!empty($cxjg['password'])&&$oldpw!=''){
					if(Checking::checkPw($password,$cxjg['password'])){
						if(!isset($_POST['password1'])||$_POST['password1']==''){
							echo "<script>alert('新密码不能为空！');window.history.back();</script>";exit;
						}else{
							$datauser['password']=Checking::hashjm(Checking::jm($_POST['password1']));
						}
					}else{
						echo "<script>alert('原密码错误！');window.history.back();</script>";exit;
					}
				}
				if(user_Model::addLine($datauser,'user',$uid)){echo "<script>location.href='".Url::setting($uid)."account';</script>";exit;}
			}else{
				echo "<script>alert('非法操作');window.history.back();</script>";exit;
			}
		}
		
		if(isset($_POST['xgll'])){
			$datauser=array();
			$ajcode=isset($_POST['ajcode'])?$_POST['ajcode']:'';
			if($ajcode==$_SESSION['ajcode']){
				$oldpw=isset($_POST['pw_old'])?$_POST['pw_old']:'';
				$cxjg=user_Model::getInfo($uid);
				$password=setUTF8(Checking::jm($oldpw));
				if(!empty($cxjg['password'])&&$oldpw!=''){
					if(Checking::checkPw($password,$cxjg['password'])){
						$sendId=isset($_POST['sendid'])?$_POST['sendid']:'';
						$code=isset($_POST['code'])?$_POST['code']:'';
						$sendType=Checking::checkSendType($sendId);
						$sendText=$sendType=='tel'?'手机号':'邮箱';
						if(Checking::checkSendId($sendId,$uid)){
							echo "<script>alert('".$sendText." ".$sendId." 已被绑定，请使用其他".$sendText."！');window.history.back();</script>";exit;
						}
						if(Checking::checkCode($code,$sendId)){
							$datauser[$sendType]=$sendId;
							$datauser[$sendType.'ok']='1';
						}else{
							echo "<script>alert('验证码错误');window.history.go(-1);</script>";exit;
						}
					}else{
						echo "<script>alert('原密码错误！');window.history.back();</script>";exit;
					}
				}
				if(user_Model::addLine($datauser,'user',$uid)){echo "<script>location.href='".Url::setting($uid)."account';</script>";exit;}
			}else{
				echo "<script>alert('非法操作');window.history.back();</script>";exit;
			}
		}
		
		include View::getView('header');
        include View::getView('setting');
	}
	
}


?>