<?php
/*
**设置页面
*/
class setting_Control{

	function display($datas=array()){
		//echo "设置页<pre>";
		//print_r($datas);
		$system_cache=Control::getAll();
		extract($system_cache);
		
		
		include View::getView('header');
        include View::getView('setting');
	}
	
}


?>