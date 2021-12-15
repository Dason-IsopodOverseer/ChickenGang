<?php
	
	function jsonRead ($json) {
		if(file_exists($json)) {
			$jsonString = file_get_contents($json);
			$phpArray = json_decode($jsonString, true);
			return $phpArray;
		}
		
		
	}
	
	
?>