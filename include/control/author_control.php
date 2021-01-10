<?php
/*
**作者页面
*/
class author_Control{
	
	function display($params=array()){
		//print_r($params);
		$cache=Conn::getCache();
		$userdiy_cache=$cache->readCache('userdiy');
		$system_cache=Control::getAll();
		extract($system_cache);
		$pnum=count($params)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($params[$pnum-1])&&$params[$pnum-1]=='page'?abs(intval($params[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		
		$uid=0;
        if(isset($params[1])){
            if($params[1]=='author'){
				if(isset($params[2])){
					if(is_numeric($params[2])){
						$uid=intval($params[2]);
					}else{
						if(!empty($userdiy_cache)){
							$alias=addslashes(urldecode(trim($params[2])));
							$uid=array_search($alias,$userdiy_cache);
						}
					}
				}
            }else if(is_numeric($params[1])){
                $uid=intval($params[1]);
            }else{
                if(!empty($userdiy_cache)){
                    $alias=addslashes(urldecode(trim($params[1])));
                    $uid=array_search($alias,$userdiy_cache);
                }
            }
        }
		if(!$uid){show_404();}
		$userinfo=user_Model::getInfo($uid);
		if(empty($userinfo)){show_404();}
		
		$site_title=$userinfo['name'].'的个人主页-'.$site_title;
		$site_description=$userinfo['name'].'，'.$site_description;
		$site_key=$userinfo['name'].','.$site_key;
		
		$gzlist=user_Model::getGz($uid);//关注列表
		$fslist=user_Model::getFs($uid);//粉丝列表
		
		$rolestr=" and `author`='".$uid."' ";
		$arts=art_Model::getNewLog($pagenum,$startnum,$rolestr,"");
		
		$hotArts=$cache->readCache('hotArts');
		
		$counts=art_Model::getArtsNum(1,1,$rolestr,'');
		$artnumb=$counts[0]['total'];
		$pages=ceil($artnumb/$pagenum);
		$urlpre=Url::author($uid,$pageid);
		$txtsub='篇笔记';
		
		$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
		
		include View::getView('header');
        include View::getView('author');
	}
	
}


?>