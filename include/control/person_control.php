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
		$pnum=count($datas)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($datas[$pnum-1])&&$datas[$pnum-1]=='page'?abs(intval($datas[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		$ccdate=isset($datas[2])?$datas[2]:'';
		
		$uid=UID;
		
		if(!$uid){Checking::goLogin();exit();}
		$userinfo=user_Model::getInfo($uid);
		if(empty($userinfo)){show_404();}
		
		switch($ccdate){
			case 'notes':
				$rolestr=" and `author`='".$uid."' ";
				$arts=art_Model::getNewLog($pagenum,$startnum,$rolestr,"");
				$counts=art_Model::getArtsNum(1,1,$rolestr,'');
				$artnumb=$counts[0]['total'];
				$pages=ceil($artnumb/$pagenum);
				$urlpre=Url::person(UID).'notes/page/';
				$txtsub='篇笔记';
				$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
				$topname='我的笔记';
				$keyson=1;
				break;
			case 'collect':
				$ids=user_Model::getStrToId($userinfo['collect']);
				$collects=user_Model::getCollect($pagenum,$startnum,$ids);
				$artnumb=count($ids);
				$pages=ceil($artnumb/$pagenum);
				$urlpre=Url::person(UID).'notes/page/';
				$txtsub='篇收藏';
				$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
				$topname='我的收藏';
				$keyson=2;
				break;
			case 'list':
				$rolestr=" and `uid`='".$uid."' ";
				$wishlists=wishlist_Model::getWhihlists($pagenum,$startnum,$rolestr);
				$counts=wishlist_Model::getWhihNum($rolestr);
				$wnumb=$counts['total'];
				$pages=ceil($wnumb/$pagenum);
				$urlpre=Url::person(UID).'list/page/';
				$txtsub='个清单';
				$pagestr=action_Model::pagelist($wnumb,$pages,$pageid,$urlpre,$txtsub,'');
				$topname='我的清单';
				$keyson=3;
				break;
			case 'follow':
				$gzlist=user_Model::getGz($uid);//关注列表
				$fslist=user_Model::getFs($uid);//粉丝列表
				$topname='关注与粉丝';
				$keyson=4;
				break;
			default:
				
				$topname=$userinfo['name']."的动态";
				$keyson=0;
				break;
		}
		
		
		$site_title=$topname.'-'.$site_title;
		$site_description=$topname.'，'.$site_description;
		$site_key=$topname.','.$site_key;

		
		$hotArts=$cache->readCache('hotArts');
		
		
		include View::getView('header');
        include View::getView('person');
	}
	
}


?>