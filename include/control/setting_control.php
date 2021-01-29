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
		
		
		include View::getView('header');
        include View::getView('setting');
	}
	
}


?>