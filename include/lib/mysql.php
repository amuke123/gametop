<?php
class Mysql{
	private static $conn;
	public function __construct() {
        if(!function_exists('mysql_connect')){emMsg('服务器空间PHP不支持MySql数据库');}
        self::$conn = @mysql_connect(DB_HOST,DB_USER,DB_PASSWD) or die("数据库链接错误:".iconv('gbk','UTF-8',mysql_errno()));
		if($this->getMysqlVersion() > '4.1') {
            mysql_query("set names 'utf8'",self::$conn);
        }
        @mysql_select_db(DB_NAME,self::$conn) OR emMsg("连接数据库失败，未找到您填写的数据库");
    }
	public static function query($sql=''){
		$result="";
		if($sql!=""){
			$result = mysql_query($sql);
		}
		//mysql_close(self::$conn);
		return $result;
	}
	
	public static function row($result,$one = false,$type = MYSQL_ASSOC){
		if(!empty($result)){
			if($one){return mysql_fetch_array($result,$type);}
			$arr = array();
			if(!empty($result)){
				while($row = mysql_fetch_array($result,$type)){
					$arr[]=$row;
				}
			}
			return $arr;
		}else{return;}
	}
	
	public static function getList($sql){
		$result = self::query($sql);
		$arr = self::row($result);
		return $arr;
	}
	
	public static function getOnce($sql){
		$result = self::query($sql);
		$arr = self::row($result,true);
		return $arr;
	}
	
	public static function close() {
        return mysql_close(self::$conn);
    }
	
	function getMysqlVersion(){
        return mysql_get_server_info();
    }
	public static function last_insert_id(){
		return mysql_insert_id(self::$conn);
	}
}
?>