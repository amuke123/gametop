<?php
/*
**tag页面
*/
class tag_Control{

	function display($params=array()){
		//print_r($params);
		$cache=Conn::getCache();
		$collects=$cache->readCache('collects');
		$sorts=$cache->readCache('sort');
		$tags=$cache->readCache('tags');
		$system_cache=Control::getAll();
		extract($system_cache);
		$pnum=count($params)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($params[$pnum-1])&&$params[$pnum-1]=='page'?abs(intval($params[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		$tag=isset($params[1])&&$params[1]=='tag'?addslashes(urldecode(trim($params[2]))):'';
		$site_title=stripslashes($tag).'-'.$site_title;
		$site_description=stripslashes($tag).'，'.$site_description;
		$site_key=stripslashes($tag).','.$site_key;
		$idsarr=array_column($tags,'tagname','id');
		$tagid=array_search($tag,$idsarr);
		$aidstr=$tags[$tagid]['a_id'];
		
		$rolestr = " AND `id` in (".$aidstr.")";
		$arts=art_Model::getNewLog($pagenum,$startnum,$rolestr,"");
		
		$hotArts=$cache->readCache('hotArts');
		
		$counts=art_Model::getArtsNum(1,1,$rolestr,'');
		$artnumb=$counts[0]['total'];
		$pages=ceil($artnumb/$pagenum);
		$urlpre=Url::tag($tags[$tagid]['tagurl'],$pageid);
		$txtsub='篇笔记';
		
		$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
		
		include View::getView('header');
        include View::getView('tag');
	}
	
}


?>