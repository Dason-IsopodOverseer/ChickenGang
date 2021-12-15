<?php
	
	include "functions.php";
	
	$id;
	
	if(isset($_GET["uid"])) {
		$id = intval($_GET["uid"]);
		
	} else {
		header("Location:index.php");
	}
	
	$phpArray = jsonRead("userprofile.json");
	
	foreach ($phpArray as $userData) {
		if ($userData["id"] == $id) {
			echo json_encode($userData, JSON_PRETTY_PRINT);
		}
		
	}
	
	
	
	
	
	
?>