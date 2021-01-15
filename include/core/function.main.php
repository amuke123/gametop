<?php
function mkAutoload($cname) {//自动加载函数
    $cname = strtolower($cname);//转化成小写
    if (file_exists(IDEA_ROOT . '/include/model/' . $cname . '.php')) {
        require_once(IDEA_ROOT . '/include/model/' . $cname . '.php');
    } elseif (file_exists(IDEA_ROOT . '/include/lib/' . $cname . '.php')) {
        require_once(IDEA_ROOT . '/include/lib/' . $cname . '.php');
    } elseif (file_exists(IDEA_ROOT . '/include/control/' . $cname . '.php')) {
        require_once(IDEA_ROOT . '/include/control/' . $cname . '.php');
    } else {
        mkMsg($cname . '加载不存在。');
    }
}


function doStripslashes(){//去除多余的转义字符
    if (get_magic_quotes_gpc()) {
        $_GET = stripslashesDeep($_GET);
        $_POST = stripslashesDeep($_POST);
        $_COOKIE = stripslashesDeep($_COOKIE);
        $_REQUEST = stripslashesDeep($_REQUEST);
    }
}

function stripslashesDeep($value){//递归去除转义字符
    $value = is_array($value) ? array_map('stripslashesDeep', $value) : stripslashes($value);
    return $value;
}

function emDirect($directUrl){
	header("Location:".$directUrl);
	exit;
}

function getGravatar($email,$s =40,$d='mm',$g ='g'){
    $hash = md5($email);
    $avatar = "http://cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
    return $avatar;
}

function getStr($number){//随机不重复字符串$number长度
	$str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890qwertyuiopasdfghjklzxcvbnm";
	$name=substr(str_shuffle($str),16,$number);
	return $name;
}

function getStrSub($str,$strat=10,$num=16){//字符串截取
	return substr($str,$strat,$num);
}

function checkRole(){//权限验证
	if(UID==0){
		Checking::goLogin();
	}else{
		Checking::roleOk(ROLE);
	}
}

function loginOk(){//验证登陆
	if(UID!=0){
		if(ROLE == ROLE_ADMIN){
			Checking::goAdmin();
		}else{
			Checking::goIndex();
		}
	}
}

function get_tq(){//获取天气
	$key='fc7594454747806f7fc523c2ed3df754';
	$city=get_addr($key);
	$cityid=$city['adcode'];
	$weatherURL = "https://restapi.amap.com/v3/weather/weatherInfo?city=$cityid&key=$key";
	$content=file_get_contents($weatherURL);
	$result = json_decode($content,true);
	return $result;
}
function get_addr($key){//获取所在城市
	$weatherURL = "https://restapi.amap.com/v3/ip?key=$key";
	$content=file_get_contents($weatherURL);
	$result = json_decode($content,true);
	return $result;
}

function setUTF8($str){//转化为统一编码;
	$str = iconv("UTF-8", "UCS-2//IGNORE", $str);
	$str = iconv("UCS-2", "UTF-8", $str);
	return $str;
}

function updateCacheAll($tb=null){//更新全部缓存
	$cache=Conn::getCache();
	$cache->updateCache($tb);
}

function getImgPath($tempath){
	$db=Conn::getConnect();
	$topid=getPathTopid($tempath);
	if($topid==0){
		return $tempath;
	}else{
		$sql="SELECT `path` FROM `". DB_PRE ."file` WHERE `id` = '".$topid."';";
		$row=$db->getOnce($sql);
		return $row['path'];
	}
}

function getPathTopid($tempath){
	$db=Conn::getConnect();
	$sql="SELECT `top_id` FROM `". DB_PRE ."file` WHERE `path` = '".$tempath."';";
	$row=$db->getOnce($sql);
	return $row['top_id'];
}

function delAllDirAndFile($path){//删除目录下的所有文件和文件夹
	if(is_dir($path)){
		$p = scandir($path);
		foreach($p as $val){
			if($val !="." && $val !=".."){
				if(is_dir($path.$val)){
					delAllDirAndFile($path.$val.'/');
					@rmdir($path.$val.'/');
				}else{
					unlink($path.$val);
				}
			}
		}
		@rmdir($path);
	}
}

function delFileLine($path){//删除操作
	$db=Conn::getConnect();
	delThem($path);
	$sql="SELECT `id` FROM `". DB_PRE ."file` WHERE `path` = '".$path."';";
	$row=$db->getOnce($sql);
	if(!empty($row['id'])){
		$sql2="SELECT `id`,`path` FROM `". DB_PRE ."file` WHERE `top_id`=".$row['id'];
		$row2=$db->getOnce($sql2);
		if(!empty($row2['id'])){
			delThem($row2['path']);
			$delsql1="delete from `". DB_PRE ."file` where `id`=".$row2['id'];
			$db->query($delsql1);
		}
		$delsql2="delete from `". DB_PRE ."file` where `id`=".$row['id'];
		$db->query($delsql2);
	}
}

function delThem($path){//删除文件
	$tem_path=str_replace('../',IDEA_ROOT.'/',$path);
	if(file_exists($tem_path)){
		unlink($tem_path);
	}
}

function getDir($path){//获取主题
	$dirs=array();
	if(is_dir($path)){
		$data = scandir($path,1);
		foreach($data as $value){
			$newdir=$path.$value;
			if($value!='..'&&$value!='.'){
				if(is_dir($newdir)){$dirs[]=$value;}
			}
		}
	}
	return $dirs;
}

function show_404(){//显示404页面
    if(is_file(TEMPLATE_PATH .'404.php')) {
        header("HTTP/1.1 404 Not Found");
        include View::getView('404');
        exit;
    }else{mkMsg('404',BLOG_URL);}
}

function mkMsg($msg,$url='javascript:history.back(-1);'){
	if ($msg == '404') {
        header("HTTP/1.1 404 Not Found");
        $msg = '抱歉，你所请求的页面不存在！';
    }
	echo '<p>'.$msg.'</p>';
	if ($url != '') {
        echo '<p><a href="'.$url.'"> 点击返回 </a></p>';
    }
}
function checkMail($email){
    if(preg_match("/^[\w\.\-]+@\w+([\.\-]\w+)*\.\w+$/",$email)&&strlen($email)<=80){return true;}else{return false;}
}


function getImg($aid=0){//获取笔记图片
	$imgs=art_Model::getFiles($aid,'image');
	if(!empty($imgs)){
		$src=str_replace('../',IDEA_URL,$imgs[0]['path']);//文章第一张图片附件
	}else{ 
		$src=getRandImg();//随机图片路径
	}
	return $src;
}

function getRandImg(){//获取笔记图片
	$randval=rand(1,30); 
	$src=TEMPLATE_URL .'images/randoms/'.$randval.'.jpg';//随机图片路径
	return $src;
}


function getTag($tagids=''){//获取笔记标签
	$ids=tag_Model::getArtTagList($tagids);
	$str='';
	foreach($ids as $val){
		$str.='<a target="_blank" href="'.Url::tag($val['tagurl']).'">'.$val['tagname'].'</a>';
	}
	return $str;
}

function addAction($hook,$actionFunc){//添加钩子
    global $mkHooks;
    if(!@in_array($actionFunc,$mkHooks[$hook])){
        $mkHooks[$hook][] =$actionFunc;
    }
    return true;
}

function doAction($hook){//调用钩子
    global $mkHooks;
    $args = array_slice(func_get_args(),1);
    if(isset($mkHooks[$hook])){
        foreach($mkHooks[$hook] as $function){
            $string = call_user_func_array($function, $args);
        }
    }
}

function getIps(){//获取用户ip地址
    if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                $ip = $_SERVER["REMOTE_ADDR"];
            } else {
                if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                        "unknown")
                ) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $ip = "unknown";
                }
            }
        }
    }
    return $ip;
}

function getIp(){//获取用户ip地址
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $ip = '';
    }
    return $ip;
}


function baiduTj($url,$key='0IY6JuKdO6j30TdC'){
	$urls = array($url);
	$api = 'http://data.zz.baidu.com/urls?site=www.ideashu.cn&token='.$key;
	$ch = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => implode("\n", $urls),
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);
	//echo $result;
}

function shenmaTj($url,$key='TI_253979fec56560604af8da0bf2f98487'){
	$urls = array($url);
	$api = 'https://data.zhanzhang.sm.cn/push?site=www.ideashu.cn&user_name=amuke123@foxmail.com&resource_name=mip_add&token='.$key;
	$ch = curl_init();
	$options =  array(
		CURLOPT_URL => $api,
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => implode("\n", $urls),
		CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
	);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch);
	//echo $result;
}

?>