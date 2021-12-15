<?php
include "functions.php";

include "header.inc";

include "home.inc";


echo "<pre>";
if(file_exists("userprofile.json")) var_dump(jsonRead("userprofile.json"));
echo "</pre>";

$dir = "profilepic/";

if (is_dir($dir)) {
	if ($dirHandle = opendir($dir)) {
		while (($file = readdir($dirHandle)) !== false) {
			if ($file != '.' && $file != '..') {
				echo "<img src='profilepic/$file'><br>";
			}
		}
		
	}
	
}


include "footer.inc";
?>