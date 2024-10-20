<?php
	class PageConfiguration {
		public $navlinks = [];
	}
	$config = new PageConfiguration();

	session_start();

	foreach (glob(dirname(__FILE__)."/../cfg/*.php") as $filename){
		include($filename);
	}

	include(dirname(__FILE__) . "/main.php");
	include(dirname(__FILE__) . "/head.php");
	if(!$noNav)
		include(dirname(__FILE__) . "/nav.php");
	include(dirname(__FILE__) . "/footer.php");
?>