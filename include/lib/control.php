<?php
class Control{
	
	const IDEA_VERSION = '1.0';//版本编号
	const ICON_MAX_W = 220;//头像缩略图最大宽
	const ICON_MAX_H = 220;//头像缩略图最大高
	const UPLOADFILE_PATH = '../content/uploadfile/';//附件上传路径
	
	static function get($option){
		$cache = Conn::getCache();
		$op_cache = $cache->readCache('options');
		if(isset($op_cache[$option])) {
			switch ($option) {
				case 'plugins_list':
				case 'widget_list':
				case 'diy_widget':
				case 'side1':
				case 'side2':
				case 'side3':
				case 'side4':
					if(!empty($op_cache[$option])) {
						return @unserialize($op_cache[$option]);
					}else{
						return array();
					}
					break;
				default:
					return $op_cache[$option];
					break;
			}
		}
	}
	
	static function getOptions(){
        $cache = Conn::getCache();
		$op_cache = $cache->readCache('options');

        $op_cache['seo_title'] = $op_cache['seo_title'] ? $op_cache['seo_title'] : $op_cache['sitename'];
        $op_cache['seo_description'] = $op_cache['seo_description'] ? $op_cache['seo_description'] : $op_cache['siteinfo'];

        return $op_cache;
    }

	static function getRoute(){//获取路由
		$acstr = self::getAcStr(self::getActions());
        $routes = array(
			array(//系统控制器
				'model'=>'action_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?action=('.$acstr.')([\?&].*)?$}',
				'reg'=>'{^.*/('.$acstr.')(\.html)?$}',
			),
			array(//清单列表分页
				'model'=>'action_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?action=(wishlist)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(wishlist)/((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//分类控制器
				'model'=>'sort_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(sort)=(\d+)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(sort)/([^\./\?=]+)/?([^\./\?=]+)?/?([^\./\?=]+)?/?([^\./\?=]+)?/?((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//榜单控制器
				'model'=>'top_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(top)=(\d+)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(top)/([^\./\?=]+)/?([^\./\?=]+)?/?([^\./\?=]+)?/?([^\./\?=]+)?/?((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//标签控制器
				'model'=>'tag_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(tag)=([^&]+)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(tag)/([^/?]+)/?((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//作者控制器
				'model'=>'author_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(author)=(\d+)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(author)/([^\./\?=]+)/?((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//搜索控制器
				'model'=>'search_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(keyword)=([^/&]+)(&(page)=(\d+))?([\?&].*)?$}',
			),
			array(//插件控制器
				'model'=>'plugin_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(plugin)=([\w\-]+).*([\?&].*)?$}',
			),
			array(//清单控制器
				'model'=>'wishlist_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?(wishlist)=(\d+)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(wishlist)/(\d+)/?((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//关注控制器
				'model'=>'action_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?action=(tips)(&(page)=(\d+))?([\?&].*)?$}',
				'reg'=>'{^.*/(tips)/((page)/(\d+))?/?([\?&].*)?$}',
			),
			array(//个人中心控制器
				'model'=>'person_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/(person)/?([^\./\?=]+)?/?((page)/(\d+))?([\?&].*)?$}',
			),
			array(//创作中心控制器
				'model'=>'work_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/(work)/?([^\./\?=]+)?/?([\?&].*)?$}',
			),
			array(//设置中心控制器
				'model'=>'setting_Control',
				'method'=>'display',
				'reg_1'=>'{^.*/(setting)/?([^\./\?=]+)?/?([\?&].*)?$}',
			),
			array(//主页分页控制器
				'model'=>'art_control',
				'method'=>'disPage',
				'reg_1'=>'{^.*/\?(page)=(\d+)([\?&].*)?$}',
				'reg'=>'{^.*/(page)/(\d+)/?([\?&].*)?$}',
			),
			array(//文章控制器
				'model'=>'art_control',
				'method'=>'display',
				'reg_1'=>'{^.*/\?post=(\d+)(&(say-page)=(\d+))?([\?&].*)?$}',
				'reg_2'=>'{^.*/post-(\d+)\.html(/(say-page)-(\d+))?/?([\?&].*)?$}',
				'reg_3'=>'{^.*?/([^\./\?=]+)(\.html)?(/(say-page)-(\d+))?/?([\?&].*)?$}',
			),
			array(//主页
				'model' => 'art_control',
				'method' => 'disIndex',
				'reg_1' => '{^/?([\?&].*)?$}',
			),
		);
		return $routes;
    }
	
	static function getActions(){//获取系统项
		$cache = Conn::getCache();
		$navs = $cache->readCache('nav');
		$actions = array('login','reset','register','goout','setcache','comments','wishlist');
		foreach($navs as $nval){
			if($nval['type']==2||$nval['type']==3){$actions[]=$nval['url'];}
		}
        return $actions;
    }
	static function getAcStr($actions){//生成系统项正则‘或’串
		$str="";
		foreach($actions as $val){
			$str.=$val.'|';
		}
		$str=trim($str,"|");
        return $str;
    }
	
    static function getFileType(){//获取允许上传的附件类型
        return explode(',', self::get('file_type'));
    }

    static function getFileMaxSize(){//获取附件最大限制,单位字节
        return self::get('file_maxsize') * 1024;
    }
	
	static function setOptions($name,$value){//更新配置选项
        $DB = Conn::getConnect();
        $DB->query("UPDATE `". DB_PRE ."options` SET `value`=$value where `key`='$name'");
    }
	static function getAll(){
        $cache=Conn::getCache();
		$sys_cache=$cache->readCache('options');

        $sys_cache['site_title'] = $sys_cache['seo_title'] ? $sys_cache['seo_title'] : $sys_cache['sitename'];
        $sys_cache['site_description'] = $sys_cache['seo_description'] ? $sys_cache['seo_description'] : $sys_cache['siteinfo'];
		$sys_cache['site_key'] = $sys_cache['seo_key'];

        return $sys_cache;
    }
	static function getTops(){
		$tops = array(
			array('url'=>'top/fabulous','name'=>'高赞榜'),
			array('url'=>'top/popularity','name'=>'人气榜'),
			array('url'=>'top/work','name'=>'创作榜'),
			array('url'=>'top/collect','name'=>'收藏榜'),
			array('url'=>'top/list','name'=>'清单榜'),
			array('url'=>'top/comment','name'=>'神评榜'),
		);
		return $tops;
	}
	static function getRoles(){
		$roles = array('admin'=>'管理员','writer'=>'作者','vip0'=>'VIP0','vip1'=>'VIP1','vip2'=>'VIP2','vip3'=>'VIP3','vip4'=>'VIP4','vip5'=>'VIP5','vip6'=>'VIP6','vip7'=>'VIP7');
		return $roles;
	}
	
	static function gettime(){//时区列表
		$timelist = array(
			'PRC'					=>	'(PRC)中华人民共和国·北京时间',
			'Etc/GMT'				=>	'(UTC)协调世界时',
			'Africa/Casablanca'		=>	'(UTC)卡萨布兰卡',
			'Atlantic/Reykjavik'	=>	'(UTC)蒙罗维亚，雷克雅未克',
			'Europe/London'			=>	'(UTC)都柏林，爱丁堡，里斯本，伦敦',
			'Africa/Lagos'			=>	'(UTC+01:00)中非西部',
			'Europe/Paris'			=>	'(UTC+01:00)布鲁塞尔，哥本哈根，马德里，巴黎',
			'Africa/Windhoek'		=>	'(UTC+01:00)温得和克',
			'Europe/Warsaw'			=>	'(UTC+01:00)萨拉热窝，斯科普里，华沙，萨格勒布',
			'Europe/Budapest'		=>	'(UTC+01:00)贝尔格莱德，布拉迪斯拉发，布达佩斯，卢布尔雅那，布拉格',
			'Europe/Berlin'			=>	'(UTC+01:00)阿姆斯特丹，柏林，伯尔尼，罗马，斯德哥尔摩，维也纳',
			'Europe/Istanbul'		=>	'(UTC+02:00)伊斯坦布尔',
			'Europe/Kaliningrad'	=>	'(UTC+02:00)加里宁格勒(RTZ 1)',
			'Africa/Johannesburg'	=>	'(UTC+02:00)哈拉雷，比勒陀利亚',
			'Asia/Damascus'			=>	'(UTC+02:00)大马士革',
			'Asia/Amman'			=>	'(UTC+02:00)安曼',
			'Africa/Cairo'			=>	'(UTC+02:00)开罗',
			'Africa/Tripoli'		=>	'(UTC+02:00)的黎波里',
			'Asia/Jerusalem'		=>	'(UTC+02:00)耶路撒冷',
			'Asia/Beirut'			=>	'(UTC+02:00)贝鲁特',
			'Europe/Kiev'			=>	'(UTC+02:00)赫尔辛基，基辅，里加，索非亚，塔林，维尔纽斯',
			'Europe/Bucharest'		=>	'(UTC+02:00)雅典，布加勒斯特',
			'Africa/Nairobi'		=>	'(UTC+03:00)内罗毕',
			'Asia/Baghdad'			=>	'(UTC+03:00)巴格达',
			'Europe/Minsk'			=>	'(UTC+03:00)明斯克',
			'Asia/Riyadh'			=>	'(UTC+03:00)科威特，利雅得',
			'Europe/Moscow'			=>	'(UTC+03:00)莫斯科，圣彼得堡，伏尔加格勒(RTZ 2)',
			'Asia/Tehran'			=>	'(UTC+03:30)德黑兰',
			'Europe/Samara'			=>	'(UTC+04:00)伊热夫斯克，萨马拉(RTZ 3)',
			'Asia/Yerevan'			=>	'(UTC+04:00)埃里温',
			'Asia/Bak'				=>	'(UTC+04:00)巴库',
			'Asia/Tbilisi'			=>	'(UTC+04:00)第比利斯',
			'Indian/Mauritius'		=>	'(UTC+04:00)路易港',
			'Asia/Dubai'			=>	'(UTC+04:00)阿布扎比，马斯喀特',
			'Asia/Kabu'				=>	'(UTC+04:30)喀布尔',
			'Asia/Karachi'			=>	'(UTC+05:00)伊斯兰堡，卡拉奇',
			'Asia/Yekaterinburg'	=>	'(UTC+05:00)叶卡捷琳堡(RTZ 4)',
			'Asia/Tashkent'			=>	'(UTC+05:00)阿什哈巴德，塔什干',
			'Asia/Colombo'			=>	'(UTC+05:30)斯里加亚渥登普拉',
			'Asia/Calcutta'			=>	'(UTC+05:30)钦奈，加尔各答，孟买，新德里',
			'Asia/Katmandu'			=>	'(UTC+05:45)加德满都',
			'Asia/Novosibirsk'		=>	'(UTC+06:00)新西伯利亚(RTZ 5)',
			'Asia/Dhaka'			=>	'(UTC+06:00)达卡',
			'Asia/Almaty'			=>	'(UTC+06:00)阿斯塔纳',
			'Asia/Rangoon'			=>	'(UTC+06:30)仰光',
			'Asia/Krasnoyarsk'		=>	'(UTC+07:00)克拉斯诺亚尔斯克(RTZ 6)',
			'Asia/Bangkok'			=>	'(UTC+07:00)曼谷，河内，雅加达',
			'Asia/Ulaanbaatar'		=>	'(UTC+08:00)乌兰巴托',
			'Asia/Irkutsk'			=>	'(UTC+08:00)伊尔库茨克(RTZ 7)',
			'Asia/Shanghai'			=>	'(UTC+08:00)北京，上海，重庆，香港特别行政区，乌鲁木齐',
			'Asia/Taipei'			=>	'(UTC+08:00)台北',
			'Asia/Singapore'		=>	'(UTC+08:00)吉隆坡，新加坡',
			'Australia/Perth'		=>	'(UTC+08:00)珀斯',
			'Asia/Tokyo'			=>	'(UTC+09:00)大阪，札幌，东京',
			'Asia/Yakutsk'			=>	'(UTC+09:00)雅库茨克(RTZ 8)',
			'Asia/Seoul'			=>	'(UTC+09:00)首尔',
			'Australia/Darwin'		=>	'(UTC+09:30)达尔文',
			'Australia/Adelaide'	=>	'(UTC+09:30)阿德莱德',
			'Pacific/Port_Moresby'	=>	'(UTC+10:00)关岛，莫尔兹比港',
			'Australia/Sydney'		=>	'(UTC+10:00)堪培拉，墨尔本，悉尼',
			'Australia/Brisbane'	=>	'(UTC+10:00)布里斯班',
			'Asia/Vladivostok'		=>	'(UTC+10:00)符拉迪沃斯托克，马加丹(RTZ 9)',
			'Australia/Hobart'		=>	'(UTC+10:00)霍巴特',
			'Asia/Magadan'			=>	'(UTC+10:00)马加丹',
			'Asia/Srednekolymsk'	=>	'(UTC+11:00)乔库尔达赫(RTZ 10)',
			'Pacific/Guadalcanal'	=>	'(UTC+11:00)所罗门群岛，新喀里多尼亚',
			'Etc/GMT-12'			=>	'(UTC+12:00)协调世界时+12',
			'Pacific/Auckland'		=>	'(UTC+12:00)奥克兰，惠灵顿',
			'Pacific/Fiji'			=>	'(UTC+12:00)斐济',
			'Asia/Kamchatka'		=>	'(UTC+12:00)阿纳德尔，彼得罗巴甫洛夫斯克-堪察加(RTZ 11)',
			'Pacific/Tongatapu'		=>	'(UTC+13:00)努库阿洛法',
			'Pacific/Apia'			=>	'(UTC+13:00)萨摩亚群岛',
			'Pacific/Kiritimati'	=>	'(UTC+14:00)圣诞岛',
			'Atlantic/Azores'		=>	'(UTC-01:00)亚速尔群岛',
			'Atlantic/Cape_Verde'	=>	'(UTC-01:00)佛得角群岛',
			//'Etc/GMT+2'				=>	'(UTC-02:00)协调世界时-02',
			'America/Cayenne'		=>	'(UTC-03:00)卡宴，福塔雷萨',
			'America/Sao_Paulo'		=>	'(UTC-03:00)巴西利亚',
			'America/Buenos_Aires'	=>	'(UTC-03:00)布宜诺斯艾利斯',
			'America/Godthab'		=>	'(UTC-03:00)格陵兰',
			'America/Bahia'			=>	'(UTC-03:00)萨尔瓦多',
			'America/Montevideo'	=>	'(UTC-03:00)蒙得维的亚',
			'America/St_Johns'		=>	'(UTC-03:30)纽芬兰',
			'America/La_Paz'		=>	'(UTC-04:00)乔治敦，拉巴斯，马瑙斯，圣胡安',
			'America/Asuncion'		=>	'(UTC-04:00)亚松森',
			'America/Halifax'		=>	'(UTC-04:00)大西洋时间(加拿大)',
			'America/Cuiaba'		=>	'(UTC-04:00)库亚巴',
			'America/Caracas'		=>	'(UTC-04:30)加拉加斯',
			'America/New_York'		=>	'(UTC-05:00)东部时间(美国和加拿大)',
			'America/Indianapolis'	=>	'(UTC-05:00)印地安那州(东部)',
			'America/Bogota'		=>	'(UTC-05:00)波哥大，利马，基多，里奥布朗库',
			'America/Guatemala'		=>	'(UTC-06:00)中美洲',
			'America/Chicago'		=>	'(UTC-06:00)中部时间(美国和加拿大)',
			'America/Mexico_City'	=>	'(UTC-06:00)瓜达拉哈拉，墨西哥城，蒙特雷',
			'America/Regina'		=>	'(UTC-06:00)萨斯喀彻温',
			'America/Phoenix'		=>	'(UTC-07:00)亚利桑那',
			'America/Chihuahua'		=>	'(UTC-07:00)奇瓦瓦，拉巴斯，马萨特兰',
			'America/Denver'		=>	'(UTC-07:00)山地时间(美国和加拿大)',
			'America/Santa_Isabel'	=>	'(UTC-08:00)下加利福尼亚州',
			'America/Los_Angeles'	=>	'(UTC-08:00)太平洋时间(美国和加拿大)',
			'America/Anchorage'		=>	'(UTC-09:00)阿拉斯加',
			'Pacific/Honolulu'		=>	'(UTC-10:00)夏威夷',
			//'Etc/GMT+11'			=>	'(UTC-11:00)协调世界时-11',
			//'Etc/GMT+12'			=>	'(UTC-12:00)国际日期变更线西',
		);
		return $timelist;
	}
	
}
?>