<?php
	
	function jsonRead ($json) {
		if(file_exists($json)) {
			$jsonString = file_get_contents($json);
			$phpArray = json_decode($jsonString, true);
			return $phpArray;
		}
		
		
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function countFiles($dir) {
		$fi = new FilesystemIterator($dir);
		return iterator_count($fi);
	}
	
?>