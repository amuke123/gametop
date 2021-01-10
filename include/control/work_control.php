<?php
/*
**创作中心
*/
class work_Control{

	function display($datas=array()){
		//echo "创作中心<pre>";
		//print_r($datas);
		$system_cache=Control::getAll();
		extract($system_cache);
		
		
		include View::getView('header');
        include View::getView('work');
	}
	
}


?>