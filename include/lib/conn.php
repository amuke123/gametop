<?php
class Conn{
	private static $link = null;
	public static function getConn(){//返回类实例
        if(self::$link == null){self::$link = new Conn();}
        return self::$link;
    }
	public static function getCache(){
        $cache = new Cache();
		return $cache;
    }
	public static function getConnect(){
		if(DB_TYPE=="mysqli"){$mysql = new Mysqlii();}elseif(DB_TYPE=="mysql"){$mysql = new Mysql();}
		return $mysql;
	}
	
	
}

?>