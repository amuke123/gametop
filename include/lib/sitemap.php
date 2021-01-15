<?php
class Sitemap{
	
	static function setXml($sitemap_name,$key=false){
		$path = IDEA_ROOT .'/'.$sitemap_name;
		$xml = self::buildXML();
		if(!is_file($path)||(time()-24*3600)>filemtime($path)){
			@file_put_contents($path,$xml);
		}
		if($key){@file_put_contents($path,$xml);}
	}
	static function getData(){
		$cache = Conn::getCache();
		$db=Conn::getConnect();
		$lastSayTime = self::getLastSayTime();
		$data = array();
		$data[] = array('url'=>IDEA_URL,'lastmod'=>time(),'changefreq'=>'always','priority'=>'1.0');
		//笔记
		$query = $db->getlist("SELECT `id`,`date` FROM `". DB_PRE ."article` WHERE `type`='a' AND `show`='1' AND `checkok`='1' ORDER BY `date` DESC");
		if(!empty($query)){foreach($query as $row){
			$lastmod = isset($lastSayTime[$row['id']])?$lastSayTime[$row['id']]:($row['date']==''?time():$row['date']);
			$data[] = array('url'=>Url::log($row['id']),'lastmod'=>$lastmod,'changefreq'=>'weekly','priority'=>'0.8');
		}}
		//页面
		$query = $db->getlist("SELECT `id`,`date` FROM `". DB_PRE ."article` WHERE `type`='p' AND `show`='1' AND `checkok`='1' ORDER BY date DESC");
		if(!empty($query)){foreach($query as $row){
			$lastmod = isset($lastSayTime[$row['id']])?$lastSayTime[$row['id']]:($row['date']==''?time():$row['date']);
			$data[] = array('url'=>Url::log($row['id']),'lastmod'=>$lastmod,'changefreq'=>'daily','priority'=>'0.8');
		}}
		//分类
		foreach($cache->readCache('sort') as $value){
			$data[] = array('url'=>Url::sort($value['id']),'lastmod'=>time(),'changefreq'=>'daily','priority'=>'0.8');	
		}
		//标签
		foreach($cache->readCache('tags') as $value){
			$data[] = array('url'=>Url::tag($value['tagurl']),'lastmod'=>time(),'changefreq'=>'daily','priority'=>'0.8');
		}
		//清单
		foreach($cache->readCache('wishlist') as $value){
			$data[] = array('url'=>Url::wishlist($value['id']),'lastmod'=>time(),'changefreq'=>'daily','priority'=>'0.8');
		}
		//导航
		foreach($cache->readCache('nav') as $value){
			if($value['show']=='1'&&$value['type']!='1'){$data[] = array('url'=>Url::nav($value['type'],$value['typeId'],$value['url']),'lastmod'=>time(),'changefreq'=>'daily','priority'=>'0.8');}
		}
		//作者
		$query = $db->getlist("SELECT `id`,`date`,`lastdate` FROM `". DB_PRE ."user` WHERE `ischeck`='1' ORDER BY `lastdate` DESC,`date` DESC");
		if(!empty($query)){foreach($query as $row){
			$lastmod = !empty($row['lastdate'])?$row['lastdate']:($row['date']==''?time():$row['date']);
			$data[] = array('url'=>Url::author($row['id']),'lastmod'=>$lastmod,'changefreq'=>'daily','priority'=>'0.8');
		}}
		
		return $data;
	}
	static function buildXML(){
		$data = self::getData();
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		foreach($data as $value) {
			extract($value);
			$xml .= self::generate($url,$lastmod,$changefreq,$priority);
		}
		$xml .= '</urlset>';
		return $xml;
	}
	static function generate($url,$lastmod,$changefreq,$priority) {
		$url = htmlspecialchars($url);
		$lastmod = gmdate('c',$lastmod);
		return "<url>\n<loc>$url</loc>\n<lastmod>$lastmod</lastmod>\n<changefreq>$changefreq</changefreq>\n<priority>$priority</priority>\n</url>\n";
	}
	static function getLastSayTime(){
		$db=Conn::getConnect();
		$query = $db->getlist("SELECT id,max(date) as date FROM ". DB_PRE ."say	WHERE del='1' and ischeck='1' and show='1' GROUP BY id");
		$lastSayTime = array();
		if(!empty($query)){
			foreach($query as $row){
				$lastSayTime[$row['id']] = $row['date'];
			}
		}
		return $lastSayTime;
	}
}
?>