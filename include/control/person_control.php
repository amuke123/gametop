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
		
		
		include View::getView('header');
        include View::getView('person');
	}
	
}


?>