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
	
	function showThumbnails($dir) {
		
		
		
		if (is_dir($dir)) {
			if ($dirHandle = opendir($dir)) {
				while (($file = readdir($dirHandle)) !== false) {
					if (isset($_GET["filter"]) && $_GET["filter"] != "all") {
						return;
						
						
						
			
			
			
					} else if ($file != '.' && $file != '..') {
						echo "<img class='thumbnail' onclick='showBigImg(\"profilepic/$file\")' src='thumbnails/$file'>";
					}//if filter set
				}//read dir
			}//open dir
		}//if dir exist
		
		
		
		
		
		
	}
	
	
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}


?>