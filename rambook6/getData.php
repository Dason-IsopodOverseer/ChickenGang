<?php declare(strict_types = 1);
if (isset($_GET["uid"])) {
	findElement($_GET["uid"]);
}

function findElement($UID) {
	 // read json file into array of strings
	 $file = "userprofiles.json";
	 
	 // in case there is an error, create a new JSON file
	 if (!file_exists($file)) {
		 file_put_contents("userprofiles.json", "[]");
	 }
	 
	 // read the file
	 $jsonstring = file_get_contents($file);
	 
	  //decode the string from json to PHP array
	 $phparray = json_decode($jsonstring, true);

	foreach ($phparray as $index) {
		 foreach ($index as $key => $value) {
			 if ($key == "UID" && $value == $UID) {
				echo json_encode($index);
			 }
		 }
	}
}
?>