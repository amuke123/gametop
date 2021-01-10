<?php
/*
**搜索页面
*/
class search_Control{

	function display($params=array()){
		//echo "搜索页<pre>";
		//print_r($params);
		$cache=Conn::getCache();
		$collects=$cache->readCache('collects');
		$sorts=$cache->readCache('sort');
		$system_cache=Control::getAll();
		extract($system_cache);
		$pnum=count($params)-1;
		$pagenum = Control::get('art_num');
		$pageid = isset($params[$pnum-1])&&$params[$pnum-1]=='page'?abs(intval($params[$pnum])):1;
		$startnum = $pagenum*($pageid-1);
		
		$keyword = isset($params[1])&&$params[1] =='keyword'?trim($params[2]):'';
        $keyword = addslashes(htmlspecialchars(urldecode($keyword)));
        $keyword = str_replace(array('%','_'),array('\%','\_'),$keyword);
		
		$site_title=stripslashes($keyword).'-'.$site_title;
		$site_description=stripslashes($keyword).'，'.$site_description;
		$site_key=stripslashes($keyword).','.$site_key;
		
		$rolestr = " AND `title` LIKE ('%".$keyword."%') ";
		$arts=art_Model::getNewLog($pagenum,$startnum,$rolestr,"");
		
		$hotArts=$cache->readCache('hotArts');
		
		$counts=art_Model::getArtsNum(1,1,$rolestr,'');
		$artnumb=$counts[0]['total'];
		$pages=ceil($artnumb/$pagenum);
		$urlpre=IDEA_URL .'?keyword='.$keyword.'&page=';
		$txtsub='篇笔记';
		
		$pagestr=action_Model::pagelist($artnumb,$pages,$pageid,$urlpre,$txtsub,'');
		
		
		include View::getView('header');
        include View::getView('search');
	}
	
}


?>