<?php
include_once 'global.php';

$temp = 'plugin';





include View::getViewA('header');
require_once(View::getViewA($temp ));
include View::getViewA('footer');
View::output();

?>