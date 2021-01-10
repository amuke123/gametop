<?php
header('Content-Type:text/html;charset=UTF-8');
include_once 'include/core/amuker.php';

//$upfile=new Upfile();
//$upfile->show();


echo Router::dispatch();

//art_Model::getRandLog();
//echo Checking::checkSendType('14555111925');
//print_r(Control::getActions());
//$db = Conn::getConnect();
//$sql="SELECT * FROM `". DB_PRE ."banner`";
//$links=$db->getOnce($sql);
//echo "<pre>";
//print_r($links);
//echo $db->last_insert_id();
?>
