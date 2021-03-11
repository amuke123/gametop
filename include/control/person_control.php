<?php
/*
**个人中心
*/
class person_Control{

	function display($datas=array()){
		//echo "个人中心<pre>";
		//print_r($datas);
		$system_cache=Control::getAll();
		extract($system_cache);
		$cache=Conn::getCache();
		$hotArts=$cache->readCache('hotArts');
		
		$uid=UID;
		
		if(!$uid){show_404();exit();}
		$site_title='个人中心-'.$site_title;
		$site_description='个人中心，'.$site_description;
		$site_key='个人中心,'.$site_key;
		
		$gzlist=user_Model::getGz($uid);//关注列表
		$fslist=user_Model::getFs($uid);//粉丝列表
		
		
		include View::getView('header');
        include View::getView('person');
	}
	
}


?>